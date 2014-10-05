<?php 
require_once("hang-so.php");
require_once("ket-noi.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Bất động sản</title>
<link rel="stylesheet" type="text/css" href="css/trang-chu.css">
<script src="js/jquery.js"></script>
<script src="js/trang-chu.js"></script>
</head>
<body>

	<div id="container">

		<div id="header">
		
			<?php 
			if ( !isset($_SESSION['id']) )
			{
			
			?>
			<a href="trang-chu.php">Trang chủ</a>
			<a id='dang_tin' href='dang-tin.php'>Đăng tin</a>
			<a id='dang_ky' href='dang-ky.php'>Đăng ký</a>
			<a id='dang_nhap' href='dang-nhap.php'>Đăng nhập</a>
			<?php 
			}
			else {
			?>
			
			<a href="trang-chu.php">Trang chủ</a>
			<a id='dang_tin' href='dang-tin.php'>Đăng tin</a>
			<a id='thoat' href='dang-xuat.php'>Thoát</a>
			<a id='thanh_vien' href='thanh-vien.php'>Chào bạn: <span class='selected'><?php echo $_SESSION['ho_ten']; ?></span></a>
			
			<?php 
			}
			?>
			<form id="main_form" method="GET" action="trang-chu.php">
				<fieldset>
					<legend>
						<?php
						if (isset($_GET["nhu_cau"])) $nhu_cau = $_GET["nhu_cau"];
						else $nhu_cau = "0";

						$arr = array("0" => "Tất cả","1" => "Bán" ,"2" => "Cho thuê", "3" => "Cần mua", "4" => "Cần thuê");
						$valid_nc = false; // used to check $nhu_cau is valid or not
						while (list($id, $value) = each($arr)) {

							if ((string)$id !== $nhu_cau)
								echo "<a class='link_nhu_cau' id='$id' href='javascript:void(0)'>".$value."</a>";
							else if ((string)$id === $nhu_cau) {
								$valid_nc = true;
								echo "<a class='link_selected selected'><span class='selected'>$value</span></a>";
							}
						}

						?>
					</legend>
					<table id="main_table1">
						<col id="col1" />
						<col id="col2" />
						<col id="col3" />
						<col id="col4" />
						<col id="col5" />
						<col id="col6" />
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td align="right">Từ khóa:</td>
							<td class="tim_kiem"><?php
							if (isset($_GET["tu_khoa"])) $tu_khoa = $_GET["tu_khoa"];
							else $tu_khoa = "";
							echo "<input type='text' name='tu_khoa' size='30' maxlength='50' value='".$tu_khoa."' />";
							?>
							</td>
							<td><select id="select_loai_bds" name="loai_bds"
								>
									<?php
									
									
									if (isset($_GET["loai_bds"])) $loai_bds = $_GET["loai_bds"];
									else $loai_bds = "0";
								
									$arr = array("0" => "Tất cả bất động sản","1" => "Nhà" ,"2" => "Tòa nhà, cao ốc", "3" => "Khách sạn", "4" => "Đất","5" => "Văn phòng","6" => "Phòng",
											"7" => "Cửa hàng","8" => "Khu du lịch, nghỉ dưỡng", "9" => "Kho xưởng","10" => "Bất động sản khác");

									$valid_bds = false;
									while (list($id, $value) = each($arr)) {
										if ($id != $loai_bds)
											echo "<option value=\"".$id."\">".$value."</option>";
										else if ($id == $loai_bds)
										{
											$valid_bds = true;
											echo "<option selected=selected value=\"".$id."\">".$value."</option>";
										}
									}


									?>
							</select>
							</td>
							<td><select name="tinh_thanh" id="select_tinh_thanh"
								>
									<?php
									if (isset($_GET["tinh_thanh"])) $tinh_thanh = $_GET["tinh_thanh"];
									else $tinh_thanh = "0";
									$arr = array("Tất cả tỉnh thành","TP.HCM","Hà Nội","Đà Nẵng","Cần Thơ","Bình Dương","Đồng Nai","Hải Phòng","An Giang","Bà Rịa Vũng Tàu","Bắc Giang"
											,"Bắc Kạn","Bạc Liêu","Bắc Ninh","Bến Tre","Bình Phước","Bình Thuận","Bình Định","Cà Mau","Cao Bằng","Đắk Lắk","Đắk Nông","Điện Biên",
											"Đồng Tháp","Gia Lai","Hà Giang","Hà Nam ","Hà Tĩnh","Hải Dương","Hậu Giang","Hòa Bình","Hưng Yên","Khánh Hòa","Kiên Giang","Kon Tum",
											"Lai Châu","Lâm Đồng","Lạng Sơn","Lào Cai","Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ","Phú Yên","Quảng Bình",
											"Quảng Nam","Quảng Ngãi","Quảng Ninh","Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh","Thái Bình","Thái Nguyên","Thanh Hóa","Thừa Thiên Huế",
											"Tiền Giang","Trà Vinh","Tuyên quang","Vĩnh Long","Vĩnh Phúc","Yên Bái");

									$i = 0; $valid_tt = false;
									foreach ($arr as $value) {
										if ((string)$i !== $tinh_thanh) echo "<option value=\"".$i."\">".$value."</option>";
										else if ((string)$i === $tinh_thanh) {
											echo "<option selected=selected value=\"".$i."\">".$value."</option>";
											$valid_tt = true;
										}
										$i++;
									}
									?>
							</select>
							</td>
							<td><select name="quan_huyen" id="select_quan_huyen">
									<option value="0">Tất cả quận huyện</option>
									<?php
									$valid_qh = false;

									$connect_ok = true;

									if (isset($_GET["quan_huyen"])) $quan_huyen = $_GET["quan_huyen"];
									else $quan_huyen = "0";


									if ($valid_tt == true) { //only connect to db if $tinh_thanh is a valid value
											
										if ( $quan_huyen === "0")
											$valid_qh = true;


										$sql = "SELECT ma_quan_huyen,ten_quan_huyen FROM quan_huyen WHERE ma_tinh_thanh =".$tinh_thanh;

										$result1 = mysqli_query($conn,$sql);

										if ($result1)
										{

											while($row = mysqli_fetch_array($result1))
											{
												if ($quan_huyen !== $row['ma_quan_huyen'])
													echo "<option class=\"qh\" value=\"".$row['ma_quan_huyen']."\">".$row['ten_quan_huyen']."</option>";
												else if ($quan_huyen === $row['ma_quan_huyen']) {
													$valid_qh = true;
													echo "<option selected=selected class=\"qh\" value=\"".$row['ma_quan_huyen']."\">".$row['ten_quan_huyen']."</option>";
												}
											}
										}
										else { //query is failed (rare case!)

											$connect_ok = false;
										}

									}
									?>
							</select>
							</td>
							<td><input id="search_butt" type="submit" value="Tìm kiếm">
							</td>
						</tr>
					</table>
					<table id="main_table2">
						<col id="col_gia" />
						<col id="col_giat" />
						<col id="col_giac" />
						<col id="col_slash" />
						<col id="col_don_vi" />
						<col id="col_dt" />
						<col id="col_dtt" />
						<col id="col_dtc" />
						<col id="col_anh" />
						<tr>
							<td align="right">Giá:</td>
							<td><?php 
							$valid_giat = true;
							if (isset($_GET["giat"])) $giat = $_GET["giat"];
							


							if (!isset($_GET["giat"]))
							{
								$giat = "0";
								?> <input class="gia" name="giat" id="input_giat" type="text"
								value="thấp nhất" size="10" maxlength="10" /> <?php 
							}
							else if (is_numeric($giat) and $giat >= 0 and $giat <= MAX_GIA)
							{
								?> <input class="gia" name="giat" id="input_giat" type="text"
								value=<?php echo $giat; ?> size="10" maxlength="10" /> <?php		
							}
							else {
								$valid_giat = false;
								?> <input class="gia" name="giat" id="input_giat" type="text"
								value="<?php echo $giat; ?>" size="10" maxlength="10" /> <?php
							}
							?>
							</td>
							<td><?php 
							$valid_giac = true;
							if (isset($_GET["giac"])) $giac = $_GET["giac"];
	

							if (!isset($_GET["giac"]))
							{
								$giac = MAX_GIA;
								?> <input class="gia" name="giac" id="input_giac" type="text"
								value="cao nhất" size="10" maxlength="10" /> <?php 
							}
							else if (is_numeric($giac) and $giac >= 0 and $giac <= MAX_GIA)
							{
								?> <input class="gia" name="giac" id="input_giac" type="text"
								value=<?php echo $giac; ?> size="10" maxlength="10" /> <?php		
							}
							else {

								$valid_giac = false;
								?> <input class="gia" name="giac" id="input_giac" type="text"
								value="<?php echo $giac; ?>" size="10" maxlength="10" /> <?php 									
							}
							?>
							
							<td align="center">/</td>
							<td><select name="don_vi">
									<?php 
									$valid_don_vi = false;

									if (isset($_GET["don_vi"])) $don_vi = $_GET["don_vi"];
									else $don_vi = "0";

									$arr = array("0" => "Tất cả", "1" => "Tổng giá" , "2" => "m2");


									while (list($id, $value) = each($arr)) {
											
										if ((string)$id !== $don_vi)
											echo "<option value='".$id."'>".$value."</option>";
										else if ((string)$id === $don_vi) {
											$valid_don_vi = true;
											echo "<option selected='selected' value='".$id."'>".$value."</option>";
										}
									}
									?>
							</select>
							</td>
							<td align="right">Diện tích:</td>
							<td><?php 
							$valid_dtt = true;

							if (isset($_GET["dtt"])) $dtt = $_GET["dtt"];
							

						

							if (!isset($_GET["dtt"]))
							{
								$dtt = "0";
								?> <input class="dt" name="dtt" id="input_dtt" type="text"
								value="thấp nhất" size="10" maxlength="10" /> <?php 
							}
							else if (is_numeric($dtt) and $dtt >= 0 and $dtt <= MAX_DT)
							{
								?> <input class="dt" name="dtt" id="input_dtt" type="text"
								value=<?php echo $dtt; ?> size="10" maxlength="10" /> <?php		
							}
							else {
								$valid_dtt = false;
								?> <input class="dt" name="dtt" id="input_dtt" type="text"
								value="<?php echo $dtt; ?>" size="10" maxlength="10" /> <?php 
							}
							?>
							</td>
							<td><?php 
							$valid_dtc = true;
							if (isset($_GET["dtc"])) $dtc = $_GET["dtc"];
							

				

							if (!isset($_GET["dtc"]))
							{
								$dtc = MAX_DT;
								?> <input class="dt" name="dtc" id="input_dtc" type="text"
								value="cao nhất" size="10" maxlength="10" /> <?php 
							}
							else if (is_numeric($dtc) and $dtc >= 0 and $dtc <= MAX_DT)
							{
								?> <input class="dt" name="dtc" id="input_dtc" type="text"
								value=<?php echo $dtc; ?> size="10" maxlength="10" /> <?php		
							}
							else {
								$valid_dtc = false;
								?> <input class="dt" name="dtc" id="input_dtc" type="text"
								value="<?php echo $dtc; ?>" size="10" maxlength="10" /> <?php 
							}
							?>
							</td>
							<td><label id="label_anh"> <?php
							if (!isset($_GET["co_anh"]))
							{
								$co_anh = "0";
								echo '<input name="co_anh" type="checkbox"/>';
							}
							else if ($_GET["co_anh"] == "on")
							{
								$co_anh = "1";
								echo '<input name="co_anh" type="checkbox" checked="checked"/>';
							}
							?> Có ảnh
							</label>
							</td>
						</tr>
						<tr>
							<td></td>
							<?php 
							if ( isset($_GET["giat"]) and $_GET["giat"] != "thấp nhất" )
								if ($valid_giat) {
								if ( ($x = $giat/1000) >= 1  )
									echo "<td><span id='span_giat'>".$x." tỷ"."</span></td>";
								else
									echo "<td><span id='span_giat'>".$giat." triệu"."</span></td>";
							}
							else {
								echo "<td><span id='span_giat'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_giat'></span></td>";


							?>
							<?php 
							if ( isset($_GET["giac"]) and $_GET["giac"] != "cao nhất" )
								if ($valid_giac) {
								if ( ($x = $giac/1000) >= 1  )
									echo "<td><span id='span_giac'>".$x." tỷ"."</span></td>";
								else
									echo "<td><span id='span_giac'>".$giac." triệu"."</span></td>";
							}
							else {
								echo "<td><span id='span_giac'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_giac'></span></td>";


							?>


							<td></td>
							<td></td>
							<td></td>

							<?php 
							if ( isset($_GET["dtt"]) and $_GET["dtt"] != "thấp nhất" )
								if ($valid_dtt) {
								if ( ($x = $dtt/10000) >= 1  )
									echo "<td><span id='span_dtt'>".$x." ha"."</span></td>";
								else
									echo "<td><span id='span_dtt'>".$dtt." m2"."</span></td>";
							}
							else {
								echo "<td><span id='span_dtt'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_dtt'></span></td>";


							?>
							<?php 
							if ( isset($_GET["dtc"]) and $_GET["dtc"] != "cao nhất" )
								if ($valid_dtc) {
								if ( ($x = $dtc/10000) >= 1  )
									echo "<td><span id='span_dtc'>".$x." ha"."</span></td>";
								else
									echo "<td><span id='span_dtc'>".$dtc." m2"."</span></td>";
							}
							else {
								echo "<td><span id='span_dtc'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_dtc'></span></td>";


							?>
							<td></td>
						</tr>


					</table>
					<input name="nhu_cau" id="input_nhu_cau" type="hidden"
						value=<?php echo $nhu_cau; ?> /> <input name="vi_tri"
						id="input_vi_tri" type="hidden"
						value=<?php if (isset($_GET["vi_tri"])) $vi_tri = $_GET["vi_tri"];
						else $vi_tri = "0"; echo $vi_tri; ?> /> <input name="huong"
						id="input_huong" type="hidden"
						value=<?php if (isset($_GET["huong"])) $huong = $_GET["huong"];
						else $huong = "0"; echo $huong; ?> /> <input name="phap_ly"
						id="input_phap_ly" type="hidden"
						value=<?php if (isset($_GET["phap_ly"])) $phap_ly = $_GET["phap_ly"];
						else $phap_ly = "0"; echo $phap_ly; ?> /> <input name="phuong_xa"
						id="input_phuong_xa" type="hidden"
						value=<?php if (isset($_GET["phuong_xa"])) $phuong_xa = $_GET["phuong_xa"];
						else $phuong_xa = "0"; echo $phuong_xa; ?> /> <input
						name="kieu_bds" id="input_kieu_bds" type="hidden"
						value=<?php if (isset($_GET["kieu_bds"])) $kieu_bds = $_GET["kieu_bds"];
						else $kieu_bds = "0"; echo $kieu_bds; ?> /> <input name="ngangt"
						id="hinput_ngangt" type="hidden"
						value=<?php if (isset($_GET["ngangt"])) $ngangt = $_GET["ngangt"];
						else $ngangt= "từ"; echo $ngangt; ?> /> <input name="ngangc"
						id="hinput_ngangc" type="hidden"
						value=<?php if (isset($_GET["ngangc"])) $ngangc = $_GET["ngangc"];
						else $ngangc= "đến"; echo $ngangc; ?> /> <input name="doct"
						id="hinput_doct" type="hidden"
						value=<?php if (isset($_GET["doct"])) $doct = $_GET["doct"];
						else $doct= "từ"; echo $doct; ?> /> <input name="docc"
						id="hinput_docc" type="hidden"
						value=<?php if (isset($_GET["docc"])) $docc = $_GET["docc"];
						else $docc= "đến"; echo $docc; ?> /> <input name="nohaut"
						id="hinput_nohaut" type="hidden"
						value=<?php if (isset($_GET["nohaut"])) $nohaut = $_GET["nohaut"];
						else $nohaut= "từ"; echo $nohaut; ?> /> <input name="nohauc"
						id="hinput_nohauc" type="hidden"
						value=<?php if (isset($_GET["nohauc"])) $nohauc = $_GET["nohauc"];
						else $nohauc= "đến"; echo $nohauc; ?> /> <input name="tangt"
						id="hinput_tangt" type="hidden"
						value=<?php if (isset($_GET["tangt"])) $tangt = $_GET["tangt"];
						else $tangt= "từ"; echo $tangt; ?> /> <input name="tangc"
						id="hinput_tangc" type="hidden"
						value=<?php if (isset($_GET["tangc"])) $tangc = $_GET["tangc"];
						else $tangc= "đến"; echo $tangc; ?> /> <input name="phongt"
						id="hinput_phongt" type="hidden"
						value=<?php if (isset($_GET["phongt"])) $phongt = $_GET["phongt"];
						else $phongt= "từ"; echo $phongt; ?> /> <input name="phongc"
						id="hinput_phongc" type="hidden"
						value=<?php if (isset($_GET["phongc"])) $phongc = $_GET["phongc"];
						else $phongc= "đến"; echo $phongc; ?> /> <input name="hien_thi"
						id="input_hien_thi" type="hidden"
						value=<?php if (isset($_GET["hien_thi"])) $hien_thi = $_GET["hien_thi"];
						else $hien_thi= "20"; echo $hien_thi; ?> /> <input name="sap_xep"
						id="input_sap_xep" type="hidden"
						value=<?php if (isset($_GET["sap_xep"])) $sap_xep = $_GET["sap_xep"];
						else $sap_xep= "1"; echo $sap_xep; ?> />
				</fieldset>
			</form>
			<?php 


			if (!$valid_bds) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Loại bất động sản không đúng! </h2>"; exit();
			}
			if (!$valid_dtc) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Diện tích cao nhất không đúng! </h2>"; exit();
			}
			if (!$valid_dtt) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Diện tích thấp nhất không đúng! </h2>"; exit();
			}
			if (!$valid_giac) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Giá cao nhất không đúng! </h2>"; exit();
			}
			if (!$valid_giat) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Giá thấp nhất không đúng! </h2>"; exit();
			}
			if (!$valid_don_vi) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Loại diện tích không đúng! </h2>"; exit();
			}
			if (!$valid_nc) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Nhu cầu (mua, bán, cho thuê, thuê) không đúng! </h2>"; exit();
			}
			if (!$valid_tt) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Tỉnh thành không đúng! </h2>"; exit();
			}
			if (!$valid_qh) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Quận huyện không đúng! </h2>"; exit();
			}
			if (!$connect_ok) {
				mysqli_close($conn);
				echo "<h2 align='center'>Lỗi: Chưa kết nối được cơ sở dữ liệu! </h2>"; exit();
			}

			?>
		</div>
		<div id="menu" align="left">
			<div id="div_loc">Lọc tìm kiếm</div>
			<?php 
			$valid_vi_tri = false;
			$valid_huong = false;
			$valid_phap_ly = false;
			$valid_px = false;
			$valid_kieu_bds = false;

			$valid_ngangt = true;
			$valid_ngangc = true;
			$valid_doct =  true;
			$valid_docc = true;
			$valid_nohaut = true;
			$valid_nohauc =  true;
			$valid_tangt =  true;
			$valid_tangc = true;
			$valid_phongt =  true;
			$valid_phongc = true;
			$connect_ok = true;
			$valid_link = true;
			?>


			<div id="div_phuong_xa">
				<?php 

				if ($quan_huyen != "0"){
					echo "<div class='selected'>Phường xã</div>";
					echo "<div class='menu_group'>";
					if ($phuong_xa === "0") {
						echo "<span class='selected' >Tất cả</span><br/>";
						$valid_px = true;
					}
					else {
						echo "<a class='link_px' id='0' href='javascript:void(0)'>Tất cả</a><br/>";
					}


					$sql = "SELECT ma_phuong_xa, ten_phuong_xa FROM phuong_xa WHERE ma_quan_huyen =".$quan_huyen;

					$result1 = mysqli_query($conn,$sql);

					if ($result1)
					{

						while($row = mysqli_fetch_array($result1))
						{

							if ($phuong_xa !== $row['ma_phuong_xa'])
								echo "<a class='link_px' id='".$row['ma_phuong_xa']."' href='javascript:void(0)'>".$row['ten_phuong_xa']."</a><br/>";
							else if ($phuong_xa === $row['ma_phuong_xa']) {
								$valid_px = true;
								echo "<span class='selected' >".$row['ten_phuong_xa']."</span><br/>";
							}
						}
						echo "</div>";
					}
					else {
						$connect_ok = false;
					}
				}
				else $valid_px = true;


				?>

			</div>
			<div id="div_kieu_bds">
				<?php 
				if ($loai_bds == "0" | $loai_bds == "10")
				{
					if ( isset( $_GET["kieu_bds"] ) )
					{
						$valid_link = false;
					}
					$valid_kieu_bds = true;
				}
				else if ($loai_bds == "1")
				{
					echo "<div class='selected'>Loại nhà</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "1" => "Nhà ở", "2" => "Căn hộ, chung cư", "3" => "Biệt thự", "4" => "Loại nhà khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "2")
				{
					echo "<div class='selected'>Loại tòa nhà, cao ốc</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "5" => "Văn phòng", "6" => "Thương mại", "7" => "Dịch vụ", "8" => "Loại khác");

					while (list($id, $value) = each($arr)) {
							
						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "3")
				{
					echo "<div class='selected'>Loại khách sạn</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "9" => "1 sao", "10" => "2 sao", "11" => "3 sao", "12" => "4 sao", "13" => "5 sao", "14" => "Loại khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "4")
				{
					echo "<div class='selected'>Loại đất</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "15" => "Đất ở", "16" => "Đất nền dự án", "17" => "Đất sản xuất", "18" => "Loại khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "5")
				{
					echo "<div class='selected'>Loại văn phòng</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "19" => "Tòa nhà, cao ốc", "20" => "Căn hộ, nhà ở", "21" => "Loại khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
					
				else if ($loai_bds == "6") {
					echo "<div class='selected'>Loại phòng</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "22" => "Phòng khách sạn", "23" => "Phòng trọ ở riêng", "24" => "Phòng trọ chung chủ", "25" => "Loại phòng khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "7") {
					echo "<div class='selected'>Loại cửa hàng</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "26" => "Nhà hàng, quán ăn", "27" => "Cà phê, giải khát", "28" => "Thời trang", "29" => "Tạp hóa, bán lẻ", "30" => "Điện máy", "31" => "Kiot, sạp", "32" => "Loại khác" );

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "8") {
					echo "<div class='selected'>Loại khu</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "33" => "Khu du lịch", "34" => "Khu nghỉ dưỡng", "35" => "Resort", "36" => "Sân golf", "37" => "Loại khác");

					while (list($id, $value) = each($arr)) {
							
						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
				else if ($loai_bds == "9") {
					echo "<div class='selected'>Loại kho xưởng</div>
					<div class='menu_group'>";

					$arr = array("0" =>"Tất cả", "38" => "Kho", "39" => "Xưởng", "40" => "Loại khác");

					while (list($id, $value) = each($arr)) {

						if ((string)$id !== $kieu_bds)
							echo "<a class='link_kieu_bds' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
						else if ((string)$id === $kieu_bds) {
							$valid_kieu_bds = true;
							echo "<span class='selected'>".$value."</span><br/>";
						}
					}
					echo "</div>";
				}
					
				?>
			</div>
			<div class='selected'>Vị trí</div>
			<div class='menu_group'>
				<?php 				
				$arr = array("0" => "Tất cả", "1" => "Mặt tiền", "2" => "Đường hẻm", "3" => "Đường nội bộ", "4" => "Khu phố", "5" => "Thôn xóm", "6" => "Vị trí khác");
					
				while (list($id, $value) = each($arr)) {

					if ((string)$id !== $vi_tri)
						echo "<a class='link_vi_tri' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
					else if ((string)$id === $vi_tri) {
						$valid_vi_tri = true;
						echo "<span class='selected'>".$value."</span><br/>";
					}
				}
				echo "</div>";
					

					
				echo "<div class='selected'>Hướng</div>";
				echo "<div class='menu_group'>";

				$arr = array("0" => "Tất cả", "1" => "Đông", "2" => "Tây", "3" => "Nam", "4" => "Bắc", "5" => "Đông bắc", "6" => "Tây bắc", "7" => "Đông nam", "8" => "Tây nam", "9" => "Hướng khác");

				while (list($id, $value) = each($arr)) {

					if ((string)$id !== $huong)
						echo "<a class='link_huong' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
					else if ((string)$id === $huong) {
						$valid_huong = true;
						echo "<span class='selected'>".$value."</span><br/>";
					}
				}
				echo "</div>";
					
				echo "<div class='selected'>Pháp lý</div>";
				echo "<div class='menu_group'>";

				$arr = array("0" => "Tất cả", "1" => "Sổ đỏ", "2" => "Sổ hồng", "3" => "Giấy tay", "4" => "Giấy tờ hợp lệ", "5" => "Đang hợp thức hóa" , "6" => "Loại khác");

				while (list($id, $value) = each($arr)) {

					if ((string)$id !== $phap_ly)
						echo "<a class='link_phap_ly' id='".$id."' href=\"javascript:void(0)\">".$value."</a><br/>";
					else if ((string)$id === $phap_ly) {
						$valid_phap_ly = true;
						echo "<span class='selected'>".$value."</span><br/>";
					}
				}

				echo "</div>";
					
				?>
				<div class='selected'>Chiều ngang</div>
				<div class='menu_group'>
					<table id="table_ngang">
						<tr>
							<?php 
						

							if ( !isset($_GET["ngangt"]) )
							{
								$ngangt = "0";
							?>
							<td><input class="ngang" id="input_ngangt" size="5" maxlength="5"
								value="từ" />
							</td>
							<?php 
							}
							else if (is_numeric($ngangt) and $ngangt >= 0 and $ngangt <= MAX_SODO)
							{
								?>
							<td><input class="ngang" id="input_ngangt" size="5" maxlength="5"
								value=<?php echo $ngangt;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_ngangt = false;
								?>
							<td><input class="ngang" id="input_ngangt" size="5" maxlength="5"
								value="<?php echo $ngangt;?>" />
							</td>
							<?php 
							}

						

							if ( !isset($_GET["ngangc"]) )
							{
								$ngangc = MAX_SODO;
								?>
							<td><input class="ngang" id="input_ngangc" size="5" maxlength="5"
								value="đến" />
							</td>
							<?php 
							}
							else if (is_numeric($ngangc) and $ngangc >= 0 and $ngangc <= MAX_SODO)
							{
								?>
							<td><input class="ngang" id="input_ngangc" size="5" maxlength="5"
								value=<?php echo $ngangc;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_ngangc = false;
								?>
							<td><input class="ngang" id="input_ngangc" size="5" maxlength="5"
								value="<?php echo $ngangc;?>" />
							</td>
							<?php 
							}
							?>

							<td><a class='img_submit' href="javascript:void(0)"><img
									src="images/arrow.gif" height="15px" width="15px" /> </a></td>
						</tr>
						<tr>
							<?php 
							if ( isset($_GET["ngangt"]) and $_GET["ngangt"] != "từ" )
								if ($valid_ngangt) {
								echo "<td><span id='span_ngangt'>".$ngangt." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_ngangt'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_ngangt'></span></td>";


							?>
							<?php 
							if ( isset($_GET["ngangc"]) and $_GET["ngangc"] != "đến" )
								if ($valid_ngangc) {
								echo "<td><span id='span_ngangc'>".$ngangc." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_ngangc'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_ngangc'></span></td>";


							?>
						</tr>
					</table>
				</div>
				<div class='selected'>Chiều dọc</div>
				<div class='menu_group'>
					<table id="table_doc">
						<tr>
							<?php 
						
							if (!isset($_GET["doct"]))
							{
								$doct = "0";
								?>
							<td><input class="doc" id="input_doct" size="5" maxlength="5"
								value="từ" />
							</td>
							<?php 
							}
							else if (is_numeric($doct) and $doct >= 0 and $doct <= MAX_SODO)
							{
								?>
							<td><input class="doc" id="input_doct" size="5" maxlength="5"
								value=<?php echo $doct;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_doct = false;
								?>
							<td><input class="doc" id="input_doct" size="5" maxlength="5"
								value="<?php echo $doct;?>" />
							</td>
							<?php 
							}
						
							
							if ( !isset($_GET["docc"]) )
							{
								$docc = MAX_SODO;
								?>
							<td><input class='doc' id="input_docc" size="5" maxlength="5"
								value='đến' />
							</td>
							<?php 
							}
							else if (is_numeric($docc) and $docc >= 0 and $docc <= MAX_SODO)
							{
								?>
							<td><input class='doc' id="input_docc" size="5" maxlength="5"
								value=<?php echo $docc;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_docc = false;
								?>
							<td><input class='doc' id="input_docc" size="5" maxlength="5"
								value="<?php echo $docc;?>" />
							</td>
							<?php 
							}
							?>

							<td><a class='img_submit' href="javascript:void(0)"><img
									src="images/arrow.gif" height="15px" width="15px" /> </a></td>
						</tr>
						<tr>
							<?php 
							if ( isset($_GET["doct"]) and $_GET["doct"] != "từ" )
								if ($valid_doct) {
								echo "<td><span id='span_doct'>".$doct." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_doct'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_doct'></span></td>";


							?>
							<?php 
							if ( isset($_GET["docc"]) and $_GET["docc"] != "đến" )
								if ($valid_docc) {
								echo "<td><span id='span_docc'>".$docc." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_docc'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_docc'></span></td>";


							?>
						</tr>
					</table>
				</div>
				<div class='selected'>Nở hậu</div>
				<div class='menu_group'>
					<table id="table_nohau">
						<tr>
							<?php 
							
							
							if ( !isset($_GET["nohaut"]))
							{
								$nohaut = "0";
								?>
							<td><input class="nohau" id="input_nohaut" size="5" maxlength="5"
								value="từ" />
							</td>
							<?php 
							}
							else if (is_numeric($nohaut) and $nohaut >= 0 and $nohaut <= MAX_SODO)
							{
								?>
							<td><input class="nohau" id="input_nohaut" size="5" maxlength="5"
								value=<?php echo $nohaut;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_nohaut = false;
								?>
							<td><input class="nohau" id="input_nohaut" size="5" maxlength="5"
								value="<?php echo $nohaut;?>" />
							</td>
							<?php 
							}
						
							
							
							if (!isset($_GET["nohauc"]))
							{
								$nohauc = MAX_SODO;
								?>
							<td><input class='nohau' id="input_nohauc" size="5" maxlength="5"
								value='đến' />
							</td>
							<?php 
							}
							else if (is_numeric($nohauc) and $nohauc >= 0 and $nohauc <= MAX_SODO)
							{
								?>
							<td><input class='nohau' id="input_nohauc" size="5" maxlength="5"
								value=<?php echo $nohauc;?> />
							</td>
							<?php 	
							}
							else
							{
								$valid_nohauc = false;
								?>
							<td><input class="nohau" id="input_nohaut" size="5" maxlength="5"
								value="<?php echo $nohauc;?>" />
							</td>
							<?php 
							}
							?>

							<td><a class='img_submit' href="javascript:void(0)"><img
									src="images/arrow.gif" height="15px" width="15px" /> </a></td>
						</tr>
						<tr>
							<?php 
							if ( isset($_GET["nohaut"]) and $_GET["nohaut"] != "từ" )
								if ($valid_nohaut) {
								echo "<td><span id='span_nohaut'>".$nohaut." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_nohaut'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_nohaut'></span></td>";


							?>
							<?php 
							if ( isset($_GET["nohauc"]) and $_GET["nohauc"] != "đến" )
								if ($valid_nohauc) {
								echo "<td><span id='span_nohauc'>".$nohauc." m"."</span></td>";
							}
							else {
								echo "<td><span id='span_nohauc'>Vui lòng nhập số</span></td>";
							}
							else
								echo  "<td><span id='span_nohauc'></span></td>";


							?>
						</tr>
					</table>

				</div>

				<div id="div_tang_phong">
					<?php 
					if ($loai_bds != "0" & $loai_bds != "4" & $loai_bds != "6" & $loai_bds != "10" )
					{
						?>
					<div class='selected'>Số tầng / lầu</div>
					<div class='menu_group'>
						<table id="table_tang">
							<tr>
								<?php 
								
								
								if (!isset($_GET["tangt"]))
								{
									$tangt = "0";
									?>
								<td><input class="tang" id="input_tangt" size="5" maxlength="5"
									value="từ" />
								</td>
								<?php 
								}
								else if (is_numeric($tangt) and $tangt >= 0 and $tangt <= MAX_SODO)
								{
									?>
								<td><input class="tang" id="input_tangt" size="5" maxlength="5"
									value=<?php echo $tangt;?> />
								</td>
								<?php 	
								}
								else
								{
									$valid_tangt = false;
									?>
								<td><input class="tang" id="input_tangt" size="5" maxlength="5"
									value="<?php echo $tangt;?>" />
								</td>
								<?php 
								}
								
								
								if (!isset($_GET["tangc"]))
								{
									$tangc = MAX_SODO;
									?>
								<td><input class="tang" id="input_tangc" size="5" maxlength="5"
									value="đến" />
								</td>
								<?php 
								}
								else if (is_numeric($tangc) and $tangc >= 0 and $tangc <= MAX_SODO)
								{
									?>
								<td><input class="tang" id="input_tangc" size="5" maxlength="5"
									value=<?php echo $tangc;?> />
								</td>
								<?php 	
								}
								else
								{
									$valid_tangc = false;
									?>
								<td><input class="tang" id="input_tangc" size="5" maxlength="5"
									value="<?php echo $tangc;?>" />
								</td>
								<?php 
								}
								?>

								<td><a class='img_submit' href="javascript:void(0)"><img
										src="images/arrow.gif" height="15px" width="15px" /> </a></td>
							</tr>
							<tr>
								<?php 
								if ( isset($_GET["tangt"]) and $_GET["tangt"] != "từ" )
									if ($valid_tangt) {
									echo "<td><span id='span_tangt'>".$tangt." tầng"."</span></td>";
								}
								else {
									echo "<td><span id='span_tangt'>Vui lòng nhập số</span></td>";
								}
								else
									echo  "<td><span id='span_tangt'></span></td>";


								?>
								<?php 
								if ( isset($_GET["tangc"]) and $_GET["tangc"] != "đến" )
									if ($valid_tangc) {
									echo "<td><span id='span_tangc'>".$tangc." tầng"."</span></td>";
								}
								else {
									echo "<td><span id='span_tangc'>Vui lòng nhập số</span></td>";
								}
								else
									echo  "<td><span id='span_tangc'></span></td>";


								?>
							</tr>
						</table>
					</div>
					<div class='selected'>Số phòng ngủ</div>
					<div class='menu_group'>
						<table id="table_phong">
							<tr>
								<?php 
								
								
								if (!isset($_GET["phongt"]))
								{
									$phongt = "0";
									?>
								<td><input class="phong" id="input_phongt" size="5"
									maxlength="5" value="từ" />
								</td>
								<?php 
								}
								else if (is_numeric($phongt) and $phongt >= 0 and $phongt <= MAX_SODO)
								{
									?>
								<td><input class="phong" id="input_phongt" size="5"
									maxlength="5" value=<?php echo $phongt;?> />
								</td>
								<?php 	
								}
								else
								{
									$valid_phongt = false;
									?>
								<td><input class="phong" id="input_phongt" size="5"
									maxlength="5" value="<?php echo $phongt;?>" />
								</td>
								<?php 
								}
								
								
								if ( !isset($_GET["phongc"]))
								{
									$phongc = MAX_SODO;
									?>
								<td><input class='phong' id="input_phongc" size='5'
									maxlength='5' value='đến' />
								</td>
								<?php 
								}
								else if (is_numeric($phongc) and $phongc >= 0 and $phongc <= MAX_SODO)
								{
									?>
								<td><input class='phong' id="input_phongc" size='5'
									maxlength='5' value="<?php echo $phongc;?>" />
								</td>
								<?php 	
								}
								else
								{
									$valid_phongc = false;
									?>
								<td><input class='phong' id="input_phongc" size='5'
									maxlength='5' value=<?php echo $phongc;?> />
								</td>
								<?php 
								}
								?>


								<td><a class='img_submit' href="javascript:void(0)"><img
										src="images/arrow.gif" height="15px" width="15px" /> </a></td>
							</tr>
							<tr>
								<?php 
								if ( isset($_GET["phongt"]) and $_GET["phongt"] != "từ" )
									if ($valid_phongt) {
									echo "<td><span id='span_phongt'>".$phongt." phòng"."</span></td>";
								}
								else {
									echo "<td><span id='span_phongt'>Vui lòng nhập số</span></td>";
								}
								else
									echo  "<td><span id='span_phongt'></span></td>";


								?>
								<?php 
								if ( isset($_GET["phongc"]) and $_GET["phongc"] != "đến" )
									if ($valid_phongc) {
									echo "<td><span id='span_phongc'>".$phongc." phòng"."</span></td>";
								}
								else {
									echo "<td><span id='span_phongc'>Vui lòng nhập số</span></td>";
								}
								else
									echo  "<td><span id='span_phongc'></span></td>";


								?>
							</tr>
						</table>
					</div>
					<?php 		
					}
					else {
						if ( isset( $_GET["tangt"] ) | isset( $_GET["tangc"] ) | isset( $_GET["phongt"] ) | isset( $_GET["phongc"] ))
							$valid_link = false;
					}

					?>
				</div>

			</div>

			<div id="content">
				<?php 
					
				if ( !$valid_link ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Địa chỉ không đúng! </h2>"; exit();
				}
				if ( !$connect_ok ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Không kết nối được cơ sở dữ liệu! </h2>"; exit();
				}
					
				if ( !$valid_px) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Phường xã không đúng! </h2>"; exit();
				}
				if ( !$valid_kieu_bds) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Kiểu bất động sản không đúng! </h2>"; exit();
				}
				if ( !$valid_vi_tri ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Vị trí không đúng! </h2>"; exit();
				}
				if ( !$valid_huong ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Hướng không đúng! </h2>"; exit();
				}
				if ( !$valid_phap_ly ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Pháp lý không đúng! </h2>"; exit();
				}
				if ( !$valid_ngangt ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Chiều ngang thấp không đúng! </h2>"; exit();
				}
				if ( !$valid_ngangc ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Chiều ngang cao không đúng! </h2>"; exit();
				}
				if ( !$valid_doct ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Chiều dọc thấp không đúng! </h2>"; exit();
				}
				if ( !$valid_docc ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Chiều dọc cao không đúng! </h2>"; exit();
				}
				if ( !$valid_nohaut ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Nở hậu thấp không đúng! </h2>"; exit();
				}
				if ( !$valid_nohauc ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Nở hậu cao không đúng! </h2>"; exit();
				}
				if ( !$valid_tangt ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Số tầng thấp không đúng </h2>"; exit();
				}
				if ( !$valid_tangc ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Số tầng cao không đúng! </h2>"; exit();
				}
				if ( !$valid_phongt ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Số phòng thấp không đúng! </h2>"; exit();
				}
				if ( !$valid_phongc ) {
					mysqli_close($conn);
					echo "<h2 align='center'>Lỗi: Số phòng cao không đúng! </h2>"; exit();
				}
					
				if ( !isset($_GET['ma_tin']) )
				{
					if( isset($_GET['hien_thi']) )
						$hien_thi = $_GET['hien_thi'];
					else
						$hien_thi = "20";

					$arr = array("5", "10", "20", "50", "100");

					if ( !in_array($hien_thi, $arr, true) )
					{
						mysqli_close($conn);
						echo "<h2 align='center'>Lỗi: Số trang không đúng! </h2>"; exit();
					}

					if ( isset($_GET['sap_xep']) )
						$sap_xep = $_GET['sap_xep'];
					else
						$sap_xep = "1";

					if( isset($_GET['trang']) )
					{
						$page = $_GET['trang'];
						$offset = $hien_thi * ($page - 1);
					}
					else
					{
						$page = 1;
						$offset = 0;
					}

					if ( !ctype_digit($page."") | $page < 1 )
					{
						mysqli_close($conn);
						echo "<h2 align='center'>Lỗi: Số trang không đúng! </h2>"; exit();
					}

					$select = "select SQL_CALC_FOUND_ROWS tin.ma_tin, tin.ma_phuong_xa, tin.ma_kieu_bds, tin.ma_nhu_cau, tin.thoi_gian_dang, tin.gia, tin.dien_tich, tin.ma_don_vi";
					$from = " from tin";
					
					$where = " where ma_trang_thai = 1";
					$order_by= " order by";
					$limit = " limit ".$offset.", ".$hien_thi;

					if ( $sap_xep === "1")
						$order_by = $order_by . " tin.thoi_gian_dang DESC";
					else if ( $sap_xep === "2" )
						$order_by = $order_by . " tin.gia DESC";
					else if ( $sap_xep === "3" )
						$order_by = $order_by . " tin.gia ASC";
					else if ( $sap_xep === "4" )
						$order_by = $order_by . " tin.dien_tich DESC";
					else if ( $sap_xep === "5" )
						$order_by = $order_by . " tin.dien_tich ASC";
					else
					{
						echo "<h2 align='center'>Lỗi: Số trang không đúng! </h2>";
						mysqli_close($conn);
						exit();
					}



					if ( $nhu_cau != "0")
						$where = $where. " and tin.ma_nhu_cau = ".$nhu_cau;

					if ( $giat == "0" and $giac < MAX_GIA )
						$where = $where . " and tin.gia <= " . $giac;
					else if ( $giat > 0 and $giac == MAX_GIA )
						$where = $where . " and tin.gia >= " . $giat;
					else if ( $giat > 0 and $giac < MAX_GIA )
						$where = $where . " and tin.gia >= " . $giat . " and tin.gia <= " . $giac;

					if ( $dtt == "0" and $dtc < MAX_DT )
						$where = $where . " and tin.dien_tich <= " . $dtc;
					else if ( $dtt > 0 and $dtc == MAX_DT )
						$where = $where . " and tin.dien_tich >= " . $dtt;
					else if ( $dtt > 0 and $dtc < MAX_DT )
						$where = $where . " and tin.dien_tich >= " . $dtt . " and tin.dien_tich <= " . $dtc;

					if ( $don_vi != "0" )
						$where = $where . " and tin.ma_don_vi = ".$don_vi;


					if ($kieu_bds != "0")
					{
						$where = $where . " and tin.ma_kieu_bds = ".$kieu_bds;
					}
					else
					{
						if ( $loai_bds != "0")
						{
							$from = $from .", kieu_bds";
							$where = $where . " and tin.ma_kieu_bds = kieu_bds.ma_kieu_bds and kieu_bds.ma_loai_bds = ".$loai_bds;
						}
					}


					if ( $phuong_xa != "0")
					{
						$where = $where. " and tin.ma_phuong_xa = ".$phuong_xa;
					}
					else
					{
						if ( $quan_huyen != "0")
						{
							$from = $from . ", phuong_xa";
							$where = $where. " and tin.ma_phuong_xa = phuong_xa.ma_phuong_xa and phuong_xa.ma_quan_huyen = ".$quan_huyen;
						}
						else
						{
							if ( $tinh_thanh != "0" )
							{
								$from = $from . ", phuong_xa, quan_huyen";
								$where = $where. " and tin.ma_phuong_xa = phuong_xa.ma_phuong_xa and phuong_xa.ma_quan_huyen = quan_huyen.ma_quan_huyen and quan_huyen.ma_tinh_thanh = ".$tinh_thanh;
							}
						}
					}


					$vt_h_pl = true;

					if ( $vi_tri != "0")
					{
						$vt_h_pl = false;
						$from = $from .", tin_vi_tri_huong_phap_ly";
						$where = $where . " and tin.ma_tin = tin_vi_tri_huong_phap_ly.ma_tin and tin_vi_tri_huong_phap_ly.ma_vi_tri= ".$vi_tri;
					}

					if ( $huong != "0")
					{
						if ( $vt_h_pl ){
							$vt_h_pl = false;
							$from = $from .", tin_vi_tri_huong_phap_ly";
							$where = $where . " and tin.ma_tin = tin_vi_tri_huong_phap_ly.ma_tin and tin_vi_tri_huong_phap_ly.ma_huong = ".$huong;
						}
						else $where = $where . " and tin_vi_tri_huong_phap_ly.ma_huong = ".$huong;
					}

					if ( $phap_ly != "0" )
					{
						if ( $vt_h_pl ){
							$from = $from .", tin_vi_tri_huong_phap_ly";
							$where = $where . " and tin.ma_tin = tin_vi_tri_huong_phap_ly.ma_tin and tin_vi_tri_huong_phap_ly.ma_phap_ly = ".$phap_ly;
						}
						else $where = $where . " and tin_vi_tri_huong_phap_ly.ma_phap_ly = ".$phap_ly;
					}

				
					$so_do = true;
					
					if ( $ngangt == "0" and $ngangc < MAX_SODO )
					{
						$so_do = false;
						$from = $from . ", tin_so_do";
						$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_ngang <= " . $ngangc;
					}
					else if ( $ngangt > "0" and $ngangc == MAX_SODO )
					{
						$so_do = false;
						$from = $from . ", tin_so_do";
						$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_ngang >= " . $ngangt;
					}
					else if ( $ngangt > "0" and $ngangc < MAX_SODO )
					{
						$so_do = false;
						$from = $from . ", tin_so_do";
						$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_ngang >= " . $ngangt . " and tin_so_do.chieu_ngang <= " . $ngangc;
					}
					
					
					if ( $doct == "0" and $docc < MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_doc <= " . $docc;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.chieu_doc <= " . $docc;
					}
					else if ( $doct > "0" and $docc == MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_doc >= " . $doct;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.chieu_doc >= " . $doct;
					}
					else if ( $doct > "0" and $docc < MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.chieu_doc >= " . $doct . " and tin_so_do.chieu_doc <= " . $docc;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.chieu_doc >= " . $doct . " and tin_so_do.chieu_doc <= " . $docc;
					}
					
					if ( $nohaut == "0" and $nohauc < MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.no_hau <= " . $nohauc;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.no_hau <= " . $nohauc;
					}
					else if ( $nohaut > "0" and $nohauc == MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.no_hau >= " . $nohaut;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.no_hau >= " . $nohaut;
					}
					else if ( $nohaut > "0" and $nohauc < MAX_SODO )
					{
						if ( $so_do )
						{
							$from = $from . ", tin_so_do";
							$where = $where . " and tin.ma_tin = tin_so_do.ma_tin and tin_so_do.no_hau >= " . $nohaut . " and tin_so_do.no_hau <= " . $nohauc;
							$so_do = false;
						}
						else $where = $where . " and tin_so_do.no_hau >= " . $nohaut . " and tin_so_do.no_hau <= " . $nohauc;
					}
						
					
					$tang_phong = true;
					if ( $tangt == "0" and $tangc < MAX_SODO )
					{
						$tang_phong = false;
						$from = $from . ", tin_so_tang_phong_ngu";
						$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_tang <= " . $tangc;
					}
					else if ( $tangt > "0" and $tangc == MAX_SODO )
					{
						$tang_phong = false;
						$from = $from . ", tin_so_tang_phong_ngu";
						$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_tang >= " . $tangt;
					}
					else if ( $tangt > "0" and $tangc < MAX_SODO )
					{
						$tang_phong = false;
						$from = $from . ", tin_so_tang_phong_ngu";
						$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_tang >= " . $tangt . " and tin_so_tang_phong_ngu.so_tang <= " . $tangc;
					}

					if ( $phongt == "0" and $phongc < MAX_SODO )
					{
						if ( $tang_phong )
						{
							$from = $from . ", tin_so_tang_phong_ngu";
							$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_phong_ngu <= " . $phongc;
						}
						else $where = $where . " and tin_so_tang_phong_ngu.so_phong_ngu <= " . $phongc;
					}
					else if ( $phongt > "0" and $phongc == MAX_SODO )
					{
						if ( $tang_phong )
						{
							$from = $from . ", tin_so_tang_phong_ngu";
							$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_phong_ngu >= " . $phongt;
						}
						else $where = $where . " and tin_so_tang_phong_ngu.so_phong_ngu >= " . $phongt;
					}
					else if ( $phongt > "0" and $phongc < MAX_SODO )
					{
						if ( $tang_phong )
						{
							$from = $from . ", tin_so_tang_phong_ngu";
							$where = $where . " and tin.ma_tin = tin_so_tang_phong_ngu.ma_tin and tin_so_tang_phong_ngu.so_phong_ngu >= " . $phongt . " and tin_so_tang_phong_ngu.so_phong_ngu <= " . $phongc;
						}
						else $where = $where . " and tin_so_tang_phong_ngu.so_phong_ngu >= " . $phongt . " and tin_so_tang_phong_ngu.so_phong_ngu <= " . $phongc;
					}

					$tu_khoa = trim($tu_khoa);
					
					if ( $tu_khoa != "" )
					{
						$sql = "( select ma_tin from tin_noi_dung where tieu_de like '%" . addcslashes(mysqli_real_escape_string($conn, $tu_khoa), "%_").
						 "%' or noi_dung like '%" . addcslashes(mysqli_real_escape_string($conn, $tu_khoa), "%_") . "%' ) as tnd";
						$from = $from . ", $sql ";
						$where = $where ." and tin.ma_tin = tnd.ma_tin";
					}
					
					$sql = $select . $from . $where . $order_by . $limit;
					//echo $sql."<br/>";
					//exit();

					$result1 = mysqli_query($conn, $sql);

					$result2 = mysqli_query($conn, "select found_rows()");

					if( !$result1 | !$result2 )
					{
						mysqli_close($conn);
						exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
					}

					$row = mysqli_fetch_array($result2);

					$num_results = $row[0];

					$num_pages = (int) ($num_results / $hien_thi);

					if ( ($num_results % $hien_thi) > 0) $num_pages++;

					if ( $num_pages == 0 ) $num_pages = 1;

					
					echo "Có <span class='selected'>".$num_results;
					
					if ( empty($_GET) ) echo "</span> bất động sản:<br/>";
					else echo "</span> kết quả:<br/>";
					
					echo "<br/>Hiển thị: <select id='select_hien_thi'>";

					foreach ($arr as $value)
					{
						if ( $hien_thi != $value)
							echo "<option value='".$value."'>".$value."</option>";
						else echo "<option selected='selected' value='".$value."'>".$value."</option>";
							
					}

					echo "</select>";

					$arr = array("1" => "Tin mới nhất", "2" => "Giá cao đến thấp", "3" => "Giá thấp đến cao", "4" => "Diện tích cao đến thấp", "5" => "Diện tích thấp đến cao");
					echo " &nbsp;&nbsp;Sắp theo: <select id='select_sap_xep'>";

					while ( list($id, $value) = each($arr) ) {
							
						if ( $sap_xep != $id)
							echo "<option value='".$id."'>".$value."</option>";
						else
							echo "<option selected='selected' value='".$id."'>".$value."</option>";
					}

					echo "</select>";

					echo "<div id='div_paging'>";

					$query_string = $_SERVER['QUERY_STRING'];


					if ( $query_string !== "")
					{
						$pos1 = strpos($query_string, "&trang=");
						$pos2 = strpos($query_string, "trang=");
							
						if ( $pos1 !== false)
						{

							$piece = preg_split("/&trang=\d+/", $query_string, 2);

							echo "<a href='trang-chu.php?".$piece[0]."&trang=1".$piece[1]."'><img src='images/first.png' title='trang đầu' /></a>";

							$prev = $page - 1;

							if ($prev < 1) $prev = 1;

							echo "<a href='trang-chu.php?".$piece[0]."&trang=".$prev.$piece[1]."'><img src='images/previous.png' title='trang trước' /></a>";

							$array = (int)($page / 4);  //1
							$mod = $page % 4;   //6
							if ( $mod < 1) $array--;
							if ($array < 0) $array = 0;
							if ( $num_pages > ($array * 4 + 5) )
								for ($i=1 ; $i <= 5 ; $i++)
								{
									$math = $array * 4 + $i;
									if ($math != $page)
										echo "<a href='trang-chu.php?".$piece[0]."&trang=".$math.$piece[1]."'>".$math."</a>";
									else
										echo "<span class='selected'>".$math."</span>";

								}
								else
								{
									$i = ($array * 4) + 1;

									for ($i; $i <= $num_pages ; $i++)
									{
										if ($i != $page)
											echo "<a href='trang-chu.php?".$piece[0]."&trang=".$i.$piece[1]."'>".$i."</a>";
										else echo "<span class='selected'>".$i."</span>";
									}
								}
									
									
								$next = $page + 1;
									
								if ($next > $num_pages ) $next = $num_pages;
									
								echo "<a href='trang-chu.php?".$piece[0]."&trang=".$next.$piece[1]."'><img src='images/next.png' title='trang sau'/></a>";
									
								echo "<a href='trang-chu.php?".$piece[0]."&trang=".$num_pages.$piece[1]."'><img src='images/last.png' title='trang cuối'/></a>";
									
								echo "</div><br/><br/>";
						}
						else if ( $pos2 !== false)
						{
							$piece = preg_split("/trang=\d+/", $query_string, 2);

							echo "<a href='trang-chu.php?".$piece[0]."trang=1".$piece[1]."'><img src='images/first.png' title='trang đầu' /></a>";

							$prev = $page - 1;

							if ($prev < 1) $prev = 1;

							echo "<a href='trang-chu.php?".$piece[0]."trang=".$prev.$piece[1]."'><img src='images/previous.png' title='trang trước' /></a>";

							$array = (int)($page / 4);  //1
							$mod = $page % 4;   //6
							if ( $mod < 1) $array--;
							if ($array < 0) $array = 0;
							if ( $num_pages > ($array * 4 + 5) )
								for ($i=1 ; $i <= 5 ; $i++)
								{
									$math = $array * 4 + $i;
									if ($math != $page)
										echo "<a href='trang-chu.php?".$piece[0]."trang=".$math.$piece[1]."'>".$math."</a>";
									else
										echo "<span class='selected'>".$math."</span>";

								}
								else
								{
									$i = ($array * 4) + 1;

									for ($i; $i <= $num_pages ; $i++)
									{
										if ($i != $page)
											echo "<a href='trang-chu.php?".$piece[0]."trang=".$i.$piece[1]."'>".$i."</a>";
										else echo "<span class='selected'>".$i."</span>";
									}
								}
									
									
								$next = $page + 1;
									
								if ($next > $num_pages ) $next = $num_pages;
									
								echo "<a href='trang-chu.php?".$piece[0]."trang=".$next.$piece[1]."'><img src='images/next.png' title='trang sau'/></a>";
									
								echo "<a href='trang-chu.php?".$piece[0]."trang=".$num_pages.$piece[1]."'><img src='images/last.png' title='trang cuối'/></a>";
									
								echo "</div><br/><br/>";
						}
						else
						{

							echo "<a href='trang-chu.php?".$query_string."&trang=1'><img src='images/first.png' title='trang đầu' /></a>";

							$prev = $page - 1;

							if ($prev < 1) $prev = 1;

							echo "<a href='trang-chu.php?".$query_string."&trang=".$prev."'><img src='images/previous.png' title='trang trước' /></a>";

							$array = (int)($page / 4);  //1
							$mod = $page % 4;   //6
							if ( $mod < 1) $array--;
							if ($array < 0) $array = 0;
							if ( $num_pages > ($array * 4 + 5) )
								for ($i=1 ; $i <= 5 ; $i++)
								{
									$math = $array * 4 + $i;
									if ($math != $page)
										echo "<a href='trang-chu.php?".$query_string."&trang=".$math."'>".$math."</a>";
									else echo "<span class='selected'>".$math."</span>";

								}
								else
								{
									$i = ($array * 4) + 1;

									for ($i; $i <= $num_pages ; $i++)
									{
										if ($i != $page)
											echo "<a href='trang-chu.php?".$query_string."&trang=".$i."'>".$i."</a>";
										else echo "<span class='selected'>".$i."</span>";
									}
								}


								$next = $page + 1;

								if ($next > $num_pages ) $next = $num_pages;

								echo "<a href='trang-chu.php?".$query_string."&trang=".$next."'><img src='images/next.png' title='trang sau'/></a>";

								echo "<a href='trang-chu.php?".$query_string."&trang=".$num_pages."'><img src='images/last.png' title='trang cuối'/></a>";

								echo "</div><br/><br/>";
						}
					}
					else if ( $query_string === "" )
					{
						echo "<a href='trang-chu.php?trang=1'><img src='images/first.png' title='trang đầu' /></a>";
							
						$prev = $page - 1;
							
						if ($prev < 1) $prev = 1;
							
						echo "<a href='trang-chu.php?trang=".$prev."'><img src='images/previous.png' title='trang trước' /></a>";

						$array = (int)($page / 4);  //1
						$mod = $page % 4;   //6
						if ( $mod < 1) $array--;
						if ($array < 0) $array = 0;
						if ( $num_pages > ($array * 4 + 5) )
							for ($i=1 ; $i <= 5 ; $i++)
							{
								$math = $array * 4 + $i;
								if ($math != $page)
									echo "<a href='trang-chu.php?trang=".$math."'>".$math."</a>";
								else echo "<span class='selected'>".$math."</span>";
									
							}
							else
							{
								$i = ($array * 4) + 1;

								for ($i; $i <= $num_pages ; $i++)
								{
									if ($i != $page)
										echo "<a href='trang-chu.php?trang=".$i."'>".$i."</a>";
									else echo "<span class='selected'>".$i."</span>";
								}
							}


							$next = $page + 1;

							if ($next > $num_pages ) $next = $num_pages;

							echo "<a href='trang-chu.php?trang=".$next."'><img src='images/next.png' title='trang sau'/></a>";

							echo "<a href='trang-chu.php?trang=".$num_pages."'><img src='images/last.png' title='trang cuối'/></a>";

							echo "</div><br/><br/>";
					}





					date_default_timezone_set('Asia/Ho_Chi_Minh');
					
					$count = 0;

					while($row = mysqli_fetch_array($result1))
					{
						$img_dir = "images/". $row['ma_tin'];
									
						$thumbs = glob($img_dir . "/thumbs/*");
						
						$num_thumbs = count($thumbs);
					if ( ( $co_anh == "1" and $num_thumbs > 0 ) | $co_anh == "0" )
					{	
						$count++;
						
						echo "<div class='query_result'>";
						echo "<div class='img' align='center'>";
						if ( $num_thumbs > 0)
							echo "<a><img src='" . $thumbs[0] . "'" . " height='100px' width='100px' /></a>";
						else echo "<a><img src='images/no-photo.JPG' height='100px' width='100px' /></a>";
						echo "<br/><span class='ma_so'>ID: ".$row['ma_tin']."</span>";
						echo "</div>";
						echo "<div class='text'>";

						$result2 = mysqli_query($conn, "select tieu_de from tin_noi_dung where ma_tin = ".$row['ma_tin']);
						if ( !$result2 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row2 = mysqli_fetch_array( $result2 );

						if ( $query_string === "" )
							echo "<a class='tieu_de' href='trang-chu.php?ma_tin=".$row['ma_tin']."'><p class='tieu_de'>".$row2['tieu_de']."</p></a>";
						else if ( $query_string !== "")
						{
							$pos1 = strpos($query_string, "ma_tin=");
							if ( $pos1 !== false)
								$query_string = preg_replace("/ma_tin=\d+/", "ma_tin=".$row['ma_tin'], $query_string);
							else
								$query_string = $query_string . "&ma_tin=" . $row['ma_tin'];
							echo "<a class='tieu_de' href='trang-chu.php?" . $query_string . "'><p class='tieu_de'>".$row2['tieu_de']."</p></a>";
						}
						$result3 = mysqli_query($conn, "select ten_quan_huyen, ma_tinh_thanh, ten_phuong_xa from quan_huyen, ( select ma_quan_huyen, ten_phuong_xa from phuong_xa where ma_phuong_xa = ".$row['ma_phuong_xa'].") as px  where quan_huyen.ma_quan_huyen = px.ma_quan_huyen");
						if ( !$result3 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row3 = mysqli_fetch_array( $result3 );

						$result4 = mysqli_query($conn, "select ten_tinh_thanh from tinh_thanh where ma_tinh_thanh = ".$row3['ma_tinh_thanh']);
						if ( !$result4 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row4 = mysqli_fetch_array( $result4 );

						$result5 = mysqli_query($conn, "select ma_loai_bds, ten_kieu_bds from kieu_bds where ma_kieu_bds = ".$row['ma_kieu_bds']);
						if ( !$result5 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row5 = mysqli_fetch_array( $result5 );

						$result6 = mysqli_query($conn, "select ten_loai_bds from loai_bds where ma_loai_bds = ".$row5['ma_loai_bds']);
						if ( !$result6 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row6 = mysqli_fetch_array( $result6 );

						$result7 = mysqli_query($conn, "select chieu_ngang, chieu_doc, no_hau from tin_so_do where ma_tin = ".$row['ma_tin']);
						if ( !$result7 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row7 = mysqli_fetch_array( $result7 );


						$result9 = mysqli_query($conn, "select ma_vi_tri, ma_huong, ma_phap_ly from tin_vi_tri_huong_phap_ly where ma_tin = " . $row['ma_tin'] );
						if ( !$result9 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row9 = mysqli_fetch_array( $result9 );
							

						echo "<div class='content'>";
						echo "<table>";
						echo "<tr><td >Loại BĐS:</td><td> ".$row6['ten_loai_bds']; 
						
						if ( $row5['ten_kieu_bds'] != "" )
							echo " >> " . $row5['ten_kieu_bds'];
						
						echo "</td></tr>";
						
						if ( $row['ma_nhu_cau'] < 3 )
						{
							if ( $row9['ma_vi_tri'] != null)
							{
								$result8 = mysqli_query($conn, "select ten_vi_tri from vi_tri where ma_vi_tri = " . $row9['ma_vi_tri'] );
								if ( !$result8 ) {
									mysqli_close($conn);
									exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
								}
								$row8 = mysqli_fetch_array( $result8 );

								echo "<tr><td>Vị trí:</td><td>" . $row8['ten_vi_tri'] . "</td></tr>";
							}

							if ( $row9['ma_phap_ly'] != null)
							{
								$result10 = mysqli_query($conn, "select ten_phap_ly from phap_ly where ma_phap_ly = " . $row9['ma_phap_ly'] );
								if ( !$result10 ) {
									mysqli_close($conn);
									exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
								}
								$row10 = mysqli_fetch_array( $result10 );

								echo "<tr><td>Pháp lý:</td><td>" . $row10['ten_phap_ly'] . "</td></tr>";
							}
						}

						echo "<tr><td >Nơi đăng:</td><td> ".$row3['ten_phuong_xa'].", ".$row3['ten_quan_huyen'].", ".$row4['ten_tinh_thanh']."</td></tr>";

						echo "<tr><td >Ngày đăng:</td><td> ".date("d/m/Y", strtotime($row['thoi_gian_dang'] ))."</td></tr></table>";
						//echo "vị trí: ".$row[''];
						echo "</div>";
						echo "</div>";
						echo "<div class='gia_dt' align='center'>";
						if (  $row['gia'] == 0 )
						{
							$gia = "Thương lượng";
						}
						else
						{
							if ( ( $x = $row['gia'] / 1000 ) >= 1 )
							{
								$y = (int)$x; //>1 ty
								$z =  (int)($row['gia'] - $y * 1000);// trieu
								$t = round( ( $row['gia'] - (int)$row['gia'] ), 3 ) * 1000; //ngan
									
								$gia = $y." tỷ";
									
								if ( $z != 0 ) $gia = $gia . " ". $z . " triệu";
								if ( $t != 0 ) $gia = $gia . " ". $t . " ngàn";
								if ( $row['ma_don_vi'] != null and $row['ma_don_vi'] == "2" ) $gia = $gia . " / m2";
									
							}
							else
							{
								$z = (int)$row['gia']; // trieu
								$t = round( ( $row['gia'] - $z ), 3 ) * 1000; //ngan

								$gia = "";

								if ( $z != 0 ) $gia = $gia . $z . " triệu";
								if ( $t != 0 )
								{
									if ( $z != 0) $gia = $gia . " ". $t . " ngàn";
									else $gia = $gia . $t . " ngàn";
								}
								if ( $row['ma_don_vi'] != null and $row['ma_don_vi'] == "2") $gia = $gia . " / m2";

							}
						}
							
						echo "<span class='selected'>". $gia ."<br/></span>";
							

						if ( $row['dien_tich'] != null )
						{
							$dt = "";

							if ( $row7['chieu_ngang'] != null)
							{
								$dt = $dt . "N: " . round($row7['chieu_ngang'],2) . "m";
							}

							if ( $row7['chieu_doc'] != null )
							{
								if ( $dt != "" )
									$dt = $dt . ", D: ".round($row7['chieu_doc'],2) . "m";
								else
									$dt = $dt . "D: ".round($row7['chieu_doc'],2) . "m";
							}

							if ( $row7['no_hau'] != null )
							{
								if ( $dt != "" )
									$dt = $dt . ", NH: ".round($row7['no_hau'],2) . "m";
								else
									$dt = $dt . "NH: ".round($row7['no_hau'],2) . "m";
							}

							if ( ( $x = $row['dien_tich'] / 10000 ) >= 1 )
							{
								if ( $dt != "" )
									$dt = round($x,4) . " ha<br/><span class='so_do'>( " . $dt . " )</span>";
								else
									$dt = round($x,4) . " ha";
							}
							else
							{
								if ( $dt != "" )
									$dt = round($row['dien_tich'],2) . " m2<br/><span class='so_do'>( " . $dt . " )</span>";
								else
									$dt = round($row['dien_tich'],2) . " m2";
							}

							echo "<span class='dt'>" . $dt . "</span>";
						}
							


						echo "</div>";
						echo "</div>";
						
					}
				}
				


					mysqli_close($conn);
				}
				else ///////////////////////////////////////// chi tiet 1 tin
				{
					$ma_tin = $_GET['ma_tin'];

					if ( !ctype_digit($ma_tin) | $ma_tin < 1 )
					{
						mysqli_close($conn);
						exit("<h2 align='center'>Mã tin không đúng!</h2>");
							
					}

					$result1 = mysqli_query( $conn, "select tieu_de, noi_dung from tin_noi_dung where ma_tin = " . $ma_tin );
					if ( !$result1 ) {
						mysqli_close($conn);
						exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
					}
					$row1 = mysqli_fetch_array( $result1 );
						
					if ( !$row1 ) {
						exit("<h2 align='center'>Mã tin không đúng!</h2>");
					}
					
					echo "<p id='tieu_de2'>" . $row1['tieu_de'] . "</p>";
					echo "<hr/>";
					echo "<br/><span class='bold'>Mô tả:</span><br/>";
					echo "<p>" . $row1['noi_dung'] . "</p>";
				
					//image gallery
					$img_dir = "images/". $ma_tin;
										
					$images = glob($img_dir . "/imgs/*");
					$thumbs = glob($img_dir . "/thumbs/*");

					$num_imgs = count($images);
					$num_thumbs = count($thumbs);

					if ( $num_imgs == $num_thumbs & $num_imgs > 0 )
					{
							
						echo "<div id='sliderFrame'>
						<div id='slider'>
						<a id='next' ></a>
						<a id='prev' ></a>";
						for ( $i = 0; $i < $num_imgs ; $i++ )
						{
							$x = $i + 1;
							echo "<img class='large' id='" . $x . "' src='". $images[$i] . "'" . " alt='anh" . $x . "' />";
						}

						echo "</div><div id='thumbs' align='center'>";

						for ( $i = 0; $i < $num_thumbs ; $i++ )
						{
							$x = $i + 1;
							echo "<img class='thumb' id='" . $x . "' src='". $thumbs[$i] . "'" . " alt='thumb" . $x. "' />";
						}

						echo "</div></div>";

							
					}


					$result2 = mysqli_query( $conn, "select * from tin where ma_tin = " . $ma_tin );
					if ( !$result2 ) {
						mysqli_close($conn);
						exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
					}
					$row2 = mysqli_fetch_array( $result2 );

					if ( $row2['ma_nhu_cau'] < 3 ) // ban, cho thue
					{
						echo "</br><span class='bold'>Thông tin cơ bản:</span><br/><br/>";
						echo "<table id='table_tt_co_ban'>";
						echo "<tr><td>Mã tin:</td><td>" . $ma_tin . "</td></tr>";
							
							
							
						if ( $row2['gia'] == 0)
						{
							$gia = "Thương lượng";

						}
						else
						{
							if ( ( $x = $row2['gia'] / 1000 ) >= 1 )
							{
								$y = (int)$x; //>1 ty
								$z =  (int)($row2['gia'] - $y * 1000);// trieu
								$t = round( ( $row2['gia'] - (int)$row2['gia'] ), 3 ) * 1000; //ngan
									
								$gia = $y." tỷ";
									
								if ( $z != 0 ) $gia = $gia . " ". $z . " triệu";
								if ( $t != 0 ) $gia = $gia . " ". $t . " ngàn";
								if ( $row2['ma_don_vi'] != null and $row['ma_don_vi'] == "2" ) $gia = $gia . " / m2";
									
							}
							else
							{
								$z = (int)$row2['gia']; // trieu
								$t = round( ( $row2['gia'] - $z ), 3 ) * 1000; //ngan

								$gia = "";

								if ( $z != 0 ) $gia = $gia . $z . " triệu";
								if ( $t != 0 )
								{
									if ( $z != 0) $gia = $gia . " ". $t . " ngàn";
									else $gia = $gia . $t . " ngàn";
								}
								if ( $row2['ma_don_vi'] != null and $row2['ma_don_vi'] == "2") $gia = $gia . " / m2";


							}

						}
						echo "<tr class='even'><td>Giá:</td><td><span class='red'>". $gia ."</span></td></tr>";
							
							
						if ( $row2['dien_tich'] != null )
						{
							$result3 = mysqli_query($conn, "select chieu_ngang, chieu_doc, no_hau from tin_so_do where ma_tin = ".$ma_tin);
							if ( !$result3 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row3 = mysqli_fetch_array( $result3 );

							$dt = "";
							
							
							if ( $row3['chieu_ngang'] != null)
							{
								$dt = $dt . " Ngang: " . round($row3['chieu_ngang'],2) . "m";
							}

							if ( $row3['chieu_doc'] != null )
							{
								if ( $dt != "" )
									$dt = $dt . ", Dọc: " . round($row3['chieu_doc'],2) . "m";
								else
									$dt = $dt . " Dọc: " . round($row3['chieu_doc'],2) . "m";
							}

							if ( $row3['no_hau'] != null )
							{
								if ( $dt != "" )
									$dt = $dt . ", Nở hậu: " . round($row3['no_hau'],2) . "m";
								else
									$dt = $dt . " Nở hậu: " . round($row3['no_hau'],2) . "m";
							}

							if ( ( $x = $row2['dien_tich'] / 10000 ) >= 1 )
							{
								if ( $dt != "" )
									$dt = round($row2['dien_tich'],2)." m2 ( " . round($x,4). " ha ) ( " . $dt . " )" ;
								else
									$dt = round($row2['dien_tich'],2)." m2 ( " . round($x,4). " ha )";
							}
							else
							{
								if ( $dt != "" )
									$dt = round($row2['dien_tich'],2) . " m2 ( " . $dt . " )";
								else
									$dt = round($row2['dien_tich'],2) . " m2";
							}

							echo "<tr><td>Diện tích:</td><td>" . $dt ."</td></tr>";
						}
						else echo "<tr><td>Diện tích:</td><td></td></tr>";

						$result4 = mysqli_query($conn, "select ten_quan_huyen, ma_tinh_thanh, ten_phuong_xa from quan_huyen, ( select ma_quan_huyen, ten_phuong_xa from phuong_xa where ma_phuong_xa = ".$row2['ma_phuong_xa'].") as px  where quan_huyen.ma_quan_huyen = px.ma_quan_huyen");
						if ( !$result4 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row4 = mysqli_fetch_array( $result4 );
							
						$result5 = mysqli_query($conn, "select ten_tinh_thanh from tinh_thanh where ma_tinh_thanh = " . $row4['ma_tinh_thanh'] );
						if ( !$result5 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row5 = mysqli_fetch_array( $result5 );
							
						$result6 = mysqli_query($conn, "select so_nha_duong from tin_so_nha_duong where ma_tin= " . $ma_tin );
						if ( !$result6 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row6 = mysqli_fetch_array( $result6 );
							
						$dia_chi = $row5['ten_tinh_thanh'];
							
						if ( $row4['ten_quan_huyen'] != "" )
							$dia_chi = $row4['ten_quan_huyen'] . ", " . $dia_chi;
							
						if ( $row4['ten_phuong_xa'] != "" )
							$dia_chi = $row4['ten_phuong_xa'] . ", " . $dia_chi;
							
							
						if ( $row6['so_nha_duong'] != null)
						{
							$so_nha = trim($row6['so_nha_duong']);
							if ( $so_nha != "" )
								$dia_chi = $so_nha . ", " . $dia_chi;
						}

						echo "<tr class='even'><td>Địa chỉ:</td><td>" . $dia_chi . "</tr>";

						$result7 = mysqli_query($conn, "select ma_loai_bds, ten_kieu_bds from kieu_bds where ma_kieu_bds = ".$row2['ma_kieu_bds']);
						if ( !$result7 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row7 = mysqli_fetch_array( $result7 );
							
						$result8 = mysqli_query($conn, "select ten_loai_bds from loai_bds where ma_loai_bds = ".$row7['ma_loai_bds']);
						if ( !$result8 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row8 = mysqli_fetch_array( $result8 );
							
						echo "<tr><td>Loại BĐS:</td><td>" . $row8['ten_loai_bds'];
						
						if ( $row7['ten_kieu_bds'] != "" )
							echo " >> " . $row7['ten_kieu_bds'];
						
						echo "</td></tr>";
							
						$result9 = mysqli_query($conn, "select ten_nhu_cau from nhu_cau where ma_nhu_cau= ".$row2['ma_nhu_cau']);
						if ( !$result9 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row9 = mysqli_fetch_array( $result9 );
							
						echo "<tr class='even'><td>Nhu cầu:</td><td>" . $row9['ten_nhu_cau'] . "</td></tr>";
							
							
						$result11 = mysqli_query($conn, "select ma_vi_tri, ma_huong, ma_phap_ly from tin_vi_tri_huong_phap_ly where ma_tin = " . $ma_tin );
						if ( !$result11 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row11 = mysqli_fetch_array( $result11 );
							
						if ( $row11['ma_vi_tri'] != null)
						{
							$result10 = mysqli_query($conn, "select ten_vi_tri from vi_tri where ma_vi_tri = " . $row11['ma_vi_tri'] );
							if ( !$result10 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row10 = mysqli_fetch_array( $result10 );

							echo "<tr><td>Vị trí:</td><td>" . $row10['ten_vi_tri'] . "</td></tr>";
						}
						else echo "<tr><td>Vị trí:</td><td></td></tr>";
							
						if ( $row11['ma_huong'] != null)
						{
							$result12 = mysqli_query($conn, "select ten_huong from huong where ma_huong = " . $row11['ma_huong'] );
							if ( !$result12 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row12 = mysqli_fetch_array( $result12 );

							echo "<tr class='even'><td>Hướng:</td><td>" . $row12['ten_huong'] . "</td></tr>";
						}
						else echo "<tr class='even'><td>Hướng:</td><td></td></tr>";
							
						if ( $row11['ma_phap_ly'] != null)
						{
							$result13 = mysqli_query($conn, "select ten_phap_ly from phap_ly where ma_phap_ly = " . $row11['ma_phap_ly'] );
							if ( !$result13 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row13 = mysqli_fetch_array( $result13 );

							echo "<tr><td>Pháp lý:</td><td>" . $row13['ten_phap_ly'] . "</td></tr>";
						}
						else echo "<tr><td>Pháp lý:</td><td></td></tr>";
							
							
						$result18 = mysqli_query($conn, "select duong_rong from tin_duong_rong where ma_tin = " . $ma_tin );
						if ( !$result18 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row18 = mysqli_fetch_array( $result18 );
							
						if ( $row18['duong_rong'] != null )
							echo "<tr class='even'><td>Đường rộng:</td><td>" . $row18['duong_rong'] . " m</td></tr>";
						else
							echo "<tr class='even'><td>Đường rộng:</td><td></td></tr>";
							
						date_default_timezone_set('Asia/Ho_Chi_Minh');
							
						echo "<tr><td>Ngày đăng tin:</td><td>" . date( "d/m/Y", strtotime($row2['thoi_gian_dang'] ) ). "</td></tr>";

							
						echo "</table>";

							
						$show_tt_khac = false;
							
						if ( $row7['ma_loai_bds'] != "4" ) // dat ko co so tang, phong
						{
							echo "<br/><span class='bold'>Thông tin khác:</span><br/><br/>";

							$show_tt_khac = true;

							$result14 = mysqli_query($conn, "select so_tang, so_phong_ngu from tin_so_tang_phong_ngu where ma_tin = " . $ma_tin );
							if ( !$result14 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row14 = mysqli_fetch_array( $result14 );

							echo "<table id='table_tt_phong'><col></col><col class='checked'></col>";

							if ( $row14['so_tang'] != null )
								echo "<tr><td>Số tầng:</td><td>" . $row14['so_tang'] . "</td></tr>";
							else
								echo "<tr><td>Số tầng:</td><td></td></tr>";

							if ( $row14['so_phong_ngu'] != null )
								echo "<tr class='even'><td>Số phòng ngủ:</td><td>" . $row14['so_phong_ngu'] . "</td></tr>";
							else
								echo "<tr class='even'><td>Số phòng ngủ:</td><td></td></tr>";

							$result15 = mysqli_query($conn, "select so_phong_khach from tin_so_phong_khach where ma_tin = " . $ma_tin );
							if ( !$result15 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row15 = mysqli_fetch_array( $result15 );

							if ( $row15['so_phong_khach'] != null )
								echo "<tr><td>Số phòng khách:</td><td>" . $row15['so_phong_khach'] . "</td></tr>";
							else
								echo "<tr><td>Số phòng khách:</td><td></td></tr>";

							$result16 = mysqli_query($conn, "select so_phong_wc from tin_so_phong_wc where ma_tin = " . $ma_tin );
							if ( !$result16 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row16 = mysqli_fetch_array( $result16 );

							if ( $row16['so_phong_wc'] != null )
								echo "<tr class='even'><td>Số phòng wc:</td><td>" . $row16['so_phong_wc'] . "</td></tr>";
							else
								echo "<tr class='even'><td>Số phòng wc:</td><td></td></tr>";

							$result17 = mysqli_query($conn, "select so_phong_khac from tin_so_phong_khac where ma_tin = " . $ma_tin );
							if ( !$result17 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row17 = mysqli_fetch_array( $result17 );

							if ( $row17['so_phong_khac'] != null )
								echo "<tr><td>Số phòng khác:</td><td>" . $row17['so_phong_khac'] . "</td></tr>";
							else
								echo "<tr><td>Số phòng khác:</td><td></td></tr>";


							echo "</table>";
						}
						$result19 = mysqli_query($conn, "select ma_tien_ich from tin_tien_ich where ma_tin = " . $ma_tin );
						if ( !$result19 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
							
							
							
						$arr1 = array("1" => "Mới xây", "2" => "Chỗ để ô tô", "3" => "Sân vườn", "4" => "Sân thượng", "5" => "Hồ bơi");
							
							
						$arr2 = array("6" => "Tiện kinh doanh", "7" => "Tiện sản xuất", "8" => "Tiện mở văn phòng");
							
						$arr3 = array("9" => "Gần chợ", "10" => "Gần siêu thị", "11" => "Gần bệnh viện", "12" => "Gần công viên");
							
						$arr4 = array();
							
						while ( $row19 = mysqli_fetch_array( $result19 ) )
						{
							$arr4[] = $row19['ma_tien_ich'];
						}
							
							
						if ( count($arr4) > 0 )
						{
							if ( $show_tt_khac == false )
							{
								echo "<br/><span class='bold'>Thông tin khác:</span><br/><br/>";
							}
							echo "<table class='tien_ich'><col></col><col class='checked'></col>";
							$i = 1;
							while (list($id, $value) = each($arr1)) {
								if ( $i % 2 != 0 )	{
									if ( in_array( $id, $arr4 ) )
										echo "<tr><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								else {
									if ( in_array( $id, $arr4 ) )
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								$i++;
							}
							echo "</table>";

							echo "<table class='tien_ich'><col></col><col class='checked'></col>";
							$i = 1;
							while (list($id, $value) = each($arr2)) {
								if ( $i % 2 != 0 )	{
									if ( in_array( $id, $arr4 ) )
										echo "<tr><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								else {
									if ( in_array( $id, $arr4 ) )
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								$i++;
							}
							echo "</table>";

							echo "<table class='tien_ich'>";
							$i = 1;
							while (list($id, $value) = each($arr3)) {
								if ( $i % 2 != 0 )	{
									if ( in_array( $id, $arr4 ) )
										echo "<tr><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								else {
									if ( in_array( $id, $arr4 ) )
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'><img class='checked' src='images/checked.jpg' /></td></tr>";
									else
										echo "<tr class='even'><td>" . $value . "</td><td class='checked'></td></tr>";
								}
								$i++;
							}
							echo "</table>";
						}
					}
					else { // thong tin cho can mua, can thue
						echo "<br/><span class='bold'>Chi tiết:</span><br/><br/>";
						echo "<table id='table_tt_co_ban'>";
						echo "<tr><td>Mã tin:</td><td>" . $ma_tin . "</td></tr>";



						if ( $row2['gia'] == 0)
						{
							$gia = "Thương lượng";

						}
						else
						{
							if ( ( $x = $row2['gia'] / 1000 ) >= 1 )
							{
								$y = (int)$x; //>1 ty
								$z =  (int)($row2['gia'] - $y * 1000);// trieu
								$t = round( ( $row2['gia'] - (int)$row2['gia'] ), 3 ) * 1000; //ngan

								$gia = $y." tỷ";

								if ( $z != 0 ) $gia = $gia . " ". $z . " triệu";
								if ( $t != 0 ) $gia = $gia . " ". $t . " ngàn";
								if ( $row2['ma_don_vi'] != null and $row['ma_don_vi'] == "2" ) $gia = $gia . " / m2";

							}
							else
							{
								$z = (int)$row2['gia']; // trieu
								$t = round( ( $row2['gia'] - $z ), 3 ) * 1000; //ngan
									
								$gia = "";
									
								if ( $z != 0 ) $gia = $gia . $z . " triệu";
								if ( $t != 0 )
								{
									if ( $z != 0) $gia = $gia . " ". $t . " ngàn";
									else $gia = $gia . $t . " ngàn";
								}
								if ( $row2['ma_don_vi'] != null and $row2['ma_don_vi'] == "2") $gia = $gia . " / m2";
									
									
							}

						}
						echo "<tr class='even'><td>Giá:</td><td><span class='red'>". $gia ."</span></td></tr>";


						if ( $row2['dien_tich'] != null )
						{
							$result3 = mysqli_query($conn, "select chieu_ngang, chieu_doc, no_hau from tin_so_do where ma_tin = ".$ma_tin);
							if ( !$result3 ) {
								mysqli_close($conn);
								exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
							}
							$row3 = mysqli_fetch_array( $result3 );

							
							if ( ( $x = $row2['dien_tich'] / 10000 ) >= 1 )
							{
								
									$dt = round($row2['dien_tich'], 2) . " m2 ( " . round($x,4). " ha )" ;
							
							}
							else
							{
							
									$dt = round($row2['dien_tich'],2) . " m2";
							}

							echo "<tr><td>Diện tích:</td><td>" . $dt ."</td></tr>";
						}
						else echo "<tr><td>Diện tích:</td><td></td></tr>";
							
						$result4 = mysqli_query($conn, "select ten_quan_huyen, ma_tinh_thanh, ten_phuong_xa from quan_huyen, ( select ma_quan_huyen, ten_phuong_xa from phuong_xa where ma_phuong_xa = ".$row2['ma_phuong_xa'].") as px  where quan_huyen.ma_quan_huyen = px.ma_quan_huyen");
						if ( !$result4 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row4 = mysqli_fetch_array( $result4 );

						$result5 = mysqli_query($conn, "select ten_tinh_thanh from tinh_thanh where ma_tinh_thanh = " . $row4['ma_tinh_thanh'] );
						if ( !$result5 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row5 = mysqli_fetch_array( $result5 );

						$result6 = mysqli_query($conn, "select so_nha_duong from tin_so_nha_duong where ma_tin= " . $ma_tin );
						if ( !$result6 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row6 = mysqli_fetch_array( $result6 );

						$dia_chi = $row5['ten_tinh_thanh'];
							
						if ( $row4['ten_quan_huyen'] != "" )
							$dia_chi = $row4['ten_quan_huyen'] . ", " . $dia_chi;
							
						if ( $row4['ten_phuong_xa'] != "" )
							$dia_chi = $row4['ten_phuong_xa'] . ", " . $dia_chi;
							
							
						if ( $row6['so_nha_duong'] != null)
						{
							$so_nha = trim($row6['so_nha_duong']);
							if ( $so_nha != "" )
								$dia_chi = $so_nha . ", " . $dia_chi;
						}
					
						echo "<tr class='even'><td>Khu vực:</td><td>" . $dia_chi . "</td></tr>";
							

						$result7 = mysqli_query($conn, "select ma_loai_bds, ten_kieu_bds from kieu_bds where ma_kieu_bds = ".$row2['ma_kieu_bds']);
						if ( !$result7 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row7 = mysqli_fetch_array( $result7 );

						$result8 = mysqli_query($conn, "select ten_loai_bds from loai_bds where ma_loai_bds = ".$row7['ma_loai_bds']);
						if ( !$result8 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row8 = mysqli_fetch_array( $result8 );

						echo "<tr><td>Loại BĐS:</td><td>" . $row8['ten_loai_bds'] . " >> " . $row7['ten_kieu_bds'] . "</td></tr>";

						$result9 = mysqli_query($conn, "select ten_nhu_cau from nhu_cau where ma_nhu_cau= ".$row2['ma_nhu_cau']);
						if ( !$result9 ) {
							mysqli_close($conn);
							exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
						}
						$row9 = mysqli_fetch_array( $result9 );

						echo "<tr class='even'><td>Nhu cầu:</td><td>" . $row9['ten_nhu_cau'] . "</td></tr>";

						date_default_timezone_set('Asia/Ho_Chi_Minh');

						echo "<tr><td>Ngày đăng tin:</td><td>" . date( "d/m/Y", strtotime($row2['thoi_gian_dang'] ) ). "</td></tr>";
							

						echo "</table>";
					}
					echo "<div class='clear'></div>";
					echo "<br/><span class='bold'>Liên hệ:</span><br/><br/>";
					echo "<table id='lien_he'>";

					$result21= mysqli_query($conn, "select ho_ten, dien_thoai, email, dia_chi from tin_lien_he where ma_tin = ".$ma_tin );
					if ( !$result21 ) {
						mysqli_close($conn);
						exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
					}
					$row21 = mysqli_fetch_array( $result21 );

					echo "<tr><td>Họ tên:</td><td>" . $row21['ho_ten'] . "</td></tr>";
					echo "<tr class='even'><td>Điện thoại:</td><td>" . $row21['dien_thoai'] . "</td></tr>";
					
					echo "<tr><td>Email:</td><td>";
					if ( $row21['email'] != null )
						echo $row21['email'] . "</td></tr>";
					else echo "</td></tr>";
					
					echo "<tr class='even'><td>Địa chỉ:</td><td>";
					if ( $row21['dia_chi'] != null )
						echo $row21['dia_chi'] . "</td></tr>";
					else echo "</td></tr>";
					
					echo "</table>";

					$result22 = mysqli_query($conn, "select vi_do, kinh_do, ghi_chu from tin_dia_diem where ma_tin = ".$ma_tin );
					if ( !$result22 ) {
						mysqli_close($conn);
						exit("<h2 align='center'>Không kết nối được cơ sở dữ liệu!</h2>");
					}
					$row22 = mysqli_fetch_array( $result22 );

					if ( $row22 != null )
					{
						
						echo "<br/><span class='bold'>Bản đồ:</span><br/><br/>";
						?>

				<script>
			function initialize()
			{
				var myCenter = new google.maps.LatLng( <?php echo $row22['vi_do'] . ', ' . $row22['kinh_do']; ?> );
 	 			var mapProp = {
    			center: myCenter,
    			zoom: 16,
    			mapTypeId: google.maps.MapTypeId.ROADMAP
  				};
  				var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

  				var marker=new google.maps.Marker({
  				  position: myCenter,
  				  map: map
  				});
				
  				var infowindow = new google.maps.InfoWindow({
  				  content: "<?php if ( $row22['ghi_chu'] != null ) echo $row22['ghi_chu']; else echo "";  ?>"
  				});

  				infowindow.open(map,marker);

  				google.maps.event.addListener(marker, 'click', function() {
  				  infowindow.open(map,marker);
  				});
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
		}
		
		
		mysqli_close($conn);
	}
		?>
			</div>
		</div>


		<div id="footer">zzz</div>

	</div>

</body>
</html>
