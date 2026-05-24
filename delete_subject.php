<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:admin_login.php");
    exit();
}

include("db.php");

$msg = "";

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM subjects
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Subject Deleted Successfully";
    }
    else
    {
        $msg = "Delete Failed";
    }
}

$result = mysqli_query($conn,"SELECT * FROM subjects");

?>

<!DOCTYPE html>
<html>
<head>

<title>Delete Subject</title>

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

table{
    width:95%;
    margin:auto;
    border-collapse:collapse;
    background:white;
    box-shadow:0px 0px 10px lightgray;
    border-radius:10px;
    overflow:hidden;
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

.delete-btn{
    background:red;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:5px;
}

.delete-btn:hover{
    background:darkred;
}

.success{
    text-align:center;
    color:green;
    margin-bottom:20px;
    font-size:18px;
}

</style>

</head>

<body>

<h1>Delete Subject</h1>

<p class="success">
<?php echo $msg; ?>
</p>

<table>

<tr>
<th>ID</th>
<th>Semester</th>
<th>Subject</th>
<th>Course</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['semester']; ?></td>

<td><?php echo $row['subject_name']; ?></td>

<td><?php echo $row['course']; ?></td>

<td>

<a class="delete-btn"
onclick="return confirm('Are you sure?')"
href="delete_subject.php?id=<?php echo $row['id']; ?>">
Delete

</a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>