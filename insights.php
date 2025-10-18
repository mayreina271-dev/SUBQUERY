<?php include("connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📊 Grade Insights</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>📊 Grade Insights</header>
  <div class="container">
    <a href="index.php" class="btn">🏠 Back to Dashboard</a>

    <h2>Overall Grade Insights</h2>
    <table>
      <tr>
        <th>Average Grade</th>
        <th>Highest Grade</th>
        <th>Lowest Grade</th>
        <th>Total Records</th>
      </tr>
      <?php
$result = $conn->query("
  SELECT
    AVG(average_grade) AS avg_grade,
    MAX(average_grade) AS max_grade,
    MIN(average_grade) AS min_grade,
    COUNT(*) AS total
  FROM grade
");

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo "
  <tr>
    <td>" . number_format($row['avg_grade'], 2) . "</td>
    <td>{$row['max_grade']}</td>
    <td>{$row['min_grade']}</td>
    <td>{$row['total']}</td>
  </tr>";
} else {
  echo "<tr><td colspan='4' style='text-align:center;'>No grade data found.</td></tr>";
}
?>

    </table>

    <h2>Average Grade per Course</h2>
    <table>
      <tr>
        <th>Course</th>
        <th>Average Grade</th>
      </tr>
      <?php
      $course_query = $conn->query("
        SELECT s.course, AVG(g.average_grade) AS avg_grade
FROM grade g
JOIN students s ON g.student_id = s.student_id
GROUP BY s.course;

      ");

      if ($course_query && $course_query->num_rows > 0) {
        while ($row = $course_query->fetch_assoc()) {
          echo "
            <tr>
              <td>{$row['course']}</td>
              <td>" . number_format($row['avg_grade'], 2) . "</td>
            </tr>
          ";
        }
      } else {
        echo "<tr><td colspan='2' style='text-align:center;'>No course grade data available.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
