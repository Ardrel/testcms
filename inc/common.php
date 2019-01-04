<?php 
session_start();
require("functions.php");

$connection = mysqli_connect('localhost', 'root', '', 'app') or die("Failed to connect to database.");
?>