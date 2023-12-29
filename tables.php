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

                    // Silme işlemi
                    if (isset($_POST['delete_button'])) {
                      // Form is submitted, get the id_to_delete value
                      $id_to_delete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : '';
          
                      if (!empty($id_to_delete)) {
                        // Silme sorgusu
                        $sql_delete = "DELETE FROM student WHERE StudentID = $id_to_delete";
                
                        // Sorguyu ekrana yazdır
                        echo "Sorgu: " . $sql_delete . "<br>";
                
                        if ($connection->query($sql_delete) === TRUE) {
                            echo "<script>alert('Student successfully deleted.');</script>";
                        } else {
                            // Hata detaylarını ekrana yazdır
                            echo "Error: " . $connection->error . "<br>";
                            echo "<script>alert('Error deleting course.');</script>";
                        }
                    } else {
                        echo "<script>alert('Invalid CourseID.');</script>";
                    }
                  }

      $select = "SELECT * FROM student";
      $result = $connection->query($select);
      
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td style='color: white;'>" . $row["StudentID"] . "</td>
                  <td style='color: white;'>" . $row["Password"] . "</td>
                  <td>
                      <a href='edit_student.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a>  
                      <a href='delete_student.php?id=" . $row["StudentID"] . "' class='ed'>Delete</a>
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

              // Silme işlemi
              if (isset($_POST['delete_button'])) {
                // Form is submitted, get the id_to_delete value
                $id_to_delete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : '';
    
                if (!empty($id_to_delete)) {
                  // Silme sorgusu
                  $sql_delete = "DELETE FROM course WHERE CourseID = $id_to_delete";
          
                  // Sorguyu ekrana yazdır
                  echo "Sorgu: " . $sql_delete . "<br>";
          
                  if ($connection->query($sql_delete) === TRUE) {
                      echo "<script>alert('Course successfully deleted.');</script>";
                  } else {
                      // Hata detaylarını ekrana yazdır
                      echo "Hata: " . $connection->error . "<br>";
                      echo "<script>alert('Error deleting course.');</script>";
                  }
              } else {
                  echo "<script>alert('Invalid CourseID.');</script>";
              }
            }

      $select = "SELECT * FROM course";
      $result = $connection->query($select);    

      if ($result->num_rows > 0) {
        while ($select = $result->fetch_assoc()) {
          $courseID = isset($row["CourseID"]) ? $row["CourseID"] : '';
          echo "<tr>
          <td style='color: white;'>" . $select["CourseID"] . "</td>
          <td style='color: white;'>" . $select["CourseName"] . "</td>
          <td>
          <a href='delete_course.php?id=" . $select["CourseID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='3'>0 results</td></tr>";
      }


    
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

                    // Silme işlemi
                    if (isset($_POST['delete_button'])) {
                      // Form is submitted, get the id_to_delete value
                      $id_to_delete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : '';
          
                      if (!empty($id_to_delete)) {
                        // Silme sorgusu
                        $sql_delete = "DELETE FROM marks WHERE CourseID = $id_to_delete";
                
                        // Sorguyu ekrana yazdır
                        echo "Sorgu: " . $sql_delete . "<br>";
                
                        if ($connection->query($sql_delete) === TRUE) {
                            echo "<script>alert('Marks successfully deleted.');</script>";
                        } else {
                            // Hata detaylarını ekrana yazdır
                            echo "Hata: " . $connection->error . "<br>";
                            echo "<script>alert('Error deleting marks.');</script>";
                        }
                    } else {
                        echo "<script>alert('Invalid Marks.');</script>";
                    }
                  }

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
          <td>
            <a href='edit_marks.php?id=" . $row["StudentID"] . "' class='edi'>Edit</a>  
            <a href='delete_marks.php?id=" . $row["CourseID"] . "' class='ed'>Delete</a>
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

                    // Silme işlemi
                    if (isset($_POST['delete_button'])) {
                      // Form is submitted, get the id_to_delete value
                      $id_to_delete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : '';
          
                      if (!empty($id_to_delete)) {
                        // Silme sorgusu
                        $sql_delete = "DELETE FROM fee WHERE StudentID = $id_to_delete";
                
                        // Sorguyu ekrana yazdır
                        echo "Sorgu: " . $sql_delete . "<br>";
                
                        if ($connection->query($sql_delete) === TRUE) {
                            echo "<script>alert('Fee informations successfully deleted.');</script>";
                        } else {
                            // Hata detaylarını ekrana yazdır
                            echo "Hata: " . $connection->error . "<br>";
                            echo "<script>alert('Error deleting fee informations.');</script>";
                        }
                    } else {
                        echo "<script>alert('Invalid Fee.');</script>";
                    }
                  }
      

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
            <a href='delete_fee.php?id=" . $row["StudentID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
      }
    
    ?>

  </table>

  <div style="text-align:center;margin-top:20px;"> 
    <button onclick="showAddFeeForm()" class="button">Add Student</button>
  </div>

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

                    // Silme işlemi
                    if (isset($_POST['delete_button'])) {
                      // Form is submitted, get the id_to_delete value
                      $id_to_delete = isset($_POST['id_to_delete']) ? $_POST['id_to_delete'] : '';
          
                      if (!empty($id_to_delete)) {
                        // Silme sorgusu
                        $sql_delete = "DELETE FROM scholar WHERE StudentID = $id_to_delete";
                
                        // Sorguyu ekrana yazdır
                        echo "Sorgu: " . $sql_delete . "<br>";
                
                        if ($connection->query($sql_delete) === TRUE) {
                            echo "<script>alert('Scholarship informations successfully deleted.');</script>";
                        } else {
                            // Hata detaylarını ekrana yazdır
                            echo "Hata: " . $connection->error . "<br>";
                            echo "<script>alert('Error deleting scholarship informations.');</script>";
                        }
                    } else {
                        echo "<script>alert('Invalid Scholarship Information.');</script>";
                    }
                  }

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
            <a href='delete_scholar.php?id=" . $row["StudentID"] . "' class='ed'>Delete</a>
          </td>
          </tr>";
        }
      }
      else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
      }
    
    ?>

  </table>

  <div style="text-align:center;margin-top:20px;"> 
    <button onclick="showAddScholarForm()" class="button">Add Student</button>
  </div>

</div>

<script>
  function showAddStudentForm() {
    // Redirect to the Add Course page
    window.location.href = 'add_student.php'; // Replace 'add_course.php' with the actual URL
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

<script>
  function showAddFeeForm() {
    // Redirect to the Add Course page
    window.location.href = 'add_fee.php'; // Replace 'add_course.php' with the actual URL
  }
</script>

<script>
  function showAddScholarForm() {
    // Redirect to the Add Course page
    window.location.href = 'add_scholar.php'; // Replace 'add_course.php' with the actual URL
  }
</script>

</body>
</html>