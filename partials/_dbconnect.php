<?php

/*
//$server = "localhost";
//$username = "phpmyadmin";
//$password = "admin";
//$database = "tests";

//$conn = mysqli_connect($server, $username, $password, $database);
$conn = mysqli_connect("localhost","phpmyadmin","admin","tests");
if (!$conn){
    echo "success";
 }
 else{
    die("Error". mysqli_connect_error());
}
*/

$mysqli = new mysqli("localhost","phpmyadmin","admin","tests");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

/*
else{
    echo "successfully connected to db";
}
*/

?> 