<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "login_crud";

    $conn = mysqli_connect($server, $username, $password, $db);

    if(!$conn){
        echo "connecton field";
    }
    
    
?>