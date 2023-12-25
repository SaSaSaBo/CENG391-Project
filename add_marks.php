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
    <title>Add Marks</title>
</head>
<body>

<h2>Add Marks</h2>

<form method="POST" action="">
    <label for="studentID">Student ID:</label>
    <input type="text" id="studentID" name="studentID" required><br>

    <label for="courseID">Course ID:</label>
    <select id="courseID" name="courseID" required>
    <?php
    // Assuming you have a list of courses and their IDs in your database
    include "connection.php";

    $selectCourses = "SELECT CourseID, CourseName FROM course";
    $resultCourses = $connection->query($selectCourses);

    while ($row = $resultCourses->fetch_assoc()) {
        echo "<option value='" . $row["CourseID"] . "'>" . $row["CourseID"] . " - " . $row["CourseName"] . "</option>";
    }

    $connection->close();
    ?>
</select><br>


    <label for="marks">Marks:</label>
    <input type="text" id="marks" name="marks" required><br>

    <label for="grades">Grades:</label>
    <input type="text" id="grades" name="grades" required><br>

    <label for="semester">Semester:</label>
    <input type="text" id="semester" name="semester" required><br>

    <button type="submit" name="submit">Add Marks</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    include "connection.php";

    // Retrieve values from the form
    $studentID = $_POST["studentID"];
    $courseID = $_POST["courseID"]; // Update this line to correctly capture Course ID
    $marks = $_POST["marks"];
    $grades = $_POST["grades"];
    $semester = $_POST["semester"];

    // Insert the data into the Marks table
    $insertQuery = $connection->prepare("INSERT INTO Marks (StudentID, CourseID, Marks, Grades, Semester) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("iisss", $studentID, $courseID, $marks, $grades, $semester);

    if ($insertQuery->execute()) {
        echo "<script>alert('Marks added successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $insertQuery->error . "\\nSQL: " . $insertQuery->errno . " " . $insertQuery->error . "');</script>";
    }

    $insertQuery->close();
    $connection->close();

    // Redirect to tables.php after form submission
    echo "<script>window.location.href = 'tables.php#marksTable';</script>";
}
?>

</body>
</html>
