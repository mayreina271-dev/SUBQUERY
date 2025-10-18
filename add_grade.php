<?php
include("connect.php");

$student_id = $_GET['student_id'] ?? $_POST['student_id'] ?? null;

// Fetch students for dropdown
$students_result = $conn->query("SELECT student_id, name FROM students");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $subject_name = $_POST['subject_name'];
    $midterm_grade = $_POST['midterm_grade'];
    $final_grade = $_POST['final_grade'];

    $average_grade = ($midterm_grade + $final_grade) / 2;
    $remarks = ($average_grade >= 75) ? 'Passed' : 'Failed';

    $sql = "INSERT INTO grade (student_id, subject_name, midterm_grade, final_grade, average_grade, remarks)
            VALUES ($student_id, '$subject_name', $midterm_grade, $final_grade, $average_grade, '$remarks')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Grade</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Add Grade</h2>
    <form method="POST">

      <!-- Student Selection -->
      <?php if (!$student_id): ?>
        <label>Select Student:</label>
        <select name="student_id" required>
          <option value="">-- Select a student --</option>
          <?php while ($student = $students_result->fetch_assoc()): ?>
            <option value="<?= $student['student_id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
          <?php endwhile; ?>
        </select>
      <?php else: ?>
        <input type="hidden" name="student_id" value="<?= htmlspecialchars($student_id) ?>">
      <?php endif; ?>

      <label>Subject Name:</label>
      <input type="text" name="subject_name" required>

      <label>Midterm Grade:</label>
      <input type="number" step="0.01" name="midterm_grade" required>

      <label>Final Grade:</label>
      <input type="number" step="0.01" name="final_grade" required>

      <input type="submit" value="Add Grade">
    </form>

    <a href="index.php" class="btn">⬅ Back to Dashboard</a>
  </div>
</body>
</html>
