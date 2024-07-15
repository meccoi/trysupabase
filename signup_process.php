<?php
// Include database connection
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form input (you should implement proper validation)
    $full_name = $_POST['fullname'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Hash the password for security (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query to insert data into 'users' table
    $sql = "INSERT INTO users (full_name, email, date_of_birth, phone_number, nationality, id_number, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters to the SQL query
        $stmt->bind_param("sssssss", $full_name, $email, $dob, $phone, $nationality, $id, $hashed_password);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Data berhasil ditambahkan";
        } else {
            echo "Data gagal ditambahkan: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
} else {
    echo "Form submission error: Method not allowed";
}

// Close database connection
$conn->close();
