<?php
class StudentManager
{
    public $conn;
    public function __construct()
    {
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "fptaptechdb";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connecting failed: " . $this->conn->connect_error);
        }
    }
    public function getAllStudent()
    {

        $sql = "SELECT * FROM students";
        $stmp = $this->conn->query($sql);
        $result = $stmp->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function addstudent($id, $name, $address)
    {
        $sql = "INSERT INTO students (id, name, address) VALUES ('$id', '$name', '$address')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }

    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $stmt->close();

        return $row;
    }

    public function updateStudent($id, $name, $address)
    {
        $sql = "UPDATE students SET name=?, address=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $address, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteStudent($id)
    {
        $deleteMarksql = "DELETE FROM marks WHERE student_id = ?";
        $result = $this->conn->prepare($deleteMarksql);
        $result->bind_param("i", $id);
        $result->execute();
        if ($result->affected_rows >= 0) {
            $sql = "DELETE FROM students WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getMarkDetails($student_id)
    {
        $markDetails = [];
        $sql = "SELECT students.id as student_id, students.name as student_name, students.address as student_address, subjects.name as 'subject', marks.mark as 'mark'         FROM students
                INNER JOIN marks ON students.id = marks.student_id
                INNER JOIN subjects ON marks.subject_id = subjects.id
                WHERE students.id = '$student_id'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $markDetails[] = $row;
        }

        $stmt->close();

        return $markDetails;
    }

    public function getAllStudentsWithMarks()
    {
        $students = [];

        $sql = "SELECT students.id , students.name, students.address, marks.mark as 'mark_count'
                FROM students
                LEFT JOIN marks ON students.id = marks.student_id
                GROUP BY students.id, students.name, students.address";

        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }

        return $students;
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
