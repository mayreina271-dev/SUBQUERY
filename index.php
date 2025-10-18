<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🎓 Student Dashboard</title>
  <link rel="stylesheet" href="style.css"> 
</head>
<body>
  <header>🎓 Student Dashboard</header>

  <div class="container">
    <div class="top-buttons">
      <a href="add_student.php" class="btn">+ Add Student</a>
      <a href="add_grade.php" class="btn">+ Add Grade</a>
      <a href="insights.php" class="btn">📊 Grade Insights</a>
      <a href="analytics.php" class="btn">📈 Analytics</a>
    </div>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Course</th>
        <th>Subject</th>
        <th>Average Grade</th>
        <th>Actions</th>
      </tr>
      <?php

      $query = "
        SELECT s.student_id, s.name, s.course, 
               g.subject_name, g.average_grade
        FROM students s
        LEFT JOIN grade g ON s.student_id = g.student_id
      ";

      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
         echo "
  <tr>
    <td>{$row['student_id']}</td>
    <td>{$row['name']}</td>
    <td>" . ($row['course'] ?: 'N/A') . "</td>
    <td>" . ($row['subject_name'] ?: 'N/A') . "</td>
    <td>" . ($row['average_grade'] ?: 'N/A') . "</td>
    <td>
      <a href='edit_student.php?id={$row['student_id']}' class='btn edit-btn'>Edit</a>
      <a href='delete_student.php?id={$row['student_id']}' class='btn delete-btn' onclick='return confirm(\"Are you sure?\")'>Delete</a>
    </td>
  </tr>
";

        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No students found.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
