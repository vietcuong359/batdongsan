<?php
session_start();

if ( !isset($_SESSION['id']) )
	exit();

if ( !isset($_GET['q']) | !isset($_GET['ma_tin']) )
	exit();

$id = $_GET['q'];
$ma_tin = $_GET['ma_tin'];


if ( !ctype_digit($id) | $id < 0 | !ctype_digit($ma_tin) | $ma_tin < 0)
	exit();


$f = glob("images/$ma_tin/imgs/$id.*");

if ( count($f) == 1 )
	unlink($f[0]);

$t = glob("images/$ma_tin/thumbs/$id.*");

if ( count($t) == 1 )
	unlink($t[0]);

?>