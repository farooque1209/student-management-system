<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:admin_login.php");
    exit();
}

include("db.php");

$msg = "";

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $subject = $_POST['subject'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance(username,subject,attendance_date,status)
            VALUES('$username','$subject','$attendance_date','$status')";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Attendance Added Successfully";
    }
    else
    {
        $msg = "Failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Attendance</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
    font-family:Arial;
}

.form-box{
    width:400px;
    margin:auto;
    margin-top:50px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0px 0px 10px lightgray;
}

h1{
    text-align:center;
}

input,select{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:1px solid lightgray;
    border-radius:5px;
}

button{
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#0056b3;
}

.success{
    text-align:center;
    color:green;
    margin-top:15px;
}

</style>

</head>

<body>

<div class="form-box">

<h1>Add Attendance</h1>

<form method="POST">

<input type="text"
name="username"
placeholder="Enter Username"
required>

<input type="text"
name="subject"
placeholder="Enter Subject"
required>

<input type="date"
name="attendance_date"
required>

<select name="status" required>

<option value="">Select Status</option>

<option value="Present">Present</option>

<option value="Absent">Absent</option>

</select>

<button type="submit" name="submit">
Add Attendance
</button>

</form>

<p class="success">
<?php echo $msg; ?>
</p>

</div>

</body>
</html>