
<?php

// How it works:
// 1.) DB Connection: Uses PDO to connect to DB using the provided credentials.
// 2.) Charset: Sets the charset to utf8mb4, which supports a wider range of characters,
//          including emojis and non-Latin characters.
// 3.) Error Handling: If the connection fails, it catches the exception and displays an error message.
// 4.) PDO Options: Configures PDO to throw exceptions on errors, fetch results as associative 
//          arrays, and disable emulated prepared statesments for security.

// Next Steps:
// 1.) Replace DB Credentials: Make sure to replace the placeholder values ('your_database', 'your_user', 'your_pass)
//           with your actual DB values.
// 2.) Include db.php in Other Scripts: In any PHP script where you need to access the DB, include
//           this file at the top:   
//           require_once 'dd.php';



// Database connection details
$host = 'localhost';       // Database host
$dbname = 'your_database'; // Database name
$username = 'your_user';   // Database username
$password = 'your_pass';   // Database password
$charset = 'utf8mb4';      // Character set

// Set the DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable error reporting
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Fetch results as associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // Disable emulated prepared statements
];

// Try to establish a connection
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Handle errors by displaying a message
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>


