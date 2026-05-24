<?php
include("db.php");

$msg = "";

if(isset($_POST['update_student']))
{
    $id = $_POST['id'];
    $roll_no = $_POST['roll_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];

    $sql = "UPDATE students SET

    roll_no='$roll_no',
    username='$username',
    password='$password',
    course='$course',
    semester='$semester'

    WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Student Updated Successfully";
    }
    else
    {
        $msg = "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Update Student</title>
<link rel="stylesheet" href="style.css">

<style>

.form-box{
    width:400px;
    margin:auto;
    margin-top:50px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 10px lightgray;
}

input,select{
    width:100%;
    padding:10px;
    margin-top:10px;
}

button{
    margin-top:15px;
    padding:10px 20px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
}

</style>

</head>
<body>

<div class="form-box">

<h1>Update Student</h1>

<form method="POST">

<input type="number"
name="id"
placeholder="Student ID"
required>

<input type="number"
name="roll_no"
placeholder="Roll Number"
required>

<input type="text"
name="username"
placeholder="Username"
required>

<input type="text"
name="password"
placeholder="Password"
required>

<input type="text"
name="course"
placeholder="Course"
required>

<select name="semester" required>

<option value="">Select Semester</option>

<option value="1st">1st Semester</option>
<option value="2nd">2nd Semester</option>
<option value="3rd">3rd Semester</option>
<option value="4th">4th Semester</option>
<option value="5th">5th Semester</option>
<option value="6th">6th Semester</option>

</select>

<button type="submit" name="update_student">
Update Student
</button>

</form>

<p><?php echo $msg; ?></p>

</div>

</body>
</html>