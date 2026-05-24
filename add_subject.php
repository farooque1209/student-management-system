<?php
include("db.php");

$message = "";

if(isset($_POST['add_subject']))
{
    $semester = $_POST['semester'];
    $subject_name = $_POST['subject_name']; 
$course=$_POST['course'];

$sql = "INSERT INTO subjects(semester, subject_name, course)
VALUES('$semester','$subject_name','$course')";
    if(mysqli_query($conn,$sql))
    {
        $message = "Subject Added Successfully";
    }
    else
    {
        $message = "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Add Subject</h1>

<form method="POST">

<select name="semester" required>

<option value="">Select Semester</option>

<option value="1st">1st Semester</option>
<option value="2nd">2nd Semester</option>
<option value="3rd">3rd Semester</option>
<option value="4th">4th Semester</option>
<option value="5th">5th Semester</option>
<option value="6th">6th Semester</option>

</select>

<input type="text"
name="subject_name"
placeholder="Subject Name"
required>

<input type="text"
name="course"
placeholder="Course"
required>
<button type="submit" name="add_subject">
Add Subject
</button>

</form>

<p><?php echo $message; ?></p>

</div>

</body>
</html>