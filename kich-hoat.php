<?php

require_once 'ket-noi.php';
require_once 'loi.php';
session_start();

if ( isset($_SESSION['id']) )
{
	echo "<script>location.href='dang-xuat.php'</script>";
	exit();
}

if ( !empty($_GET['k']) and !empty($_GET['e']) )
{
	$k = $_GET['k']; $e = urldecode(base64_decode($_GET['e']));
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	
	$curr_date = date("Y-m-d H:i:s",time());
	
	$sql1 = "select ma_thanh_vien, ma_trang_thai, ten_dang_nhap, ho_ten from thanh_vien where email = '" .  mysqli_real_escape_string($conn, $e) . "'";
	
	if ( !$result1 = mysqli_query($conn, $sql1 ) )
		query_exec_err();
	
	if ( $row1 = mysqli_fetch_array($result1) )
	{
		if ( $row1['ma_trang_thai'] > 1 )
		{
			echo "<h2 align='center'>Bạn đã kích hoạt tài khoản trước đây. Không thể kích hoạt thêm!";
			echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";
			exit();
		}
		
		$sql2 = "select * from khoa_kich_hoat where ma_thanh_vien = " . $row1['ma_thanh_vien'] . " and khoa = '" .  mysqli_real_escape_string($conn, $k) . "'";
		
		if ( !$result2 = mysqli_query($conn, $sql2) )
			query_exec_err();
		
		if ( $row2 = mysqli_fetch_array($result2) )
		{
			//start transaction
			if (!mysqli_query($conn,'START TRANSACTION'))
				query_exec_err();
			
			$sql4 = "delete from khoa_kich_hoat where ma_thanh_vien =  " . $row1['ma_thanh_vien'];
			
			if ( !mysqli_query($conn, $sql4) )
			{
				query_exec_err();
			}
			
			$sql3 = "update thanh_vien set ma_trang_thai = 2 where ma_thanh_vien = " . $row1['ma_thanh_vien'];
			
			if ( !mysqli_query($conn, $sql3) )
			{
				echo "<h2 align='center'>Chưa kích hoạt được tài khoản được lúc này. Bạn vui lòng thử lại sau!</h2>";
				echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";
				exit();
			}
				
			if (!mysqli_query($conn,'COMMIT'))
				query_exec_err();
			// end transaction
			
			$_SESSION['id'] = $row1['ma_thanh_vien'];
			$_SESSION['ten_dang_nhap'] = $row1['ten_dang_nhap'];
			$_SESSION['ho_ten'] = $row1['ho_ten'];
			
			echo "<h2 align='center'>Kích hoạt tài khoản thành công! Hệ thống đang chuyển bạn về trang chủ</h2>";
			echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";
			
		
		}
		else invalid_url();
	}
	else invalid_url();
	
}
else invalid_url();
?>