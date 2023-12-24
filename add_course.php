<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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
            margin-bottom: 8px;
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

<h2>Add Course</h2>

<form action="process_add_course.php" method="post" class="form">
    <!-- You can customize the form fields as needed -->
    <label for="courseID">Course ID:</label>
    <input type="text" id="courseID" name="courseID" required>

    <label for="courseName">Course Name:</label>
    <input type="text" id="courseName" name="courseName" required>
<br>
    <button type="submit" class="button">Add Course</button>
</form>

<!-- Include your JavaScript if needed -->

</body>
</html>

<?php
// Include your database connection file
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $courseID = $_POST["courseID"];
    $courseName = $_POST["courseName"];

    // Perform the database insertion (replace table_name with your actual table name)
    $insertQuery = "INSERT INTO Course (CourseID, CourseName) VALUES ('$courseID', '$courseName')";
    
    if ($connection->query($insertQuery) === TRUE) {
        echo "Course added successfully";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $connection->error;
    }

    // Close the database connection
    $connection->close();
}
?>
