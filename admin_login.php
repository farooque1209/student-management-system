<?php
session_start();
include("db.php");

$error = "";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin 
            WHERE username='$username' 
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1)
    {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    }
    else
    {
        $error = "Invalid Admin Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Admin Login</h1>

<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

</div>

</body>
</html>