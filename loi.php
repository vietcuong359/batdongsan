<?php
function query_exec_err() {
	echo "<h2>Có lỗi xảy ra trong quá trình xử lý dữ liệu!</h2>";
	exit();
}

function invalid_url() {
	echo "<h2>Địa chỉ không hợp lệ!</h2>";
	echo "<script>setInterval(function(){location.href='trang-chu.php'},10000);</script>";				
	exit();
}

function invalid_post_id() {
	echo "<h2>Mã tin không đúng!</h2>";
	exit();
}
?>