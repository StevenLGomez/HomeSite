
<?php

// How it works:
// 1.) Session Start: It starts the session to acess the session variables.
// 2.) Unset Session Variables: The session_unset() function removes session variables.
// 3.) Session Destruction: The session_destroy() function destroys the session.
// 4.) Redirect: After logging out, the user is redirected tothe login.php page.
//
// This logout.php file can be in your menu or any other page, linking it with a simple
// logout button or link:
// <a href="logout.php">Logout</a>


// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: login.php");
exit;
?>


