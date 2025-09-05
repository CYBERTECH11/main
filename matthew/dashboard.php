<?php
// dashboard.php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'header.php';
requireLogin();

// Include the admin verification functionality
include 'admin-verification.php';

// Process admin code verification for customer details
$verificationResult = verifyAdminCode();
$showCustomerDetails = $verificationResult['showCustomerDetails'];
$adminCodeError = $verificationResult['adminCodeError'];
$customerDetails = $verificationResult['customerDetails'];

// Process survey submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['survey_submission'])) {
    // Basic validation - check if required fields are filled
    $requiredFields = ['customer_name', 'customer_email'];
    $missingFields = [];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }
    
    if (!empty($missingFields)) {
        $errors[] = "Please fill in all required fields: " . implode(', ', $missingFields);
    } else {
        // Extract and sanitize survey data
        $surveyData = [];
        foreach ($_POST as $key => $value) {
            if ($key !== 'survey_submission') {
                // Handle array values (like checkboxes)
                if (is_array($value)) {
                    $surveyData[$key] = json_encode($value);
                } else {
                    $surveyData[$key] = trim($value);
                }
            }
        }
        
        // Add survey title
        $surveyData['survey_title'] = 'Customer Satisfaction Survey';
        
        try {
            // Prepare SQL statement
            $columns = implode(', ', array_keys($surveyData));
            $placeholders = ':' . implode(', :', array_keys($surveyData));
            
            // Debug output
            error_log("Columns: " . $columns);
            error_log("Data: " . print_r($surveyData, true));
            
            $sql = "INSERT INTO survey_responses (user_id, $columns, submitted_at) VALUES (:user_id, $placeholders, NOW())";
            $stmt = $db->prepare($sql);
            
            // Bind user ID
            $stmt->bindValue(':user_id', $_SESSION['user_id']);
            
            // Bind other values
            foreach ($surveyData as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            
            // Execute query
            if ($stmt->execute()) {
                $success = "Survey submitted successfully! Thank you for your feedback.";
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Survey Submission Failed: " . $errorInfo[2], 3, "logs/database_errors.log");
                $errors[] = "Failed to submit survey. Database error: " . $errorInfo[2];
            }
        } catch (PDOException $e) {
            error_log("Survey Submission Exception: " . $e->getMessage(), 3, "logs/database_errors.log");
            $errors[] = "Survey submission failed. Error: " . $e->getMessage();
        }
    }
}

// Get user's survey history
try {
    $stmt = $db->prepare("SELECT id, survey_title, submitted_at FROM survey_responses WHERE user_id = ? ORDER BY submitted_at DESC");
    $stmt->execute([$_SESSION['user_id']]);
    $surveyHistory = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Survey History Error: " . $e->getMessage(), 3, "logs/database_errors.log");
    $surveyHistory = [];
}

// Debug: Check session variables
echo "<!-- Session Debug: ";
print_r($_SESSION);
echo " -->";
?>

