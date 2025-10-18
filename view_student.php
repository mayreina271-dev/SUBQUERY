<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>View Students</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>👨‍🎓 Student List</header>

  <div class="container">
    <div class="top-buttons">
      <a href="add.php" class="btn">➕ Add Student</a>
      <a href="index.php" class="btn">🏠 Dashboard</a>
    </div>

    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>

      <?php
      // Query the students table
      $result = $conn->query("SELECT * FROM students");

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id      = $row['student_id'] ?? '';
          $name    = $row['name'] ?? '';
          $age     = $row['age'] ?? '';
          $gender  = $row['gender'] ?? '';
          $address = $row['address'] ?? '';
          $contact = $row['contact_number'] ?? '';
          $email   = $row['email'] ?? '';

          echo "
          <tr>
            <td>{$id}</td>
            <td>{$name}</td>
            <td>{$age}</td>
            <td>{$gender}</td>
            <td>{$address}</td>
            <td>{$contact}</td>
            <td>{$email}</td>
            <td>
              <a href='edit_student.php?id={$id}' class='btn edit-btn'>✏️ Edit</a>
              <a href='delete_student.php?id={$id}' class='btn delete-btn' onclick=\"return confirm('Are you sure you want to delete this student?')\">🗑️ Delete</a>
              <a href='add_grade.php?student_id={$id}' class='btn'>➕ Add Grade</a>
              <a href='view_grade.php?student_id={$id}' class='btn'>📊 View Grades</a>
            </td>
          </tr>";
        }
      } else {
        echo "<tr><td colspan='8' style='text-align:center;'>No students found.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>
