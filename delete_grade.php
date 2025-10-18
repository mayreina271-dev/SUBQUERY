<?php include 'connect.php'; ?>

<?php
$grade_id = $_GET['grade_id'];
$student_id = $_GET['student_id'];

$sql = "DELETE FROM grades WHERE grade_id = '$grade_id'";
if ($conn->query($sql) === TRUE) {
  header("Location: view_grades.php?student_id=$student_id");
  exit();
} else {
  echo "Error deleting record: " . $conn->error;
}
?>
