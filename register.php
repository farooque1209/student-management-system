<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>

<h2>Student Registration</h2>

<form method="post">

    Name:<br>
    <input type="text" name="name" required><br><br>

    Roll No:<br>
    <input type="text" name="roll" required><br><br>

    Course:<br>
    <input type="text" name="course" required><br><br>

    Semester:<br>
    <input type="text" name="semester" required><br><br>

    Username:<br>
    <input type="text" name="username" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <input type="submit" name="submit" value="Register">

</form>

<?php
// DATABASE CONNECTION
$conn = mysqli_connect("localhost", "root", "", "student_utility");

if (!$conn) {
    die("Database connection failed");
}

// FORM SUBMIT CHECK
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $username = $_POST['username'];
    $password = $_POST['password']; 

$check= "SELECT*FROM students WHERE
username='$username'";
 $result =mysqli_query($conn,$check);
 if(mysqli_num_rows($result)>0){
echo"<p style='color:red'>Usrename already exist</p>";
}

else{


    $sql = "INSERT INTO students 
            (name, roll_no, course, semester, username, password)
            VALUES 
            ('$name', '$roll', '$course', '$semester', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Registration Successful</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
} 
}
?>

</body>
</html>
