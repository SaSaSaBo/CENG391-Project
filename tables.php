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
      <th>Action</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM student";
      $result = $connection->query($select);
      
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td style='color: white;'>" . $row["StudentID"] . "</td>
                  <td style='color: white;'>" . $row["Password"] . "</td>
                  <td>
                      <a href='edit_student.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a>  
                      <a href='?action=delete&id=" . $row["StudentID"] . "' class='ed'>Delete</a>
                  </td>
                </tr>";
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
      <th>Action</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM course";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          echo "<tr>
          <td style='color: white;'>" . $select["CourseID"] . "</td>
          <td style='color: white;'>" . $select["CourseName"] . "</td>
          <td>
          <a href='?action=delete&id=" . (isset($row["StudentID"]) ? $row["StudentID"] : "") . "' class='ed'>Delete</a>
      </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='3'>0 results</td></tr>";
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
      <th>Action</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM marks";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          echo "<tr>
          <td>" . $select["StudentID"] . "</td>
          <td>" . $select["CourseID"] . "</td>
          <td>" . $select["Marks"] . "</td>
          <td>" . $select["Grades"] . "</td>
          <td>" . $select["Semester"] . "</td>
          <td>
            <a href='edit_marks.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a>  
            <a href='?action=delete&id=" . $row["StudentID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
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
      <th>Action</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM fee";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>" . $row["StudentID"] . "</td>
          <td>" . $row["Amount"] . "</td>
          <td>" . $row["DueDate"] . "</td>
          <td>" . $row["PaymentStatus"] . "</td>
          <td>
            <a href='edit_fee.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a> 
            <a href='?action=delete&id=" . $row["StudentID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
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
      <th>Action</th>
    </tr>

    <?php

      include "connection.php";

      $select = "SELECT * FROM scholar";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
          <td>" . $row["StudentID"] . "</td>
          <td>" . $row["Type"] . "</td>
          <td>" . $row["Amount"] . "</td>
          <td>" . $row["ValidityPeriod"] . "</td>
          <td>
            <a href='edit_scholar.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a> 
            <a href='?action=delete&id=" . $row["StudentID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
      }
    
    ?>

  </table>
</div>



</body>
</html>