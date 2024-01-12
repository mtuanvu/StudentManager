<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include "./StudentManager.php";

$students = new StudentManager();


$students = $studentManager->getAllStudentsWithMarks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Wellcome <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is the main page after successful login.</p>

        <a href="Logout.php" class="btn btn -danger">Logout</a>

        <h3>Student List</h3>
        <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Action</th>
                    <th>Marks Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['address']; ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">Add</a>
                            <a href="delete_student.php?id=<?php echo $student['id']; ?>" class="btn btn-primary" onclick="return comfirm('Are you sure you want to delete this student')">Delete</a>
                        </td>
                        <td>
                            <?php
                            if ($student['mark_count'] > 0) {
                                echo '<a href="mark_detail.php?student_id=' . $student['id'] . '" class="btn btn-info btn-sm">Mark Details.</a>';
                            } else {
                                echo '<button class="btn btn-info btn-sm" disabled>Mark Details</button>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>