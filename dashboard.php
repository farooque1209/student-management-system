<?php

session_start();
include "db.php";
if(!isset($_SESSION['username'])){
header("location:login.php");
exit();
} 
$username = $_SESSION['username'];

$sql_student = "SELECT * FROM students WHERE username='$username'";
$result_student = mysqli_query($conn,$sql_student);

$data = mysqli_fetch_assoc($result_student);

$student_course = $data['course'];
$student_sem = $data['semester'];
$sql = "SELECT marks.subject, marks.marks
FROM marks
INNER JOIN subjects
ON LOWER(marks.subject) = LOWER(subjects.subject_name)

WHERE LOWER(marks.username) = LOWER('$username')
AND LOWER(subjects.semester) = LOWER('$student_sem')
AND LOWER(subjects.course) = LOWER('$student_course')";

$result = mysqli_query($conn,$sql);
$total_marks = 0;
$subject_count = 0;

$marks_sql = "SELECT marks FROM marks
              WHERE username='$username'";

$marks_result = mysqli_query($conn,$marks_sql);

while($m = mysqli_fetch_assoc($marks_result))
{
    $total_marks += $m['marks'];
    $subject_count++;
}

if($subject_count > 0)
{
    $percentage = $total_marks / $subject_count;
}
else
{
    $percentage = 0;
}

if($percentage >= 40)
{
    $result_status = "Pass";
}
else
{
    $result_status = "Fail";
}

if($percentage >= 75)
{
    $grade = "A";
}
elseif($percentage >= 60)
{
    $grade = "B";
}
elseif($percentage >= 40)
{
    $grade = "C";
}
else
{
    $grade = "F";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>student Dashbboard</title> 
<link rel="stylesheet" href="style.css">
</head>
<body id="body"> 
<button onclick="toggleDarkMode()" class="dark-btn">
Dark Mode
</button>
<div class="container">
<div class="card"> 
<h2>Dashboard</h2>
<p>
Welcome,<b> 
<?php echo
$_SESSION['username'];?></b>
</p> 


<h3>Your Details</h3>

<p>Roll NO:<?php echo $data['roll_no'];?></p>
<p>Course:<?php echo $data['course'];?></p>
<p>Semester:<?php echo $data['semester']?></p>
<p>Username:<?php echo $data['username']?></p>
<br>
<div class="stats-container">

<div class="stat-card">
<h2><?php echo $total_marks; ?></h2>
<p>Total Marks</p>
</div>

<div class="stat-card">
<h2><?php echo round($percentage,2); ?>%</h2>
<p>Percentage</p>
</div>

<div class="stat-card">
<h2><?php echo $grade; ?></h2>
<p>Grade</p>
</div>

<div class="stat-card">
<h2><?php echo $result_status; ?></h2>
<p>Result</p>
</div>

</div>





<h3>Your Marks</h3>

<table border="1" cellpadding="6">
<tr>
    <th>Subject</th>
    <th>Marks</th>
</tr>

<?php


while ($row = mysqli_fetch_assoc($result)) {
   
echo "<tr style='color:black;'>
        <td>{$row['subject']}</td>
        <td>{$row['marks']}</td>
      </tr>";


}
?>
</table>

<a href="student_attendance.php" class="btn">
My Attendance
</a>
<a href="logout.php"class="logout">Logout</a> 
</div>
</div>
<script>

function toggleDarkMode()
{
    var body = document.getElementById("body");

    if(body.style.background == "black")
    {
        body.style.background = "#f4f6f9";
        body.style.color = "black";
    }
    else
    {
        body.style.background = "black";
        body.style.color = "white";
    }
}

</script>
</body>
</html>