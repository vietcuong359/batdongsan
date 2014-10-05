<?php

require_once("hang-so.php");
require_once("ket-noi.php");

if ( !isset($_GET['q']) )
	exit();
$q = $_GET['q'];

if (ctype_digit($q) and $q > 0 and $q <= MAX_QH) {
	
	$sql = "SELECT ma_phuong_xa,ten_phuong_xa FROM phuong_xa WHERE ma_quan_huyen =".$q;
	$result2 = mysqli_query($conn,$sql);

	if($result2)
	{
		while($row = mysqli_fetch_array($result2))
		{
			echo "<option value='" . $row['ma_phuong_xa'] . "'>" . $row['ten_phuong_xa'] . "</option>";
		}
	}
}


mysqli_close($conn);



?>