<?php
// Retrieve form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Validate form data (e.g., check if required fields are not empty, validate email format, etc.)

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Connect to the database (replace with your database credentials)
$dbUsername = 'username';
$dbEmail = 'email';
$dbPassword = 'password';

$conn = new mysqli($dbUsername, $dbEmail, $dbPassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement to insert the user data into the database
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashedPassword);
$stmt->execute();

// Close statement and database connection
$stmt->close();
$conn->close();

// Redirect the user to a success page
header("Location: dashboard.html");
exit();
?>
