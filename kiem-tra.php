<?php
function blowfish_crypt($input, $rounds = 7) {
	$salt = ""; $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9), array(".", "/"));

	for($i=0; $i < 22; $i++) {
		$salt .= $salt_chars[array_rand($salt_chars)];
	}

	return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
}

function check_existed_user_name($name, $conn) {
	$result = mysqli_query($conn, "select * from thanh_vien where ten_dang_nhap = '" . $name . "'");
		
	if (!$result) {
		mysqli_close($conn);
		exit("<h2>Có lỗi trong quá trình xử lý dữ liệu</h2>");
	}
		
	if ( mysqli_num_rows($result ) > 0 )
		return false;
		
	return true;
}

function check_existed_email($email, $conn) {
	$result = mysqli_query($conn, "select * from thanh_vien where email = '" . $email . "'");
		
	if (!$result) {
		mysqli_close($conn);
		exit("<h2>Có lỗi trong quá trình xử lý dữ liệu</h2>");
	}
		
	if ( mysqli_num_rows($result ) > 0 )
		return false;
		
	return true;
}
/*function checkSpecialChars($str){
 for($i=0;$i<strlen($str);$i++){
$code = ord($str[$i]);
if( ( $code < 48 && $code != 46) || $code > 122)
	return false;
if( $code > 57 && $code< 65)
	return false;
if( $code > 90 && $code < 97 && $code != 95)
	return false;
}
return true;
}*/


function check_tieng_viet($str){
	for($i=0; $i < strlen($str); $i++){
		$code = ord($str[$i]);
		if( $code < 32 || $code > 126 )
			return false;
	}
	return true;
}


function validate_ten_dang_nhap ($ten_dang_nhap, &$err, $conn){

	$ten_dang_nhap = trim($ten_dang_nhap);
	$len = strlen($ten_dang_nhap);

	if ( $ten_dang_nhap == "" )
		$err = "Bạn chưa điền tên đăng nhập";

	else if ( $len < 4 | $len > 30 )
		$err = "Tên đăng nhập phải từ 4-30 kí tự";

	else if ( $ten_dang_nhap[0] == "_" | $ten_dang_nhap[0] == "." | !ctype_alpha( $ten_dang_nhap[0] ) )
		$err = "Tên đăng nhập phải bắt đầu bằng chữ cái";

	else if ( $ten_dang_nhap[$len - 1] == "_" | $ten_dang_nhap[$len - 1] == "." )
		$err = "Tên đăng nhập không kết thúc bằng dấu chấm hoặc dấu gạch";

	else if ( preg_match("/\._|_\.|__|\.\./", $ten_dang_nhap) )
		$err = "Tên đăng nhập không được dùng các dấu . hoặc _ liên tiếp";

	else if ( !preg_match("/^[A-Za-z0-9_\.]+$/", $ten_dang_nhap) )
		$err = "Tên đăng nhập chỉ gồm chữ cái không dấu, chữ số, dấu gạch dưới và dấu chấm";
	else if ( !check_existed_user_name($ten_dang_nhap, $conn) )
		$err = "Tên đăng nhập đã tồn tại";
	else return true;

	return false;
}


function validate_mat_khau($mat_khau, &$err) {
		
		
	$len = strlen($mat_khau);
		
	if ( $mat_khau == "" )
		$err = "Bạn chưa điền mật khẩu";
	else if ( $len  < 6 | $len  > 30 )
		$err = "Mật khẩu phải từ 6 đến 30 kí tự";
	else if ( !check_tieng_viet($mat_khau) )
		$err = "Mật khẩu không được gõ dấu tiếng Việt";
	else return true;

	return false;
}

function validate_email($email, &$err, $conn)
{
	$email = trim($email);	
	if ( $email == "" )
		$err = "Bạn chưa điền email";
	else if ( strlen($email) > 50 )
		$err = "Email quá dài";
	else if ( !preg_match("/^([A-Za-z0-9\_\-]+\.)*[A-Za-z0-9\_\-]+@[A-Za-z0-9\_\-]+(\.[A-Za-z0-9\_\-]+)+$/", $email ) )
		$err = "Email không đúng";
	else if ( !check_existed_email($email, $conn) )
		$err = "Email đã được sử dụng";
	else return true;

	return false;
}

function validate_ho_ten($ho_ten, &$err)
{
	$ho_ten = trim($ho_ten);

	if ( $ho_ten == "" )
		$err = "Bạn chưa điền họ tên";
	else if ( strlen($ho_ten) > 50 )
		$err = "Họ tên quá dài";
	else return true;

	return false;
}

function validate_dien_thoai($dien_thoai, &$err)
{
	$dien_thoai = trim($dien_thoai);
	$len = strlen( $dien_thoai );
	
	if ( $dien_thoai == "" )
		$err = "Bạn chưa điền số điện thoại";
	else if ( $dien_thoai[0] == "." )
		$err = "Số điện thoại không được dùng dấu chấm ở đầu";
	else if ( $dien_thoai[$len - 1] == "." )
		$err = "Số điện thoại không được dùng dấu chấm ở cuối";
	else if ( $len > 20 )
		$err = "Số điện thoại quá dài";
	else if ( preg_match("/\.\./", $dien_thoai ) )
		$err = "Số điện thoại không được dùng các dấu . liên tiếp";
	else if ( !preg_match("/^[0-9\.]+$/", $dien_thoai ) )
		$err = "Số điện thoại chỉ gồm chữ số và dấu chấm";
	else return true;

	return false;
}
?>