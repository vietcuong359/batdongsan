<?php
require_once("ket-noi.php");
require_once("loi.php");
require_once("kiem-tra.php");
require_once 'hang-so.php';
require_once 'create-thumbs.php';

session_start();

if ( !isset($_SESSION['id']) )
{
	header( 'Location: http://localhost/bds/dang-nhap.php' );
	exit("<h2>Bạn chưa đăng nhập!</h2>");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Trang thành viên</title>
<link rel="stylesheet" type="text/css" href="css/thanh-vien.css">
<script src="js/jquery.js"></script>
<script src="js/thanh-vien.js"></script>
<script src="js/up-anh.js"></script>
</head>
<body>
	<div id='container'>
		<a href="trang-chu.php">Trang chủ</a>&nbsp;&gt;&gt;&nbsp;<a
			href="thanh-vien.php">Trang thành viên</a> <a id='thoat'
			href='dang-xuat.php'>Thoát</a> <a id='thanh_vien'
			href='thanh-vien.php'>Chào bạn: <span class='selected'><?php echo $_SESSION['ho_ten']; ?>
		</span>
		</a> <br /> <br />
		<div class='clear'></div>
		<div id='menu'>

			<?php 

			function show_user_info($row , $err) {
				?>

			<br /> <span class='bold indent'>Thay đổi email:</span><br /> <br />
			<form method='post' action='thanh-vien.php?muc=3'>
				<table>
					<tr>
						<td class='text'>Email cũ:</td>
						<td><?php echo $row[0]; ?></td>


					</tr>

					<tr>
						<td class='text'>Email mới:</td>
						<td><input class='regular' name='email_moi' size='30'
							maxlength='50'
							value="<?php echo str_replace('"', "&#34;", $row[1] ); ?>" />
						</td>
						<td><span class='selected'><?php echo $err[0]; ?> </span>
					
					</tr>

					<tr>
						<td class='text'>Xác nhận email:</td>
						<td><input class='regular' name='xn_email_moi' size='30'
							maxlength='50'
							value="<?php echo str_replace('"', "&#34;", $row[2] ); ?>" />
						</td>
						<td><span class='selected'><?php echo $err[1]; ?> </span>
					
					</tr>

					<tr>
						<td colspan='2' id='td_submit'><input type='submit'
							class='but_submit' name='submit_email' value='Cập nhật' />
						</td>
					</tr>
				</table>
			</form>

			<br /> <span class='bold indent'>Thay đổi mật khẩu:</span><br /> <br />

			<form method='post' action='thanh-vien.php?muc=3'>
				<table>
					<tr>
						<td class='text'>Mật khẩu cũ:</td>
						<td><input class='regular' name='mat_khau_cu' type='password'
							value="<?php echo str_replace('"', "&#34;", $row[3] ); ?>"
							size='30' maxlength='30' /></td>
						<td><span class='selected'><?php echo $err[2]; ?> </span></td>
					</tr>

					<tr>
						<td class='text'>Mật khẩu mới:</td>
						<td><input class='regular' name='mat_khau_moi' type='password'
							value="<?php echo str_replace('"', "&#34;", $row[4] ); ?>"
							size='30' maxlength='30' /></td>
						<td><span class='selected'><?php echo $err[3]; ?> </span></td>
					</tr>

					<tr>
						<td class='text'>Xác nhận mật khẩu:</td>
						<td><input class='regular' name='xn_mat_khau_moi' type='password'
							value="<?php echo str_replace('"', "&#34;", $row[5] ); ?>"
							size='30' maxlength='30' /></td>
						<td><span class='selected'><?php echo $err[4]; ?> </span></td>
					</tr>


					<tr>
						<td colspan='2' id='td_submit'><input type='submit'
							class='but_submit' name='submit_mat_khau' value='Cập nhật' />
						</td>
					</tr>
				</table>
			</form>
			<br /> <span class='bold indent'>Thông tin cá nhân</span><br /> <br />
			<form method='post' action='thanh-vien.php?muc=3'>
				<table>
					<tr>
						<td class='text'>Tên đăng nhập</td>
						<td><?php echo $_SESSION['ten_dang_nhap']; ?></td>
					</tr>
					<tr>
						<td class='text'>Ngày đăng kí:</td>
						<td><?php echo  $row[9]; ?></td>
					</tr>
					<tr>
						<td class='text'>Họ tên:</td>
						<td><input class='regular' name='ho_ten'
							value="<?php echo str_replace('"', "&#34;", $row[6] ); ?>"
							type='text' size='30' maxlength='50' /></td>
						<td><span class='selected'><?php echo $err[5]; ?> </span>
					
					</tr>

					<tr>
						<td class='text'>Điện thoại:</td>
						<td><input class='regular' name='dien_thoai'
							value="<?php echo str_replace('"', "&#34;", $row[7] ); ?>"
							type='text' size='30' maxlength='20' /></td>
						<td><span class='selected'><?php echo $err[6]; ?> </span></td>
					</tr>



					<tr>
						<td class='text'>Địa chỉ:</td>
						<td><input class='regular' name='dia_chi'
							value="<?php echo str_replace('"', "&#34;", $row[8] ); ?>"
							type='text' size='30' maxlength='100' /></td>

					</tr>



					<tr>
						<td colspan='2' id='td_submit'><input type='submit'
							class='but_submit' name='submit_thong_tin' value='Cập nhật' />
						</td>
					</tr>
				</table>
			</form>
			<?php
			}


			function loop_select($arr, $val ) {

				$valid = false;
				while ( $row = mysqli_fetch_array($arr) )
				{
					if ( $val !== $row[0] )
						echo "<option value='$row[0]'>$row[1]</option>";
					else
					{
						$valid = true;
						echo "<option selected='selected' value='$row[0]' >$row[1]</option>";
					}
				}

				return $valid;

			}



			if ( isset($_GET['muc']) ) $muc = $_GET['muc'];
			else $muc = "1";

			$valid_muc = false;
			?>



			<?php 

			$arr = array( "1" => "Quản lý tin đăng" , "2" => "Đăng tin mới" , "3" => "Thiết lập tài khoản" );

			for ( $i = 0 ; $i < 3 ; $i++ )
			{
				echo "<div class='menu_group'>";

				while ( list( $key, $value ) = each( $arr ) )
				{
					if ( $muc === (string)$key )
					{
						$valid_muc = true;
						echo "<p><span class='selected'>" . $value . "</span></p>";
					}
					else
						echo "<p><a href='thanh-vien.php?muc=" . $key . "' >" . $value . "</a></p>";
				}

				echo "</div>";
			}


			?>

		</div>

		<div id='content'>
			<?php 
			if ( !$valid_muc )
			{
				invalid_url();
				exit();
			}

			if ( $muc == 3 )
			{
				if ( !$result = mysqli_query( $conn, "select * from thanh_vien where ma_thanh_vien = " . $_SESSION['id'] ) )
					query_exec_err();

				$row = mysqli_fetch_array($result);

				date_default_timezone_set("Asia/Ho_Chi_Minh");

				$row['ngay_dang_ki'] = date("d-m-Y", strtotime($row['ngay_dang_ki']) );
					

				if ( empty($_POST) )
				{

					show_user_info(array($row['email'], "", "", "", "", "", $row['ho_ten'], $row['dien_thoai'], $row['dia_chi'] , $row['ngay_dang_ki']),
							array("","","","","","",""));

				}
				else
				{
					$email_moi = ""; $xn_email_moi = ""; $mat_khau_cu = ""; $mat_khau_moi = ""; $xn_mat_khau_moi = "";
					$ho_ten = $row['ho_ten']; $dien_thoai = $row['dien_thoai']; $dia_chi = $row['dia_chi'];

					$err0 = ""; $err1 = ""; $err2 = ""; $err3 = ""; $err4 = ""; $err5 = ""; $err6 = "";

					$flag0 = true; $flag1 = true; $flag2 = true; $flag3 = true; $flag4 = true; $flag5 = true;

					if ( isset($_POST['submit_email']) )
					{
						if ( isset($_POST['email_moi']) )
							$email_moi = $_POST['email_moi'];

						if ( isset($_POST['xn_email_moi']) )
							$xn_email_moi = $_POST['xn_email_moi'];

						$flag0 = validate_email($email_moi, $err0, $conn);
						$flag1 = validate_email($xn_email_moi, $err1, $conn);


						if ( $email_moi !== $xn_email_moi)
						{
							$err1 = "Xác nhận email không đúng";
							$flag1 = false;
						}
							

						if ( $flag0 & $flag1 )
						{
							if ( !mysqli_query($conn, "update thanh_vien set email = '$email_moi' where ma_thanh_vien = " . $row['ma_thanh_vien']) )
								query_exec_err();
							echo "<script>alert('Cập nhật email thành công');</script>";

							show_user_info(array($email_moi, "", "", "", "", "", $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array("","","","","","",""));


						}
						else
						{
							show_user_info(array($row['email'], $email_moi, $xn_email_moi, "", "", "", $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array($err0,$err1,"","","","",""));

						}
							
					}

					if ( isset($_POST['submit_mat_khau']) )
					{
						if ( isset($_POST['mat_khau_cu']) )
							$mat_khau_cu = $_POST['mat_khau_cu'];

						if ( isset($_POST['mat_khau_moi']) )
							$mat_khau_moi = $_POST['mat_khau_moi'];

						if ( isset($_POST['xn_mat_khau_moi']) )
							$xn_mat_khau_moi = $_POST['xn_mat_khau_moi'];

						if ( crypt($mat_khau_cu, $row['mat_khau'] ) != $row['mat_khau'] )
						{
							$flag2 = false;
							$err2 = "Mật khẩu cũ không đúng";
						}

						$flag3 = validate_mat_khau($mat_khau_moi, $err3);
						$flag4 = validate_mat_khau($xn_mat_khau_moi, $err4);

						if ( $mat_khau_moi !== $xn_mat_khau_moi )
						{
							$flag4 = false;
							$err4 = "Mật khẩu xác nhận không đúng";
						}
							
						if ( $flag2 & $flag3 & $flag4 )
						{
							if ( !mysqli_query($conn, "update thanh_vien set mat_khau = '" . blowfish_crypt($mat_khau_moi) . "' where ma_thanh_vien = " . $row['ma_thanh_vien']) )
								query_exec_err();
							echo "<script>alert('Cập nhật mật khẩu thành công!');</script>";

							show_user_info(array($row['email'], "", "", "", "", "", $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array("","","","","","",""));

						}
						else
						{
							show_user_info(array($row['email'], "", "", $mat_khau_cu, $mat_khau_moi, $xn_mat_khau_moi, $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array("","",$err2,$err3,$err4,"",""));
						}


					}

					if ( isset($_POST['submit_thong_tin']) )
					{
						if ( isset($_POST['ho_ten']) )
							$ho_ten = $_POST['ho_ten'];

						if ( isset($_POST['dien_thoai']) )
							$dien_thoai = $_POST['dien_thoai'];

						if ( isset($_POST['dia_chi']) )
							$dia_chi = $_POST['dia_chi'];

						$flag5 = validate_ho_ten($ho_ten, $err2);

						$flag6 = validate_dien_thoai($dien_thoai, $err3);
							
						if ( $flag5 & $flag6 )
						{
							if ( !mysqli_query($conn, "update thanh_vien set ho_ten = '$ho_ten', dien_thoai = '$dien_thoai', dia_chi = '$dia_chi'
									where ma_thanh_vien = " . $row['ma_thanh_vien']) )
								query_exec_err();
							echo "<script>alert('Cập nhật thông tin thành công!');</script>";
							show_user_info(array($row['email'], "", "", "", "", "", $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array("","","","","","",""));

						}
						else
						{
							show_user_info(array($row['email'], "", "", "", "", "", $ho_ten, $dien_thoai, $dia_chi , $row['ngay_dang_ki']),
									array("","","","","",$err2, $err3));

						}

					}
				}
			}
			else if ( $muc == "2" ) //dang tin
			{


				if ( !isset($_GET['nhu_cau']) )
					echo "<div id='chon'>
					<div id='chon1'><h3>Chọn loại tin đăng:</h3></div>
					<div id='chon2'>
					<label><input type='radio' name='nhu_cau' value='1'> Bán</input></label><br/><br/>
					<label><input type='radio' name='nhu_cau' value='2'> Cho Thuê</input></label><br/><br/>
					<label><input type='radio' name='nhu_cau' value='3'> Cần mua</input></label><br/><br/>
					<label><input type='radio' name='nhu_cau' value='4'> Cần thuê</input></label><br/><br/>
					</div>
					</div>";
				else
				{
					$nhu_cau = $_GET['nhu_cau'];

					$arr = array("1" => "Bán", "2" => "Cho thuê", "3" => "Cần mua", "4" => "Cần thuê");

					if ( !in_array($nhu_cau, array("1", "2", "3", "4"), true))
					{
						exit("<h2 align='center'>Nhu cầu không đúng!</h2>");
					}

					ob_start();

					echo "<h2 id='dang_tin'>Đăng tin bất động sản</h2>";

					echo "<form action='thanh-vien.php?muc=2&nhu_cau=$nhu_cau' method='post' >";

					echo "<table id='table1'>";

					echo "<tr><td>Nhu cầu: <span class='selected2'>*</span></td><td><span class='blue'>$arr[$nhu_cau]</span></td>";

					//loai bds

					if (isset($_POST["loai_bds"])) $loai_bds = $_POST["loai_bds"];
					else $loai_bds = "0";

					echo '<tr><td>Loại BĐS: <span class="selected2">*</span></td><td><select id="select_loai_bds" name="loai_bds">';

					echo "<option value='0'>Chọn</option>";

					if ( !$res = mysqli_query($conn, "select * from loai_bds") )
						query_exec_err();

					$valid_loai_bds = loop_select($res, $loai_bds);

					echo "</select>";


					if ( !$valid_loai_bds & isset($_POST['loai_bds']) )
					{
						echo "<span class='selected'>Bạn chưa chọn loại bất động sản</span>";
					}

					echo "</td></tr>";

					//kieu bds
					if ( isset($_POST['kieu_bds']) )
						$kieu_bds = $_POST['kieu_bds'];
					else $kieu_bds = "0";

					$valid_kieu_bds = false;

					echo "<tr><td>Kiểu BĐS:</td><td><select id='select_kieu_bds' name='kieu_bds'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_loai_bds & $loai_bds != "10")
					{
						if ( !$res = mysqli_query($conn, "select ma_kieu_bds, ten_kieu_bds from kieu_bds where ma_loai_bds = " . $loai_bds) )
							query_exec_err();
							
						$valid_kieu_bds = loop_select($res, $kieu_bds);
					}

					echo "</select></td></tr>";

					if ( $kieu_bds === "0" ) $valid_kieu_bds = true;


					// tieu de
					$valid_tieu_de = false;

					if ( !isset( $_POST['tieu_de'] ) )
					{
						echo "<tr><td>Tiêu đề: <span class='selected2'>*</span></td><td><input type='text' id='tieu_de' name='tieu_de' maxlength='150' />";
							
					}
					else
					{
						$valid_tieu_de = true;

						$tieu_de = $_POST['tieu_de'];

						echo "<tr><td>Tiêu đề: <span class='selected2'>*</span></td><td><input type='text' id='tieu_de' name='tieu_de' maxlength='150' value='" . str_replace("'", "&#34;", $tieu_de ) . "' />";
							
						if ( trim($tieu_de) == "" )
						{
							$valid_tieu_de = false;
							echo "<span class='selected'>Bạn chưa nhập tiêu đề</span>";

						}
					}

					echo "</td></tr>";

					// noi dung

					$valid_noi_dung = false;


					if ( !isset( $_POST['noi_dung'] ) )
					{
						echo "<tr><td id='td_nd'>Nội dung: <span class='selected2'>*</span></td><td><textarea id='noi_dung' rows='8' name='noi_dung'></textarea>";
							
					}
					else
					{
						$valid_noi_dung = true;

						$noi_dung = $_POST['noi_dung'];

						echo "<tr><td id='td_nd'>Nội dung: <span class='selected2'>*</span></td><td><textarea id='noi_dung' rows='8' name='noi_dung'>$noi_dung</textarea>";
							
						if ( trim($noi_dung) == "" )
						{
							$valid_noi_dung = false;
							echo "<span class='selected'>Bạn chưa nhập nội dung</span></td>";
						}
							
					}

					echo "</td></tr>";

					echo "</table>";

					echo "<br/><span class='bold indent'>";

					if ( $nhu_cau < 3 )
						echo "Địa chỉ";
					else
						echo "Khu vực";

					echo "</span><br/><br/>";

					echo "<table id='table2'>";

					// tinh thanh

					if (isset($_POST["tinh_thanh"])) $tinh_thanh = $_POST["tinh_thanh"];
					else $tinh_thanh = "0";

					echo '<tr><td>Tỉnh/Thành: <span class="selected2">*</span></td><td><select id="select_tinh_thanh" name="tinh_thanh">';

					echo "<option value='0'>Chọn</option>";

					if ( !$res = mysqli_query($conn, "select * from tinh_thanh") )
						query_exec_err();

					$valid_tinh_thanh = loop_select($res, $tinh_thanh);

					echo "</select>";

					if ( !$valid_tinh_thanh & isset($_POST['tinh_thanh']) )
					{
						echo "<span class='selected'>Bạn chưa chọn tỉnh thành</span>";
					}


					echo "</td></tr>";

					// quan huyen

					if ( isset($_POST['quan_huyen']) )
						$quan_huyen = $_POST['quan_huyen'];
					else $quan_huyen = "0";

					$valid_quan_huyen = false;


					echo "<tr><td>Quận/Huyện:";

					if ( $nhu_cau == "1" | $nhu_cau == "2" )
						echo " <span class='selected2'>*</span>";

					echo "</td><td><select id='select_quan_huyen' name='quan_huyen'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_tinh_thanh )
					{
						if ( !$res = mysqli_query($conn, "select ma_quan_huyen, ten_quan_huyen from quan_huyen where ma_tinh_thanh = " . $tinh_thanh) )
							query_exec_err();
							
						$valid_quan_huyen = loop_select($res, $quan_huyen);
					}

					echo "</select>";

					if ( $nhu_cau == "3" | $nhu_cau == "4" )
					{
						if ( $quan_huyen === "0" )
							$valid_quan_huyen = true;
					}

					if ( $nhu_cau == "1" | $nhu_cau == "2" )
					{
						if ( !$valid_quan_huyen & isset($_POST['quan_huyen']) )
							echo "<span class='selected'>Bạn chưa chọn quận huyện</span>";
					}

					echo "</td></tr>";

					//phuong xa

					if ( isset($_POST['phuong_xa']) )
						$phuong_xa = $_POST['phuong_xa'];
					else $phuong_xa = "0";

					$valid_phuong_xa = false;

					echo "<tr><td>Phường/Xã: </td><td><select id='select_phuong_xa' name='phuong_xa'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_quan_huyen )
					{
						if (!$result = mysqli_query($conn, "select ma_phuong_xa, ten_phuong_xa from phuong_xa where ma_quan_huyen = " . $quan_huyen ) )
							query_exec_err();
							
						$valid_phuong_xa = loop_select($result, $phuong_xa);
					}

					echo "</select></td></tr>";


					if ( $phuong_xa === "0" ) $valid_phuong_xa = true;

					//so nha duong
					if ( $nhu_cau < 3 )
					{
						if ( isset( $_POST['so_nha'] ) )
							$so_nha = $_POST['so_nha'];
						else $so_nha = "";

						echo "<tr><td>Số nhà:</td><td><input type='text' id='so_nha' name='so_nha' maxlength='150' value='" . str_replace("'", "&#34;", $so_nha ) . "' />";

						echo "</tr>";
					}
					echo "</table>";
					if ( $nhu_cau < 3 )
					{
						echo "<br/>";
						?>

			<script>
					var infowindow, marker;
					function initialize()
					{
						var myCenter = new google.maps.LatLng( 10.771654, 106.698285 );
						var mapProp = {
							center: myCenter,
							zoom: 16,
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
						
						var html = "<div id='div_map'>Ghi chú:<br/>" +
						"<textarea id='text_map' cols='25' rows='4'></textarea>" + 
						"<input type='button' id='but_map' onclick='set_data(event)' value='Lưu'/></div>";
			
						infowindow = new google.maps.InfoWindow({
			    			content: html
			 			});

						marker = new google.maps.Marker({
						  });
						  
						google.maps.event.addListener(map, 'click', function(event) {						
							
							var location = event.latLng;
							$("#h_input_lat").val(location.lat());
							$("#h_input_lng").val(location.lng());
							
							marker.setPosition(location);
							marker.setMap(map);
							infowindow.open(map,marker);	
											
						});

						google.maps.event.addListener(marker, 'click', function() {	
							infowindow.open(map,marker);						
						});	

					}
					function set_data(e)
					{
						e.stopPropagation();
						var note = $("#text_map").val();
						if ( note != "" )
						{
							var html = "<div id='div_map'>Ghi chú:<br/>" +
							"<textarea id='text_map' cols='25' rows='4'>" + note + "</textarea>" + 
							"<input type='button' id='but_map' onclick='set_data(event)' value='Lưu'/></div>";
							infowindow.setContent(html);
							$("#h_input_note").val( note );	
						}				
						infowindow.close();						
					}
					function loadScript()
					{
						var script = document.createElement("script");
						script.type = "text/javascript";
						script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBQEEBXoivv7OlyNYkJgDRI2_Ry93OMZiE&sensor=false&callback=initialize";
						document.body.appendChild(script);
					}

					
					
					window.onload = loadScript;
					</script>
			<div id="googleMap"></div>

			<?php
			echo "<br/>";
					}
					echo "<br/><span class='bold indent'>Giá</span><br/><br/>";

					echo "<table id='table3'>";
					?>

			<?php 

			// gia
			if ( isset($_POST['gia']) )
				$gia = $_POST['gia'];

			$valid_gia = false;

			echo "<tr><td>Giá (triệu):";

			if ( $nhu_cau < 3 )
				echo " <span class='selected2'>*</span>";

			echo "</td>";

			if ( !isset($_POST['gia']) )
			{
				echo "<td><input class='gia' name='gia' id='input_gia' type='text'
				size='20' maxlength='7' />";
			}
			else if (is_numeric($gia) and $gia >= 0 and $gia <= MAX_GIA)
			{
				$valid_gia = true;
				echo "<td><input class='gia' value=\"". $gia . "\" name='gia' id='input_gia' type='text'
				size='20' maxlength='7' />";

			}
			else
			{
					
				echo "<td><input class='gia' value=\"". str_replace('"', "&#34;", $gia ) . "\" name='gia' id='input_gia' type='text'
				size='20' maxlength='7' />";
				if ( $nhu_cau < 3 )
				{
					if ( $gia === "" )
						echo "<span class='selected'>Bạn chưa điền giá</span>";
					else
						echo "<span class='selected'>Giá không hợp lệ</span>";
				}
				else
				{
					if ( $gia === "" )
						$valid_gia = true;
				}

			}
			echo "</td></tr>";

			echo "<tr><td></td>";

			if ( isset( $_POST["gia"] ) )
			{
				if ($valid_gia) {
					if ( ($x = $gia/1000) >= 1  )
						echo "<td><span id='span_gia'>".$x." tỷ"."</span></td>";
					else
						echo "<td><span id='span_gia'>" . $gia . " triệu"."</span></td>";
				}
				else echo "<td><span id='span_gia'>" . $gia . "</span></td>";
			}
			else
				echo  "<td><span id='span_gia'></span></td>";

			echo "</tr>";
			// Đơn vị

			if (isset($_POST["don_vi"])) $don_vi = $_POST["don_vi"];
			else $don_vi = "1";

			echo "<tr><td>Đơn vị:</td><td><select id='select_don_vi' name='don_vi'>";

			if ( !$res = mysqli_query($conn, "select * from don_vi") )
				query_exec_err();

			$valid_don_vi = loop_select($res, $don_vi);

			echo "</select></td>";

			if ( !$valid_don_vi )
				echo "<td><span class='selected'>Bạn chưa chọn đơn vị</span></td>";

			echo "</tr>";

			echo "</table>";

			echo "<table id='table4'>";

			echo "<br/><span class='bold indent'>Diện tích</span><br/><br/>";

			// dien tich

			if ( isset($_POST['dien_tich']) )
				$dien_tich = $_POST['dien_tich'];

			$valid_dien_tich = false;

			echo "<tr><td>Diện tích (m2):";

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
				echo "<span class='selected2'>*</span>";

			echo "</td>";

			if ( !isset($_POST['dien_tich']) )
			{
				echo "<td><input class='dien_tich' name='dien_tich' id='input_dien_tich' type='text'
				size='20' maxlength='8' />";
			}
			else if (is_numeric($dien_tich) and $dien_tich >= 0 and $dien_tich <= MAX_DT)
			{
				$valid_dien_tich = true;
				echo "<td><input class='dien_tich' value=\"". $dien_tich . "\" name='dien_tich' id='input_dien_tich' type='text'
				size='20' maxlength='8' />";
					
			}
			else
			{
					
				echo "<td><input class='dien_tich' value=\"". str_replace('"', "&#34;", $dien_tich ) . "\" name='dien_tich' id='input_dien_tich' type='text'
				size='20' maxlength='8' />";

				if ( $nhu_cau == "1" | $nhu_cau == "2" )
				{
					if ( $dien_tich === "" )
						echo "<span class='selected'>Bạn chưa điền diện tích</span>";
					else
						echo "<span class='selected'>Diện tích không hợp lệ</span>";

				}
				else {
					if ( $dien_tich === "")
						$valid_dien_tich = true;
				}
			}


			echo "</td></tr>";

			echo "<tr><td></td>";

			if ( isset( $_POST["dien_tich"] ) )
			{
				if ( $valid_dien_tich & $dien_tich != "" )
				{
					if ( ($x = $dien_tich/10000) >= 1  )
						echo "<td><span id='span_dt'>".$x." ha"."</span></td>";
					else
						echo "<td><span id='span_dt'>".$dien_tich." m2"."</span></td>";
				}
				else echo "<td><span id='span_dt'>" . $dien_tich . "</span></td>";
			}
			else
				echo  "<td><span id='span_dt'></span></td>";

			echo "</tr>";
			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{
				// chieu ngang
					
				if ( isset($_POST['chieu_ngang']) )
					$chieu_ngang = $_POST['chieu_ngang'];
					

				$valid_chieu_ngang = false;


				echo "<tr><td>Chiều ngang (m):</td>";

				if ( !isset($_POST['chieu_ngang']) )
				{
					echo "<td><input class='chieu_ngang' name='chieu_ngang' id='input_chieu_ngang' type='text'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($chieu_ngang) and $chieu_ngang >= 0 and $chieu_ngang <= MAX_SODO)
				{
					$valid_chieu_ngang = true;
					echo "<td><input class='chieu_ngang' value=\"". $chieu_ngang . "\" name='chieu_ngang' id='input_chieu_ngang' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='chieu_ngang' value=\"". str_replace('"', "&#34;", $chieu_ngang ) . "\" name='chieu_ngang' id='input_chieu_ngang' type='text'
					size='20' maxlength='5' />";

					if ( $chieu_ngang === "" )
						$valid_chieu_ngang = true;

					if ( $chieu_ngang !== "" )
						echo "<span class='selected'>Chiều ngang không hợp lệ</span>";
				}
					
				//
					


				// chieu doc
				if ( isset($_POST['chieu_doc']) )
					$chieu_doc = $_POST['chieu_doc'];

				$valid_chieu_doc = false;


				echo "<tr><td>Chiều doc (m):</td>";

				if ( !isset($_POST['chieu_doc']) )
				{
					echo "<td><input class='chieu_doc' name='chieu_doc' id='input_chieu_doc' type='text'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($chieu_doc) and $chieu_doc >= 0 and $chieu_doc <= MAX_SODO)
				{
					$valid_chieu_doc = true;
					echo "<td><input class='chieu_doc' value=\"". $chieu_doc . "\" name='chieu_doc' id='input_chieu_doc' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='chieu_doc' value=\"". str_replace('"', "&#34;", $chieu_doc ) . "\" name='chieu_doc' id='input_chieu_doc' type='text'
					size='20' maxlength='5' />";

					if ( $chieu_doc === "" )
						$valid_chieu_doc = true;

					if ( $chieu_doc !== "" )
						echo "<span class='selected'>Chiều dọc không hợp lệ</span>";
				}

					
				//



				// no hau
				if ( isset($_POST['no_hau']) )
					$no_hau = $_POST['no_hau'];

				$valid_no_hau = false;


				echo "<tr><td>Nở hậu (m):</td>";

				if ( !isset($_POST['no_hau']) )
				{
					echo "<td><input class='no_hau' name='no_hau' id='input_no_hau' type='text'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($no_hau) and $no_hau >= 0 and $no_hau <= MAX_SODO)
				{
					$valid_no_hau = true;
					echo "<td><input class='no_hau' value=\"". $no_hau . "\" name='no_hau' id='input_no_hau' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='no_hau' value=\"". str_replace('"', "&#34;", $no_hau ) . "\" name='no_hau' id='input_no_hau' type='text'
					size='20' maxlength='5' />";

					if ( $no_hau === "" )
						$valid_no_hau = true;

					if ( $no_hau !== "" )
						echo "<span class='selected'>Nở hậu không hợp lệ</span>";
				}
					
				//
			}


			echo "</table>";

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{
				echo "<br/><span class='bold indent'>Đặc điểm</span><br/><br/>";
					
				echo "<table id='table5'>";
					
				// Vi tri
					
				if (isset($_POST["vi_tri"])) $vi_tri = $_POST["vi_tri"];
				else $vi_tri = "0";

					
				echo '<tr><td>Vị trí:</td><td><select id="select_vi_tri" name="vi_tri">';
					
				echo "<option value='0'>Chọn</option>";
					
				if ( !$res = mysqli_query($conn, "select * from vi_tri") )
					query_exec_err();

				$valid_vi_tri = loop_select($res, $vi_tri);
					
				echo "</select></td></tr>";
					
				if ( $vi_tri === "0" )
					$valid_vi_tri = true;
					
				// Huong


				if (isset($_POST["huong"])) $huong = $_POST["huong"];
				else $huong = "0";
					
				echo '<tr><td>Hướng:</td><td><select id="select_huong" name="huong">';
					
				echo "<option value='0'>Chọn</option>";
					
				if ( !$res = mysqli_query($conn, "select * from huong") )
					query_exec_err();
					
				$valid_huong = loop_select($res, $huong);

				echo "</select></td></tr>";

				if ( $huong === "0" )
					$valid_huong = true;
					

				// Phap ly


				if (isset($_POST["phap_ly"])) $phap_ly = $_POST["phap_ly"];
				else $phap_ly = "0";
					
				echo '<tr><td>Pháp lý:</td><td><select id="select_phap_ly" name="phap_ly">';
					
				echo "<option value='0'>Chọn</option>";
					
				if ( !$res = mysqli_query($conn, "select * from phap_ly") )
					query_exec_err();
					
				$valid_phap_ly = loop_select($res, $phap_ly);

				echo "</select></td></tr>";

				if ( $phap_ly === "0" )
					$valid_phap_ly = true;

				// Đường rộng

				if ( isset($_POST['duong_rong']) )
					$duong_rong = $_POST['duong_rong'];

					
					
				$valid_duong_rong = false;

					
				echo "<tr><td>Đường vào rộng (m):</td>";
					
				if ( !isset($_POST['duong_rong']) )
				{

					echo "<td><input class='duong_rong' name='duong_rong' id='input_duong_rong' type='text'
					maxlength='3' />";
				}
				else if (is_numeric($duong_rong) and $duong_rong >= 0 and $duong_rong <= MAX_DUONG)
				{
					$valid_duong_rong = true;
					echo "<td><input class='duong_rong' value=\"". $duong_rong . "\" name='duong_rong' id='input_duong_rong' type='text'
					maxlength='3' />";

				}
				else
				{

					echo "<td><input class='duong_rong' value=\"". str_replace('"', "&#34;", $duong_rong ) . "\" name='duong_rong' id='input_duong_rong' type='text'
					maxlength='3' />";

					if ( $duong_rong === "" )
						$valid_duong_rong = true;

					if ( $duong_rong !== "" )
						echo "<span class='selected'>Đường vào rộng không hợp lệ</span>";
				}

					
				//

				echo "</td></tr>";
					
				echo "</table>";
					
					
				//

				if ($loai_bds !== "4")
				{
					// so tang

					if ( isset($_POST['so_tang']) )
						$so_tang = $_POST['so_tang'];


					$valid_so_tang = false;

					echo "<div id='tang_phong'><br/><span class='bold indent'>Tầng phòng</span><br/><br/>";
					echo "<table id='table6'>";
					echo "<tr><td>Số tầng:</td>";

					if ( !isset($_POST['so_tang']) )
					{
							
						echo "<td><input class='so_tang' name='so_tang' id='input_so_tang' type='text'
						size='10' maxlength='3' />";
					}
					else if (is_numeric($so_tang) and $so_tang >= 0 and $so_tang <= MAX_TANG)
					{
						$valid_so_tang = true;
						echo "<td><input class='so_tang' value=\"". $so_tang . "\" name='so_tang' id='input_so_tang' type='text'
						size='10' maxlength='3' />";

					}
					else
					{

						echo "<td><input class='so_tang' value=\"". str_replace('"', "&#34;", $so_tang ) . "\" name='so_tang' id='input_so_tang' type='text'
						size='10' maxlength='3' />";
						if ( $so_tang === "" )
							$valid_so_tang = true;
						if ( $so_tang !== "" )
							echo "<span class='selected'>Số tầng không hợp lệ</span>";
					}

					echo "</td></tr>";

					// so phong ngu

					if ( isset($_POST['so_phong_ngu']) )
						$so_phong_ngu = $_POST['so_phong_ngu'];


					$valid_so_phong_ngu = false;


					echo "<tr><td>Số phòng ngủ:</td>";

					if ( !isset($_POST['so_phong_ngu']) )
					{

						echo "<td><input class='so_phong_ngu' name='so_phong_ngu' id='input_so_phong_ngu' type='text'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_ngu) and $so_phong_ngu >= 0 and $so_phong_ngu <= MAX_SODO)
					{
						$valid_so_phong_ngu = true;
						echo "<td><input class='so_phong_ngu' value=\"". $so_phong_ngu . "\" name='so_phong_ngu' id='input_so_phong_ngu' type='text'
						size='10' maxlength='5' />";

					}
					else
					{

						echo "<td><input class='so_phong_ngu' value=\"". str_replace('"', "&#34;", $so_phong_ngu ) . "\" name='so_phong_ngu' id='input_so_phong_ngu' type='text'
						size='10' maxlength='5' />";

						if ( $so_phong_ngu === "" )
							$valid_so_phong_ngu = true;

						if ( $so_phong_ngu !== "" )
							echo "<span class='selected'>Số phòng ngủ không hợp lệ</span>";

					}

					echo "</td></tr>";

					//so phong khach


					if ( isset($_POST['so_phong_khach']) )
						$so_phong_khach = $_POST['so_phong_khach'];

					$valid_so_phong_khach = false;


					echo "<tr><td>Số phòng khách:</td>";

					if ( !isset($_POST['so_phong_khach']) )
					{

						echo "<td><input class='so_phong_khach' name='so_phong_khach' id='input_so_phong_khach' type='text'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_khach) and $so_phong_khach >= 0 and $so_phong_khach <= MAX_SODO)
					{
						$valid_so_phong_khach = true;
						echo "<td><input class='so_phong_khach' value=\"". $so_phong_khach . "\" name='so_phong_khach' id='input_so_phong_khach' type='text'
						size='10' maxlength='5' />";

					}
					else
					{

						echo "<td><input class='so_phong_khach' value=\"". str_replace('"', "&#34;", $so_phong_khach ) . "\" name='so_phong_khach' id='input_so_phong_khach' type='text'
						size='10' maxlength='5' />";

						if ( $so_phong_khach === "" )
							$valid_so_phong_khach = true;

						if ( $so_phong_khach !== "" )
							echo "<span class='selected'>Số phòng khách không hợp lệ</span>";
							
					}

					echo "</tr>";
					//so phong wc


					if ( isset($_POST['so_phong_wc']) )
						$so_phong_wc = $_POST['so_phong_wc'];

					$valid_so_phong_wc = false;


					echo "<tr><td>Số phòng tắm/WC:</td>";

					if ( !isset($_POST['so_phong_wc']) )
					{

						echo "<td><input class='so_phong_wc' name='so_phong_wc' id='input_so_phong_wc' type='text'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_wc) and $so_phong_wc >= 0 and $so_phong_wc <= MAX_SODO)
					{
						$valid_so_phong_wc = true;
						echo "<td><input class='so_phong_wc' value=\"". $so_phong_wc . "\" name='so_phong_wc' id='input_so_phong_wc' type='text'
						size='10' maxlength='5' />";

					}
					else
					{

						echo "<td><input class='so_phong_wc' value=\"". str_replace('"', "&#34;", $so_phong_wc ) . "\" name='so_phong_wc' id='input_so_phong_wc' type='text'
						size='10' maxlength='5' />";

						if ( $so_phong_wc === "" )
							$valid_so_phong_wc = true;

						if ( $so_phong_wc !== "" )
							echo "<span class='selected'>Số phòng tắm/WC không hợp lệ</span>";
							
					}


					//

					echo "</tr>";

					// so phong khac


					if ( isset($_POST['so_phong_khac']) )
						$so_phong_khac = $_POST['so_phong_khac'];

					$valid_so_phong_khac = false;


					echo "<tr><td>Số phòng khác:</td>";

					if ( !isset($_POST['so_phong_khac']) )
					{

						echo "<td><input class='so_phong_khac' name='so_phong_khac' id='input_so_phong_khac' type='text'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_khac) and $so_phong_khac >= 0 and $so_phong_khac <= MAX_SODO)
					{
						$valid_so_phong_khac = true;
						echo "<td><input class='so_phong_khac' value=\"". $so_phong_khac . "\" name='so_phong_khac' id='input_so_phong_khac' type='text'
						size='10' maxlength='5' />";

					}
					else
					{

						echo "<td><input class='so_phong_khac' value=\"". str_replace('"', "&#34;", $so_phong_khac ) . "\" name='so_phong_khac' id='input_so_phong_khac' type='text'
						size='10' maxlength='5' />";

						if ( $so_phong_khac === "" )
							$valid_so_phong_khac = true;

						if ( $so_phong_khac !== "" )
							echo "<span class='selected'>Số phòng khác không hợp lệ</span>";
							

					}


					//
					echo "</tr>";

					echo "</table></div>";

				}
				else
				{
					$valid_so_tang = true;
					$valid_so_phong_ngu = true;
					$valid_so_phong_khach = true;
					$valid_so_phong_khac = true;
					$valid_so_phong_wc = true;

				}
					

					
				echo "</table>";
				////////// Tiện ích
				echo "<br/><span class='bold indent'>Tiện ích:</span><br/><br/>";
					
				$arr1 = array("1" => "Mới xây", "2" => "Chỗ để ô tô", "3" => "Sân vườn", "4" => "Sân thượng", "5" => "Hồ bơi");
					
				$arr2 = array("6" => "Tiện kinh doanh", "7" => "Tiện sản xuất", "8" => "Tiện mở văn phòng");

				$arr3 = array("9" => "Gần chợ", "10" => "Gần siêu thị", "11" => "Gần bệnh viện", "12" => "Gần công viên");

				function loop_check($arr) {
					while ( list($id, $value) = each($arr) ) {

						if ( isset( $_POST[$id] ) )
							echo "<tr><td><input type='checkbox' checked='checked' name='$id' ></td><td>$value</td>";
						else
							echo "<tr><td><input type='checkbox' name='$id' ></td><td>$value</td>";
					}
				}
					
				if ( $loai_bds !== "4" )
				{
					echo "<table id='table7'>";
					loop_check($arr1);
					echo "</table>";
				}
				echo "<table id='table8'>";
				loop_check($arr2);
				echo "</table>";
					
				echo "<table id='table9'>";
				loop_check($arr3);
				echo "</table>";
			}
			echo "<div class='clear'></div>";

			echo "<br/><span class='bold indent'>Hình ảnh:</span><br/><br/>";

			$temp_dir = "images/temp/{$_SESSION['id']}";

			?>
			<div id="images_container">
				<?php 

				if (is_dir($temp_dir) && $handle = opendir($temp_dir)) {
					while (false !== ($file = readdir($handle))) {
						if ( $file != "." & $file != ".." )
						{
							$arr = explode(".", $file);
							$id = $arr[0];
							echo "<div class='div_image' id='$id'>
							<img class='upload' src='$temp_dir/$file'></img>
							<a class='xoa_anh' href='javascript:void(0)' onclick=\"remove_image('$id')\">xóa</a>
							</div>";
						}
					}
					closedir($handle);
				}
				?>
			</div>
			<div class='clear'></div>
			<div id='error'></div>
			<iframe id='frame' src="up-anh.php"> </iframe>

			<?php 
			echo "<br/><br/><span class='bold indent'>Liên hệ</span><br/><br/>";
			echo "<table id='table10'>";

			if ( !$res = mysqli_query( $conn, "select email, dia_chi, dien_thoai from thanh_vien where ma_thanh_vien = " . $_SESSION['id'] ) )
				query_exec_err();
			$row = mysqli_fetch_array($res);

			$valid_ho_ten = false;

			if ( !isset( $_POST['ho_ten'] ) )
			{
				echo "<tr><td>Tên liên hệ: <span class='selected2'>*</span></td><td><input type='text' name='ho_ten' maxlength='50' value='" . $_SESSION['ho_ten'] . "' />";
			}
			else
			{
				$ho_ten = $_POST['ho_ten'];

				$valid_ho_ten = validate_ho_ten($ho_ten, $err);

				echo "<tr><td>Tên liên hệ: <span class='selected2'>*</span></td><td><input type='text' name='ho_ten' maxlength='50' value='" . $ho_ten . "' />";

				if ( !$valid_ho_ten)
					echo "<span class='selected'>$err</span>";
			}



			echo "</td></tr>";

			$valid_dien_thoai = false;

			if ( !isset( $_POST['dien_thoai'] ) )
			{
				echo "<tr><td>Điện thoại: <span class='selected2'>*</span></td><td><input type='text' name='dien_thoai' maxlength='20' value='" . $row['dien_thoai'] . "' />";
			}
			else
			{
				$dien_thoai = $_POST['dien_thoai'];
				$valid_dien_thoai = validate_dien_thoai($dien_thoai, $err);
				echo "<tr><td>Điện thoại: <span class='selected2'>*</span></td><td><input type='text' name='dien_thoai' maxlength='20' value='" . $dien_thoai . "' />";
				if ( !$valid_dien_thoai)
					echo "<span class='selected'>$err</span>";
			}



			echo "</td></tr>";

			$valid_email = false;

			if ( !isset( $_POST['email'] ) )
			{
				echo "<tr><td>Email:</td><td><input type='text' name='email' maxlength='50' value='" . $row['email'] . "' />";
			}
			else
			{
				$email = $_POST['email'];

				if ( $email === "" | preg_match("/^([A-Za-z0-9\_\-]+\.)*[A-Za-z0-9\_\-]+@[A-Za-z0-9\_\-]+(\.[A-Za-z0-9\_\-]+)+$/", $email ) )
					$valid_email = true;

				echo "<tr><td>Email:</td><td><input type='text' name='email' maxlength='50' value='" . $email . "' />";

				if ( !$valid_email )
					echo "<span class='selected'>Email không hợp lệ</span>";
			}

			echo "</td></tr>";

			if ( isset( $_POST['dia_chi'] ) )
				$dia_chi = trim($_POST['dia_chi']);
			else $dia_chi = "";

			$valid_dia_chi = true;

			if ( !isset( $_POST['dia_chi'] ) )
			{
				echo "<tr><td>Địa chỉ:</td><td><input type='text' name='dia_chi' maxlength='100' value='" . $row['dia_chi'] . "' /></td></tr>";
			}
			else
			{
				if ( strlen($dia_chi) > 100 )
					$valid_dia_chi = false;
				echo "<tr><td>Địa chỉ:</td><td><input type='text' name='dia_chi' maxlength='100' value='" . $dia_chi . "' /></td></tr>";

			}
			echo "</table>";

			echo "<div id='div_submit'><button name='luu_tin' type='submit' id='but_luu_tin'>Lưu tin</button><button name='dang_tin' type='submit'>Đăng tin</button>";
			?>
			<input name='h_input_note' id='h_input_note' type='hidden' /> <input
				name='h_input_lat' id='h_input_lat' type='hidden' /> <input
				name='h_input_lng' id='h_input_lng' type='hidden' />
			<?php 
			echo "</form>";



			$valid_coor = false;

			if ( !empty($_POST['h_input_lat']) )
				$lat = trim($_POST['h_input_lat']);
			else $lat = "";

			if ( !empty($_POST['h_input_lng']) )
				$lng = trim($_POST['h_input_lng']);
			else $lng = "";

			if ( $lat === "" & $lng === "")
			{
				$valid_coor = true;
			}
			else if ( is_numeric( $lat ) & is_numeric( $lng ) & $lat > -1000 & $lat < 10000 & $lng > -1000 & $lng < 10000 )
			{
				$valid_coor = true;
			}

			$valid_note = false;

			if ( !empty( $_POST['h_input_note'] ) )
				$note = $_POST['h_input_note'];
			else $note = "";

			if ( strlen($note) <= 100 )
				$valid_note = true;

			date_default_timezone_set("Asia/Ho_Chi_Minh");

			/*var_dump($valid_kieu_bds);var_dump($valid_loai_bds);var_dump($valid_tieu_de);var_dump($valid_noi_dung);var_dump($valid_tinh_thanh);
			 var_dump($valid_quan_huyen);var_dump($valid_phuong_xa);var_dump($valid_gia);var_dump($valid_don_vi);var_dump($valid_dien_tich);
			var_dump($valid_chieu_ngang);var_dump($valid_chieu_doc);var_dump($valid_no_hau );var_dump($valid_vi_tri);var_dump($valid_huong);
			var_dump($valid_phap_ly);var_dump($valid_duong_rong);var_dump($valid_so_tang);var_dump($valid_so_phong_ngu);var_dump($valid_so_phong_khach);
			var_dump($valid_so_phong_wc);var_dump($valid_so_phong_khac);var_dump($valid_ho_ten);var_dump($valid_dien_thoai);var_dump($valid_email);
			*/

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{
				if ( $valid_kieu_bds & $valid_loai_bds & $valid_tieu_de & $valid_noi_dung & $valid_tinh_thanh & $valid_quan_huyen
						& $valid_phuong_xa & $valid_gia & $valid_don_vi & $valid_dien_tich & $valid_chieu_ngang & $valid_chieu_doc
						& $valid_no_hau & $valid_vi_tri & $valid_huong & $valid_phap_ly & $valid_duong_rong & $valid_so_tang & $valid_so_phong_ngu
						& $valid_so_phong_khach & $valid_so_phong_wc & $valid_so_phong_khac & $valid_ho_ten & $valid_dien_thoai & $valid_email
						& $valid_coor & $valid_note & $valid_dia_chi)
				{

					if ( isset($_POST['luu_tin']) )
					{
						$trang_thai = 2;
					}
					else if ( isset($_POST['dang_tin']) )
					{
						$trang_thai = 3;
					}

					if ( $phuong_xa == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_phuong_xa) as phuong_xa from phuong_xa where ma_quan_huyen = $quan_huyen" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);

						$phuong_xa = $row['phuong_xa'];
					}

					if ( $kieu_bds == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_kieu_bds) as kieu_bds from kieu_bds where ma_loai_bds = $loai_bds" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);

						$kieu_bds = $row['kieu_bds'];
					}


					//start transaction
					if (!mysqli_query($conn,'START TRANSACTION'))
						query_exec_err();

					//echo "insert into tin values (NULL, $phuong_xa, $kieu_bds, $nhu_cau,'" . date('Y-m-d H:i:s') . "', $dien_tich, $gia, $don_vi, $trang_thai)";

					if ( !mysqli_query( $conn, "insert into tin values (NULL, $phuong_xa, $kieu_bds, $nhu_cau,'" . date('Y-m-d H:i:s') . "', $dien_tich, $gia, $don_vi, $trang_thai, " . $_SESSION['id'] . ")" ) )
						query_exec_err();


					$ma_tin = mysqli_insert_id($conn);


					if ( !mysqli_query( $conn, "insert into tin_noi_dung values( $ma_tin, '" . mysqli_real_escape_string( $conn, $tieu_de) . "', '" . mysqli_real_escape_string( $conn, $noi_dung ) . "' )" ) )
						query_exec_err();



					if ( trim( $so_nha ) != "" )
						if ( !mysqli_query( $conn, "insert into tin_so_nha_duong values( $ma_tin, '" . mysqli_real_escape_string( $conn, $so_nha ) . "' )" ) )
						query_exec_err();



					if ( $chieu_ngang != "" | $chieu_doc != "" | $no_hau != "" )
					{
						if ( $chieu_ngang == "" )
							$chieu_ngang = 'null';
						if ( $chieu_doc == "" )
							$chieu_doc = 'null';
						if ( $no_hau == "" )
							$no_hau = 'null';

						if ( !mysqli_query( $conn, "insert into tin_so_do values($ma_tin, $chieu_ngang, $chieu_doc, $no_hau)" ) )
							query_exec_err();
					}

					if ( $vi_tri != "0" | $huong != "0" | $phap_ly != "0" )
					{
						if ( $vi_tri == "0" )
							$vi_tri = 'null';
						if ( $huong == "0" )
							$huong = 'null';
						if ( $phap_ly == "0" )
							$phap_ly = 'null';
							
						if ( !mysqli_query( $conn, "insert into tin_vi_tri_huong_phap_ly values($ma_tin, $vi_tri, $huong, $phap_ly)" ) )
							query_exec_err();
					}

					if ( $duong_rong != "" )
						if ( !mysqli_query($conn, "insert into tin_duong_rong values($ma_tin, $duong_rong)") )
						query_exec_err();

					if ( $so_tang != "" | $so_phong_ngu != "" )
					{
						if ( $so_tang == "" )
							$so_tang = 'null';
						if ( $so_phong_ngu == "" )
							$so_phong_ngu = 'null';

						if ( !mysqli_query( $conn, "insert into tin_so_tang_phong_ngu values($ma_tin, $so_tang, $so_phong_ngu)" ) )
							query_exec_err();

					}

					if ( $so_phong_khach != "" )
						if ( !mysqli_query( $conn, "insert into tin_so_phong_khach values($ma_tin, $so_phong_khach)" ) )
						query_exec_err();

					if ( $so_phong_wc != "" )
						if ( !mysqli_query( $conn, "insert into tin_so_phong_wc values($ma_tin, $so_phong_wc)" ) )
						query_exec_err();

					if ( $so_phong_khac != "" )
						if ( !mysqli_query( $conn, "insert into tin_so_phong_khac values($ma_tin, $so_phong_khac)" ) )
						query_exec_err();

					if ( $loai_bds != "4")
					{
						for ( $i = 1; $i <= 5 ; $i++ )
						{
							if ( isset( $_POST[$i] ) )
								if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
								query_exec_err();
						}

							
					}

					for ( $i = 6; $i <= 12 ; $i++ )
					{
						if ( isset( $_POST[$i] ) )
							if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
							query_exec_err();
					}


					if ( $email == "" )
						$email = 'null';

					if ( $dia_chi == "" )
						$dia_chi = 'null';
					
					

					if ( !mysqli_query($conn, "insert into tin_lien_he values($ma_tin, '" . mysqli_real_escape_string($conn, $ho_ten) . "', '$dien_thoai', '$email', '" . mysqli_real_escape_string( $conn, $dia_chi ) . "')") )
						query_exec_err();


					if ( $lat != "" & $lng != "" )
					{
						if ( trim($note) == "" )
							$sql = "insert into tin_dia_diem values($ma_tin, $lat, $lng, null)";
						else $sql = "insert into tin_dia_diem values($ma_tin, $lat, $lng, '" . mysqli_real_escape_string($conn, $note) . "')";
							
						if ( !mysqli_query( $conn, $sql ) )
							query_exec_err();
					}


					if (!mysqli_query($conn,'COMMIT'))
						query_exec_err();
					// end transaction

					$imgs = glob($temp_dir . "/*");

					$num_imgs = count($imgs);

					if ( $num_imgs != 0 )
					{

						$thumbs_dir = "images/$ma_tin/thumbs";
						if ( !is_dir($thumbs_dir) )
							mkdir($thumbs_dir, 0777, true);

						$imgs_dir = "images/$ma_tin/imgs";
						if ( !is_dir($imgs_dir) )
							mkdir($imgs_dir, 0777, true);

						for ( $i = 0; $i < $num_imgs; $i ++ )
						{
							$img = explode("/", $imgs[$i]);
							copy($imgs[$i], $imgs_dir . "/" . $img[ count($img) - 1 ]);
							unlink($imgs[$i]);
						}

						createThumbs($imgs_dir, $thumbs_dir, 100);

					}

					ob_end_clean();

					if ( isset($_POST['luu_tin']) )
						echo "<h2 align='center'>Tin đã được lưu.</h2>";
					else if ( isset($_POST['dang_tin']) )
						echo "<h2 align='center'>Đăng tin thành công. Tin sẽ được duyệt trước khi đăng trong vòng 12h</h2>";

				}
			}
			else
			{
				if ( $valid_kieu_bds & $valid_loai_bds & $valid_tieu_de & $valid_noi_dung & $valid_tinh_thanh & $valid_quan_huyen
						& $valid_phuong_xa & $valid_gia & $valid_don_vi & $valid_dien_tich & $valid_ho_ten & $valid_dien_thoai & $valid_email
						& $valid_dia_chi )
				{



					if ( isset($_POST['luu_tin']) )
					{
						$trang_thai = 2;
					}
					else if ( isset($_POST['dang_tin']) )
					{
						$trang_thai = 3;
					}


					if ( $quan_huyen == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_quan_huyen) as ma_quan_huyen from quan_huyen where ma_tinh_thanh = $tinh_thanh") )
							query_exec_err();

						$row = mysqli_fetch_array($res);

						if ( !$res2 = mysqli_query($conn, "select ma_phuong_xa from phuong_xa where ma_quan_huyen = " . $row['ma_quan_huyen'] ) )
							query_exec_err();

						$row2 = mysqli_fetch_array($res2);

						$phuong_xa = $row2['ma_phuong_xa'];

					}
					else if ( $phuong_xa == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_phuong_xa) as phuong_xa from phuong_xa where ma_quan_huyen = $quan_huyen" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$phuong_xa = $row['phuong_xa'];
					}

					if ( $kieu_bds == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_kieu_bds) as kieu_bds from kieu_bds where ma_loai_bds = $loai_bds" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$kieu_bds = $row['kieu_bds'];
					}


					//start transaction
					if (!mysqli_query($conn,'START TRANSACTION'))
						query_exec_err();


					if ( $gia == "" )
					{
						$gia = 'null';
						$don_vi = 'null';
					}

					if ( $dien_tich == "" )
						$dien_tich = 'null';

					if ( !mysqli_query( $conn, "insert into tin values (NULL, $phuong_xa, $kieu_bds, $nhu_cau,'" . date('Y-m-d H:i:s') . "', $dien_tich, $gia, $don_vi, $trang_thai, " . $_SESSION['id'] . ")" ) )
						query_exec_err();


					$ma_tin = mysqli_insert_id($conn);


					if ( !mysqli_query( $conn, "insert into tin_noi_dung values( $ma_tin, '$tieu_de', '$noi_dung' )" ) )
						query_exec_err();


					if ( $email == "" )
						$email = 'null';

					if ( $dia_chi == "" )
						$dia_chi = 'null';

					if ( !mysqli_query($conn, "insert into tin_lien_he values($ma_tin, '" . mysqli_real_escape_string($conn, $ho_ten) . "', '$dien_thoai', '$email', '" . mysqli_real_escape_string( $conn, $dia_chi ) . "')") )
						query_exec_err();



					if (!mysqli_query($conn,'COMMIT'))
						query_exec_err();
					// end transaction

					
					$imgs = glob($temp_dir . "/*");
					
					$num_imgs = count($imgs);
					
					if ( $num_imgs != 0 )
					{
					
						$thumbs_dir = "images/$ma_tin/thumbs";
						if ( !is_dir($thumbs_dir) )
							mkdir($thumbs_dir, 0777, true);
					
						$imgs_dir = "images/$ma_tin/imgs";
						if ( !is_dir($imgs_dir) )
							mkdir($imgs_dir, 0777, true);
					
						for ( $i = 0; $i < $num_imgs; $i ++ )
						{
							$img = explode("/", $imgs[$i]);
							copy($imgs[$i], $imgs_dir . "/" . $img[ count($img) - 1 ]);
							unlink($imgs[$i]);
						}
					
						createThumbs($imgs_dir, $thumbs_dir, 100);
					
					}
					
					ob_end_clean();

					if ( isset($_POST['luu_tin']) )
						echo "<h2 align='center'>Tin đã được lưu.</h2>";
					else if ( isset($_POST['dang_tin']) )
						echo "<h2 align='center'>Đăng tin thành công. Tin sẽ được duyệt trước khi đăng trong vòng 12h</h2>";


				}
			}
				}



			}

			else if ( $muc == "1" ) // quan ly tin dang
			{
				if ( !isset($_GET['ma_tin']) )
				{
					echo "<div id='container2'><form action='thanh-vien.php' method='get' id='form_quan_ly_tin'><fieldset>";
					echo "<legend>";

					if ( isset( $_GET['trang_thai'] ) )
						$trang_thai = $_GET['trang_thai'];
					else $trang_thai = "0";

					$valid_trang_thai = false;

					$arr = array( "0" => "Tất cả", "1" => "Đang đăng", "2" => "Đang soạn", "3" => "Chờ duyệt", "4" => "Hết hạn", "5" => "Không hợp lệ" );


					while ( list($id, $value) = each($arr) ) {

						if ( (string)$id !== $trang_thai )
							echo "<a class='link_trang_thai' id='$id' href='javascript:void(0)'>$value</a>";
						else if ( (string)$id === $trang_thai ) {
							$valid_trang_thai = true;
							echo "<a class='link_trang_thai2 selected'><span class='selected'>$value</a>";
						}
					}

					echo "</legend>";

					echo "<table id='table_quan_ly_tin'>";

					echo "<tr><td>";
					//nhu cau

					if ( isset($_GET['nhu_cau']) ) $nhu_cau = $_GET['nhu_cau'];
					else $nhu_cau = "0";

					echo "<select id='select_nhu_cau2' name='nhu_cau'>";

					echo "<option value='0'>Tất cả nhu cầu</option>";

					if ( !$res = mysqli_query($conn, "select * from nhu_cau") )
						query_exec_err();

					$valid_nhu_cau= loop_select($res, $nhu_cau);

					echo "</select>";

					if ( $nhu_cau === "0" )
						$valid_nhu_cau = true;

					echo "</td><td>";

					//loai bds

					if (isset($_GET['loai_bds'])) $loai_bds = $_GET['loai_bds'];
					else $loai_bds = "0";

					echo "<select id='select_loai_bds2' name='loai_bds'>";

					echo "<option value='0'>Tất cả bất động sản</option>";

					if ( !$res = mysqli_query($conn, "select * from loai_bds") )
						query_exec_err();

					$valid_loai_bds = loop_select($res, $loai_bds);

					echo "</select>";

					if ( $loai_bds === "0" )
						$valid_loai_bds = true;

					echo "</td><td>";
					// tinh thanh

					if (isset($_GET["tinh_thanh"])) $tinh_thanh = $_GET["tinh_thanh"];
					else $tinh_thanh = "0";

					echo "<select id='select_tinh_thanh2' name='tinh_thanh'>";

					echo "<option value='0'>Tất cả tỉnh thành</option>";

					if ( !$res = mysqli_query($conn, "select * from tinh_thanh") )
						query_exec_err();

					$valid_tinh_thanh = loop_select($res, $tinh_thanh);

					echo "</select>";

					if ( $tinh_thanh === "0" )
						$valid_tinh_thanh = true;


					echo "</td><td>";

					// quan huyen

					if ( isset($_GET['quan_huyen']) )
						$quan_huyen = $_GET['quan_huyen'];
					else $quan_huyen = "0";

					$valid_quan_huyen = false;


					echo "<select id='select_quan_huyen2' name='quan_huyen'>";

					echo "<option value='0'>Tất cả quận huyện</option>";

					if ( $valid_tinh_thanh )
					{
						if ( !$res = mysqli_query($conn, "select ma_quan_huyen, ten_quan_huyen from quan_huyen where ma_tinh_thanh = " . $tinh_thanh) )
							query_exec_err();

						$valid_quan_huyen = loop_select($res, $quan_huyen);
					}

					echo "</select>";

					if ( $quan_huyen === "0" )
						$valid_quan_huyen = true;

					echo "</td><td>";

					echo "<input type='submit' value='Tìm kiếm'/>";

					echo "</td></tr></table>";

					echo "</fieldset>";

					echo "<input type='hidden' name='trang_thai' id='hinput_trang_thai' value='" . $trang_thai . "'/>";

					echo "</form>";

					if ( !$valid_trang_thai | !$valid_loai_bds | !$valid_tinh_thanh | !$valid_quan_huyen | !$valid_nhu_cau)
					{
						echo "<h2>Địa chỉ không đúng!</h2>";
						exit();
					}

					echo "<div id='div_result'>";

					echo "<table id='table_result'>";

					$from = " from tin";
					$where = " where ma_thanh_vien = " . $_SESSION['id'];

					if ( $nhu_cau != "0" )
						$where = $where . " and ma_nhu_cau = $nhu_cau";

					if ( $trang_thai != "0" )
						$where = $where . " and ma_trang_thai = $trang_thai";

					if ( $quan_huyen != "0")
					{
						$from = $from . ", phuong_xa";
						$where = $where. " and tin.ma_phuong_xa = phuong_xa.ma_phuong_xa and phuong_xa.ma_quan_huyen = ".$quan_huyen;
					}
					else if ( $tinh_thanh != "0" )
					{
						$from = $from . ", phuong_xa, quan_huyen";
						$where = $where. " and tin.ma_phuong_xa = phuong_xa.ma_phuong_xa and phuong_xa.ma_quan_huyen = quan_huyen.ma_quan_huyen and quan_huyen.ma_tinh_thanh = ".$tinh_thanh;

					}

					if ( $loai_bds != "0")
					{
						$from = $from .", kieu_bds";
						$where = $where . " and tin.ma_kieu_bds = kieu_bds.ma_kieu_bds and kieu_bds.ma_loai_bds = ".$loai_bds;
					}



					$sql = "select SQL_CALC_FOUND_ROWS ma_tin, ma_trang_thai, thoi_gian_dang" . $from . $where . " order by thoi_gian_dang desc limit 0, 20";

					if ( !$res1 = mysqli_query($conn, $sql) )
						query_exec_err();

					if ( !$res4 = mysqli_query($conn, "select found_rows()") )
						query_exec_err();

					$row4 = mysqli_fetch_array( $res4 );

					if ( $row4[0] == "0" )
					{
						exit();
					}

					date_default_timezone_set("Asia/Ho_Chi_Minh");

					echo "<tr><th>Mã tin</th><th id='th_tieu_de'>Tiêu đề</th><th>Trạng thái</th><th>Ngày đăng</th><th>Thao tác</th></tr>";

					while ( $row1 = mysqli_fetch_array($res1) )
					{
						if ( !$res2 = mysqli_query($conn, "select tieu_de from tin_noi_dung where ma_tin = " . $row1['ma_tin'] ) )
							query_exec_err();

						$row2 = mysqli_fetch_array($res2);

						if ( $res3 = mysqli_query($conn, "select ten_trang_thai from trang_thai_tin where ma_trang_thai = " . $row1['ma_trang_thai'] ) )

							$row3 = mysqli_fetch_array($res3);

						echo "<tr>";

						echo "<td><a href='trang-chu.php?ma_tin=" .$row1['ma_tin']. "'>" . $row1['ma_tin'] . "</a></td><td>" . $row2['tieu_de'] . "</td><td>" . $row3['ten_trang_thai'] .
						"</td><td>" . date( "d-m-Y h:i", strtotime( $row1['thoi_gian_dang'] ) )
						. "</td><td><a class='link_xoa' href='javascript:void(0)' id='" . $row1['ma_tin'] . "'>xóa tin</a><a href='thanh-vien.php?ma_tin=" . $row1['ma_tin'] . "' id='" . $row1['ma_tin'] . "'>sửa tin</a></td>";

						echo "</tr>";

					}


					echo "</table>";

					echo "</div></div>";

				}
				else // edit tin
				{
					ob_start();

					$ma_tin = $_GET['ma_tin'];
					$ma_tv = $_SESSION['id'];

					if ( ctype_digit($ma_tin) & $ma_tin > 0 )
					{
							
						if ( !$res = mysqli_query($conn, "select * from tin where ma_tin = $ma_tin and ma_thanh_vien = $ma_tv") )
							query_exec_err();
							
						$row = mysqli_fetch_array($res);

						$nhu_cau = $row['ma_nhu_cau'];

						$trang_thai = $row['ma_trang_thai'];
							
						if ( $row == null )
							invalid_post_id();
					}
					else invalid_post_id();

					echo "<h2 id='dang_tin'>Chỉnh sửa tin</h2>";

					echo "<form action='thanh-vien.php?ma_tin=$ma_tin' method='post' >";

					echo "<table id='table1'>";

					if ( !$res = mysqli_query($conn, "select ten_nhu_cau from nhu_cau where ma_nhu_cau = " . $row['ma_nhu_cau'] ) )
						query_exec_err();

					$row1 = mysqli_fetch_array($res);

					echo "<tr><td>Nhu cầu: <span class='selected2'>*</span></td><td><span class='blue'>" . $row1['ten_nhu_cau'] . "</span></td>";

					//loai bds

					if (isset($_POST["loai_bds"])) $loai_bds = $_POST["loai_bds"];
					else
					{
						if ( !$res = mysqli_query($conn, "select ma_loai_bds from kieu_bds where ma_kieu_bds = " . $row['ma_kieu_bds'] ) )
							query_exec_err();

						$row1 = mysqli_fetch_array($res);

						$loai_bds = $row1['ma_loai_bds'];
					}

					echo '<tr><td>Loại BĐS: <span class="selected2">*</span></td><td><select id="select_loai_bds" name="loai_bds">';

					echo "<option value='0'>Chọn</option>";

					if ( !$res = mysqli_query($conn, "select * from loai_bds") )
						query_exec_err();

					$valid_loai_bds = loop_select($res, $loai_bds);

					echo "</select>";


					if ( !$valid_loai_bds & isset($_POST['loai_bds']) )
					{
						echo "<span class='selected'>Bạn chưa chọn loại bất động sản</span>";
					}

					echo "</td></tr>";

					//kieu bds
					if ( isset($_POST['kieu_bds']) )
						$kieu_bds = $_POST['kieu_bds'];
					else $kieu_bds = $row['ma_kieu_bds'];

					$valid_kieu_bds = false;

					echo "<tr><td>Kiểu BĐS:</td><td><select id='select_kieu_bds' name='kieu_bds'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_loai_bds & $loai_bds != "10")
					{
						if ( !$res = mysqli_query($conn, "select ma_kieu_bds, ten_kieu_bds from kieu_bds where ma_loai_bds = " . $loai_bds) )
							query_exec_err();

						$valid_kieu_bds = loop_select($res, $kieu_bds);
					}

					echo "</select></td></tr>";

					if ( $kieu_bds === "0" ) $valid_kieu_bds = true;


					// tieu de
					$valid_tieu_de = false;

					if ( !isset( $_POST['tieu_de'] ) )
					{
						if ( !$res = mysqli_query($conn, "select tieu_de from tin_noi_dung where ma_tin = " . $ma_tin) )
							query_exec_err();
						$row1 = mysqli_fetch_array($res);
						echo "<tr><td>Tiêu đề: <span class='selected2'>*</span></td><td><input type='text' id='tieu_de' name='tieu_de' maxlength='150' value=\"" . str_replace("'", "&#34;", $row1['tieu_de']) . "\" />";

					}
					else
					{
						$valid_tieu_de = true;
							
						$tieu_de = $_POST['tieu_de'];
							
						echo "<tr><td>Tiêu đề: <span class='selected2'>*</span></td><td><input type='text' id='tieu_de' name='tieu_de' maxlength='150' value=\"" . str_replace("'", "&#34;", $tieu_de ) . "\" />";

						if ( trim($tieu_de) == "" )
						{
							$valid_tieu_de = false;
							echo "<span class='selected'>Bạn chưa nhập tiêu đề</span>";

						}
					}

					echo "</td></tr>";

					// noi dung

					$valid_noi_dung = false;


					if ( !isset( $_POST['noi_dung'] ) )
					{
						if ( !$res = mysqli_query($conn, "select noi_dung from tin_noi_dung where ma_tin = " . $ma_tin) )
							query_exec_err();
						$row1 = mysqli_fetch_array($res);
							
						echo "<tr><td id='td_nd'>Nội dung: <span class='selected2'>*</span></td><td><textarea id='noi_dung' rows='8' name='noi_dung'>" . $row1['noi_dung'] . "</textarea>";

					}
					else
					{
						$valid_noi_dung = true;
							
						$noi_dung = $_POST['noi_dung'];
							
						echo "<tr><td id='td_nd'>Nội dung: <span class='selected2'>*</span></td><td><textarea id='noi_dung' rows='8' name='noi_dung'>$noi_dung</textarea>";

						if ( trim($noi_dung) == "" )
						{
							$valid_noi_dung = false;
							echo "<span class='selected'>Bạn chưa nhập nội dung</span></td>";
						}

					}

					echo "</td></tr>";

					echo "</table>";

					echo "<br/><span class='bold indent'>";

					if ( $nhu_cau < 3 )
						echo "Địa chỉ";
					else
						echo "Khu vực";

					echo "</span><br/><br/>";

					echo "<table id='table2'>";

					// tinh thanh

					if (isset($_POST["tinh_thanh"])) $tinh_thanh = $_POST["tinh_thanh"];
					else {

						if ( !$res = mysqli_query($conn, "select ma_quan_huyen from phuong_xa where ma_phuong_xa = " . $row['ma_phuong_xa'] ) )
							query_exec_err();
						$row1 = mysqli_fetch_array($res);

						if ( !$res1 = mysqli_query($conn, "select ma_tinh_thanh from quan_huyen where ma_quan_huyen = " . $row1['ma_quan_huyen'] ) )
							query_exec_err();
						$row2 = mysqli_fetch_array($res1);

						$tinh_thanh = $row2['ma_tinh_thanh'];
					}

					echo '<tr><td>Tỉnh/Thành: <span class="selected2">*</span></td><td><select id="select_tinh_thanh" name="tinh_thanh">';

					echo "<option value='0'>Chọn</option>";

					if ( !$res = mysqli_query($conn, "select * from tinh_thanh") )
						query_exec_err();

					$valid_tinh_thanh = loop_select($res, $tinh_thanh);

					echo "</select>";

					if ( !$valid_tinh_thanh & isset($_POST['tinh_thanh']) )
					{
						echo "<span class='selected'>Bạn chưa chọn tỉnh thành</span>";
					}


					echo "</td></tr>";

					// quan huyen

					if ( isset($_POST['quan_huyen']) )
						$quan_huyen = $_POST['quan_huyen'];
					else {

						if ( !$res = mysqli_query($conn, "select ma_quan_huyen from phuong_xa where ma_phuong_xa = " . $row['ma_phuong_xa'] ) )
							query_exec_err();
						$row1 = mysqli_fetch_array($res);

						$quan_huyen = $row1['ma_quan_huyen'];
					}

					$valid_quan_huyen = false;


					echo "<tr><td>Quận/Huyện:";

					if ( $nhu_cau == "1" | $nhu_cau == "2" )
						echo " <span class='selected2'>*</span>";

					echo "</td><td><select id='select_quan_huyen' name='quan_huyen'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_tinh_thanh )
					{
						if ( !$res = mysqli_query($conn, "select ma_quan_huyen, ten_quan_huyen from quan_huyen where ten_quan_huyen != '' and ma_tinh_thanh = " . $tinh_thanh) )
							query_exec_err();
							
						$valid_quan_huyen = loop_select($res, $quan_huyen);
					}

					echo "</select>";

					if ( $nhu_cau == "3" | $nhu_cau == "4" )
					{
						if ( $quan_huyen === "0" )
							$valid_quan_huyen = true;
					}

					if ( $nhu_cau == "1" | $nhu_cau == "2" )
					{
						if ( !$valid_quan_huyen & isset($_POST['quan_huyen']) )
							echo "<span class='selected'>Bạn chưa chọn quận huyện</span>";
					}

					echo "</td></tr>";

					//phuong xa

					if ( isset($_POST['phuong_xa']) )
						$phuong_xa = $_POST['phuong_xa'];
					else $phuong_xa = $row['ma_phuong_xa'];

					$valid_phuong_xa = false;

					echo "<tr><td>Phường/Xã: </td><td><select id='select_phuong_xa' name='phuong_xa'>";

					echo "<option value='0'>Chọn</option>";

					if ( $valid_quan_huyen )
					{
						if (!$result = mysqli_query($conn, "select ma_phuong_xa, ten_phuong_xa from phuong_xa where ten_phuong_xa != '' and ma_quan_huyen = " . $quan_huyen ) )
							query_exec_err();
							
						$valid_phuong_xa = loop_select($result, $phuong_xa);
					}

					echo "</select></td></tr>";


					if ( $phuong_xa === "0" ) $valid_phuong_xa = true;

					//so nha duong
					if ( $nhu_cau < 3 )
					{
						if ( !$res = mysqli_query($conn, "select so_nha_duong from tin_so_nha_duong where ma_tin = $ma_tin") )
							query_exec_err();
						$row_so_nha = mysqli_fetch_array($res);
							
						if ( isset( $_POST['so_nha'] ) )
							$so_nha = $_POST['so_nha'];
						else {

							if ( !empty($row_so_nha['so_nha_duong']) )
								$so_nha = $row_so_nha['so_nha_duong'];
							else $so_nha = "";
						}
							
						echo "<tr><td>Số nhà:</td><td><input type='text' id='so_nha' name='so_nha' maxlength='150' value=\"" . str_replace("'", "&#34;", $so_nha ) . "\" />";
							
						echo "</tr>";
					}
					echo "</table>";
					if ( $nhu_cau < 3 )
					{
						if ( !$res = mysqli_query($conn, "select * from tin_dia_diem where ma_tin = $ma_tin") )
							query_exec_err();
						$row_dia_diem = mysqli_fetch_array($res);

						$valid_coor = false;
						$no_marker = false;
							


						if ( isset($_POST['h_input_lat']) & isset($_POST['h_input_lng']) )
						{
							$lat = trim($_POST['h_input_lat']);
							$lng = trim($_POST['h_input_lng']);
						}
						else {
							if ( $row_dia_diem != null )
							{
								$lat = $row_dia_diem['vi_do'];
								$lng = $row_dia_diem['kinh_do'];
							}
							else
							{
								$no_marker = true;
								$lat = 10.771654;
								$lng = 106.698285;
							}
						}

						if ( $lat === "" & $lng === "")
						{
							$no_marker = true;
							$lat = 10.771654;
							$lng = 106.698285;

							$valid_coor = true;
						}
						else if ( is_numeric( $lat ) & is_numeric( $lng ) & $lat > -1000 & $lat < 10000 & $lng > -1000 & $lng < 10000 )
						{
							$valid_coor = true;
						}

						$valid_note = false;

						if ( isset( $_POST['h_input_note'] ) )
							$note = trim($_POST['h_input_note']);
						else {
							if ( $row_dia_diem['ghi_chu'] != null )
								$note = $row_dia_diem['ghi_chu'];
							else $note = "";
						}

						if ( strlen($note) <= 100 )
							$valid_note = true;

						if ( !$valid_coor | !$valid_note )
							query_exec_err();

						echo "<br/>";
						?>

			<script>
										var infowindow, marker;
										function initialize()
										{
											var myCenter = new google.maps.LatLng( <?php echo $lat . ", " . $lng; ?>);
											var mapProp = {
												center: myCenter,
												zoom: 16,
												mapTypeId: google.maps.MapTypeId.ROADMAP
											};
											var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

											var note = "<?php echo $note;?>";
											
											var html = "<div id='div_map'>Ghi chú:<br/>" +
											"<textarea id='text_map' cols='25' rows='4'>" + note + "</textarea>" + 
											"<input type='button' id='but_map' onclick='set_data(event)' value='Lưu'/></div>";

											var cond = "<?php echo $no_marker; ?>";
																					
											if ( cond == false )
											{
												marker = new google.maps.Marker({
													position: myCenter,
													map: map
											  	});
												$("#h_input_lat").val(<?php echo $lat;?>);
												$("#h_input_lng").val(<?php echo $lng;?>);
												$("#h_input_note").val(note);
												infowindow = new google.maps.InfoWindow({
								    				content: html
								 				});
												infowindow.open(map,marker);
												
													
											}
											
											
		
											google.maps.event.addListener(map, 'click', function(event) {						
												
												var location = event.latLng;
												$("#h_input_lat").val(location.lat());
												$("#h_input_lng").val(location.lng());
												
												if (marker == null )
											  	{
													marker = new google.maps.Marker({
														position: location,
														map: map
												  	});
											  	}
												else marker.setPosition(location);
												
													
												if (infowindow == null )
											  	{
											  		infowindow = new google.maps.InfoWindow({
									    				content: html
									 				});
											  	}
												$("#h_input_note").val( $("#text_map").val() );
												infowindow.open(map,marker);
																
											});
					
											google.maps.event.addListener(marker, 'click', function() {	
												infowindow.open(map,marker);						
											});	
					
										}
										function set_data(e)
										{
											e.stopPropagation();
											var note = $("#text_map").val();
											if ( note != "" )
											{
												var html = "<div id='div_map'>Ghi chú:<br/>" +
												"<textarea id='text_map' cols='25' rows='4'>" + note + "</textarea>" + 
												"<input type='button' id='but_map' onclick='set_data(event)' value='Lưu'/></div>";
												infowindow.setContent(html);
												$("#h_input_note").val(note);	
											}				
											infowindow.close();						
										}
										function loadScript()
										{
											var script = document.createElement("script");
											script.type = "text/javascript";
											script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBQEEBXoivv7OlyNYkJgDRI2_Ry93OMZiE&sensor=false&callback=initialize";
											document.body.appendChild(script);
										}
					
										
										
										window.onload = loadScript;
										</script>
			<div id="googleMap"></div>

			<?php
			echo "<br/>";

					}
					echo "<br/><span class='bold indent'>Giá</span><br/><br/>";

					echo "<table id='table3'>";
					?>

			<?php 

			// gia
			if ( isset($_POST['gia']) )
				$gia = $_POST['gia'];

			$valid_gia = false;

			echo "<tr><td>Giá (triệu):";

			if ( $nhu_cau < 3 )
				echo " <span class='selected2'>*</span>";

			echo "</td>";

			if ( !isset($_POST['gia']) )
			{
				echo "<td><input class='gia' name='gia' id='input_gia' type='text' value='" . ( ( $row['gia'] == null )? "" : round( $row['gia'], 3 ) ) . "'
				size='20' maxlength='7' />";
			}
			else if (is_numeric($gia) and $gia >= 0 and $gia <= MAX_GIA)
			{
				$valid_gia = true;
				echo "<td><input class='gia' value=\"". $gia . "\" name='gia' id='input_gia' type='text'
				size='20' maxlength='7' />";
					
			}
			else
			{

				echo "<td><input class='gia' value=\"". str_replace('"', "&#34;", $gia ) . "\" name='gia' id='input_gia' type='text'
				size='20' maxlength='7' />";
				if ( $nhu_cau < 3 )
				{
					if ( $gia === "" )
						echo "<span class='selected'>Bạn chưa điền giá</span>";
					else
						echo "<span class='selected'>Giá không hợp lệ</span>";
				}
				else
				{
					if ( $gia === "" )
						$valid_gia = true;
				}
					
			}
			echo "</td></tr>";

			echo "<tr><td></td>";

			if ( isset( $_POST["gia"] ) )
			{
				if ($valid_gia) {
					if ( ($x = $gia/1000) >= 1  )
						echo "<td><span id='span_gia'>".$x." tỷ"."</span></td>";
					else
						echo "<td><span id='span_gia'>" . $gia . " triệu"."</span></td>";
				}
				else echo "<td><span id='span_gia'>" . $gia . "</span></td>";
			}
			else {
				echo  "<td><span id='span_gia'>";

				if ( $row['gia'] != null )
				{
					if ( ($x = $row['gia']/1000) >= 1  )
						echo round($x, 6) . " tỷ";
					else
						echo round($row['gia'], 3) . " triệu";
				}

				echo "</span></td>";
			}
			echo "</tr>";
			// Đơn vị

			if (isset($_POST["don_vi"])) $don_vi = $_POST["don_vi"];
			else {
				if ( $row['ma_don_vi'] != null )
					$don_vi = $row['ma_don_vi'];
				else $don_vi = "1";
			}

			echo "<tr><td>Đơn vị:</td><td><select id='select_don_vi' name='don_vi'>";

			if ( !$res = mysqli_query($conn, "select * from don_vi") )
				query_exec_err();

			$valid_don_vi = loop_select($res, $don_vi);

			echo "</select></td>";

			if ( !$valid_don_vi )
				echo "<td><span class='selected'>Bạn chưa chọn đơn vị</span></td>";

			echo "</tr>";

			echo "</table>";

			echo "<table id='table4'>";

			echo "<br/><span class='bold indent'>Diện tích</span><br/><br/>";

			// dien tich

			if ( isset($_POST['dien_tich']) )
				$dien_tich = $_POST['dien_tich'];

			$valid_dien_tich = false;

			echo "<tr><td>Diện tích (m2):";

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
				echo "<span class='selected2'>*</span>";

			echo "</td>";

			if ( !isset($_POST['dien_tich']) )
			{
				echo "<td><input class='dien_tich' name='dien_tich' id='input_dien_tich' type='text' value='" . ( ( $row['dien_tich'] == null )? "" : round( $row['dien_tich'], 4 ) ) . "'
				size='20' maxlength='8' />";
			}
			else if (is_numeric($dien_tich) and $dien_tich >= 0 and $dien_tich <= MAX_DT)
			{
				$valid_dien_tich = true;
				echo "<td><input class='dien_tich' value=\"". $dien_tich . "\" name='dien_tich' id='input_dien_tich' type='text'
				size='20' maxlength='8' />";

			}
			else
			{

				echo "<td><input class='dien_tich' value=\"". str_replace('"', "&#34;", $dien_tich ) . "\" name='dien_tich' id='input_dien_tich' type='text'
				size='20' maxlength='8' />";
					
				if ( $nhu_cau == "1" | $nhu_cau == "2" )
				{
					if ( $dien_tich === "" )
						echo "<span class='selected'>Bạn chưa điền diện tích</span>";
					else
						echo "<span class='selected'>Diện tích không hợp lệ</span>";

				}
				else {
					if ( $dien_tich === "")
						$valid_dien_tich = true;
				}
			}


			echo "</td></tr>";

			echo "<tr><td></td>";

			if ( isset( $_POST["dien_tich"] ) )
			{
				if ( $valid_dien_tich & $dien_tich != "" )
				{
					if ( ($x = $dien_tich/10000) >= 1  )
						echo "<td><span id='span_dt'>".$x." ha"."</span></td>";
					else
						echo "<td><span id='span_dt'>".$dien_tich." m2"."</span></td>";
				}
				else echo "<td><span id='span_dt'>" . $dien_tich . "</span></td>";
			}
			else {
				echo  "<td><span id='span_dt'>";

				if ( $row['dien_tich'] != null )
				{
					if ( ($x = $row['dien_tich']/10000) >= 1  )
						echo round($x,8) . " ha";
					else
						echo round($row['dien_tich'], 4) . " m2";
				}

				echo "</span></td>";
			}

			echo "</tr>";
			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{

				if ( !$res = mysqli_query($conn, "select * from tin_so_do where ma_tin = " . $ma_tin ))
					query_exec_err();
				$row_so_do = mysqli_fetch_array($res);

				// chieu ngang

				if ( isset($_POST['chieu_ngang']) )
					$chieu_ngang = $_POST['chieu_ngang'];

					
				$valid_chieu_ngang = false;
					
					
				echo "<tr><td>Chiều ngang (m):</td>";
					
				if ( !isset($_POST['chieu_ngang']) )
				{
					echo "<td><input class='chieu_ngang' name='chieu_ngang' id='input_chieu_ngang' type='text'
					value='" . (( $row_so_do['chieu_ngang'] == null )? "" : round($row_so_do['chieu_ngang'],2)) . "'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($chieu_ngang) and $chieu_ngang >= 0 and $chieu_ngang <= MAX_SODO)
				{
					$valid_chieu_ngang = true;
					echo "<td><input class='chieu_ngang' value=\"". $chieu_ngang . "\" name='chieu_ngang' id='input_chieu_ngang' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='chieu_ngang' value=\"". str_replace('"', "&#34;", $chieu_ngang ) . "\" name='chieu_ngang' id='input_chieu_ngang' type='text'
					size='20' maxlength='5' />";

					if ( $chieu_ngang === "" )
						$valid_chieu_ngang = true;

					if ( $chieu_ngang !== "" )
						echo "<span class='selected'>Chiều ngang không hợp lệ</span>";
				}

				//

					
					
				// chieu doc
				if ( isset($_POST['chieu_doc']) )
					$chieu_doc = $_POST['chieu_doc'];
					
				$valid_chieu_doc = false;
					
					
				echo "<tr><td>Chiều doc (m):</td>";
					
				if ( !isset($_POST['chieu_doc']) )
				{
					echo "<td><input class='chieu_doc' name='chieu_doc' id='input_chieu_doc' type='text' value='" . ( ( $row_so_do['chieu_doc'] == null )? "" : round($row_so_do['chieu_doc'],2) ) . "'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($chieu_doc) and $chieu_doc >= 0 and $chieu_doc <= MAX_SODO)
				{
					$valid_chieu_doc = true;
					echo "<td><input class='chieu_doc' value=\"". $chieu_doc . "\" name='chieu_doc' id='input_chieu_doc' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='chieu_doc' value=\"". str_replace('"', "&#34;", $chieu_doc ) . "\" name='chieu_doc' id='input_chieu_doc' type='text'
					size='20' maxlength='5' />";

					if ( $chieu_doc === "" )
						$valid_chieu_doc = true;

					if ( $chieu_doc !== "" )
						echo "<span class='selected'>Chiều dọc không hợp lệ</span>";
				}
					

				//
					
					
					
				// no hau
				if ( isset($_POST['no_hau']) )
					$no_hau = $_POST['no_hau'];
					
				$valid_no_hau = false;
					
					
				echo "<tr><td>Nở hậu (m):</td>";
					
				if ( !isset($_POST['no_hau']) )
				{
					echo "<td><input class='no_hau' name='no_hau' id='input_no_hau' type='text' value='" . (( $row_so_do['no_hau'] == null )? "" : round($row_so_do['no_hau'],2)) . "'
					size='10' maxlength='5' />";
				}
				else if (is_numeric($no_hau) and $no_hau >= 0 and $no_hau <= MAX_SODO)
				{
					$valid_no_hau = true;
					echo "<td><input class='no_hau' value=\"". $no_hau . "\" name='no_hau' id='input_no_hau' type='text'
					size='20' maxlength='5' />";

				}
				else {
					echo "<td><input class='no_hau' value=\"". str_replace('"', "&#34;", $no_hau ) . "\" name='no_hau' id='input_no_hau' type='text'
					size='20' maxlength='5' />";

					if ( $no_hau === "" )
						$valid_no_hau = true;

					if ( $no_hau !== "" )
						echo "<span class='selected'>Nở hậu không hợp lệ</span>";
				}

				//
			}


			echo "</table>";

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{
				echo "<br/><span class='bold indent'>Đặc điểm</span><br/><br/>";

				echo "<table id='table5'>";

				if ( !$res = mysqli_query($conn, "select * from tin_vi_tri_huong_phap_ly where ma_tin = $ma_tin") )
					query_exec_err();
				$row_h_vt_pl = mysqli_fetch_array($res);

				// Vi tri

				if (isset($_POST["vi_tri"])) $vi_tri = $_POST["vi_tri"];
				else {
					if ( $row_h_vt_pl['ma_vi_tri'] != null )
						$vi_tri = $row_h_vt_pl['ma_vi_tri'];
					else $vi_tri = "0";
				}
					

				echo '<tr><td>Vị trí:</td><td><select id="select_vi_tri" name="vi_tri">';

				echo "<option value='0'>Chọn</option>";

				if ( !$res = mysqli_query($conn, "select * from vi_tri") )
					query_exec_err();
					
				$valid_vi_tri = loop_select($res, $vi_tri);

				echo "</select></td></tr>";

				if ( $vi_tri === "0" )
					$valid_vi_tri = true;

				// Huong
					
					
				if (isset($_POST["huong"])) $huong = $_POST["huong"];
				else {
					if ( $row_h_vt_pl['ma_huong'] != null )
						$huong = $row_h_vt_pl['ma_huong'];
					else $huong = "0";
				}

				echo '<tr><td>Hướng:</td><td><select id="select_huong" name="huong">';

				echo "<option value='0'>Chọn</option>";

				if ( !$res = mysqli_query($conn, "select * from huong") )
					query_exec_err();

				$valid_huong = loop_select($res, $huong);
					
				echo "</select></td></tr>";
					
				if ( $huong === "0" )
					$valid_huong = true;

					
				// Phap ly
					
					
				if (isset($_POST["phap_ly"])) $phap_ly = $_POST["phap_ly"];
				else {
					if ( $row_h_vt_pl['ma_phap_ly'] != null )
						$phap_ly = $row_h_vt_pl['ma_phap_ly'];
					else $phap_ly = "0";
				}

				echo '<tr><td>Pháp lý:</td><td><select id="select_phap_ly" name="phap_ly">';

				echo "<option value='0'>Chọn</option>";

				if ( !$res = mysqli_query($conn, "select * from phap_ly") )
					query_exec_err();

				$valid_phap_ly = loop_select($res, $phap_ly);
					
				echo "</select></td></tr>";
					
				if ( $phap_ly === "0" )
					$valid_phap_ly = true;
					
				// Đường rộng
					


				if ( isset($_POST['duong_rong']) )
					$duong_rong = $_POST['duong_rong'];
					


				$valid_duong_rong = false;
					

				echo "<tr><td>Đường vào rộng (m):</td>";

				if ( !$res = mysqli_query($conn, "select duong_rong from tin_duong_rong where ma_tin = $ma_tin") )
					query_exec_err();
					
				$row_duong_rong = mysqli_fetch_array($res);


				if ( !isset($_POST['duong_rong']) )
				{
					echo "<td><input class='duong_rong' name='duong_rong' id='input_duong_rong' type='text' value='" . ( ( $row_duong_rong['duong_rong'] == null )? "" : $row_duong_rong['duong_rong'] ) . "'
					maxlength='3' />";
				}
				else if (is_numeric($duong_rong) and $duong_rong >= 0 and $duong_rong <= MAX_DUONG)
				{
					$valid_duong_rong = true;
					echo "<td><input class='duong_rong' value=\"". $duong_rong . "\" name='duong_rong' id='input_duong_rong' type='text'
					maxlength='3' />";

				}
				else
				{

					echo "<td><input class='duong_rong' value=\"". str_replace('"', "&#34;", $duong_rong ) . "\" name='duong_rong' id='input_duong_rong' type='text'
					maxlength='3' />";

					if ( $duong_rong === "" )
						$valid_duong_rong = true;

					if ( $duong_rong !== "" )
						echo "<span class='selected'>Đường vào rộng không hợp lệ</span>";
				}


				//
					
				echo "</td></tr>";

				echo "</table>";


				//
					
				if ($loai_bds !== "4")
				{
					// so tang

					if ( isset($_POST['so_tang']) )
						$so_tang = $_POST['so_tang'];


					$valid_so_tang = false;

					echo "<div id='tang_phong'><br/><span class='bold indent'>Tầng phòng</span><br/><br/>";
					echo "<table id='table6'>";
					echo "<tr><td>Số tầng:</td>";

					if ( !$res = mysqli_query($conn, "select * from tin_so_tang_phong_ngu where ma_tin = $ma_tin") )
						query_exec_err();

					$row_tang_phong_ngu = mysqli_fetch_array($res);

					if ( !isset($_POST['so_tang']) )
					{
							
						echo "<td><input class='so_tang' name='so_tang' id='input_so_tang' type='text' value='" . ( ( $row_tang_phong_ngu['so_tang'] == null )? "" : $row_tang_phong_ngu['so_tang'] ) . "'
						size='10' maxlength='3' />";
					}
					else if (is_numeric($so_tang) and $so_tang >= 0 and $so_tang <= MAX_TANG)
					{
						$valid_so_tang = true;
						echo "<td><input class='so_tang' value=\"". $so_tang . "\" name='so_tang' id='input_so_tang' type='text'
						size='10' maxlength='3' />";
							
					}
					else
					{
							
						echo "<td><input class='so_tang' value=\"". str_replace('"', "&#34;", $so_tang ) . "\" name='so_tang' id='input_so_tang' type='text'
						size='10' maxlength='3' />";
						if ( $so_tang === "" )
							$valid_so_tang = true;
						if ( $so_tang !== "" )
							echo "<span class='selected'>Số tầng không hợp lệ</span>";
					}

					echo "</td></tr>";

					// so phong ngu

					if ( isset($_POST['so_phong_ngu']) )
						$so_phong_ngu = $_POST['so_phong_ngu'];


					$valid_so_phong_ngu = false;


					echo "<tr><td>Số phòng ngủ:</td>";

					if ( !isset($_POST['so_phong_ngu']) )
					{
						echo "<td><input class='so_phong_ngu' name='so_phong_ngu' id='input_so_phong_ngu' type='text' value='" . ( ( $row_tang_phong_ngu['so_phong_ngu'] == null )? "" : $row_tang_phong_ngu['so_phong_ngu'] ) . "'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_ngu) and $so_phong_ngu >= 0 and $so_phong_ngu <= MAX_SODO)
					{
						$valid_so_phong_ngu = true;
						echo "<td><input class='so_phong_ngu' value=\"". $so_phong_ngu . "\" name='so_phong_ngu' id='input_so_phong_ngu' type='text'
						size='10' maxlength='5' />";
							
					}
					else
					{
							
						echo "<td><input class='so_phong_ngu' value=\"". str_replace('"', "&#34;", $so_phong_ngu ) . "\" name='so_phong_ngu' id='input_so_phong_ngu' type='text'
						size='10' maxlength='5' />";
							
						if ( $so_phong_ngu === "" )
							$valid_so_phong_ngu = true;
							
						if ( $so_phong_ngu !== "" )
							echo "<span class='selected'>Số phòng ngủ không hợp lệ</span>";
							
					}

					echo "</td></tr>";

					//so phong khach


					if ( isset($_POST['so_phong_khach']) )
						$so_phong_khach = $_POST['so_phong_khach'];

					$valid_so_phong_khach = false;


					echo "<tr><td>Số phòng khách:</td>";

					if ( !$res = mysqli_query($conn, "select so_phong_khach from tin_so_phong_khach where ma_tin = $ma_tin") )
						query_exec_err();

					$row_phong_khach = mysqli_fetch_array($res);

					if ( !isset($_POST['so_phong_khach']) )
					{

						echo "<td><input class='so_phong_khach' name='so_phong_khach' id='input_so_phong_khach' type='text'
						value='" . ( ( $row_phong_khach['so_phong_khach'] == null )? "" : $row_phong_khach['so_phong_khach'] ) . "'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_khach) and $so_phong_khach >= 0 and $so_phong_khach <= MAX_SODO)
					{
						$valid_so_phong_khach = true;
						echo "<td><input class='so_phong_khach' value=\"". $so_phong_khach . "\" name='so_phong_khach' id='input_so_phong_khach' type='text'
						size='10' maxlength='5' />";
							
					}
					else
					{
							
						echo "<td><input class='so_phong_khach' value=\"". str_replace('"', "&#34;", $so_phong_khach ) . "\" name='so_phong_khach' id='input_so_phong_khach' type='text'
						size='10' maxlength='5' />";
							
						if ( $so_phong_khach === "" )
							$valid_so_phong_khach = true;
							
						if ( $so_phong_khach !== "" )
							echo "<span class='selected'>Số phòng khách không hợp lệ</span>";

					}

					echo "</tr>";
					//so phong wc


					if ( isset($_POST['so_phong_wc']) )
						$so_phong_wc = $_POST['so_phong_wc'];

					$valid_so_phong_wc = false;


					echo "<tr><td>Số phòng tắm/WC:</td>";

					if ( !$res = mysqli_query($conn, "select so_phong_wc from tin_so_phong_wc where ma_tin = $ma_tin") )
						query_exec_err();

					$row_phong_wc = mysqli_fetch_array($res);


					if ( !isset($_POST['so_phong_wc']) )
					{


						echo "<td><input class='so_phong_wc' name='so_phong_wc' id='input_so_phong_wc' type='text'
						value='" . ( ( $row_phong_wc ['so_phong_wc'] == null )? "" : $row_phong_wc ['so_phong_wc'] ) . "' size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_wc) and $so_phong_wc >= 0 and $so_phong_wc <= MAX_SODO)
					{
						$valid_so_phong_wc = true;
						echo "<td><input class='so_phong_wc' value=\"". $so_phong_wc . "\" name='so_phong_wc' id='input_so_phong_wc' type='text'
						size='10' maxlength='5' />";
							
					}
					else
					{
							
						echo "<td><input class='so_phong_wc' value=\"". str_replace('"', "&#34;", $so_phong_wc ) . "\" name='so_phong_wc' id='input_so_phong_wc' type='text'
						size='10' maxlength='5' />";
							
						if ( $so_phong_wc === "" )
							$valid_so_phong_wc = true;
							
						if ( $so_phong_wc !== "" )
							echo "<span class='selected'>Số phòng tắm/WC không hợp lệ</span>";

					}


					//

					echo "</tr>";

					// so phong khac


					if ( isset($_POST['so_phong_khac']) )
						$so_phong_khac = $_POST['so_phong_khac'];

					$valid_so_phong_khac = false;


					echo "<tr><td>Số phòng khác:</td>";

					if ( !$res = mysqli_query($conn, "select so_phong_khac from tin_so_phong_khac where ma_tin = $ma_tin") )
						query_exec_err();

					$row_phong_khac = mysqli_fetch_array($res);

					if ( !isset($_POST['so_phong_khac']) )
					{
						echo "<td><input class='so_phong_khac' name='so_phong_khac' id='input_so_phong_khac' type='text' value='" . ( ( $row_phong_khac['so_phong_khac'] == null )? "" : $row_phong_khac['so_phong_khac'] ) . "'
						size='10' maxlength='5' />";
					}
					else if (is_numeric($so_phong_khac) and $so_phong_khac >= 0 and $so_phong_khac <= MAX_SODO)
					{
						$valid_so_phong_khac = true;
						echo "<td><input class='so_phong_khac' value=\"". $so_phong_khac . "\" name='so_phong_khac' id='input_so_phong_khac' type='text'
						size='10' maxlength='5' />";
							
					}
					else
					{
							
						echo "<td><input class='so_phong_khac' value=\"". str_replace('"', "&#34;", $so_phong_khac ) . "\" name='so_phong_khac' id='input_so_phong_khac' type='text'
						size='10' maxlength='5' />";
							
						if ( $so_phong_khac === "" )
							$valid_so_phong_khac = true;
							
						if ( $so_phong_khac !== "" )
							echo "<span class='selected'>Số phòng khác không hợp lệ</span>";

							
					}


					//
					echo "</tr>";

					echo "</table></div>";

				}
				else {
					$valid_so_tang = true;
					$valid_so_phong_ngu = true;
					$valid_so_phong_khach = true;
					$valid_so_phong_khac = true;
					$valid_so_phong_wc = true;
				}
					

				echo "</table>";
				////////// Tiện ích
				echo "<br/><span class='bold indent'>Tiện ích:</span><br/><br/>";

				$arr1 = array("1" => "Mới xây", "2" => "Chỗ để ô tô", "3" => "Sân vườn", "4" => "Sân thượng", "5" => "Hồ bơi");

				$arr2 = array("6" => "Tiện kinh doanh", "7" => "Tiện sản xuất", "8" => "Tiện mở văn phòng");
					
				$arr3 = array("9" => "Gần chợ", "10" => "Gần siêu thị", "11" => "Gần bệnh viện", "12" => "Gần công viên");

				$arr_tien_ich = array();

				if ( !$res = mysqli_query($conn, "select ma_tien_ich from tin_tien_ich where ma_tin = $ma_tin ") )
					query_exec_err();

				while ( $row1 = mysqli_fetch_array($res) )
				{
					$arr_tien_ich[] = $row1['ma_tien_ich'];
				}

				function loop_check($arr) {
					while ( list($id, $value) = each($arr) ) {
							
						if ( isset( $_POST[$id] ) )
							echo "<tr><td><input type='checkbox' checked='checked' name='$id' ></td><td>$value</td>";
						else
						{
							if ( in_array($id, $GLOBALS['arr_tien_ich']) )
								echo "<tr><td><input type='checkbox' checked='checked' name='$id' ></td><td>$value</td>";
							else
								echo "<tr><td><input type='checkbox' name='$id' ></td><td>$value</td>";
						}
					}
				}

				if ( $loai_bds !== "4" )
				{
					echo "<table id='table7'>";
					loop_check($arr1);
					echo "</table>";
				}
				echo "<table id='table8'>";
				loop_check($arr2);
				echo "</table>";

				echo "<table id='table9'>";
				loop_check($arr3);
				echo "</table>";
			}
			echo "<div class='clear'></div>";

			echo "<br/><span class='bold indent'>Hình ảnh:</span><br/><br/>";

			$thumbs_dir = "images/$ma_tin/thumbs";
			$temp_dir = "images/temp/{$_SESSION['id']}";

			?>
			<div id="images_container">
				<?php 

				if ($handle = @opendir($thumbs_dir)) {
					while (false !== ($file = readdir($handle))) {
						if ( $file != "." & $file != ".." )
						{
							$arr = explode(".", $file);
							$id = $arr[0];
							echo "<div class='div_image' id='$id'>
							<img class='upload' src='$thumbs_dir/$file'></img>
							<a class='xoa_anh' href='javascript:void(0)' onclick=\"remove_image2('$id', '$ma_tin')\">xóa</a>
							</div>";
						}
					}
					closedir($handle);
				}
				if ($handle = @opendir($temp_dir)) {
					while (false !== ($file = readdir($handle))) {
						if ( $file != "." & $file != ".." )
						{
							$arr = explode(".", $file);
							$id = $arr[0];
							echo "<div class='div_image' id='$id'>
							<img class='upload' src='$temp_dir/$file'></img>
							<a class='xoa_anh' href='javascript:void(0)' onclick=\"remove_image('$id')\">xóa</a>
							</div>";
						}
						}
						closedir($handle);
				}
				?>
			</div>
			<div class='clear'></div>
			<div id='error'></div>
			<iframe id='frame' src="up-anh.php"> </iframe>
			<?php 

			echo "<br/><span class='bold indent'>Liên hệ</span><br/><br/>";

			echo "<table id='table10'>";

			if ( !$res = mysqli_query( $conn, "select ho_ten, email, dia_chi, dien_thoai from tin_lien_he where ma_tin = " . $ma_tin ) )
				query_exec_err();
			$row = mysqli_fetch_array($res);



			$valid_ho_ten = false;

			if ( !isset( $_POST['ho_ten'] ) )
			{
				echo "<tr><td>Tên liên hệ: <span class='selected2'>*</span></td><td><input type='text' name='ho_ten' maxlength='50' value='" . $row['ho_ten'] . "' />";
			}
			else
			{

				$ho_ten = $_POST['ho_ten'];
					
				$valid_ho_ten = validate_ho_ten($ho_ten, $err);
					
				echo "<tr><td>Tên liên hệ: <span class='selected2'>*</span></td><td><input type='text' name='ho_ten' maxlength='50' value='" . $ho_ten . "' />";
					
				if ( !$valid_ho_ten)
					echo "<span class='selected'>$err</span>";
			}



			echo "</td></tr>";

			$valid_dien_thoai = false;

			if ( !isset( $_POST['dien_thoai'] ) )
			{
				echo "<tr><td>Điện thoại: <span class='selected2'>*</span></td><td><input type='text' name='dien_thoai' maxlength='20' value='" . $row['dien_thoai'] . "' />";
			}
			else
			{
				$dien_thoai = $_POST['dien_thoai'];
				$valid_dien_thoai = validate_dien_thoai($dien_thoai, $err);
				echo "<tr><td>Điện thoại: <span class='selected2'>*</span></td><td><input type='text' name='dien_thoai' maxlength='20' value='" . $dien_thoai . "' />";
				if ( !$valid_dien_thoai)
					echo "<span class='selected'>$err</span>";
			}



			echo "</td></tr>";

			$valid_email = false;

			if ( !isset( $_POST['email'] ) )
			{
				echo "<tr><td>Email:</td><td><input type='text' name='email' maxlength='50' value='" . $row['email'] . "' />";
			}
			else
			{
				$email = $_POST['email'];
					
				if ( $email === "" | preg_match("/^([A-Za-z0-9\_\-]+\.)*[A-Za-z0-9\_\-]+@[A-Za-z0-9\_\-]+(\.[A-Za-z0-9\_\-]+)+$/", $email ) )
					$valid_email = true;
					
				echo "<tr><td>Email:</td><td><input type='text' name='email' maxlength='50' value='" . $email . "' />";
					
				if ( !$valid_email )
					echo "<span class='selected'>Email không hợp lệ</span>";
			}

			echo "</td></tr>";

			if ( isset( $_POST['dia_chi'] ) )
				$dia_chi = $_POST['dia_chi'];
			else $dia_chi = "";

			$valid_dia_chi = true;

			if ( !isset( $_POST['dia_chi'] ) )
			{
				echo "<tr><td>Địa chỉ:</td><td><input type='text' name='dia_chi' maxlength='100' value='" . $row['dia_chi'] . "' /></td></tr>";
			}
			else
			{
				if ( strlen($dia_chi) > 100 )
					$valid_dia_chi = false;
				echo "<tr><td>Địa chỉ:</td><td><input type='text' name='dia_chi' maxlength='100' value='" . $dia_chi . "' /></td></tr>";
					
			}
			echo "</table>";

			echo "<div id='div_submit'>";
			echo "<button name='luu_tin' type='submit' id='but_luu_tin'>Lưu tin</button>";
			if ( $trang_thai != "1" & $trang_thai != "3" & $trang_thai != "4" )
			{
				echo "<button name='dang_tin' type='submit'>Đăng tin</button>";
			}

			echo "</div>";
			?>
			<input name='h_input_note' id='h_input_note' type='hidden' /> <input
				name='h_input_lat' id='h_input_lat' type='hidden' /> <input
				name='h_input_lng' id='h_input_lng' type='hidden' />
			<?php 
			echo "</form>";


			date_default_timezone_set("Asia/Ho_Chi_Minh");

			/*var_dump($valid_kieu_bds);var_dump($valid_loai_bds);var_dump($valid_tieu_de);var_dump($valid_noi_dung);var_dump($valid_tinh_thanh);
			 var_dump($valid_quan_huyen);var_dump($valid_phuong_xa);var_dump($valid_gia);var_dump($valid_don_vi);var_dump($valid_dien_tich);
			var_dump($valid_chieu_ngang);var_dump($valid_chieu_doc);var_dump($valid_no_hau );var_dump($valid_vi_tri);var_dump($valid_huong);
			var_dump($valid_phap_ly);var_dump($valid_duong_rong);var_dump($valid_so_tang);var_dump($valid_so_phong_ngu);var_dump($valid_so_phong_khach);
			var_dump($valid_so_phong_wc);var_dump($valid_so_phong_khac);var_dump($valid_ho_ten);var_dump($valid_dien_thoai);var_dump($valid_email);
			*/

			if ( $nhu_cau == "1" | $nhu_cau == "2" )
			{
				if ( $valid_kieu_bds & $valid_loai_bds & $valid_tieu_de & $valid_noi_dung & $valid_tinh_thanh & $valid_quan_huyen
						& $valid_phuong_xa & $valid_gia & $valid_don_vi & $valid_dien_tich & $valid_chieu_ngang & $valid_chieu_doc
						& $valid_no_hau & $valid_vi_tri & $valid_huong & $valid_phap_ly & $valid_duong_rong & $valid_so_tang & $valid_so_phong_ngu
						& $valid_so_phong_khach & $valid_so_phong_wc & $valid_so_phong_khac & $valid_ho_ten & $valid_dien_thoai & $valid_email
						& $valid_dia_chi)
				{


					if ( $trang_thai == "1" ) // dang dang
					{
						if ( isset($_POST['luu_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Tin đã được lưu. Tin của bạn sẽ được duyệt lại trước khi đăng trong vòng 6h";
						}
					}
					else if ( $trang_thai == "2" ) // dang soan
					{
						if ( isset($_POST['dang_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Đăng tin thành công. Tin của bạn sẽ được duyệt trước khi đăng trong vòng 6h";
						}
						else if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
							
					}
					else if ( $trang_thai == "3" ) // cho duyet
					{
						if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}
					else if ( $trang_thai == "4" ) //het han
					{
						if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}
					else if ( $trang_thai == "5" ) //khong hop le
					{
						if ( isset($_POST['dang_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Đăng tin thành công. Tin của bạn sẽ được duyệt trước khi đăng trong vòng 6h";
						}
						else if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}


					if ( $phuong_xa == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_phuong_xa) as phuong_xa from phuong_xa where ma_quan_huyen = $quan_huyen" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$phuong_xa = $row['phuong_xa'];
					}

					if ( $kieu_bds == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_kieu_bds) as kieu_bds from kieu_bds where ma_loai_bds = $loai_bds" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$kieu_bds = $row['kieu_bds'];
					}


					//start transaction
					if (!mysqli_query($conn,'START TRANSACTION'))
						query_exec_err();


					if ( !mysqli_query( $conn, "update tin set ma_phuong_xa = $phuong_xa, ma_kieu_bds = $kieu_bds,
							dien_tich = $dien_tich, gia = $gia, ma_don_vi = $don_vi, ma_trang_thai = $trang_thai where ma_tin = $ma_tin" ) )
						query_exec_err();


					if ( !mysqli_query( $conn, "update tin_noi_dung set tieu_de = '" . mysqli_real_escape_string( $conn, $tieu_de) . "',
							noi_dung = '" . mysqli_real_escape_string( $conn, $noi_dung ) . "' where ma_tin = $ma_tin" ) )
						query_exec_err();



					if ( trim($so_nha) != "" )
					{
						if ( $row_so_nha != null )
						{
							if ( !mysqli_query( $conn, "update tin_so_nha_duong set so_nha_duong = '" . mysqli_real_escape_string( $conn, $so_nha ) . "' where ma_tin = $ma_tin" ) )
								query_exec_err();
						}
						else
						{
							if ( !mysqli_query( $conn, "insert into tin_so_nha_duong values($ma_tin,'" . mysqli_real_escape_string( $conn, $so_nha ) . "')" ) )
								query_exec_err();
						}
					}
					else
					{
						if ( $row_so_nha != null )
						{
							if ( !mysqli_query( $conn, "delete from tin_so_nha_duong where ma_tin = $ma_tin" ) )
								query_exec_err();
						}
					}

					if ( $chieu_ngang != "" | $chieu_doc != "" | $no_hau != "" )
					{
						if ( $chieu_ngang == "" )
							$chieu_ngang = 'null';
						if ( $chieu_doc == "" )
							$chieu_doc = 'null';
						if ( $no_hau == "" )
							$no_hau = 'null';
							
						if ( $row_so_do != null)
						{
							if ( !mysqli_query( $conn, "update tin_so_do set chieu_ngang = $chieu_ngang, chieu_doc = $chieu_doc, no_hau = $no_hau where ma_tin = $ma_tin" ) )
								query_exec_err();
						}
						else
						{
							if ( !mysqli_query( $conn, "insert into tin_so_do values($ma_tin, $chieu_ngang, $chieu_doc, $no_hau)" ) )
								query_exec_err();
						}
					}
					else if ( $chieu_ngang == "" & $chieu_doc == "" & $no_hau == "")
					{
						if ( !mysqli_query( $conn, "delete from tin_so_do where ma_tin = $ma_tin" ) )
							query_exec_err();
					}


					if ( $vi_tri != "0" | $huong != "0" | $phap_ly != "0" )
					{
						if ( $vi_tri == "0" )
							$vi_tri = 'null';
						if ( $huong == "0" )
							$huong = 'null';
						if ( $phap_ly == "0" )
							$phap_ly = 'null';

						if ( $row_h_vt_pl != null )
						{
							if ( !mysqli_query( $conn, "update tin_vi_tri_huong_phap_ly set ma_vi_tri = $vi_tri, ma_huong = $huong, ma_phap_ly = $phap_ly where ma_tin = $ma_tin" ) )
								query_exec_err();
						}
						else
						{
							if ( !mysqli_query( $conn, "insert into tin_vi_tri_huong_phap_ly values($ma_tin, $vi_tri, $huong, $phap_ly)" ) )
								query_exec_err();
						}
					}
					else if ( $vi_tri == "0" & $huong == "0" & $phap_ly == "0" )
					{
						if ( $row_h_vt_pl != null )
						{
							if ( !mysqli_query( $conn, "delete from tin_vi_tri_huong_phap_ly where ma_tin = $ma_tin" ) )
								query_exec_err();
						}
					}

					if ( $duong_rong != "" )
					{
						if ( $row_duong_rong != null )
						{
							if ( !mysqli_query($conn, "update tin_duong_rong set duong_rong = $duong_rong where ma_tin = $ma_tin") )
								query_exec_err();
						}
						else
						{
							if ( !mysqli_query($conn, "insert into tin_duong_rong values($ma_tin, $duong_rong)") )
								query_exec_err();
						}
					}
					else
					{
						if ( $row_duong_rong != null )
						{
							if ( !mysqli_query($conn, "delete from tin_duong_rong where ma_tin = $ma_tin") )
								query_exec_err();
						}
					}

					if ( $loai_bds != "4")
					{
							
						if ( $so_tang != "" | $so_phong_ngu != "" )
						{
							if ( $so_tang == "" )
								$so_tang = 'null';
							if ( $so_phong_ngu == "" )
								$so_phong_ngu = 'null';

							if ( $row_tang_phong_ngu != null )
							{
								if ( !mysqli_query( $conn, "update tin_so_tang_phong_ngu set so_tang = $so_tang, so_phong_ngu = $so_phong_ngu where ma_tin = $ma_tin " ) )
									query_exec_err();
							}
							else
							{
								if ( !mysqli_query( $conn, "insert into tin_so_tang_phong_ngu values($ma_tin, $so_tang, $so_phong_ngu)" ) )
									query_exec_err();
							}

						}
						else if ( $so_tang == "" & $so_phong_ngu == "")
						{
							if ( $row_tang_phong_ngu != null )
							{
								if ( !mysqli_query( $conn, "delete from tin_so_tang_phong_ngu where ma_tin = $ma_tin " ) )
									query_exec_err();
							}
						}
							
						if ( $so_phong_khach != "" )
						{
							if ($row_phong_khach != null)
							{
								if ( !mysqli_query( $conn, "update tin_so_phong_khach set so_phong_khach = $so_phong_khach where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
							else
							{
								if ( !mysqli_query( $conn, "insert into tin_so_phong_khach values($ma_tin, $so_phong_khach)" ) )
									query_exec_err();
							}
						}
						else {
							if ($row_phong_khach != null)
							{
								if ( !mysqli_query( $conn, "delete from tin_so_phong_khach where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
						}

						if ( $so_phong_wc != "" )
						{
							if ( $row_phong_wc != null )
							{
								if ( !mysqli_query( $conn, "update tin_so_phong_wc set so_phong_wc = $so_phong_wc where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
							else
							{
								if ( !mysqli_query( $conn, "insert into tin_so_phong_wc values($ma_tin, $so_phong_wc)" ) )
									query_exec_err();
							}
						}
						else
						{
							if ( $row_phong_wc != null )
							{
								if ( !mysqli_query( $conn, "delete from tin_so_phong_wc where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
						}
							
						if ( $so_phong_khac != "" )
						{
							if ( $row_phong_khac != null )
							{
								if ( !mysqli_query( $conn, "update tin_so_phong_khac set so_phong_khac = $so_phong_khac where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
							else
							{
								if ( !mysqli_query( $conn, "insert into tin_so_phong_khac values($ma_tin, $so_phong_khac)" ) )
									query_exec_err();
							}
						}
						else
						{
							if ( $row_phong_khac != null )
							{
								if ( !mysqli_query( $conn, "delete from tin_so_phong_khac where ma_tin = $ma_tin" ) )
									query_exec_err();
							}
						}
							
						for ( $i = 1; $i <= 5 ; $i++ )
						{

							if ( isset( $_POST[$i] ) )
							{
								if ( !in_array($i, $arr_tien_ich) )
									if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
									query_exec_err();
							}
							else {
								if ( in_array($i, $arr_tien_ich) )
									if ( !mysqli_query( $conn, "delete from tin_tien_ich where ma_tin = $ma_tin and ma_tien_ich = $i ") )
									query_exec_err();
							}
						}
							

					}

					for ( $i = 6; $i <= 12 ; $i++ )
					{
							
						if ( isset( $_POST[$i] ) )
						{
							if ( !in_array($i, $arr_tien_ich) )
								if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
								query_exec_err();
						}
						else {
							if ( in_array($i, $arr_tien_ich) )
								if ( !mysqli_query( $conn, "delete from tin_tien_ich where ma_tin = $ma_tin and ma_tien_ich = $i ") )
								query_exec_err();
						}
					}


					if ( $email == "" )
						$email = 'null';

					if ( trim($dia_chi) == "" )
						$dia_chi = 'null';

					if ( !mysqli_query($conn, "update tin_lien_he set ho_ten = '" . mysqli_real_escape_string($conn, $ho_ten) . "', dien_thoai = '$dien_thoai', email = '$email', dia_chi = '" . mysqli_real_escape_string( $conn, $dia_chi ) . "' where ma_tin = $ma_tin") )
						query_exec_err();


					if ( !$no_marker )
					{

						if ( $row_dia_diem != null )
						{
							if ($note == "" )
								$sql = "update tin_dia_diem set vi_do = $lat, kinh_do = $lng where ma_tin = $ma_tin";
							else $sql = "update tin_dia_diem set vi_do = $lat, kinh_do = $lng, ghi_chu = '" . mysqli_real_escape_string($conn, $note) . "' where ma_tin = $ma_tin";
						}
						else
						{
							if ($note == "" )
								$sql = "insert into tin_dia_diem(ma_tin,vi_do,kinh_do) values($ma_tin, $lat, $lng)";
							else $sql = "insert into tin_dia_diem values($ma_tin, $lat, $lng, '" . mysqli_real_escape_string($conn, $note) . "')";

						}

						if ( !mysqli_query( $conn, $sql ) )
							query_exec_err();
					}


					if (!mysqli_query($conn,'COMMIT'))
						query_exec_err();
					// end transaction

					
					$imgs = glob($temp_dir . "/*");
					
					$num_imgs = count($imgs);
					
					if ( $num_imgs != 0 )
					{
					
						$thumbs_dir = "images/$ma_tin/thumbs";
						if ( !is_dir($thumbs_dir) )
							mkdir($thumbs_dir, 0777, true);
					
						$imgs_dir = "images/$ma_tin/imgs";
						if ( !is_dir($imgs_dir) )
							mkdir($imgs_dir, 0777, true);
					
						for ( $i = 0; $i < $num_imgs; $i ++ )
						{
							$img = explode("/", $imgs[$i]);
							copy($imgs[$i], $imgs_dir . "/" . $img[ count($img) - 1 ]);
							unlink($imgs[$i]);
						}
					
						createThumbs($imgs_dir, $thumbs_dir, 100);
					
					}
						
					
					ob_end_clean();

					echo "<h2 align='center'>$message</h2>";
				}
			}
			else
			{
				if ( $valid_kieu_bds & $valid_loai_bds & $valid_tieu_de & $valid_noi_dung & $valid_tinh_thanh & $valid_quan_huyen
						& $valid_phuong_xa & $valid_gia & $valid_don_vi & $valid_dien_tich & $valid_ho_ten & $valid_dien_thoai & $valid_email
						& $valid_dia_chi )
				{



					if ( $trang_thai == "1" ) // dang dang
					{
						if ( isset($_POST['luu_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Tin đã được lưu. Tin của bạn sẽ được duyệt lại trước khi đăng trong vòng 6h";
						}
					}
					else if ( $trang_thai == "2" ) // dang soan
					{
						if ( isset($_POST['dang_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Đăng tin thành công. Tin của bạn sẽ được duyệt trước khi đăng trong vòng 6h";
						}
						else if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
							
					}
					else if ( $trang_thai == "3" ) // cho duyet
					{
						if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}
					else if ( $trang_thai == "4" ) //het han
					{
						if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}
					else if ( $trang_thai == "5" ) //khong hop le
					{
						if ( isset($_POST['dang_tin']) )
						{
							$trang_thai = 3; // cho duyet
							$message = "Đăng tin thành công. Tin của bạn sẽ được duyệt trước khi đăng trong vòng 6h";
						}
						else if ( isset($_POST['luu_tin']) )
							$message = "Tin đã được lưu!";
					}

					if ( $quan_huyen == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_quan_huyen) as ma_quan_huyen from quan_huyen where ma_tinh_thanh = $tinh_thanh") )
							query_exec_err();
							
						$row = mysqli_fetch_array($res);
							
						if ( !$res2 = mysqli_query($conn, "select ma_phuong_xa from phuong_xa where ma_quan_huyen = " . $row['ma_quan_huyen'] ) )
							query_exec_err();
							
						$row2 = mysqli_fetch_array($res2);
							
						$phuong_xa = $row2['ma_phuong_xa'];
							
					}

					if ( $phuong_xa == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_phuong_xa) as phuong_xa from phuong_xa where ma_quan_huyen = $quan_huyen" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$phuong_xa = $row['phuong_xa'];
					}

					if ( $kieu_bds == "0" )
					{
						if ( !$res = mysqli_query($conn, "select max(ma_kieu_bds) as kieu_bds from kieu_bds where ma_loai_bds = $loai_bds" ) )
							query_exec_err();
						$row = mysqli_fetch_array($res);
							
						$kieu_bds = $row['kieu_bds'];
					}


					//start transaction
					if (!mysqli_query($conn,'START TRANSACTION'))
						query_exec_err();

					if ( $gia == "" )
					{
						$gia = 'null';
						$don_vi = 'null';
					}

					if ( $dien_tich == "" )
						$dien_tich = 'null';

					if ( !mysqli_query( $conn, "update tin set ma_phuong_xa = $phuong_xa, ma_kieu_bds = $kieu_bds,
							dien_tich = $dien_tich, gia = $gia, ma_don_vi = $don_vi, ma_trang_thai = $trang_thai where ma_tin = $ma_tin" ) )
						query_exec_err();


					if ( !mysqli_query( $conn, "update tin_noi_dung set tieu_de = '" . mysqli_real_escape_string( $conn, $tieu_de) . "',
							noi_dung = '" . mysqli_real_escape_string( $conn, $noi_dung ) . "' where ma_tin = $ma_tin" ) )
						query_exec_err();


					if ( $loai_bds != "4")
					{
							
							
						for ( $i = 1; $i <= 5 ; $i++ )
						{

							if ( isset( $_POST[$i] ) )
							{
								if ( !in_array($i, $arr_tien_ich) )
									if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
									query_exec_err();
							}
							else {
								if ( in_array($i, $arr_tien_ich) )
									if ( !mysqli_query( $conn, "delete from tin_tien_ich where ma_tin = $ma_tin and ma_tien_ich = $i ") )
									query_exec_err();
							}
						}
							

					}

					for ( $i = 6; $i <= 12 ; $i++ )
					{
							
						if ( isset( $_POST[$i] ) )
						{
							if ( !in_array($i, $arr_tien_ich) )
								if ( !mysqli_query( $conn, "insert into tin_tien_ich values($ma_tin, $i )") )
								query_exec_err();
						}
						else {
							if ( in_array($i, $arr_tien_ich) )
								if ( !mysqli_query( $conn, "delete from tin_tien_ich where ma_tin = $ma_tin and ma_tien_ich = $i ") )
								query_exec_err();
						}
					}


					if ( $email == "" )
						$email = 'null';

					if ( trim($dia_chi) == "" )
						$dia_chi = 'null';

					if ( !mysqli_query($conn, "update tin_lien_he set ho_ten = '" . mysqli_real_escape_string($conn, $ho_ten) . "', dien_thoai = '$dien_thoai', email = '$email', dia_chi = '" . mysqli_real_escape_string( $conn, $dia_chi ) . "' where ma_tin = $ma_tin") )
						query_exec_err();

					if (!mysqli_query($conn,'COMMIT'))
						query_exec_err();
					// end transaction

					
					$imgs = glob($temp_dir . "/*");
						
					$num_imgs = count($imgs);
						
					if ( $num_imgs != 0 )
					{
							
						$thumbs_dir = "images/$ma_tin/thumbs";
						if ( !is_dir($thumbs_dir) )
							mkdir($thumbs_dir, 0777, true);
							
						$imgs_dir = "images/$ma_tin/imgs";
						if ( !is_dir($imgs_dir) )
							mkdir($imgs_dir, 0777, true);
							
						for ( $i = 0; $i < $num_imgs; $i ++ )
						{
							$img = explode("/", $imgs[$i]);
							copy($imgs[$i], $imgs_dir . "/" . $img[ count($img) - 1 ]);
							unlink($imgs[$i]);
						}
							
						createThumbs($imgs_dir, $thumbs_dir, 100);
							
					}
					
					
					ob_end_clean();

					echo "<h2 align='center'>$message</h2>";

				}
			}
				}
			}
			?>
		</div>
	</div>


</body>
</html>
