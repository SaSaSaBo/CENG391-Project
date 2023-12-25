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

      .tab {
        display: none;
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

      .edi {
        background-color: #ea7500;
        text-decoration: none;
        color: #000;
        padding: 5px 8px;
        border-radius: 8px;
      }

      .ed {
        background-color: #a04545;
        text-decoration: none;
        color: #000;
        padding: 5px 8px;
        border-radius: 8px;
      }

  </style>

  <title>Tables Pages</title>

</head>
<body>

<div style="text-align:center;margin-top:20px;">
  <button onclick="showTab('studentTable')" class="button">Student Table</button>
  <button onclick="showTab('courseTable')" class="button">Course Table</button>
  <button onclick="showTab('marksTable')" class="button">Marks Table</button>
  <button onclick="showTab('feeTable')" class="button">Fee Table</button>
  <button onclick="showTab('scholarshipTable')" class="button">Scholarship Table</button>
  <button onclick="logOut()" class="button">Log Out</button>
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
                      <a href='?action=delete&id=" . $row["StudentID"] . " ". $row["Password"] . " ' class='ed'>Delete</a>
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
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td style='color: white;'>" . $row["CourseID"] . "</td><td style='color: white;'>" . $row["CourseName"] . "</td>
          <td>
          <a href='?action=delete&id=" . $row["CourseID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
      }
      
      }
      else {
        echo "<tr><td colspan='3'>0 results</td></tr>";
      }

      if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && isset($_GET["id"])) {
        $action = $_GET["action"];
        $id = intval($_GET["id"]); // Güvenli bir şekilde integer'a dönüştürme

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        echo "ID: " . $id; // Bu satırı ekleyerek ID değerini kontrol edin

        if ($action === "delete" && $id > 0) {
            // Perform the deletion based on the action and id
            $deleteQuery = $connection->prepare("DELETE FROM Course WHERE CourseID = ?");
            $deleteQuery->bind_param("is", $id);
                      
    
            if ($deleteQuery->execute()) {
              echo "<script>alert('Course deleted successfully');</script>";
          } else {
              echo "<script>alert('Error: " . $deleteQuery->error . "\\nSQL: " . $deleteQuery->errno . " " . $deleteQuery->error . "');</script>";
          }
          
    
            $deleteQuery->close();
    
            // Redirect to the course table page
            echo "<script>window.location.href = 'tables.php#courseTable';</script>";
        }
      }
    
    // Close the database connection
    $connection->close();

    
    
    ?>

  </table>

  <div style="text-align:center;margin-top:20px;"> 
    <button onclick="showAddCourseForm()" class="button">Add Course</button>
  </div>

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

      $select = "SELECT * FROM Marks";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($marksRow = $result->fetch_assoc()) {
          echo "<tr><td>" . $marksRow["StudentID"] . "</td><td>" . $marksRow["CourseID"] . "</td><td>" . $marksRow["Marks"] . "</td><td>" . $marksRow["Grades"] . "</td><td>" . $marksRow["Semester"] . "</td>
          <td>
              <a href='?id=" . $marksRow["StudentID"] . "' class='edi'>Edit</a>
              <a href='?action=delete&id=" . $marksRow["Marks"] . " ". $marksRow["Grades"] . " ' class='ed'>Delete</a>
          </td>
          </tr>";
      }
      
      }
      else {
        echo "<tr><td colspan='6'>0 results</td></tr>";
      }
    
    ?>

  </table>

  <div style="text-align:center;margin-top:20px;"> 
    <button onclick="showAddMarksForm()" class="button">Add Marks</button>
  </div>

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
      $resultFee = $connection->query($select);

      if ($resultFee -> num_rows > 0) {
        while ($feeRow = $resultFee->fetch_assoc()) {
            echo "<tr><td>" . $feeRow["StudentID"] . "</td><td>" . $feeRow["Amount"] . "</td><td>" . $feeRow["DueDate"] . "</td><td>" . $feeRow["PaymentStatus"] . "</td>
            <td>
            <a href='edit_student.php?id=" . $feeRow["DueDate"] . "' class='edi'>Edit</a>
            <a href='?action=delete&id=" . $feeRow["StudentID"] . " ' class='ed'>Delete</a>
            </td>
            </tr>";
        }
    } else {
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

      $select = "SELECT * FROM Scholar";
      $resultScholarship = $connection->query($select);

      if ($resultScholarship->num_rows > 0) {
        while ($scholarshipRow = $resultScholarship->fetch_assoc()) {
            echo "<tr><td>" . $scholarshipRow["StudentID"] . "</td><td>" . $scholarshipRow["Type"] . "</td><td>" . $scholarshipRow["Amount"] . "</td><td>" . $scholarshipRow["ValidityPeriod"] . "</td>
            <td>
            <a href='edit_student.php?id=" . $scholarshipRow["Amount"] . "' class='edi'>Edit</a>
            <a href='?action=delete&id=" . $scholarshipRow["StudentID"] . " ' class='ed'>Delete</a>
            </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
    
    ?>

  </table>
</div>

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

<script>
  function showAddCourseForm() {
    // Redirect to the Add Course page
    window.location.href = 'add_course.php'; // Replace 'add_course.php' with the actual URL
  }
</script>

<script>
  function showAddMarksForm() {
    // Redirect to the Add Course page
    window.location.href = 'add_marks.php'; // Replace 'add_course.php' with the actual URL
  }
</script>


</body>
</html>