<?php include("connect.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>🎓 Add Student</header>

<div class="container">
  <form action="" method="POST">
    <label>Student Name</label>
    <input type="text" name="name" required>

    <label>Course</label>
    <input type="text" name="course" required>

    <input type="submit" name="submit" value="Add Student">
  </form>

  <a href="index.php" class="back-link">← Back to Dashboard</a>
</div>

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $course = $_POST['course'];

  $sql = "INSERT INTO students (name, course) VALUES ('$name', '$course')";
  if ($conn->query($sql)) {
    echo "<script>alert('✅ Student added successfully!'); window.location='index.php';</script>";
  } else {
    echo "<script>alert('❌ Failed to add student.');</script>";
  }
}
?>
</body>
</html>
