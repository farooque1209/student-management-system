<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "student_db");

if(!$conn)
{
    die("Connection Failed");
}

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'"; 


    $result = mysqli_query($conn, $sql); 

if(!$result){
    die(mysqli_error($conn));
}
if(mysqli_num_rows($result) > 0)
{
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
}
else
{
    $error = "Invalid username or password";
}
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>
<body>

<h1>Student Login</h1>

<form method="POST"action="">

Username:
<input type="text" name="username"><br><br>

Password:
<input type="password" name="password"><br><br> 
<button type="submit" name="login">Login</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

</body>
</html>