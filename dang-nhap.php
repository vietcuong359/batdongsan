<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>
<link rel="stylesheet" type="text/css" href="css/dang-ky-dang-nhap.css">
</head>
<body>
	<a id='trang_chu' href="trang-chu.php">Trang chủ</a>
	<br />
	<br />

	<?php
	require_once("ket-noi.php");

	session_start();

	function show_login($ten_dang_nhap, $mat_khau)
	{
		?>
	<form method='post' action='dang-nhap.php'>
		
		<table id='table_dang_nhap'>
			<tr>
				<td>Tên đăng nhập:</td>
				<td><input name='ten_dang_nhap' type='text' size='30' maxlength='30'
					value="<?php echo str_replace('"', "&#34;", $ten_dang_nhap ); ?>" /></td>
			</tr>
			<tr>
				<td>Mật khẩu:</td>
				<td><input name='mat_khau' type='password' size='30' maxlength='30'
					value="<?php echo str_replace('"', "&#34;", $mat_khau ); ?>" /></td>
			</tr>
			
			<tr>
				<td class='quen'><a href="quen-mat-khau.php">Quên mật khẩu?</a></td>
				<td class='quen'><a href="dang-ky.php">Chưa có tài khoản?</a></td>
			</tr>
			
			<tr>
				<td colspan='2' id='td_submit'><button type='submit'>Đăng nhập</button>
				</td>
			</tr>
		</table>
	</form>
	<?php 
	}

	if ( !isset($_SESSION['id']) )
	{
		if( empty($_POST) ) {
			show_login("", "");
		}
		else
		{
			$ten_dang_nhap = ""; $mat_khau = ""; $ma_thanh_vien = ""; $ho_ten = "";
			$err = false; $kich_hoat = false; $khoa = false;

			if ( !empty($_POST['ten_dang_nhap']) and !empty($_POST['mat_khau']) )
			{
				$ten_dang_nhap = $_POST['ten_dang_nhap'];
				$mat_khau = $_POST['mat_khau'];
				
				$result = mysqli_query($conn, "select ma_thanh_vien, mat_khau, ma_trang_thai, ho_ten from thanh_vien where ten_dang_nhap = '" . mysqli_real_escape_string($conn, $ten_dang_nhap) . "'" );

				if ( !$result )
				{
					mysqli_close($conn);
					exit("<h2>Có lỗi trong quá trình xử lý dữ liệu</h2>");
				}
				
				$row = mysqli_fetch_array($result);
						
				if ( $row )
				{
					$ma_thanh_vien = $row['ma_thanh_vien'];
					$ho_ten = $row['ho_ten'];
					
					if ( $row['ma_trang_thai'] == "1")
						$kich_hoat = true;
					else if ( $row['ma_trang_thai'] == "3")
						$khoa = true;
					
					
					$hash = crypt( $mat_khau, $row['mat_khau'] );

					if ( $hash !== $row['mat_khau'] )
						$err = true;
				}
				else $err = true;
			}
			else $err = true;

			if ( $err )
			{
				echo "<span class='red'>Tên đăng nhập hoặc mật khẩu không đúng</span><br/><br/>";
				show_login($ten_dang_nhap, $mat_khau);
			}
			else if ( $kich_hoat )
			{
				echo "<span class='red'>Bạn chưa kích hoạt tài khoản. Vui lòng kiểm tra email hoặc click mục Quên mật khẩu</span><br/><br/>";
				show_login($ten_dang_nhap, $mat_khau);
			}
			else if ( $khoa )
			{
				echo "<span class='red'>Tài khoản của bạn đã bị khóa. Vui lòng liên hệ support@localhost.com</span><br/><br/>";
				show_login($ten_dang_nhap, $mat_khau);
			}
			else //login successfully
			{
				$_SESSION['ho_ten'] = $ho_ten;
				$_SESSION['ten_dang_nhap'] = $ten_dang_nhap;
				$_SESSION['id'] = $ma_thanh_vien;
			}

		}
	}

	if ( isset($_SESSION['id']) )
	{
		echo("<script>location.href='trang-chu.php'</script>");
		exit();
	}
	?>
</body>
</html>
