<!DOCTYPE html>
<html lang="EN">
<head>
<meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="tables.css">
  
    <title>Tables Pages</title>

    <script>
  function showTab(tabId) {
    var tabs = document.getElementsByClassName("tab");
    for (var i = 0; i < tabs.length; i++) {
      tabs[i].style.display = "none";
    }
    document.getElementById(tabId).style.display = "block";
  }
  function logOut() {
    window.location.href = 'home_page.php';
  }
</script>

</head>
<body>

<div style="text-align:center;margin-top:20px;">
  <button type="button" onclick="showTab('studentTable')" class="button">Student Table</button>
  <button type="button" onclick="showTab('courseTable')" class="button">Course Table</button>
  <button type="button" onclick="showTab('marksTable')" class="button">Marks Table</button>
  <button type="button" onclick="showTab('feeTable')" class="button">Fee Table</button>
  <button type="button" onclick="showTab('scholarshipTable')" class="button">Scholarship Table</button>
  <button type="button" onclick="logOut()" class="button">Log Out</button>
</div>

<div class="tab" id="studentTable">
  <h2>Student Table</h2>
  <table>
    <tr>
      <th>StudentID</th>
      <th>Password</th>
    </tr>

    <?php
      include "connection.php";

      $select = "SELECT * FROM student";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $password = str_repeat('*', strlen($row["Password"])); // '*' ile değiştirme
          echo "<tr>
                  <td style='color: white;'>" . $row["StudentID"] . "</td>
                  <td style='color: white;'>" . $password . "</td>
                ";
      }
  } else {
        echo "<tr><td colspan='3'>0 results</td></tr>";
      }
    ?>

  </table>

</div>

<div class="tab" id="courseTable">
  <h2>Course Table</h2>
  <table>
    <tr>
      <th>CourseID</th>
      <th>CourseName</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM course";
      $result = $connection->query($select);    

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          $courseID = isset($row["CourseID"]) ? $row["CourseID"] : '';
          echo "<tr>
          <td style='color: white;'>" . $select["CourseID"] . "</td>
          <td style='color: white;'>" . $select["CourseName"] . "</td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='2'>0 results</td></tr>";
      }


    
    ?>

  </table>



</div>

<div class="tab" id="marksTable">
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

      $select = "SELECT * FROM marks";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>" . $row["StudentID"] . "</td>
          <td>" . $row["CourseID"] . "</td>
          <td>" . $row["Marks"] . "</td>
          <td>" . $row["Grades"] . "</td>
          <td>" . $row["Semester"] . "</td>

          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
      }
    
    ?>

  </table>

</div>

<div class="tab" id="feeTable">
  <h2>Fee Table</h2>
  <table>
    <tr>
      <th>StudentID</th>
      <th>Amount</th>
      <th>DueDate</th>
      <th>PaymentStatus</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM fee";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $amount = str_repeat('*', strlen($row["Amount"]));
          echo "<tr>
          <td>" . $row["StudentID"] . "</td>
          <td style='color: white;'>" . $amount . "</td>
          <td>" . $row["DueDate"] . "</td>
          <td>" . $row["PaymentStatus"] . "</td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
      }
    
    ?>

  </table>


</div>

<div class="tab" id="scholarshipTable">
  <h2>Scholarship Table</h2>
  <table>
    <tr>
      <th>StudentID</th>
      <th>Type</th>
      <th>Amount</th>
      <th>ValidityPeriod</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM scholar";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $amount = str_repeat('*', strlen($row["Amount"]));
          echo "<tr>
          <td>" . $row["StudentID"] . "</td>
          <td>" . $row["Type"] . "</td>
          <td style='color: white;'>" . $amount . "</td>
          <td>" . $row["ValidityPeriod"] . "</td>

          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='4'>0 results</td></tr>";
      }
    
    ?>

  </table>


</div>



</body>
</html>