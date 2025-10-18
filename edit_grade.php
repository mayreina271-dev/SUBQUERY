<?php include 'connect.php'; ?>

<?php
$grade_id = $_GET['grade_id'];
$student_id = $_GET['student_id'];

// Get existing grade
$result = $conn->query("SELECT * FROM grades WHERE grade_id = '$grade_id'");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $subject_name = $_POST['subject_name'];
  $midterm_grade = $_POST['midterm_grade'];
  $final_grade = $_POST['final_grade'];
  $average = ($midterm_grade + $final_grade) / 2;
  $remarks = ($average >= 75) ? 'Passed' : 'Failed';

  $sql = "UPDATE grades SET 
            subject_name='$subject_name',
            midterm_grade='$midterm_grade',
            final_grade='$final_grade',
            average_grade='$average',
            remarks='$remarks'
          WHERE grade_id='$grade_id'";

  if ($conn->query($sql) === TRUE) {
    header("Location: view_grades.php?student_id=$student_id");
    exit();
  } else {
    echo "Error updating record: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Grade</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Edit Grade for Student ID: <?php echo $student_id; ?></h2>
  <form method="POST">
    <label>Subject Name:</label><br>
    <input type="text" name="subject_name" value="<?php echo $row['subject_name']; ?>" required><br><br>

    <label>Midterm Grade:</label><br>
    <input type="number" name="midterm_grade" step="0.01" value="<?php echo $row['midterm_grade']; ?>" required><br><br>

    <label>Final Grade:</label><br>
    <input type="number" name="final_grade" step="0.01" value="<?php echo $row['final_grade']; ?>" required><br><br>

    <button type="submit">Update</button>
  </form>
</body>
</html>
