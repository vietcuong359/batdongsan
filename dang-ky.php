<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng ký thành viên</title>
<link rel="stylesheet" type="text/css" href="css/dang-ky-dang-nhap.css">
<script src="js/jquery.js"></script>
<script src="js/dang-ky.js"></script>

</head>
<body>

	<a id='trang_chu' href="trang-chu.php">Trang chủ</a>
	<br />
	<br />
	<?php
	require_once("ket-noi.php");
	require_once("kiem-tra.php");
	require_once 'gui-mail.php';
	require_once 'loi.php';
	function show_register($row, $err)
	{
		?>
	<form action='dang-ky.php' method='post'>
		<table>
			<tr>
				<td>Tên đăng nhập: <span class='red2'>*</span>
				</td>
				<td><input name='ten_dang_nhap'
					value="<?php echo str_replace('"', "&#34;", $row[0] ); ?>"
					type='text' size='30' maxlength='30' id='dang_nhap' /></td>
				<td><span class='red'><?php echo $err[0]; ?> </span></td>
			</tr>
			<tr>
				<td>Mật khẩu: <span class='red2'>*</span>
				</td>
				<td><input name='mat_khau'
					value="<?php echo str_replace('"', "&#34;", $row[1] ); ?>"
					type='password' size='30' maxlength='30' id='dang_nhap' /></td>
				<td><span class='red'><?php echo $err[1]; ?> </span></td>
			</tr>
			<tr>
				<td>Xác nhận mật khẩu: <span class='red2'>*</span>
				</td>
				<td><input name='xn_mat_khau'
					value="<?php echo str_replace('"', "&#34;", $row[2] ); ?>"
					type='password' size='30' maxlength='30' id='dang_nhap' /></td>
				<td><span class='red'> <?php echo $err[2]; ?>
				</span></td>
			</tr>
			<tr>
				<td>Email: <span class='red2'>*</span>
				</td>
				<td><input name='email'
					value="<?php echo str_replace('"', "&#34;", $row[3] ); ?>"
					type='text' size='30' maxlength='50' /></td>
				<td><span class='red'> <?php echo $err[3]; ?>
				</span>
				</td>
			</tr>
			<tr>
				<td>Họ tên: <span class='red2'>*</span>
				</td>
				<td><input name='ho_ten'
					value="<?php echo str_replace('"', "&#34;", $row[4] ); ?>"
					type='text' size='30' maxlength='50' /></td>
				<td><span class='red'> <?php echo $err[4]; ?>
				</span></td>
			</tr>
			<tr>
				<td>Điện thoại: <span class='red2'>*</span>
				</td>
				<td><input name='dien_thoai'
					value="<?php echo str_replace('"', "&#34;", $row[5] ); ?>"
					type='text' size='30' maxlength='20' /></td>
				<td><span class='red'> <?php echo $err[5]; ?>
				</span>
				</td>
			</tr>

			<tr>
				<td>Địa chỉ:</td>
				<td><input name='dia_chi'
					value="<?php echo str_replace('"', "&#34;", $row[6] ); ?>"
					type='text' size='30' maxlength='100' /></td>
			</tr>

			<tr>
				<td colspan='2' id='td_submit'><button type='submit' id='but_submit'>Đăng
						ký</button>
					<button type="button" id='button_xoa'>Xóa</button></td>
			</tr>
		</table>
	</form>
	<?php
	}

	if ( empty($_POST) )
	{
		show_register(array("","","","","","",""), array("","","","","",""));
	}
	else {
		$ten_dang_nhap = ""; $mat_khau = ""; $xn_mat_khau = ""; $email = ""; $ho_ten = ""; $dien_thoai = "";
			
		if ( isset( $_POST['ten_dang_nhap'] ) )
			$ten_dang_nhap = $_POST['ten_dang_nhap'];
			
		if ( isset( $_POST['mat_khau'] ) )
			$mat_khau = $_POST['mat_khau'];
			
		if ( isset( $_POST['xn_mat_khau'] ) )
			$xn_mat_khau = $_POST['xn_mat_khau'];

		if ( isset( $_POST['email'] ) )
			$email = $_POST['email'];
			
		if ( isset( $_POST['ho_ten'] ) )
			$ho_ten = $_POST['ho_ten'];
			
		if ( isset( $_POST['dien_thoai'] ) )
			$dien_thoai = $_POST['dien_thoai'];

		if ( isset( $_POST['dia_chi'] ) )
			$dia_chi = $_POST['dia_chi'];
			
		$err1 = ""; $err2 = ""; $err3 = ""; $err4 = ""; $err5 = ""; $err6 = "";
			
		$flag1 = validate_ten_dang_nhap($ten_dang_nhap, $err1, $conn);
		$flag2 = validate_mat_khau($mat_khau, $err2);
		$flag3 = validate_mat_khau($xn_mat_khau, $err3);
		if ( $mat_khau !== $xn_mat_khau )
		{
			$flag3 = false;
			$err3 = "Mật khẩu xác nhận phải giống với mật khẩu";
		}
		$flag4 = validate_email($email, $err4, $conn);

		$flag5 = validate_ho_ten($ho_ten, $err5);

		$flag6 = validate_dien_thoai($dien_thoai, $err6);



			
		if ( $flag1 and $flag2 and $flag3 and $flag4 and $flag5 and $flag6)
		{ //register successfully

			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$date = date('Y-m-d', time());

			$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+10, date("Y"));
			$expDate = date("Y-m-d H:i:s",$expFormat);

			$rand = $email . rand(0, 10000) . $expDate;

			$key = blowfish_crypt( $rand );
			
			//start transaction
			if (!mysqli_query($conn,'START TRANSACTION'))
				query_exec_err();

			$sql1 = sprintf("insert into thanh_vien(ten_dang_nhap, mat_khau, email, ho_ten, dien_thoai, ma_trang_thai, ngay_dang_ki, dia_chi) values ('%s', '%s', '%s', '%s', '%s', %s, '%s', '%s')",
					$ten_dang_nhap, blowfish_crypt($mat_khau), $email, mysqli_real_escape_string($conn, $ho_ten), $dien_thoai, "1", $date, mysqli_real_escape_string($conn,$dia_chi));

			if(!mysqli_query($conn, $sql1))
				query_exec_err();

			$sql2 = "select ma_thanh_vien from thanh_vien where email = '" . $email . "'";

			if(!$result2 = mysqli_query($conn, $sql2))
				query_exec_err();

			$row = mysqli_fetch_array($result2);

			$sql3 = sprintf("insert into khoa_kich_hoat(ma_thanh_vien, khoa) values(%s, '%s')", $row['ma_thanh_vien'], $key);
			if(!mysqli_query($conn, $sql3))
				query_exec_err();

			if (!mysqli_query($conn,'COMMIT'))
				query_exec_err();
			// end transaction

			$from = "Bat dong san <support@localhost.com>";
			$to = $email;
			$subject = "Kích hoạt tài khoản";
			$body = "Cảm ơn bạn đã đăng kí thành viên tại website.\n";
			$body .= "Dưới đây là thông tin tài khoản của bạn:\n";
			$body .= "------------------------------------------\n";
			$body .= "Tên đăng nhập: " . $ten_dang_nhap . "\n";
			$body .= "Mật khẩu: " . $mat_khau . "\n";
			$body .= "------------------------------------------\n";
			$body .= "Bạn vui lòng click vào liên kết dưới đây để hoàn tất thủ tục đăng ký:\n";
			$body .= "http://localhost/bds/kich-hoat.php?k=" . $key ."&e=" .urlencode(base64_encode($email))."\n";
			send_email($from, $to, $subject, $body);

			echo "<h2>Bạn đã đăng kí thành viên thành công. Kiểm tra hộp thư ( $email ) bạn vừa đăng kí để hoàn tất thủ tục đăng kí!</h2>";

			echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";

		}
		else
		{
			show_register(array($ten_dang_nhap, $mat_khau, $xn_mat_khau, $email, $ho_ten, $dien_thoai, $dia_chi), array($err1, $err2, $err3, $err4, $err5, $err6));
		}
	}


	?>

</body>
</html>
