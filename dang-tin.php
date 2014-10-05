<?php
session_start();

if ( !isset($_SESSION['id']) )
{
	header( 'Location: dang-nhap.php' );
}

header( 'Location: thanh-vien.php?muc=2' );