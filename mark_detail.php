<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include "StudentManager.php";

$studentManager = new StudentManager();
$markDetails = $studentManager->getMarkDetails();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Mark Details</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student ID</th>
                    <th>Subject</th>
                    <th>Mark</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($markDetails as $markDetail) : ?>
                    <tr>
                        <td><?php echo $markDetail['student_id']; ?></td>
                        <td><?php echo $markDetail['student_name']; ?></td>
                        <td><?php echo $markDetail['subject']; ?></td>
                        <td><?php echo $markDetail['mark']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>