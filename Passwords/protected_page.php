
<?php

// How it works:
// 1.) Session Check: The page checks whether the user is logged in by verifying if
//                  $_SESSION['user_id'] exists.
// 2.) Redirect to Login: If the session variable is not set (user not logged in), the
                    user is redirected to login.php.
// 3.) Content Display: You can add uer-specific conent inside this page.  For example
//                  you could query the database to fetch and display the user's name
//                  or other personal details.

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit;
}

// You can fetch user-specific data from the database if needed
// Example: $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
// Example: $stmt->execute([$_SESSION['user_id']]);
// Example: $user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
</head>
<body>
    <h1>Welcome to the Protected Page</h1>

    <!-- You can display user data here if you fetched it from the database -->
    <!-- <p>Hello, <?php echo htmlspecialchars($user['username']); ?>!</p> -->

    <p>This page is only accessible to logged-in users.</p>

    <!-- Logout link -->
    <a href="logout.php">Logout</a>
</body>
</html>


