
<?php 
session_start();

if ( !isset($_SESSION['id'] ) )
{
	header( 'Location: http://localhost/bds/dang-nhap.php' );
	exit("<h2>Bạn chưa đăng nhập!</h2>");
}

?>
<!DOCTYPE html>
<html>
<body>
<?php


set_time_limit(60);
$err = false;

if (isset($_FILES['file'])) {
	$files = $_FILES['file'];

	$id_max = $_POST['id_max'];
	
	if ( !ctype_digit($id_max) | $id_max < 0 )
		exit();
	
	$arr_err = array();
	$arr_valid = array();
	
	$num_files = count($files['name']);
	
	$arr_type = array("image/gif", "image/jpeg", "image/png", "image/pjpeg" );
	$arr_ext = array("jpg", "jpeg", "gif", "png");
	
	
	for ( $i = 0 ; $i < $num_files ; $i ++ )
	{
		$ext = explode( ".", $files["name"][$i] );
		
		if ($ext[1] == null | !in_array( strtolower($ext[1]), $arr_ext ) | !in_array($files['type'][$i], $arr_type) )
		{
			$arr = array( $id_max + $i + 1, "File {$files['name'][$i]} không hợp lệ" );
			$arr_err[] = $arr;
			continue;
		}
		else if ( $files['size'][$i] > 2000000 )
		{
			$arr = array( $id_max + $i + 1, "File upload phải nhỏ hơn 2MB" );
			$arr_err[] = $arr;
			continue;
		}
		$arr = array( $id_max + $i + 1, $ext[1], $files['tmp_name'][$i] );
		$arr_valid[] = $arr;
	}	
	
	$n = count($arr_err);
	if ( $n != 0 )
	{
		for ( $i = 0 ; $i < $n ; $i ++ )
		{
			
			echo sprintf("<script>
			window.parent.uploadError( '%s', '%s');
			</script>", $arr_err[$i][0], $arr_err[$i][1]);
		}
	}
	
	$n = count($arr_valid);
	if ( $n != 0 )
	{
		$temp_dir = "images/temp/{$_SESSION['id']}/" ;
		
		if ( !is_dir( $temp_dir ) )
			mkdir($temp_dir, 0777, true );
		
		for ( $i = 0 ; $i < $n ; $i ++ )
		{
			$div_id = $arr_valid[$i][0];
			$fname = $arr_valid[$i][0] . "." . $arr_valid[$i][1];
			$fpath = $temp_dir . $fname;
			if ( move_uploaded_file( $arr_valid[$i][2], $fpath) )
			{
				echo "<script>
				window.parent.setUploadedImage( '$fpath', '$fname', '$div_id' );
				</script>";
			}
			else $err= true;
		}
		
	}
	
	if ( $err ) 
		echo "<script>window.parent.unknownError();</script>";
	
}

	
?>
	<form name="iform" action="" method="post" enctype="multipart/form-data">
	<input id='file' size='40'  type="file" name="file[]" multiple='multiple' onChange="window.parent.upload(this);"/><br>
  
    
    <span style="font-size:15px; color:#666666;">hỗ trợ ảnh định dạng gif, png, jpg, jpeg.</span>
	<input type="hidden" value="" name="id_max" />
	</form>
	
</body>

</html>