<!-- Your dashboard HTML content -->
<div id="dashboard-container" class="min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 overflow-hidden left-0 w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-16 bg-blue-600">
            <img src="https://via.placeholder.com/150x50?text=B+Modibbo" alt="B Modibbo Enterprise" class="h-10">
        </div>
        <div class="flex flex-col h-full p-4">
            <div class="flex-1 space-y-4">
                <div class="space-y-2">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                    <a href="dashboard.php" id="dashboard-link" class="flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md group nav-link">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                </div>
                
                <div class="space-y-2">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</h3>
                    <div class="pl-4">
                        <details class="group" open>
                            <summary class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer">
                                <i class="fas fa-users mr-3"></i>
                                <span>Manage User</span>
                                <i class="fas fa-chevron-down ml-auto text-xs text-gray-500 group-open:rotate-180"></i>
                            </summary>
                            <div class="mt-1 pl-8 space-y-1">
                                <a href="#" id="customer-details-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">View Customer Details</a>
                                <a href="#" id="contact-customer-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Contact Customer</a>
                            </div>
                        </details>
                        
                        <details class="group" open>
                            <summary class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                <span>Manage Survey</span>
                                <i class="fas fa-chevron-down ml-auto text-xs text-gray-500 group-open:rotate-180"></i>
                            </summary>
                            <div class="mt-1 pl-8 space-y-1">
                                <a href="#" id="view-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">View Survey</a>
                                <a href="#" id="edit-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Edit or Add Survey</a>
                                <a href="#" id="export-survey-link" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md nav-sub-link">Export Survey</a>
                            </div>
                        </details>
                        
                        <a href="#" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md">
                            <i class="fas fa-user-circle mr-3"></i>
                            Admin/Customer Profile
                        </a>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Services</h3>
                    <a href="#" id="survey-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                        <i class="fas fa-clipboard-check mr-3"></i>
                        Take Survey
                    </a>
                    <a href="#" id="products-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Order Products
                    </a>
                    <a href="#" id="about-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                        <i class="fas fa-info-circle mr-3"></i>
                        About Us
                    </a>
                    <a href="#" id="contact-link" class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md group nav-link">
                        <i class="fas fa-envelope mr-3"></i>
                        Contact Us
                    </a>
                </div>
            </div>
            
            <div class="pb-4">
                <div class="flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-200 rounded-md cursor-pointer" id="logout-btn">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64 overflow-y-auto">
        <!-- Top Navigation -->
        <div class="flex items-center justify-between h-16 px-6 bg-white shadow-sm">
            <div class="flex items-center">
                <button class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="flex items-center">
                <div class="relative">
                    <button class="flex items-center text-gray-500 focus:outline-none">
                        <i class="fas fa-bell"></i>
                    </button>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </div>
                
                <div class="ml-4 flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center">
                            <div class="text-sm text-right mr-3">
                                <div class="font-medium text-gray-900"><?php echo htmlspecialchars($_SESSION['name']); ?></div>
                                <div class="text-gray-500"><?php echo htmlspecialchars(ucfirst($_SESSION['user_type'])); ?></div>
                            </div>
                            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-6">
            <div id="dashboard-content">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                    <p class="text-gray-600">WELCOME TO B MODIBBO ENTERPRISE SURVEY AND FEEDBACK SYSTEM</p>
                </div>
                
                <!-- Display errors -->
                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Display success -->
                <?php if (isset($success)): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Rest of your dashboard content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Surveys</p>
                                <h3 class="text-2xl font-bold text-gray-800"><?php echo count($surveyHistory); ?></h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-clipboard-list text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Active Users</p>
                                <h3 class="text-2xl font-bold text-gray-800">342</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-users text-green-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Pending Surveys</p>
                                <h3 class="text-2xl font-bold text-gray-800">56</h3>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Completion Rate</p>
                                <h3 class="text-2xl font-bold text-gray-800">89%</h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-percentage text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Survey history -->
                <?php if (!empty($surveyHistory)): ?>
                <div class="bg-white p-6 rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Your Survey History</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Survey Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submission Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($surveyHistory as $survey): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($survey['survey_title']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($survey['submitted_at']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Quick Actions -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#survey-content" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <i class="fas fa-clipboard-check text-blue-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Take Survey</span>
                        </a>
                        <a href="logout.php" class="flex flex-col items-center justify-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition">
                            <i class="fas fa-sign-out-alt text-red-600 text-2xl mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Survey Content (Hidden by default) -->
            <div id="survey-content" class="hidden">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Customer Satisfaction Survey</h1>
                    <p class="text-gray-600">Please answer all questions honestly. Your feedback is valuable to us.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Progress</span>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                <div id="survey-progress" class="progress-bar bg-blue-600 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                        <span id="progress-text" class="text-sm font-medium text-gray-500">0/4</span>
                    </div>
                    
                    <form id="survey-form" class="space-y-8" method="POST">
                        <input type="hidden" name="survey_submission" value="1">
                        
                        <!-- Section 1: Personal Information -->
                        <div class="survey-section">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 1: Personal Information</h2>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">1. What is your name?</label>
                                <input type="text" name="customer_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">2. What is your email address?</label>
                                <input type="email" name="customer_email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">3. What is your age group?</label>
                                <select name="age_group" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select age group</option>
                                    <option value="Under 18">Under 18</option>
                                    <option value="18-24">18-24</option>
                                    <option value="25-34">25-34</option>
                                    <option value="35-44">35-44</option>
                                    <option value="45-54">45-54</option>
                                    <option value="55-64">55-64</option>
                                    <option value="65 or older">65 or older</option>
                                </select>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">4. What is your gender?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="gender" value="Male" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Male</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="gender" value="Female" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Female</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="gender" value="Other" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Other</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="gender" value="Prefer not to say" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Prefer not to say</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">5. How did you hear about B Modibbo Enterprise?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="hear_about[]" value="Social media" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Social media</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="hear_about[]" value="Word of mouth" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Word of mouth</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="hear_about[]" value="Advertisement" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Advertisement</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="hear_about[]" value="Other" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Other (please specify)</label>
                                    </div>
                                </div>
                                <input type="text" name="hear_about_other" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Specify other">
                            </div>
                        </div>
                        
                        <!-- Section 2: Customer Experience -->
                        <div class="survey-section">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 2: Customer Experience</h2>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">6. How satisfied are you with our products?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="product_satisfaction" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="product_satisfaction" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="product_satisfaction" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="product_satisfaction" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="product_satisfaction" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">7. How would you rate the quality of our products?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Poor</span>
                                        <span>Excellent</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="product_quality" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="product_quality" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="product_quality" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="product_quality" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="product_quality" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">8. How satisfied are you with our customer service?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="service_satisfaction" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="service_satisfaction" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="service_satisfaction" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="service_satisfaction" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="service_satisfaction" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">9. How likely are you to recommend B Modibbo Enterprise to others?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Not at all likely</span>
                                        <span>Extremely likely</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="recommendation" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="recommendation" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="recommendation" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="recommendation" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="recommendation" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">10. What do you like most about our products?</label>
                                <textarea name="likes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">11. What areas do you think we need to improve?</label>
                                <textarea name="improvements" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">12. How often do you purchase from B Modibbo Enterprise?</label>
                                <select name="purchase_frequency" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select frequency</option>
                                    <option value="First time">First time</option>
                                    <option value="Occasionally">Occasionally</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Daily">Daily</option>
                                </select>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">13. What is your preferred method of purchase?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="purchase_method" value="In-store" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">In-store</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="purchase_method" value="Online" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Online</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="purchase_method" value="Phone order" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Phone order</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="purchase_method" value="No preference" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">No preference</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">14. How satisfied are you with our pricing?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="pricing_satisfaction" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="pricing_satisfaction" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="pricing_satisfaction" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="pricing_satisfaction" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="pricing_satisfaction" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">15. Have you experienced any issues with our products?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="product_issues" value="Yes" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="product_issues" value="No" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">No</label>
                                    </div>
                                </div>
                                <div id="issue-details" class="mt-2 hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Please describe the issue:</label>
                                    <textarea name="issue_description" rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 3: Product Specific Questions -->
                        <div class="survey-section">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 3: Product Specific Questions</h2>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">16. Which of our products have you purchased? (Select all that apply)</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="products_purchased[]" value="Agricultural products" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Agricultural products</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="products_purchased[]" value="Construction materials" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Construction materials</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="products_purchased[]" value="Electronics" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Electronics</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="products_purchased[]" value="Household items" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Household items</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="checkbox" name="products_purchased[]" value="Other" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Other (please specify)</label>
                                    </div>
                                </div>
                                <input type="text" name="products_other" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Specify other">
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">17. How satisfied are you with the durability of our products?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="durability_satisfaction" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="durability_satisfaction" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="durability_satisfaction" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="durability_satisfaction" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="durability_satisfaction" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">18. How would you rate the packaging of our products?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Poor</span>
                                        <span>Excellent</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="packaging_rating" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="packaging_rating" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="packaging_rating" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="packaging_rating" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="packaging_rating" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">19. How satisfied are you with the delivery time of our products?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="delivery_satisfaction" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="delivery_satisfaction" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="delivery_satisfaction" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="delivery_satisfaction" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="delivery_satisfaction" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">20. What new products would you like to see from us?</label>
                                <textarea name="new_products" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">21. How often do you use our products?</label>
                                <select name="usage_frequency" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select frequency</option>
                                    <option value="Daily">Daily</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Occasionally">Occasionally</option>
                                    <option value="Rarely">Rarely</option>
                                </select>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">22. Would you be interested in a loyalty program?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="loyalty_program" value="Yes" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="loyalty_program" value="No" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="loyalty_program" value="Maybe" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Maybe</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">23. How important is product variety to you?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Not important</span>
                                        <span>Very important</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="variety_importance" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="variety_importance" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="variety_importance" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="variety_importance" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="variety_importance" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">24. Have you participated in any of our promotional offers?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="promo_participation" value="Yes" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="promo_participation" value="No" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">No</label>
                                    </div>
                                </div>
                                <div id="promo-details" class="mt-2 hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Which promotional offers?</label>
                                    <textarea name="promo_details" rows="2" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">25. How satisfied are you with our return/refund policy?</label>
                                <div class="mt-2">
                                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                                        <span>Very Dissatisfied</span>
                                        <span>Very Satisfied</span>
                                    </div>
                                    <div class="flex space-x-4">
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">1</span>
                                            <input type="radio" name="return_policy" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">2</span>
                                            <input type="radio" name="return_policy" value="2" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">3</span>
                                            <input type="radio" name="return_policy" value="3" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">4</span>
                                            <input type="radio" name="return_policy" value="4" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                        <label class="flex flex-col items-center">
                                            <span class="text-xs mb-1">5</span>
                                            <input type="radio" name="return_policy" value="5" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 4: General Feedback -->
                        <div class="survey-section">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Section 4: General Feedback</h2>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">26. How can we improve your overall experience with B Modibbo Enterprise?</label>
                                <textarea name="experience_improvement" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">27. What additional services would you like us to offer?</label>
                                <textarea name="additional_services" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">28. Do you have any suggestions for our business?</label>
                                <textarea name="suggestions" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">29. Would you be interested in participating in future surveys?</label>
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="future_surveys" value="Yes" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" name="future_surveys" value="No" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                        <label class="ml-2 block text-sm text-gray-700">No</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="survey-question bg-gray-50 p-4 rounded-lg">
                                <label class="block text-sm font-medium text-gray-700 mb-2">30. Any other comments or feedback?</label>
                                <textarea name="comments" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mt-8">
                            <button type="button" id="prev-btn" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hidden">
                                Previous
                            </button>
                            <button type="button" id="next-btn" class="ml-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Next
                            </button>
                            <button type="submit" id="submit-btn" class="ml-auto px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hidden">
                                Submit Survey
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logout functionality
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    }
    
    // Navigation functionality
    const navLinks = document.querySelectorAll('.nav-link, .nav-sub-link');
    const contentSections = document.querySelectorAll('[id$="-content"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.id.replace('-link', '-content');
            
            // Hide all content sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show the target content section
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                targetSection.classList.remove('hidden');
                
                // If it's the survey section, initialize it
                if (targetId === 'survey-content') {
                    initSurvey();
                }
            }
        });
    });
    
    // Survey navigation functionality
    function initSurvey() {
        const surveyForm = document.getElementById('survey-form');
        if (surveyForm) {
            const surveySections = document.querySelectorAll('.survey-section');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            const progressBar = document.getElementById('survey-progress');
            const progressText = document.getElementById('progress-text');
            
            let currentSection = 0;
            
            // Initialize sections
            function showSection(index) {
                surveySections.forEach((section, i) => {
                    section.style.display = i === index ? 'block' : 'none';
                });
                
                // Update buttons
                prevBtn.classList.toggle('hidden', index === 0);
                nextBtn.classList.toggle('hidden', index === surveySections.length - 1);
                submitBtn.classList.toggle('hidden', index !== surveySections.length - 1);
                
                // Update progress
                const progress = ((index + 1) / surveySections.length) * 100;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `${index + 1}/${surveySections.length}`;
            }
            
            // Next button click
            nextBtn.addEventListener('click', () => {
                if (currentSection < surveySections.length - 1) {
                    currentSection++;
                    showSection(currentSection);
                }
            });
            
            // Previous button click
            prevBtn.addEventListener('click', () => {
                if (currentSection > 0) {
                    currentSection--;
                    showSection(currentSection);
                }
            });
            
            // Show issue details when "Yes" is selected for product issues
            const productIssuesYes = document.querySelector('input[name="product_issues"][value="Yes"]');
            const issueDetails = document.getElementById('issue-details');
            
            if (productIssuesYes && issueDetails) {
                productIssuesYes.addEventListener('change', function() {
                    issueDetails.classList.toggle('hidden', !this.checked);
                });
                
                // Also check on page load if "Yes" is already selected
                if (productIssuesYes.checked) {
                    issueDetails.classList.remove('hidden');
                }
            }
            
            // Show promo details when "Yes" is selected for promo participation
            const promoParticipationYes = document.querySelector('input[name="promo_participation"][value="Yes"]');
            const promoDetails = document.getElementById('promo-details');
            
            if (promoParticipationYes && promoDetails) {
                promoParticipationYes.addEventListener('change', function() {
                    promoDetails.classList.toggle('hidden', !this.checked);
                });
                
                // Also check on page load if "Yes" is already selected
                if (promoParticipationYes.checked) {
                    promoDetails.classList.remove('hidden');
                }
            }
            
            // Initialize first section
            showSection(currentSection);
        }
    }
    
    // Initialize survey if we're on the survey page
    if (window.location.hash === '#survey-content') {
        const surveySection = document.getElementById('survey-content');
        if (surveySection) {
            // Hide all content sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show the survey content section
            surveySection.classList.remove('hidden');
            
            // Initialize survey
            initSurvey();
        }
    }
});
</script>

<?php include 'footer.php'; ?>