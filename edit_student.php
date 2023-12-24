<?php

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $studentID = $_GET["id"];
    
    // Öğrenci bilgilerini veritabanından al
    $select = "SELECT * FROM student WHERE StudentID = $studentID";
    $result = $connection->query($select);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password = $row["Password"];
    } else {
        // Öğrenci bulunamazsa hata mesajı ver
        echo "Öğrenci bulunamadı.";
        exit;
    }
} else {
    // Geçersiz istek durumunda ana tablo sayfasına yönlendir
    header("Location: tables.php#studentTable");
    exit;
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newPassword"];
    
    // Yeni şifreyi güncelle
    $update = "UPDATE student SET Password = '$newPassword' WHERE StudentID = $studentID";

    // Güncelleme sorgusunu doğrulamak için eklenen kod
    if ($newPassword === "") {
        echo "Yeni şifre boş olamaz.";
    } else {
        if ($connection->query($update) === TRUE) {
            // Şifre başarıyla güncellendi
            // Ana tablo sayfasına yönlendir
            header("Location: tables.php#studentTable");
            exit;
        } else {
            // Hata mesajını görmek için eklediğimiz kod
            echo "Hata: " . $connection->error;
        }
    }
}       

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            background-color: #121212;
        }

        h2 {
            color: #ffffff;
        }

        .pw {
            color: #fff;
        }

        .pwtext {
            color: #000;
            border-radius: 5px;
            padding: 10px;
            width: 8%;
        }

        .btn {
            background-color: rgb(201, 131, 10);
            color: #fff;
            padding: 10px 58px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            opacity: 1;
            background-color: rgb(201, 131, 90);
        }

        .tab {
            display: none;
        }

        button {
            background-color: #a04545;
            color: #fff;
            font-size: 16px;
            padding: 10px 14px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #a04545b5;
        }

    </style>

    <title>Edit Password</title>
</head>
<body>

<div style="text-align:center;margin-top:20px;">
    <h2>Edit Password</h2>
    <form method="post" action="">
        <label for="newPassword" class="pw">New Password:</label>
        <input class ="pwtext" id="newPassword" name="newPassword" required>
        <br><br>
        <button type="submit">Update Password</button>
    </form>
    <br>
    <a href="tables.php#studentTable" class="btn">Back</a>
</div>

</body>
</html>
