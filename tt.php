<?php

require_once("hang-so.php");
require_once("ket-noi.php");

if ( !isset($_GET['q']) )
	exit();

$q = $_GET['q'];

if (ctype_digit($q) and $q > 0 and $q <= MAX_TT) {

	$sql = "SELECT ma_quan_huyen,ten_quan_huyen FROM quan_huyen WHERE ma_tinh_thanh =".$q;
	$result2 = mysqli_query($conn,$sql);

	if($result2)
	{
		while($row = mysqli_fetch_array($result2))
		{
			echo "<option value='" . $row['ma_quan_huyen'] . "'>" . $row['ten_quan_huyen'] . "</option>";
		}
	}
}


mysqli_close($conn);



?>