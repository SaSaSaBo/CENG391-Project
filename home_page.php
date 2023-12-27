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

<br>
<br>

<section id="info1">
        <img src="images/okan_srks.png" alt="umldiagram"><br>
        
        <a href="register.php">
            <button class="button">Sign In</button>
        </a>
    </section>


    <div id="copyright" style="position: fixed; bottom: 0; left: 0; padding: 10px; font-size: 10px;">2023 All Rights Reserved</div>

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
