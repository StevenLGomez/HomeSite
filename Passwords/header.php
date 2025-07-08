
<?php

// How it works:
// 1.) Session Start: Starts the session to check if a user is logged in.
//        (using $_SESSION['user_id'];
// 2.) If the user is logged in links to the protected_page.php and logout.php is shown.
// 3.) CSS Link: A link to an external stylesheet (styles.css) is included.  This must
//        point to your actual CSS file.
// 4.) HTML Structure: Includes the basic structure for a header (<header>) and a 
          navigation bar (<nav>).

// Usage: Use PHP's include() or require() functions.  for example in index.php you could 
//        write:  <?php include('header.php');

// Start the session to access session variables (like logged-in user)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- User is logged in -->
                    <li><a href="protected_page.php">Protected Page</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>


