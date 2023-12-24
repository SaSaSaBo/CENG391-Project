<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="homepage.css">

    <title>HomePage</title>
</head>
<body>
    
    <section id="menu">
        <div id="logo">STUDENT RECORD KEEPING SYSTEM DATABASE</div>
    </section>

        <p>
            <br>
            This project includes a database system created to keep and manage student records. Below is the UML and relational schema information about the project:<br>
            <br>
        </p>

    <section id="info1">
        <p>UML (Unified Modeling Language) Diagram:</p><br>
        <img src="images/umldiagram_skrs.png" alt="umldiagram"><br>
    </section>

            <br>

    <section id="info2">
        <p>Relational Schema:</p>
        <hr>
        <p>
            <p class="tables">1. Student Table:</p>
            <ul>
                <li>Attributes:
                    <ul>
                        <li><code>StudentID</code>(Primary Key)</li>
                        <li><code>Password</code></li>
                    </ul>
                </li>
            </ul>
        </p>
        <br>
        <br>
        <hr>
        <br>
        <p>
            <p class="tables">2. Course Table:</p>
            <ul>
                <li>Attributes:
                    <ul>
                        <li><code>CourseID</code>(Primary Key)</li>
                        <li><code>CourseName</code></li>
                    </ul>
                </li>
            </ul>
        </p>
        <br>
        <br>
        <hr>
        <br>
        <p>
            <p class="tables">3. Marks Table:</p>
            <ul>
                <li>Attributes:
                    <ul>
                        <li><code>StudentID</code>(Foreign Key)</li>
                        <li><code>CourseID</code>(Foreign Key)</li>
                        <li><code>Marks</code></li>
                        <li><code>Grade</code></li>
                        <li><code>Semester</code></li>
                    </ul>
                </li>
            </ul>
        </p>
        <br>
        <br>
        <hr>
        <br>
        <p>
            <p class="tables">4. Fee Table:</p>
            <ul>
                <li>Attributes:
                    <ul>
                        <li><code>StudentID</code>(Foreign Key)</li>
                        <li><code>Amount</code></li>
                        <li><code>DueDate</code></li>
                        <li><code>PaymentStatus</code></li>
                    </ul>
                </li>
            </ul>
        </p>
        <br>
        <br>
        <hr>
        <br>
        <p>
            <p class="tables">5. Concession/Scholarship Table:</p>
            <ul>
                <li>Attributes:
                    <ul>
                        <li><code>StudentID</code> (Foreign Key)</li>
                        <li><code>Type</code></li>
                        <li><code>Amount</code></li>
                        <li><code>ValidityPeriod</code></li>
                    </ul>
                </li>
            </ul>
        </p>
    </section>
<br>
<br>
<br>
<br>

    <a href="register.php">
        <button class="button">Sign In</button>
    </a>

    <a href="login_page.php">
        <button class="button">Log In</button>
    </a>

    <div id="copyright">2023 All Rights Reserved</div>
    <a href="javascript:void(0);" onclick="scrollToSection();" href="#menu"><i class="fa-solid fa-arrow-up" id="up"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <script src="owl/owl.carousel.min.js"></script>

    <script src="owl/script.js"></script>
    <script>
        function scrollToSection() {
            var targetElement = document.getElementById("menu");
            targetElement.scrollIntoView({ behavior: 'smooth' });

        }
    </script>

</body>
</html>
