<?php

session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:admin_login.php");
    exit();
}

include("db.php");

$result = mysqli_query($conn,"SELECT * FROM attendance");

?>

<!DOCTYPE html>
<html>
<head>

<title>Attendance Records</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
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

.present{
    color:green;
    font-weight:bold;
}

.absent{
    color:red;
    font-weight:bold;
}

</style>

</head>

<body>

<h1>Attendance Records</h1>

<table>

<tr>
<th>ID</th>
<th>Username</th>
<th>Subject</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td><?php echo $row['attendance_date']; ?></td>

<td class="<?php echo strtolower($row['status']); ?>">
<?php echo $row['status']; ?>
</td>

</tr>

<?php
}
?>

</table>

</body>
</html>