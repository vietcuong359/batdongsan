<?php
	require_once "ket-noi.php";
	require_once 'loi.php';
	session_start();
	if ( !isset($_SESSION['valid_user']) ) 
	{
		exit("<h2>Bạn chưa đăng nhập!</h2>");
	}
	$user = $_SESSION['valid_user'];
	
	$res = mysqli_query($conn, "select email, ho_ten, dien_thoai from thanh_vien where ten_dang_nhap = '" . $user . "'");
	
	if ( !$res )
	{
		mysqli_close($conn);
		query_exec_err();
	}
	
	$row = mysqli_fetch_array($res);
?>	
	<span id='1'><input name='email' value="<?php echo $row['email']; ?>"
							type='text' size='30' maxlength='50' />  </span>
	<span id='2'> <input name='ho_ten' value="<?php echo $row['ho_ten']; ?>"
							type='text' size='30' maxlength='50' /></span>
	<span id='3'><input name='dien_thoai'
							value="<?php echo $row['dien_thoai']; ?>" type='text' size='30'
							maxlength='20' /></span>
