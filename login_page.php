<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="loginpage.css">
<title>Login Page</title>
</head>
<body>

<form action="" method="post" style="max-width:500px;margin:auto">
  <h2 class="register">Login Page</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username / StudentID" name="usrnm" id="username">
  </div>

  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="psw" id="password">
  </div>

  <button type="submit" class="btn">Login</button>
</form>

<?php
include "connection.php";
  
if(isset($_POST['usrnm']) && isset($_POST['psw']))
{
    $username = $_POST['usrnm'];
    $password = $_POST['psw'];

    $query = $connection->prepare("SELECT Password FROM student WHERE StudentID = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $query->bind_result($plainTextPassword);
    $query->fetch();
    $query->close();

    if ($plainTextPassword !== null && $password === $plainTextPassword) {
        // Kullanıcı girişi başarılı, tables.php'ye yönlendir
        header("Location: tables.php");
        exit();
    } else {
        // Yanlış şifre
        echo "<script>alert('Login Failed');</script>";
    }
}

?>

</body>
</html>
