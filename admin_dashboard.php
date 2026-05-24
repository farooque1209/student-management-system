<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
}

include("db.php");

$student_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));

$marks_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM marks"));


$subject_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM subjects"));

$attendance_count = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM attendance"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">

    <style>

    .admin-box{
        width:80%;
        margin:auto;
        margin-top:50px;
    }

    .card{
        background:white;
        padding:30px;
        margin:20px;
        border-radius:10px;
        box-shadow:0px 0px 10px lightgray;
    } 

.button-box{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}





    .btn{
background:#007bff;
color:white;
padding:10px 20px;
text-decoration:none;
border-radius:5px;
display:inline-block;
margin:10px;
 }

    .logout{
        background:red;
    }

    </style>

</head>
<body>
<div class="sidebar">

<h2>Admin Panel</h2>

<a href="admin_dashboard.php">Dashboard</a>

<a href="add_student.php">Add Student</a>

<a href="update_student.php">Update Student</a>

<a href="delete_student.php">Delete Student</a>

<a href="add_subject.php">Add Subject</a>

<a href="update_subject.php">Update Subject</a>

<a href="delete_subject.php">Delete Subject</a>

<a href="add_marks.php">Add Marks</a>

<a href="update_marks.php">Update Marks</a>

<a href="delete_marks.php">Delete Marks</a>

<a href="search_student.php">Search Student</a>

<a href="add_attendance.php">Attendance</a>

<a href="logout.php" class="logout-btn">
Logout
</a>

</div>

<div class="main-content">
<div id="admin-text">

<div class="admin-box">

<h1>Admin Dashboard</h1>

<h3>Welcome Admin: <?php echo $_SESSION['admin']; ?></h3>

<a href="delete_student.php" class="card-link">
<div class="card">
    <h2>Total Students</h2>
<h1><?php echo $student_count;?></h1>

</div>
</a>
<a href="delete_marks.php" class="card-link">
<div class="card">
    <h2>Total Marks</h2>
<h1><?php echo $marks_count;?></h1>

</div>
</a>
<a href="delete_subject.php" class="card-link">
<div class="card">
    <h2>Total Subjects</h2>
<h1><?php echo $subject_count;?></h1>

</div>
</a> 
<a href="view_attendance.php" class="card-link">
<div class="card">
    <h2>Total Attendance Records</h2>
<h1><?php echo $attendance_count;?></h1>



</div>
</a>
</div>
</div>
</div>
</body>
</html>