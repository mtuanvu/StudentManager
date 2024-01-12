<?php
include './config.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT FROM account WHERE username = '?' AND password = '?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit();
    } else {
        die("Error in prepare statement: " . $conn->error);
    }
}

$conn->close();
