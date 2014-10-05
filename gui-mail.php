<?php
require_once "Mail.php";
function send_email($from, $to, $subject, $body)
{
	$host = "ssl://smtp.gmail.com";
	$port = "465";
	$username = "vietcuong359";
	$password = "cuong300890";
		
	$headers = array ('From' => $from,
			'To' => $to,
			'Subject' => $subject);
	$smtp = @Mail::factory('smtp',
			array ('host' => $host,
					'port' => $port,
					'auth' => true,
					'username' => $username,
					'password' => $password));

	$mail = @$smtp->send($to, $headers, $body);

	if (@PEAR::isError($mail)) {
		echo("<p>Có lỗi trong quá trình xử lý dữ liệu. Vui lòng thử lại sau!</p>");
		echo("<p>" . $mail->getMessage() . "</p>");
	}

}


?>