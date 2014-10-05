<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Đăng xuất</title>
<link rel="stylesheet" type="text/css" href="css/dang-xuat.css">
</head>
<body>
	<a id='trang_chu' href="trang-chu.php">Trang chủ</a>
	<br />
	<br />


	<?php
	session_start();

	if ( isset($_SESSION['id']) )
		$id = $_SESSION['id'];
	else $id = "";

	unset($_SESSION['id']);
	unset($_SESSION['ten_dang_nhap']);
	unset($_SESSION['ho_ten']);

	$result_dest = session_destroy();

	if ( empty($id) )
	{
		echo "<h2>Bạn chưa đăng nhập!</h2>";
		exit();
	}
	else
	{
		if ( !$result_dest )
		{
			echo "<h2>Chưa thể đăng xuất lúc này!<h2>";
			exit();
		}
		else
		{		
			echo("<script>location.href='trang-chu.php'</script>");
			exit();
		}
	}

	?>
</body>
</html>
