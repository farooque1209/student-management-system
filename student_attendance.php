<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location:login.php");
    exit();
}

include("db.php");

$username = $_SESSION['username'];

$sql = "SELECT * FROM attendance
        WHERE username='$username'";

$result = mysqli_query($conn,$sql);

$total_sql = "SELECT COUNT(*) as total
              FROM attendance
              WHERE username='$username'";

$total_result = mysqli_query($conn,$total_sql);

$total_row = mysqli_fetch_assoc($total_result);

$total_classes = $total_row['total'];

$present_sql = "SELECT COUNT(*) as present
                FROM attendance
                WHERE username='$username'
                AND status='Present'";

$present_result = mysqli_query($conn,$present_sql);

$present_row = mysqli_fetch_assoc($present_result);

$total_present = $present_row['present'];

$total_absent = $total_classes - $total_present;

if($total_classes > 0)
{
    $attendance_percentage =
    ($total_present / $total_classes) * 100;
}
else
{
    $attendance_percentage = 0;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>My Attendance</title>

<link rel="stylesheet" href="style.css">

<style>

body{
    background:#f5f6fa;
    font-family:Arial;
    padding:20px;
    display:block!important;
}

h1{
    text-align:center;
    margin-bottom:30px;
}

table{
    width:90%;
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

.present{
    color:green;
    font-weight:bold;
}

.absent{
    color:red;
    font-weight:bold;
}

.stats-container{
    width:90%;
    margin:auto;
    display:flex;
    justify-content:space-between;
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    flex:1;
    background:white;
    padding:20px;
    text-align:center;
    border-radius:10px;
    box-shadow:0px 0px 10px lightgray;
}

.stat-card h2{
    color:#007bff;
    margin-bottom:10px;
}

.stat-card p{
    font-size:18px;
    color:#555;
}




</style>

</head>

<body>

<h1>My Attendance</h1> 
<div class="stats-container">

<div class="stat-card">
<h2><?php echo $total_classes; ?></h2>
<p>Total Classes</p>
</div>

<div class="stat-card">
<h2><?php echo $total_present; ?></h2>
<p>Present</p>
</div>

<div class="stat-card">
<h2><?php echo $total_absent; ?></h2>
<p>Absent</p>
</div>

<div class="stat-card">
<h2>
<?php echo round($attendance_percentage,2); ?>%
</h2>
<p>Attendance</p>
</div>

</div>

<table>

<tr>
<th>ID</th>
<th>Subject</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['subject']; ?>
</td>

<td>
<?php echo $row['attendance_date']; ?>
</td>

<td>

<?php
if($row['status']=="Present")
{
    echo "<span class='present'>Present</span>";
}
else
{
    echo "<span class='absent'>Absent</span>";
}
?>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>