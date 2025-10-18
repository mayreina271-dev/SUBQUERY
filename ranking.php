<?php
include("connect.php");

$type = $_GET['type'] ?? 'average';

switch ($type) {
  case 'highest':
    $title = "🏆 Highest Grade Rankings";
    $query = "SELECT s.name, g.subject_name, g.average_grade 
              FROM students s 
              JOIN grade g ON s.student_id = g.student_id 
              ORDER BY g.average_grade ASC";
    break;

  case 'lowest':
    $title = "⚠️ Lowest Grade Rankings";
    $query = "SELECT s.name, g.subject_name, g.average_grade 
              FROM students s 
              JOIN grade g ON s.student_id = g.student_id 
              ORDER BY g.average_grade DESC";
    break;

  default:
    $title = "⭐ Average Grade Rankings";
    $query = "SELECT s.name, g.subject_name, g.average_grade 
              FROM students s 
              JOIN grade g ON s.student_id = g.student_id 
              ORDER BY g.average_grade ASC";
    break;
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header><?= $title ?></header>

<div class="container">
  <a href="analytics.php" class="btn">⬅ Back to Analytics</a>

  <table>
    <tr>
      <th>Rank</th>
      <th>Student Name</th>
      <th>Subject</th>
      <th>Average Grade</th>
    </tr>
    <?php
    $rank = 1;
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "
          <tr>
            <td>{$rank}</td>
            <td>{$row['name']}</td>
            <td>{$row['subject_name']}</td>
            <td>{$row['average_grade']}</td>
          </tr>
        ";
        $rank++;
      }
    } else {
      echo "<tr><td colspan='4' style='text-align:center;'>No data found.</td></tr>";
    }
    ?>
  </table>
</div>
</body>
</html>
