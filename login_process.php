<?php
// Include database connection
include 'db_connect.php';

// Initialize variables to store user input
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// SQL query to retrieve user data based on email
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, verify password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, start session and set session variables
        session_start();
        $_SESSION['id_number'] = $row['id_number'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['full_name'] = $row['full_name'];

        echo "OK";
        exit();
    } else {
        // Password is incorrect
        echo "Invalid password";
    }
} else {
    // User not found
    echo "User not found";
}

// Close database connection
$conn->close();
