<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["studentID"])) {
    $studentID = intval($_GET["studentID"]);

    $selectQuery = $connection->prepare("SELECT * FROM scholar WHERE StudentID = ?");
    $selectQuery->bind_param("i", $studentID);
    $selectQuery->execute();
    $result = $selectQuery->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $type = $row["Type"];
        $amount = $row["Amount"];
        $validityPeriod = $row["ValidityPeriod"];
    } else {
        echo "<script>alert('No scholar information found for student ID: " . $studentID . "');</script>";
    }

    $selectQuery->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["studentID"])) {
    $studentID = intval($_POST["studentID"]);
    $type = $_POST["newType"];
    $amount = $_POST["newAmount"];
    $validityPeriod = $_POST["newValidityPeriod"];

    $updateQuery = $connection->prepare("UPDATE scholar SET Type=?, Amount=?, ValidityPeriod=? WHERE StudentID=?");

    if ($updateQuery === false) {
        die('Error in preparing the update query: ' . $connection->error);
    }

    $updateQuery->bind_param("sisi", $type, $amount, $validityPeriod, $studentID);

    if ($updateQuery->execute()) {
        echo "<script>alert('Scholarship information updated successfully');</script>";
        header("Location: tables.php");
        exit();
    } else {
        echo "<script>alert('Error: " . $updateQuery->error . "\\nSQL: " . $updateQuery->errno . " " . $updateQuery->error . "');</script>";
    }

    $updateQuery->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>

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
            color: #ffffff;
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


        <h2>Edit Scholarship Information</h2>

        <form method="post" action="">
            <label for="newType">New Type:</label>
            <input type="text" id="newType" name="newType" value="" required>

            <label for="newAmount">New Amount:</label>
            <input type="text" id="newAmount" name="newAmount" value="" required>

            <label for="newValidityPeriod">New ValidityPeriod:</label>
            <input type="date" id="newValidityPeriod" name="newValidityPeriod" value="<?php echo $validityPeriod; ?>" required>

            <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">

            <input type="submit" value="Update Information">
        </form>


</body>

</html>
