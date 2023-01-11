<?php

if( isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gym";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM trainers WHERE id=$id";
    $connection->query($sql);
}

header("location: /gym_club/usertrainer.php");
exit;

?>