<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = intval($id);
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        
        // Bağlantıyı kontrol et
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $selectQuery = $connection->prepare("SELECT * FROM fee WHERE StudentID = ?");
        $selectQuery->bind_param("i", $id);
        $selectQuery->execute();

        // Result setini al
        $result = $selectQuery->get_result();

        // Result setini kontrol et
        if ($result === false) {
            die("Query failed: " . $selectQuery->error);
        }

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $studentID = $student["StudentID"];
            $amount = $student["Amount"];
            $dueDate = $student["DueDate"];
            $paymentStatus = $student["PaymentStatus"];
        } else {
            echo "No fee found.";
            exit;
        }

        // Kullanılan kaynakları serbest bırak
        $result->close();
        $selectQuery->close();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newAmount"]) && isset($_POST["newDueDate"]) && isset($_POST["newPaymentStatus"]) && isset($_POST["studentID"])) {
        $newAmount = $_POST["newAmount"];
        $newDueDate = $_POST["newDueDate"];
        $newPaymentStatus = $_POST["newPaymentStatus"];
        $studentID = $_POST["studentID"];

        $updateQuery = $connection->prepare("UPDATE fee SET Amount=?, DueDate=?, PaymentStatus=? WHERE StudentID=?");
        $updateQuery->bind_param("siii", $newAmount, $newDueDate, $newPaymentStatus, $studentID);
         
        if ($updateQuery->execute()) {
            header("Location: tables.php");
            exit;
        } else {
            echo "<script>alert('Error: " . $updateQuery->error . "\\nSQL: " . $updateQuery->errno . " " . $updateQuery->error . "');</script>";
        }

        $updateQuery->close();
    } else {
        echo "Invalid request.";
        exit;
    }
}

$connection->close();
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

    <h2>Edit Fee Information</h2>

    <form method="post" action="">
        <label for="newAmount">New Amount:</label>
        <input type="text" id="newAmount" name="newAmount" value="<?php echo $amount; ?>" required>
        
        <label for="newDueDate">New Due Date:</label>
        <input type="date" id="newDueDate" name="newDueDate" value="<?php echo $dueDate; ?>" required>

        <label for="newPaymentStatus">New Payment Status:</label>
        <input type="text" id="newPaymentStatus" name="newPaymentStatus" value="<?php echo $paymentStatus; ?>" required>

        <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">

        <input type="submit" value="Update Information">
    </form>

    <!-- İhtiyacınıza göre diğer HTML içeriğini ekleyebilirsiniz -->

</body>

</html>
