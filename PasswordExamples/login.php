
// login.php

<?php

// How it works:
// 1.) Form Validation: Checks that both username and password are entered.
// 2.) DB Query: Looks up the username in the database.  If found, verifies the password
//               using password_verify().
// 3.) Session Creation: If the password is correct a session is started and the user is
//               redirected to a protected page (protected_page.php).
// 4.) Error Handling: If the credentials are incorrect, an error message is displayed.


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
    } else {
        $password = $_POST['password'];
    }

    if (empty($errors)) {
        // Check if the username exists in the database
        $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $user['id'];
            // Redirect to a protected page
            header("Location: protected_page.php");
            exit;
        } else {
            $errors[] = 'Invalid username or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <!-- Show errors if any -->
    <?php if ($errors): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Login form -->
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>


