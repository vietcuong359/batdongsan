<?php
	require_once 'ket-noi.php';
	require_once 'loi.php';
	
	session_start();
	
	if ( !isset($_SESSION['id']) | !isset($_GET['q']) )
	{
		exit("");
	}
	
	$ma_tin = $_GET['q'];
	$ma_tv = $_SESSION['id'];
	
	if ( ctype_digit($ma_tin) & $ma_tin > 0 )
	{
	
		if ( !$res = mysqli_query($conn, "select count(*) from tin where ma_tin = $ma_tin and ma_thanh_vien = $ma_tv") )
			query_exec_err();
		
		$row = mysqli_fetch_array($res);
		
		if ( $row[0] == "1" )
		{
			if ( !mysqli_query($conn, "delete from tin where ma_tin = " . $ma_tin) )
				query_exec_err();
		}
		
			
	}
	
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	
	rrmdir("images/$ma_tin");
	
?>