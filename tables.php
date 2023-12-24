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

  </style>
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
                          <a href='?action=edit&id=" . $row["StudentID"] . "'>Edit</a> | 
                          <a href='?action=delete&id=" . $row["StudentID"] . "'>Delete</a>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='3'>0 results</td></tr>";
      }
      
      // Edit ve Delete işlemleri
      if (isset($_GET['action']) && isset($_GET['id'])) {
        $action = $_GET['action'];
        $studentID = $_GET['id'];
    
        if ($action == 'edit') {
            // Öğrenci verilerini al
            $select = "SELECT * FROM student WHERE StudentID = $studentID";
            $result = $connection->query($select);
    
            if ($result->num_rows > 0) {
                $studentData = $result->fetch_assoc();
                // Düzenleme formunu görüntüle
                echo "<form action='' method='post'>
                        <input type='hidden' name='studentID' value='" . $studentData["StudentID"] . "'>
                        Password: <input type='text' name='password' value='" . $studentData["Password"] . "'><br>
                        <input type='submit' name='update' value='Update'>
                      </form>";
            } else {
                echo "Student not found.";
            }
        } elseif ($action == 'delete') {
            // Öğrenciyi veritabanından sil
            $delete = "DELETE FROM student WHERE StudentID = $studentID";
            $result = $connection->query($delete);
    
            if ($result) {
                echo "Student deleted successfully.";
                // Başarıyla silindiği durumda başka bir sayfaya yönlendir
                header("Location: tables.php");
                exit(); // Kodun devamını engellemek için exit() kullanın
            } else {
                echo "Error deleting student: " . $connection->error;
            }
        }
    }
    
    // Güncelleme işlemi
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $studentID = $_POST['studentID'];
        $password = $_POST['password'];
    
        // Veritabanındaki öğrenci verilerini güncelle
        $update = "UPDATE student SET Password = '$password' WHERE StudentID = $studentID";
        $result = $connection->query($update);
    
        if ($result) {
            echo "Student updated successfully.";
        } else {
            echo "Error updating student: " . $connection->error;
        }
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

      $select = "SELECT * FROM Course";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          echo "<tr><td style='color: white;'>" . $select["CourseID"] . "</td><td style='color: white;'>" . $select["CourseName"] . "</td></tr>";
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
        while ($select = $result->fetch_assoc()) {
          echo "<tr><td>" . $select["StudentID"] . "</td><td>" . $select["Amount"] . "</td><td>" . $select["DueDate"] . "</td><td>" . $select["PaymentStatus"] . "</td></tr>";
        }
      }
      else {
        echo "<tr><td colspan='2'>0 results</td></tr>";
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

      $select = "SELECT * FROM Scholar";
      $result = $connection->query($select);

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          echo "<tr><td>" . $select["StudentID"] . "</td><td>" . $select["Type"] . "</td><td>" . $select["Amount"] . "</td><td>" . $select["ValidityPeriod"] . "</td></tr>";
        }
      }
      else {
        echo "<tr><td colspan='2'>0 results</td></tr>";
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

</body>
</html>