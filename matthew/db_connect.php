<?php
// db_connect.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create logs directory if it doesn't exist
if (!file_exists('logs')) {
    mkdir('logs', 0777, true);
}

// Database configuration
$host = 'localhost';
$dbname = 'bmodibbo_survey';
$username = 'root';
$password = ''; // Default XAMPP password is empty

try {
    // Create PDO instance
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set PDO attributes for error handling and data fetching
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch(PDOException $e) {
    // Log error to file instead of displaying to users
    error_log("Database Connection Failed: " . $e->getMessage() . "\n", 3, "logs/database_errors.log");
    
    // Display user-friendly error message
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}

/**
 * Function to submit survey responses
 * @param array $surveyData Array containing survey responses
 * @param int $userId User ID submitting the survey
 * @return bool|string Returns true on success, error message on failure
 */
function submitSurvey($surveyData, $userId) {
    global $db;
    
    try {
        // Add survey title and user ID
        $surveyData['survey_title'] = 'Customer Satisfaction Survey';
        $surveyData['user_id'] = $userId;
        
        // Prepare SQL statement
        $columns = implode(', ', array_keys($surveyData));
        $placeholders = ':' . implode(', :', array_keys($surveyData));
        
        $stmt = $db->prepare("INSERT INTO survey_responses ($columns, submitted_at) VALUES ($placeholders, NOW())");
        
        // Bind values
        foreach ($surveyData as $key => $value) {
            // Handle array values (like checkboxes)
            if (is_array($value)) {
                $value = json_encode($value);
            }
            $stmt->bindValue(':' . $key, $value);
        }
        
        // Execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return "Failed to submit survey. Please try again.";
        }
    } catch (PDOException $e) {
        error_log("Survey Submission Error: " . $e->getMessage(), 3, "logs/database_errors.log");
        return "Survey submission failed. Please try again.";
    }
}

/**
 * Function to get user's survey history
 * @param int $userId User ID to retrieve history for
 * @return array Array of survey history records
 */
function getSurveyHistory($userId) {
    global $db;
    
    try {
        $stmt = $db->prepare("SELECT id, survey_title, submitted_at FROM survey_responses WHERE user_id = ? ORDER BY submitted_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Survey History Error: " . $e->getMessage(), 3, "logs/database_errors.log");
        return [];
    }
}

/**
 * Function to check if survey table has all required columns
 * @return bool True if table has all required columns, false otherwise
 */
function checkSurveyTableStructure() {
    global $db;
    
    // List of required columns for the survey
    $requiredColumns = [
        'customer_name', 'customer_email', 'age_group', 'gender', 'hear_about', 
        'hear_about_other', 'product_satisfaction', 'product_quality', 'service_satisfaction',
        'recommendation', 'likes', 'improvements', 'purchase_frequency', 'purchase_method',
        'pricing_satisfaction', 'product_issues', 'issue_description', 'products_purchased',
        'products_other', 'durability_satisfaction', 'packaging_rating', 'delivery_satisfaction',
        'new_products', 'usage_frequency', 'loyalty_program', 'variety_importance',
        'promo_participation', 'promo_details', 'return_policy', 'experience_improvement',
        'additional_services', 'suggestions', 'future_surveys', 'comments'
    ];
    
    try {
        // Get current table structure
        $stmt = $db->query("DESCRIBE survey_responses");
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        // Check if all required columns exist
        foreach ($requiredColumns as $column) {
            if (!in_array($column, $columns)) {
                return false;
            }
        }
        
        return true;
    } catch (PDOException $e) {
        error_log("Table Structure Check Error: " . $e->getMessage(), 3, "logs/database_errors.log");
        return false;
    }
}

/**
 * Function to create or alter survey_responses table with all required columns
 * @return bool True on success, false on failure
 */
