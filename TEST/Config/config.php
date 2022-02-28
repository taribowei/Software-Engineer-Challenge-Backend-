<?php

$url = "localhost";
$database = "deliverydb";
$username = "root";
$password = "root";	

$conn = mysqli_connect($url, $username, $password, $database);

if(!$conn) {
 die("Unable to connect: " . $conn->connect_error);
}
?>