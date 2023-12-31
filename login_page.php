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

  <button type="submit" class="btn" name="admin_button"  style="float: left; margin-right: 100px; width: 40%;">Admin</button>
  <button type="submit" class="btn" name="student_button"  style="float: left; width: 40%;">Student</button>
</form>

<?php
include "connection.php";

if (isset($_POST['usrnm']) && isset($_POST['psw'])) {
    $username = $_POST['usrnm'];
    $password = $_POST['psw'];

    if (isset($_POST['admin_button'])) {
        // Admin butonuna tıklanmışsa sadece admin tablosunu kontrol et
        $queryAdmin = $connection->prepare("SELECT Password FROM admin WHERE StudentID = ?");
        $queryAdmin->bind_param("s", $username);
        $queryAdmin->execute();
        $queryAdmin->bind_result($adminPlainTextPassword);
        $queryAdmin->fetch();
        $queryAdmin->close();

        if ($adminPlainTextPassword !== null && $password === $adminPlainTextPassword) {
            // Admin girişi başarılı, tables.php'ye yönlendir
            header("Location: tables.php");
            exit();
        } else {
            // Yanlış şifre veya kullanıcı adı
            echo "<script>alert('Admin login failed');</script>";
        }
    } elseif (isset($_POST['student_button'])) {
        // Student butonuna tıklanmışsa sadece student tablosunu kontrol et
        $queryStudent = $connection->prepare("SELECT Password FROM student WHERE StudentID = ?");
        $queryStudent->bind_param("s", $username);
        $queryStudent->execute();
        $queryStudent->bind_result($studentPlainTextPassword);
        $queryStudent->fetch();
        $queryStudent->close();

        if ($studentPlainTextPassword !== null && $password === $studentPlainTextPassword) {
            // Öğrenci girişi başarılı, öğrenci sayfasına yönlendir
            header("Location: student_tables.php");
            exit();
        } else {
            // Yanlış şifre veya kullanıcı adı
            echo "<script>alert('Student login failed');</script>";
        }
    }
}
?>



</body>
</html>