function setupSurveyTable() {
    global $db;
    
    try {
        // Check if table exists
        $tableExists = $db->query("SHOW TABLES LIKE 'survey_responses'")->rowCount() > 0;
        
        if (!$tableExists) {
            // Create table if it doesn't exist
            $sql = "CREATE TABLE survey_responses (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id INT(11) NOT NULL,
                survey_title VARCHAR(255) NOT NULL,
                customer_name VARCHAR(255),
                customer_email VARCHAR(255),
                age_group VARCHAR(50),
                gender VARCHAR(50),
                hear_about TEXT,
                hear_about_other VARCHAR(255),
                product_satisfaction INT(1),
                product_quality INT(1),
                service_satisfaction INT(1),
                recommendation INT(1),
                likes TEXT,
                improvements TEXT,
                purchase_frequency VARCHAR(50),
                purchase_method VARCHAR(50),
                pricing_satisfaction INT(1),
                product_issues VARCHAR(10),
                issue_description TEXT,
                products_purchased TEXT,
                products_other VARCHAR(255),
                durability_satisfaction INT(1),
                packaging_rating INT(1),
                delivery_satisfaction INT(1),
                new_products TEXT,
                usage_frequency VARCHAR(50),
                loyalty_program VARCHAR(10),
                variety_importance INT(1),
                promo_participation VARCHAR(10),
                promo_details TEXT,
                return_policy INT(1),
                experience_improvement TEXT,
                additional_services TEXT,
                suggestions TEXT,
                future_surveys VARCHAR(10),
                comments TEXT,
                submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX user_id_index (user_id),
                INDEX submitted_at_index (submitted_at)
            )";
            
            $db->exec($sql);
            return true;
        } else {
            // Table exists, check if we need to add missing columns
            $requiredColumns = [
                'customer_name' => "ALTER TABLE survey_responses ADD COLUMN customer_name VARCHAR(255)",
                'customer_email' => "ALTER TABLE survey_responses ADD COLUMN customer_email VARCHAR(255)",
                'age_group' => "ALTER TABLE survey_responses ADD COLUMN age_group VARCHAR(50)",
                'gender' => "ALTER TABLE survey_responses ADD COLUMN gender VARCHAR(50)",
                'hear_about' => "ALTER TABLE survey_responses ADD COLUMN hear_about TEXT",
                'hear_about_other' => "ALTER TABLE survey_responses ADD COLUMN hear_about_other VARCHAR(255)",
                'product_satisfaction' => "ALTER TABLE survey_responses ADD COLUMN product_satisfaction INT(1)",
                'product_quality' => "ALTER TABLE survey_responses ADD COLUMN product_quality INT(1)",
                'service_satisfaction' => "ALTER TABLE survey_responses ADD COLUMN service_satisfaction INT(1)",
                'recommendation' => "ALTER TABLE survey_responses ADD COLUMN recommendation INT(1)",
                'likes' => "ALTER TABLE survey_responses ADD COLUMN likes TEXT",
                'improvements' => "ALTER TABLE survey_responses ADD COLUMN improvements TEXT",
                'purchase_frequency' => "ALTER TABLE survey_responses ADD COLUMN purchase_frequency VARCHAR(50)",
                'purchase_method' => "ALTER TABLE survey_responses ADD COLUMN purchase_method VARCHAR(50)",
                'pricing_satisfaction' => "ALTER TABLE survey_responses ADD COLUMN pricing_satisfaction INT(1)",
                'product_issues' => "ALTER TABLE survey_responses ADD COLUMN product_issues VARCHAR(10)",
                'issue_description' => "ALTER TABLE survey_responses ADD COLUMN issue_description TEXT",
                'products_purchased' => "ALTER TABLE survey_responses ADD COLUMN products_purchased TEXT",
                'products_other' => "ALTER TABLE survey_responses ADD COLUMN products_other VARCHAR(255)",
                'durability_satisfaction' => "ALTER TABLE survey_responses ADD COLUMN durability_satisfaction INT(1)",
                'packaging_rating' => "ALTER TABLE survey_responses ADD COLUMN packaging_rating INT(1)",
                'delivery_satisfaction' => "ALTER TABLE survey_responses ADD COLUMN delivery_satisfaction INT(1)",
                'new_products' => "ALTER TABLE survey_responses ADD COLUMN new_products TEXT",
                'usage_frequency' => "ALTER TABLE survey_responses ADD COLUMN usage_frequency VARCHAR(50)",
                'loyalty_program' => "ALTER TABLE survey_responses ADD COLUMN loyalty_program VARCHAR(10)",
                'variety_importance' => "ALTER TABLE survey_responses ADD COLUMN variety_importance INT(1)",
                'promo_participation' => "ALTER TABLE survey_responses ADD COLUMN promo_participation VARCHAR(10)",
                'promo_details' => "ALTER TABLE survey_responses ADD COLUMN promo_details TEXT",
                'return_policy' => "ALTER TABLE survey_responses ADD COLUMN return_policy INT(1)",
                'experience_improvement' => "ALTER TABLE survey_responses ADD COLUMN experience_improvement TEXT",
                'additional_services' => "ALTER TABLE survey_responses ADD COLUMN additional_services TEXT",
                'suggestions' => "ALTER TABLE survey_responses ADD COLUMN suggestions TEXT",
                'future_surveys' => "ALTER TABLE survey_responses ADD COLUMN future_surveys VARCHAR(10)",
                'comments' => "ALTER TABLE survey_responses ADD COLUMN comments TEXT"
            ];
            
            // Get current table structure
            $stmt = $db->query("DESCRIBE survey_responses");
            $existingColumns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Add missing columns
            foreach ($requiredColumns as $column => $sql) {
                if (!in_array($column, $existingColumns)) {
                    $db->exec($sql);
                }
            }
            
            return true;
        }
    } catch (PDOException $e) {
        error_log("Table Setup Error: " . $e->getMessage(), 3, "logs/database_errors.log");
        return false;
    }
}

// Automatically check and setup table structure when this file is included
setupSurveyTable();
?>