<?php
include("db.php");

$msg = "";

if(isset($_POST['submit']))
{
    $username = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];

    $sql = "INSERT INTO marks(username,subject,marks)
            VALUES('$username','$subject','$marks')";

    if(mysqli_query($conn,$sql))
    {
        $msg = "Marks Added Successfully";
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
    <title>Add Marks</title>
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

input{
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

<h1>Add Marks</h1>

<form method="POST">

<input type="text" name="student_id" placeholder="Student ID" required>

<input type="text" name="subject" placeholder="Subject Name" required>

<input type="number" name="marks" placeholder="Marks" required>

<button type="submit" name="submit">
Add Marks
</button>

</form>

<p>
<?php echo $msg; ?>
</p>

</div>

</body>
</html>