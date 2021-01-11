<?php
// Procedural mysqli

// Connection details
$host = 'localhost';
session_start();
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$dbms = 'global_plants';

// Create connection 
$conn = mysqli_connect($host, $user, $pass, $dbms);
// Check connection 
if (!$conn) {
    die('Connection Error: ' . mysqli_connect_error());
}
// Optional 
echo 'Connection Established';
