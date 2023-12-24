<?php

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "srks";

    $connection = mysqli_connect($db_server, $db_username, $db_password, $db_name);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }


?>