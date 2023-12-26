  <!DOCTYPE html>
  <html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="loginpage.css">
  <style>
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

  .btn:hover {
    opacity: 1;
    background-color: rgba(71, 151, 61, 0.541);
  }

  </style>

  <title>Register Page</title>

  </head>
  <body>



      <form action="register.php" method="post" style="max-width:500px;margin:auto">
          <h2 class="register">Register Page</h2>    
          <a href="login_page.php">
              <button class="button" onclick="goToLoginPage(event)">Log In</button>
          </a>
          <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username / StudentID" name="usrnm">
          </div>

          <div class="input-container">
              <i class="fa fa-key icon"></i>
              <input class="input-field" type="password" placeholder="Password" name="psw">
          </div>

          <button type="submit" class="btn">Register</button>

      </form>

      <script>
        function goToLoginPage(event) {
          event.preventDefault(); // Prevents the default form submission
          window.location.href = "login_page.php";
        }
      </script>

  </body>
  </html>

  <?php
include "connection.php"; // Veritabanı bağlantı scriptini dahil et

if (isset($_POST['usrnm']) && isset($_POST['psw'])) {
    $username = $_POST['usrnm'];
    $password = $_POST['psw']; 

    // Kontrol et: Aynı StudentID ile başka bir öğrenci var mı?
    $checkQuery = $connection->prepare("SELECT * FROM student WHERE StudentID = ?");
    $checkQuery->bind_param("s", $username);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('This StudentID already exists.');</script>";
    } else {
        // Eğer aynı StudentID yoksa ekleme işlemini yap
        $addQuery = $connection->prepare("INSERT INTO student (`StudentID`, `Password`) VALUES (?, ?)");
        $addQuery->bind_param("ss", $username, $password);

        if ($addQuery->execute()) {
            echo "<script>alert('Registration successful');</script>";
            // Yönlendirme işlemi
            echo "<script>window.location.href = 'login_page.php';</script>";
            exit(); // Bu noktada scriptin devam etmesini engelliyoruz
        } else {
            echo "<script>alert('Registration failed');</script>";
        }

        $addQuery->close();
    }

    $checkQuery->close();
} 

$connection->close();
?>
