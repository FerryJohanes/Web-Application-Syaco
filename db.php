<?php 
//Menuliskan
$server="localhost";
$username="root";
$password="";
$db="syaco";

$conn = mysqli_connect($server,$username,$password,$db);
// try {
//     $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     echo "err: " . $e->getMessage();
// }

?>