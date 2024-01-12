<?php
include './config.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO account (username, password) VALUES ('$username', '$password')";
