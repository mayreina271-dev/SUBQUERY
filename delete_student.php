<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ✅ Use the correct column name: student_id
    $sql = "DELETE FROM students WHERE student_id = '$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_student.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No student ID provided.";
}
?>
