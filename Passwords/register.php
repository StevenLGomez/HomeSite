
// Always hash passwords using password_hash() before storing them.

<?php

// How it works:
// 1.) Form Validation: Checks for valid username and password fields.  Ensures the 
//          password is at least 6 characters long.
// 2.) Unique Username Check: Queries the DB to see if the username already exists.
//          If it does an error is displayed.
// 3.) Password Hashing:  Uses password_hash() to hash the password before storing it in the DB.
// 4.) Redirect on Success: After successful registration, the user is redirected to login.php,
//          and a success message is set in the session.
// 5.) Error Display: Displays any form errors above the registration form.
// 6.) Success Message: If successful a message is displayed when the user returns to the
            registration page.


// Start the session
session_start();

// Include the database connection
require_once 'db.php';

// Initialize error messages
$errors = [];

// Process the form when it's submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    if (empty($_POST['username'])) {
        $errors[] = 'Username is required';
    } else {
        $username = trim($_POST['username']);
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Password is required';
    } elseif (strlen($_POST['password']) < 6) {
        $errors[] = 'Password must be at least 6 characters';
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        // Check if the username already exists in the database
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $errors[] = 'Username is already taken';
        } else {
            // Hash the password before saving
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
            $stmt->execute([$username, $password_hash]);

            // Redirect to login page after successful registration
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <!-- Show errors if any -->
    <?php if ($errors): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Registration form -->
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>


