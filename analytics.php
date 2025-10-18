<?php
include("connect.php");

// Get general stats
$totalStudents = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'];
$totalGrades = $conn->query("SELECT COUNT(*) AS total FROM grade")->fetch_assoc()['total'];
$averageGrade = $conn->query("SELECT AVG(average_grade) AS avg_grade FROM grade")->fetch_assoc()['avg_grade'];
$highestGrade = $conn->query("SELECT MIN(average_grade) AS high_grade FROM grade")->fetch_assoc()['high_grade'];
$lowestGrade = $conn->query("SELECT MAX(average_grade) AS low_grade FROM grade")->fetch_assoc()['low_grade'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📊 Grade Analytics</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #ffe5e5;
    }
    .analytics-box {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: 40px auto;
    }
    .stat {
      margin: 20px 0;
      font-size: 18px;
    }
    .stat a {
      color: #8B0000;
      font-weight: bold;
      text-decoration: none;
    }
    .stat a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>📊 Grade Analytics</header>

<div class="container">
  <a href="index.php" class="btn">⬅ Back to Dashboard</a>

  <div class="analytics-box">
    <div class="stat">👩‍🎓 <strong>Total Students:</strong> <?= $totalStudents ?></div>
    <div class="stat">📘 <strong>Total Grades:</strong> <?= $totalGrades ?></div>

    <div class="stat">⭐ <strong><a href="ranking.php?type=average">Average Grade:</a></strong> <?= number_format($averageGrade, 2) ?></div>
    <div class="stat">🏆 <strong><a href="ranking.php?type=highest">Highest Grade:</a></strong> <?= number_format($highestGrade, 2) ?></div>
    <div class="stat">⚠️ <strong><a href="ranking.php?type=lowest">Lowest Grade:</a></strong> <?= number_format($lowestGrade, 2) ?></div>
  </div>
</div>

</body>
</html>
