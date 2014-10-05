<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Phục hồi mật khẩu</title>
<link rel="stylesheet" type="text/css" href="css/mat-khau-moi.css">
<script src="js/jquery.js"></script>
</head>
<body>
<a id='trang_chu' href="trang-chu.php">Trang chủ</a>
	<br />
	<br />
<?php
	require_once 'ket-noi.php';
	require_once 'loi.php';
	require_once 'kiem-tra.php';
	session_start();
	if ( isset($_SESSION['id']) ) {
		echo "<script>location.href='dang-xuat.php'</script>";
		exit();
	}
	function show_new_pass($e, $k, $row, $err)
	{
	?>
	<form method='post' action='mat-khau-moi.php?e=<?php echo $e; ?>&k=<?php echo $k; ?>'>
		
		<table>
			<tr>
				<td>Tên đăng nhập:</td>
				<td><input name='ten_dang_nhap' type='text' size='30' maxlength='30' disabled='disabled'
					value="<?php echo $row[0]; ?>" /></td>
			</tr>
			<tr>
				<td>Mật khẩu mới:</td>
				<td><input name='mat_khau_moi' type='password' size='30' maxlength='30'
					value="<?php echo str_replace('"', "&#34;", $row[1] ); ?>" /></td>
				<td><span class='red'><?php echo $err[0]; ?></span></td>
			</tr>
			
			<tr>
				<td>Xác nhận mật khẩu mới:</td>
				<td><input name='xn_mat_khau_moi' type='password' size='30' maxlength='30'
					value="<?php echo str_replace('"', "&#34;", $row[2] ); ?>" /></td>
				<td><span class='red'><?php echo $err[1]; ?></span></td>
			</tr>
			
			<tr>
				<td colspan='2' id='td_submit'><button type='submit'>Đổi mật khẩu</button>
				</td>
			</tr>
		</table>
	</form>
	<?php 
	}
	
	if ( !empty($_GET["k"]) and !empty($_GET["e"]) )
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		
		$curr_date = date("Y-m-d H:i:s",time());
		
		$k = $_GET["k"]; $e = urldecode(base64_decode($_GET['e']));
		
		if ( !$result1 = mysqli_query($conn, "select ma_thanh_vien, ten_dang_nhap, ho_ten from thanh_vien where email = '" . mysqli_real_escape_string($conn, $e) . "'") )
			query_exec_err();
		
		if ( !$row1 = mysqli_fetch_array($result1) )
			invalid_url();
		
		if ( !$result2 = mysqli_query($conn, "select khoa, hieu_luc from khoa_phuc_hoi where khoa = '$k' and ma_thanh_vien =" . $row1['ma_thanh_vien']) )
			query_exec_err();
		
		if ( $row2 = mysqli_fetch_array($result2) )
		{
			if ( $row2['hieu_luc'] >= $curr_date )
			{
				if ( empty($_POST) )
				{
					show_new_pass($_GET['e'], $k, array($row1['ten_dang_nhap'], "", ""), array("", ""));
				}
				else
				{
					$mat_khau_moi = ""; $xn_mat_khau_moi = "";
					$err1 = ""; $err2 = "";
				
					if ( isset($_POST['mat_khau_moi']) )
						$mat_khau_moi = $_POST['mat_khau_moi'];
				
					if ( isset($_POST['xn_mat_khau_moi']) )
						$xn_mat_khau_moi = $_POST['xn_mat_khau_moi'];
				
					$flag1 = validate_mat_khau($mat_khau_moi, $err1);
				
					$flag2 = validate_mat_khau($xn_mat_khau_moi, $err2);
				
					if ( $xn_mat_khau_moi !== $mat_khau_moi)
					{
						$flag2 = false;
						$err2 = "Mật khẩu xác nhận phải giống với mật khẩu";
					}
				
					if ( $flag1 and $flag2 )
					{
						$hash = blowfish_crypt($mat_khau_moi);
						
						//start transaction
						if (!mysqli_query($conn,'START TRANSACTION'))
							query_exec_err();
												
						if ( !mysqli_query($conn, "update thanh_vien set ma_trang_thai = 2, mat_khau = '" . $hash . "' where ma_thanh_vien = '" . $row1['ma_thanh_vien'] . "'"))
							query_exec_err();
						
						if (!mysqli_query($conn, "delete from khoa_phuc_hoi where ma_thanh_vien = " . $row1['ma_thanh_vien']))
							query_exec_err();
						
						if (!mysqli_query($conn,'COMMIT'))
							query_exec_err();
						// end transaction
						
						$_SESSION['id'] = $row1['ma_thanh_vien'];
						$_SESSION['ten_dang_nhap'] = $row1['ten_dang_nhap'];
						$_SESSION['ho_ten'] = $row1['ho_ten'];
							
						echo "<h2 align='center'>Cập nhật mật khẩu mới thành công!</h2>";
							
						echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";
					}
					else
					{
							
						show_new_pass($_GET['e'], $k, array($row1['ten_dang_nhap'], $mat_khau_moi, $xn_mat_khau_moi), array($err1, $err2));
					}
				}
			}
			else 
			{
				echo "<h2 align='center'>Link đã hết hạn!</h2>";
				echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";
				exit();
			}
		}
		else
		{
			invalid_url();
		}
		
	}	
	
	else
	{
	
		echo "<script>location.href='trang-chu.php'</script>";
		exit();
	}

?>

</body>
</html>