<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Quên mật khẩu</title>
<link rel="stylesheet" type="text/css" href="css/quen-mat-khau.css">
<script src="js/jquery.js"></script>
</head>
<body>
<a id='trang_chu' href="trang-chu.php">Trang chủ</a><br/><br/>
	<?php
	require_once 'ket-noi.php';
	require_once 'loi.php';
	require_once 'kiem-tra.php';
	require_once 'gui-mail.php';
	
	function show_reset_pass($email, $err)
	{
		?>
	<form method='post' action='quen-mat-khau.php'>
		<table>
			<tr>
				<td>Email:</td>
				<td><input name='email' type='text'
					value="<?php echo str_replace('"', "&#34;", $email ); ?>" size='30'
					maxlength='50' /></td>
				<td><span class='red'><?php echo $err; ?> </span></td>
			</tr>
			<tr>
				<td colspan='2' id='td_submit'><button>Gửi mật khẩu</button></td>
			</tr>
		</table>
	</form>
	<?php 
	}
	
	
	if ( !isset($_POST['email']) )
	{
		show_reset_pass("","");
	}
	else
	{
		$email = $_POST['email'];

		$err = ""; $flag = false; $ma_thanh_vien = "";

		if ( trim($email) == "" )
			$err = "Bạn chưa điền email";
		else if ( !preg_match("/^([A-Za-z0-9\_\-]+\.)*[A-Za-z0-9\_\-]+@[A-Za-z0-9\_\-]+(\.[A-Za-z0-9\_\-]+)+$/", $email ) )
			$err = "Email không đúng";
		else {
			
			if ( !$result = mysqli_query($conn, "select ma_thanh_vien from thanh_vien where email = '" . $email . "'") )
				query_exec_err();

			if ( $row = mysqli_fetch_array($result) )
			{
				$flag = true;
				$ma_thanh_vien = $row['ma_thanh_vien'];
			}
			else 
			{
				$err = "<span class='red'>Địa chỉ email không tồn tại trong hệ thống!</span>";
			}
		}
		if ( !$flag )
		{
			show_reset_pass($email, $err);
		}
		else
		{
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
			$expDate = date("Y-m-d H:i:s",$expFormat);

			$rand = $email . rand(0, 10000) . $expDate;

			$key = blowfish_crypt( $rand );
			
			//update the key each time user request for new passw
			if ( !$result1 = mysqli_query($conn, "select * from khoa_phuc_hoi where ma_thanh_vien = $ma_thanh_vien") )
				query_exec_err();
			
			if ( $row1 = mysqli_fetch_array($result1) )
			{
				$sql = sprintf("update khoa_phuc_hoi set khoa = '%s', hieu_luc = '%s' where ma_thanh_vien = %s", $key, $expDate, $ma_thanh_vien);
				if ( !$result1 = mysqli_query($conn, $sql) )
					query_exec_err();
				
			}
			else 
			{
				$sql = sprintf("insert into khoa_phuc_hoi values(%s, '%s', '%s')", $ma_thanh_vien, $key, $expDate);
				
				if ( !$result1 = mysqli_query($conn, $sql) )
					query_exec_err();
			}
			
			

			
			$from = "Bat dong san <support@bds.com>";
			
			$to = $email;

			$subject = "Phục hồi mật khẩu";

			$body = "Bạn hay ai đó đã yêu cầu khôi phục mật khẩu. Vui lòng click vào link sau để tạo mật khẩu mới:\n";
			$body .= "http://localhost/bds/mat-khau-moi.php?k=$key&e=".urlencode(base64_encode($email))."\n";
			$body .= "Link trên chỉ có tác dụng trong vòng 3 ngày kể từ lúc bạn yêu cầu phục hồi mật khẩu";
				
			send_email($from, $to, $subject, $body);
			
			
			echo "<h2 align='center'>Website đã gửi yêu cầu tạo mật khẩu mới đến hộp thư ( $email ) của bạn.
			Bạn hãy kiểm tra hộp thư và làm theo hướng dẫn trong nội dung thư.</h2><br/>
			<p align='center'>Vui lòng chờ trong giấy lát hệ thống sẽ tự động chuyển bạn đến trang chủ.</p>";

			echo "<script>setInterval(function(){location.href='trang-chu.php'},5000);</script>";
		}
		
	}

?>
</body>
</html>
