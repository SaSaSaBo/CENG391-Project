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
        // Display alert in JavaScript
        echo "<script>alert('Course added successfully');</script>";
        // Redirect to the course table page
        echo "<script>window.location.href = 'tables.php#courseTable';</script>";
    } else {
        // Display error in JavaScript
        echo "<script>alert('Error: " . $insertQuery . "\\n" . $connection->error . "');</script>";
        // Redirect to the course table page
        echo "<script>window.location.href = 'tables.php#courseTable';</script>";
    }

    // Close the database connection
    $connection->close();
}
?>
