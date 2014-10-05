<?php
$host="localhost";
$user="root";
$password="";
$database="bds";

$conn= mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($conn, "utf8");

if ( !$conn ) {
	die("Không kết nối được cơ sở dữ liệu");
}
?>