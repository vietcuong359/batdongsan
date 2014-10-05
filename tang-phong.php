<?php

require_once 'ket-noi.php';
if ( !isset( $_GET['q']) )
{
	exit();
}
else $bds_id = $_GET['q'];

if ( !in_array($bds_id, array("1", "2", "3", "5", "7", "8", "9", "10"), true ))
	exit();

echo "<div id='tang_phong'><br/><span class='bold indent'>Tầng phòng</span><br/><br/>
	  <table id='table6'>
	  <tr>
	  	<td>Số tầng:</td>
	  <td>
	  	<input class='so_tang' name='so_tang' id='input_so_tang' type='text'
     	size='10' maxlength='3' />
      </td>
      </tr>
      <tr>
      	<td>Số phòng ngủ:</td>
      	<td><input class='so_phong_ngu' name='so_phong_ngu' id='input_so_phong_ngu' type='text'
	  	size='10' maxlength='5' /></td>
	  </tr>
	  <tr>
      	<td>Số phòng khách:</td>
      	<td><input class='so_phong_khach' name='so_phong_khach' id='input_so_phong_khach' type='text'
	  	size='10' maxlength='5' /></td>
	  </tr>
	  <tr>
      	<td>Số phòng WC:</td>
      	<td><input class='so_phong_wc' name='so_phong_wc' id='input_so_phong_wc' type='text'
	  	size='10' maxlength='5' /></td>
	  </tr>
	  <tr>
      	<td>Số phòng khác:</td>
      	<td><input class='so_phong_khac' name='so_phong_khac' id='input_so_phong_khac' type='text'
	  	size='10' maxlength='5' /></td>
	  </tr>
	  </table></div>";

?>