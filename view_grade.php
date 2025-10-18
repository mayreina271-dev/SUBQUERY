<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Grades</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>📚 Student Grades</header>

  <div class="container">
    <div class="top-buttons">
      <a href="add_grades.php" class="btn">➕ Add Grade</a>
      <a href="view_student.php" class="btn">👨‍🎓 View Students</a>
      <a href="index.php" class="btn">🏠 Dashboard</a>
    </div>

    <table>
      <tr>
        <th>Student Name</th>
        <th>Subject</th>
        <th>Midterm</th>
        <th>Final</th>
        <th>Average</th>
        <th>Remarks</th>
      </tr>

      <?php
      // Corrected query: use s.name instead of s.student_name
      $sql = "SELECT s.name, g.subject_name, g.midterm_grade, g.final_grade, g.average_grade, g.remarks
              FROM grade g
              JOIN students s ON g.student_id = s.student_id";

      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
          <tr>
            <td>{$row['name']}</td>
            <td>{$row['subject_name']}</td>
            <td>{$row['midterm_grade']}</td>
            <td>{$row['final_grade']}</td>
            <td>{$row['average_grade']}</td>
            <td>{$row['remarks']}</td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No grades found.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
