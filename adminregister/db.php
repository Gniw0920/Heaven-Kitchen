<?php
// Starting the session on whatever page this file is included
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "heaven kitchen";

    // Establish connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Incase connection failes, then the entire script should go down
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }