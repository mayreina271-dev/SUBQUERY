<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Fetch student info
    $student_query = $conn->query("SELECT * FROM students WHERE student_id = '$student_id'");
    $student = $student_query->fetch_assoc();

    // Fetch grades if exists
    $grade_query = $conn->query("SELECT * FROM grade WHERE student_id = '$student_id'");
    $grade = $grade_query->fetch_assoc();
}

// Update student
if (isset($_POST['update_student'])) {
    $name = $_POST['name'];
    $course = $_POST['course'];
    $conn->query("UPDATE students SET name='$name', course='$course' WHERE student_id='$student_id'");
    header("Location: index.php");
}

// Add or update grade
if (isset($_POST['save_grade'])) {
    $subject = $_POST['subject'];
    $midterm = $_POST['midterm_grade'];
    $final = $_POST['final_grade'];
    $average = ($midterm + $final) / 2;

    if ($grade) {
        // Update existing grade
        $conn->query("UPDATE grade SET subject_name='$subject', midterm_grade='$midterm', final_grade='$final', average_grade='$average' WHERE student_id='$student_id'");
    } else {
        // Insert new grade
        $conn->query("INSERT INTO grade (student_id, subject_name, midterm_grade, final_grade, average_grade) 
        VALUES ('$student_id', '$subject', '$midterm', '$final', '$average')");
    }
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student & Add Grade</title>
    <style>
        body { font-family: Arial, sans-serif; background: #ffeaea; }
        .container { max-width: 600px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 10px; }
        input[type=text], input[type=number] { width: 100%; padding: 8px; margin: 5px 0 15px; }
        button { background: #800000; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; margin-bottom: 10px; }
        button:hover { background: #a00000; }
        h2 { margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Student</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        <label>Course:</label>
        <input type="text" name="course" value="<?php echo $student['course']; ?>">
        <button type="submit" name="update_student">Update Student</button>
    </form>

    <h2><?php echo $grade ? "Edit Grade" : "Add Grade"; ?></h2>
    <form method="POST">
        <label>Subject:</label>
        <input type="text" name="subject" value="<?php echo $grade ? $grade['subject_name'] : ''; ?>" required>
        <label>Midterm Grade:</label>
        <input type="number" step="0.01" name="midterm_grade" value="<?php echo $grade ? $grade['midterm_grade'] : ''; ?>" required>
        <label>Final Grade:</label>
        <input type="number" step="0.01" name="final_grade" value="<?php echo $grade ? $grade['final_grade'] : ''; ?>" required>
        <button type="submit" name="save_grade"><?php echo $grade ? "Update Grade" : "Add Grade"; ?></button>
    </form>

    <a href="index.php" style="display:block; text-align:center; margin-top:10px; color:#800000;">Back to Dashboard</a>
</div>

</body>
</html>
