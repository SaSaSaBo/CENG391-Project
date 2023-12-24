<!DOCTYPE html>
<html>
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

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      th, td {
        border: 1px solid #ffffffd1;
        text-align: left;
        padding: 8px;
      }

      th {
        background-color: #121212;
        color: #ffffff;
      }

      td {
        background-color: #1c1c1c;
        color: #ffffff;
      }

      tr:nth-child(even) td {
        background-color: #121212;
        color: #ffffff;
      }

      .btn {
        background-color: rgb(201, 131, 20);
        color: rgb(0, 0, 0);
        padding: 15px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      .btn:hover {
        opacity: 1;
      }

    </style>
</head>
<body>

<form action="fee.php" method="post" style="max-width:500px;margin:auto">


<h2>Marks Table</h2>

<table>

  <tr>
    <th>StudentID</th>
    <th>CourseID</th>
    <th>Marks</th>
    <th>Grades</th>
    <th>Semester</th>
  </tr>

  <?php

    include "connection.php";

    $select = "SELECT * FROM Marks";
    $result = $connection->query($select);

    if ($result->num_rows > 0) {
      while ($select = $result->fetch_assoc()) {
        echo "<tr><td>" . $select["StudentID"] . "</td><td>" . $select["CourseID"] . "</td><td>" . $select["Marks"] . "</td><td>" . $select["Grades"] . "</td><td>" . $select["Semester"] . "</td></tr>";
      }
    }
    else {
      echo "<tr><td colspan='2'>0 results</td></tr>";
    }
    

  ?>

</table>

<button type="submit" class="btn">Next</button>
</form>

</body>
</html>