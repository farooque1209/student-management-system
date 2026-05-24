<?php 
session_start(); 
if(!isset($_SESSION['admin']))
 {
   header("Location:admin_login.php");
    exit();
}
include("db.php");

$msg = "";

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $marks = $_POST['marks'];

    $sql = "UPDATE marks 
            SET marks='$marks'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Marks Updated Successfully";
    }
    else
    {
        $msg = "Update failed";
    }
}

$result = mysqli_query($conn,"SELECT * FROM marks");
?>

<!DOCTYPE html>
<html>
<head>
<title>Update Marks</title>
<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
    font-family:Arial;
    padding:20px;
}   


h1{
    text-align:center;
    margin-top:30px;
    margin-bottom:20px;
}
table{
    width:95%;
    margin-left:auto; 
    margin-right:auto;
    
    margin-top:40px;
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
    border:1px solid #ddd;
    padding:15px;
    text-align:center;
}

input{
    width:80%;
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
.table-container{

   width:95%;
   margin:auto;


} 

</style>

</head>
<body>

<div class="table-container">

<h1 style="text-align:center;">
Update Marks
</h1>

<p class="success">
<?php echo $msg; ?>
</p>

<table>

<tr>
<th>ID</th>
<th>Username</th>
<th>Subject</th>
<th>Marks</th>
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
<?php echo $row['username']; ?>
</td>

<td>
<?php echo $row['subject']; ?>
</td>

<td>

<input type="number"
name="marks"
value="<?php echo $row['marks']; ?>">

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