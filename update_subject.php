<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: admin_login.php");
    exit();
}

include("db.php");

$msg = "";

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $semester = $_POST['semester'];
    $subject_name = $_POST['subject_name'];
    $course = $_POST['course'];

    $sql = "UPDATE subjects 
            SET semester='$semester',
                subject_name='$subject_name',
                course='$course'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Subject Updated Successfully";
    }
    else
    {
        $msg = "Update Failed";
    }
}

$result = mysqli_query($conn,"SELECT * FROM subjects");

?>

<!DOCTYPE html>
<html>
<head>

<title>Update Subject</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
    font-family:Arial;
} 

h1{
    text-align:center;
    margin-top:30px;
}

.table-container{
    width:95%;
    margin:auto;
    margin-top:30px;
}

table{

th{
    background:#007bff;
    color:white;
}

th,td{
    border:1px solid #ddd;
    padding:15px;
    text-align:center;
}

input,select{
    width:90%;
    padding:10px;
    border:1px solid lightgray;
    border-radius:5px;
}

button{
    background:#007bff;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#0056b3;
}

.success{
    text-align:center;
    color:green;
    font-size:18px;
    margin-top:15px;
}

</style>


</head>

<body>  

<div class="table-container">

<h1>
Update Subject
</h1>

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

<form method="POST">

<td>

<?php echo $row['id']; ?>

<input type="hidden"
name="id"
value="<?php echo $row['id']; ?>">

</td>

<td>

<select name="semester">

<option value="1st">1st</option>
<option value="2nd">2nd</option>
<option value="3rd">3rd</option>
<option value="4th">4th</option>
<option value="5th">5th</option>
<option value="6th">6th</option>

</select>

</td>

<td>

<input type="text"
name="subject_name"
value="<?php echo $row['subject_name']; ?>">

</td>

<td>

<input type="text"
name="course"
value="<?php echo $row['course']; ?>">

</td>

<td>

<button type="submit"
name="update">
Update
</button>

</td>

</form>

</tr>

<?php
}
?>

</table> 
</div>

</body>
</html>