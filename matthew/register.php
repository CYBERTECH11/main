<?php
// register.php
include 'header.php';

// Create logs directory if it doesn't exist
if (!file_exists('logs')) {
    mkdir('logs', 0777, true);
}

// Process registration form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if email already exists
    if (empty($errors)) {
        try {
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $errors[] = "Email already registered";
            }
        } catch (PDOException $e) {
            $errorMsg = "Registration Error (Email Check): " . $e->getMessage();
            error_log($errorMsg . "\n", 3, "logs/database_errors.log");
            $errors[] = "Registration failed. Please try again. [Error: DBCHECK]";
        }
    }
    
    // If no errors, create user
    if (empty($errors)) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Updated query to match your database schema
            $stmt = $db->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, 'user')");
            $result = $stmt->execute([$name, $email, $hashedPassword]);
            
            if ($result) {
                $success = "Registration successful! You can now login.";
                // Clear form fields
                $name = $email = '';
                
                // Log successful registration
                error_log("Registration successful for email: $email\n", 3, "logs/registration.log");
            } else {
                $errorInfo = $stmt->errorInfo();
                $errorMsg = "Registration Failed - PDO Error: " . json_encode($errorInfo);
                error_log($errorMsg . "\n", 3, "logs/database_errors.log");
                $errors[] = "Registration failed. Please try again. [Error: INSERT]";
            }
        } catch (PDOException $e) {
            $errorMsg = "Registration Error: " . $e->getMessage();
            error_log($errorMsg . "\n", 3, "logs/database_errors.log");
            $errors[] = "Registration failed. Please try again. [Error: EXCEPTION]";
        }
    }
}
?>

<div id="auth-container" class="min-h-screen flex items-center justify-center gradient-bg">
    <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-lg shadow-xl">
        <div class="text-center">
            <img src="https://via.placeholder.com/150x50?text=B+Modibbo" alt="B Modibbo Enterprise" class="mx-auto h-12">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Register</h2>
            <p class="mt-2 text-sm text-gray-600">Create your account</p>
        </div>
        
        <!-- Display errors -->
        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <!-- Display success -->
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        
        <!-- Register Form -->
        <form method="POST" class="mt-8 space-y-6">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="reg-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="reg-name" name="name" type="text" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                </div>
                <div>
                    <label for="reg-email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input id="reg-email" name="email" type="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                </div>
                <div>
                    <label for="reg-password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="reg-password" name="password" type="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="reg-confirm" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="reg-confirm" name="confirm" type="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="flex items-center">
                <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="terms" class="ml-2 block text-sm text-gray-900">I agree to the <a href="#" class="text-blue-600">terms and conditions</a></label>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Register
                </button>
            </div>
        </form>
        
        <div class="text-center text-sm">
            <a href="login.php" class="font-medium text-blue-600 hover:text-blue-500">Already have an account? Login</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>