<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Fee</title>
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

<!-- Your HTML form for adding a fee -->
<form method="post" action="add_fee.php">
    <label for="studentID">Student ID:</label>
    <input type="text" name="studentID" required>

    <label for="amount">Amount:</label>
    <input type="text" name="amount" required>

    <label for="studentID">Due Date:</label>
    <input type="text" name="date" required>

    <label for="studentID">Payment Status:</label>
    <input type="text" name="payment" required>

    <!-- Add more fields as needed -->

    <button type="submit">Add Fee</button>
</form>

<!-- Add your additional HTML content if needed -->

</body>
</html>

<?php
include "connection.php"; // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentID = $_POST["studentID"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $payment = $_POST["payment"];

    // Add more fields as needed

    // Perform SQL insertion

    $insertQuery = $connection->prepare("INSERT INTO fee (StudentID, Amount, DueDate, PaymentStatus) VALUES (?, ?, ?, ?)");
    $insertQuery->bind_param("isss", $studentID, $amount, $date, $payment);


    if ($insertQuery->execute()) {
        echo "<script>alert('Fee added successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $insertQuery->error . "');</script>";
    }

    $insertQuery->close();

    // Redirect to the fee table page
    echo "<script>window.location.href = 'tables.php#feeTable';</script>";
}

$connection->close();
?>
