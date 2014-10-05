<?php
session_start();

if ( !isset($_SESSION['id']) )
	exit();

if ( !isset($_GET['q']) )
	exit();

$id = $_GET['q'];


if ( !ctype_digit($id) | $id < 0 )
	exit();

$f = glob("images/temp/{$_SESSION['id']}/{$id}.*");

if ( count($f) == 1 )
	unlink($f[0]);


?>