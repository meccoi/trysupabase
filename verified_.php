<?php

include 'admin/db_connect.php';

$email = $_GET['email'];
$code = $_GET['code'];

$sql = "UPDATE users SET verified = 1 WHERE email = '$email' && verify_code = '$code'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['verified_success'] = true;
    header("location: admin/dashboard");
}
