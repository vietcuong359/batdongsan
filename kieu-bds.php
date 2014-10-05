<?php
require_once 'ket-noi.php';
if ( !isset( $_GET['q']) )
{
	exit();
}	
else $bds_id = $_GET['q'];

if ( !in_array($bds_id, array("1", "2", "3", "4", "5", "6", "7", "8", "9"), true ))
	exit();

if ( !$res = mysqli_query($conn, "select * from kieu_bds where ma_loai_bds = $bds_id") )
	exit();

while ( $row = mysqli_fetch_array($res) )
{
	echo "<option value='" . $row['ma_kieu_bds'] . "'>" . $row['ten_kieu_bds'] . "</option>";
}



?>