<?php
include './config.php';
include './StudentManager.php';
$student_id = $_GET['id'];

$student = new StudentManager;
$student->deleteStudent($student_id);
header("location: dashboard.php");
