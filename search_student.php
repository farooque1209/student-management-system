<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:admin_login.php");
    exit();
}

include("db.php");

$search = "";

if(isset($_POST['search']))
{
    $search = $_POST['search_text'];

    $sql = "SELECT * FROM students
            WHERE username LIKE '%$search%'
            OR roll_no LIKE '%$search%'
            OR course LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM students";
}

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Search Student</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
    font-family:Arial;
    padding:20px;
    display:block !important;
}

h1{
    text-align:center;
    margin-bottom:30px;
}

.search-box{
    width:50%;
    margin:auto;
    margin-bottom:30px;
    display:flex;
    gap:10px;
}

.search-box input{
    flex:1;
    padding:12px;
    border:1px solid lightgray;
    border-radius:5px;
}

.search-box button{
    padding:12px 20px;
    background:#007bff;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

table{
    width:95%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    box-shadow:0px 0px 10px lightgray;
}

th{
    background:#007bff;
    color:white;
}

th,td{
    padding:15px;
    border:1px solid #ddd;
    text-align:center;
}

</style>

</head>

<body>

<h1>Search Student</h1>

<form method="POST">

<div class="search-box">

<input type="text"
name="search_text"
placeholder="Search by Username, Roll No or Course">

<button type="submit"
name="search">

Search

</button>

</div>

</form>

<table>

<tr>
<th>ID</th>
<th>Roll No</th>
<th>Username</th>
<th>Course</th>
<th>Semester</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['roll_no']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['course']; ?></td>

<td><?php echo $row['semester']; ?></td>

</tr>

<?php
}
?>

</table>

</body>
</html>