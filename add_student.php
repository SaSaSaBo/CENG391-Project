<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            background-color: #121212;
            margin: 0;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h2 {
            color: #ffffff;
            text-align: center;
        }

        form {
            max-width: 400px;
            width: 100%;
            margin: 0 auto; /* Center the form horizontally */
            padding: 20px;
            background-color: #272727;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: floralwhite;
        }

        label {
            display: block;
            margin-top: 10px;
            color: #ffffff;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #1c1c1c;
            color: #ffffff;
            border: 1px solid #ffffffd1;
            border-radius: 4px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
</head>
<body>

<h2>Add Student</h2>

<form method="post" action="add_student.php">
    <label for="studentID">Student ID:</label>
    <input type="text" name="studentID" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <!-- Add more fields as needed -->

    <button type="submit">Add Student</button>
</form>


</body>
</html>

<?php
include "connection.php"; // Veritabanı bağlantı scriptini dahil et

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST["studentID"];
    $password = $_POST["password"];

    // Diğer alanları da ekleyebilirsiniz

    // Kontrol et: Aynı StudentID ile başka bir öğrenci var mı?
    $checkQuery = $connection->prepare("SELECT * FROM student WHERE StudentID = ?");
    $checkQuery->bind_param("s", $studentID);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('This StudentID already exists.');</script>";
    } else {
        // Eğer aynı StudentID yoksa ekleme işlemini yap
        $insertQuery = $connection->prepare("INSERT INTO student (StudentID, Password) VALUES (?, ?)");
        $insertQuery->bind_param("ss", $studentID, $password);

        if ($insertQuery->execute()) {
            echo "<script>alert('Student succesfully added.');</script>";
        } else {
            echo "<script>alert('Error: " . $insertQuery->error . "');</script>";
        }

        $insertQuery->close();

        // Öğrenci tablosu sayfasına yönlendir
        echo "<script>window.location.href = 'tables.php';</script>";
    }

    $checkQuery->close();
}

$connection->close();
?>

