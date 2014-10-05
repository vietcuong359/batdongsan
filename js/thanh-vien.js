$(document).ready(function(){
	$(".huy").click(function(){
		 $(location).attr("href","thanh-vien.php");
	});
	
	$("#chon2 input").click(function(){
		$(location).attr("search","muc=2&nhu_cau=" + $(this).val());
	});
	
	$("#select_loai_bds").change(function(){
		show_re($(this).val());
	});
	
	$("#select_tinh_thanh").change(function(){
		show_district($(this).val());
	});
	
	$("#select_tinh_thanh2").change(function(){
		show_district2($(this).val());
	});
	
	$("#select_quan_huyen").change(function(){
		show_ward($(this).val());
	});
	
	$(".lb_nhu_cau").change(function(){
		$(location).attr('href', "thanh-vien.php?muc=3&nhu_cau=" + $(this).children(":first").val() );
	});
	
	
	// gia
	
	  $("#input_gia").keyup( function(){
		  display_price( $(this).val(), $("#span_gia"));
	  });
	  
	  $("#input_gia").blur( function(){
		  if ( $(this).val() == "" )
			  $("#span_gia").text("");
	  });
	  
	// dien tich
		
	  $("#input_dien_tich").keyup( function(){
		  display_area( $(this).val(), $("#span_dt"));
	  });
	  
	  $("#input_dien_tich").blur( function(){
		  if ( $(this).val() == "" )
			  $("#span_dt").text("");
	  });
	
	 $(".link_trang_thai").click( function(){
		$("#hinput_trang_thai").val( $(this).attr("id") );
		$("#form_quan_ly_tin").submit();
	 });
	  
	 $(".link_xoa").click( function(){
		 var ok = confirm("Bạn có muốn xóa tin có mã số: " + $(this).attr("id") + "?");
		 
		 if ( ok == true )
			 remove_post( $(this).parent().parent(), $(this).attr("id") );
			 
	 });
});


var xmlhttp;
function sendRequest(id,url,func)
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
}
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=func;
xmlhttp.open("GET",url+"?q="+id,true);
xmlhttp.send();
}


function show_re(bds_id) 
{
	// kieu bds
	sendRequest(bds_id,"kieu-bds.php",function() 
	{
	    if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	$("#select_kieu_bds").empty();
	    	$("#select_kieu_bds").append("<option value='0'>Chọn</option>");
	    	$("#select_kieu_bds").append(xmlhttp.responseText);	    	
	    }
	});	
	
	// tien ich
	if ( bds_id == "4" )
	{
		$("#table7").remove();
	}
	else if ( bds_id == "0" | bds_id == "1" | bds_id == "2" | bds_id == "3" | bds_id == "5" | bds_id == "6"
		| bds_id == "7"| bds_id == "8"| bds_id == "9" | bds_id == "10" )
	{
		
		if ( $("#table7").length == 0 )
		{
			var x = '<table id="table7">' +
					'<tr>' +
					'<td><input  name="tienich1" type="checkbox"></td>' +
					'<td>Mới xây</td>' +
					'</tr>' +
					'<tr>' +
					'<td><input name="tienich2" type="checkbox"></td>' +
					'<td>Chỗ để ô tô</td>' +
					'</tr>' +
					'<tr>' +
					'<td><input name="tienich3" type="checkbox"></td>'+
					'<td>Sân vườn</td>' +
					'</tr>' +
					'<tr>' +
					'<td><input  name="tienich4" type="checkbox"></td>' +
					'<td>Sân thượng</td>' +
					'</tr>' +
					'<tr>' +
					'<td><input  name="tienich5" type="checkbox"></td>' +
					'<td>Hồ bơi</td>' +
					'</tr>' +
					'</table>';
					$("#table8").before(x);
		}
	}
	
	// tang phong
	if ( bds_id === "4" )
	{
		$("div #tang_phong").remove();
	}
	else if ( bds_id == "0" | bds_id == "1" | bds_id == "2" | bds_id == "3" | bds_id == "5" | bds_id == "6"
		| bds_id == "7"| bds_id == "8"| bds_id == "9" | bds_id == "10" )
	{
		
		if ( $("#table6").length == 0 )
		{			
	   	 		var x = "<div id='tang_phong'><br/><span class='bold indent'>Tầng phòng</span><br/><br/>" +
	   	 				"<table id='table6'>" +
	   	 				"<tr>" +
	   	 					"<td>Số tầng:</td>" +
	   	 					"<td>" +
	   	 					"<input class='so_tang' name='so_tang' id='input_so_tang' type='text'" +
	   	 						"size='10' maxlength='3' />" +
	   	 					"</td>" +
	   	 				"</tr>" +
	   	 				"<tr>" +
	   	 					"<td>Số phòng ngủ:</td>" +
	   	 					"<td><input class='so_phong_ngu' name='so_phong_ngu' id='input_so_phong_ngu' type='text'" +
	   	 						"size='10' maxlength='5' /></td>" +
	   	 				"</tr>" +
	   	 				"<tr>" +
	   	 				"<td>Số phòng khách:</td>" +
	   	 				"<td><input class='so_phong_khach' name='so_phong_khach' id='input_so_phong_khach' type='text'" +
	   	 					"size='10' maxlength='5' /></td>" +
	   	 				"</tr>" +
	   	 				"<tr>" +
	   	 				"<td>Số phòng tắm/WC:</td>" +
	   	 				"<td><input class='so_phong_wc' name='so_phong_wc' id='input_so_phong_wc' type='text'" +
	   	 					"size='10' maxlength='5' /></td>" +
	   	 				"</tr>" +
	   	 				"<tr>" +
	   	 				"<td>Số phòng khác:</td>" +
	   	 				"<td><input class='so_phong_khac' name='so_phong_khac' id='input_so_phong_khac' type='text'" +
	   	 					"size='10' maxlength='5' /></td>" +
	   	 				"</tr>" +
	   	 				"</table></div>";
	   	 			
	   	 			
	   	 			$("#table5").after(x);
	   	 					
		}
	}
}

function show_district(tt_id)
{
	$("#select_quan_huyen").empty();
	$("#select_quan_huyen").append("<option value='0'>Chọn</option>");
	$("#select_phuong_xa").empty();	
	$("#select_phuong_xa").append("<option value='0'>Chọn</option>");
	
	if ( tt_id != "0" )
    {	
    	sendRequest(tt_id,"tt.php",function() 
    	{
    		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			$("#select_quan_huyen").append(xmlhttp.responseText);
    		}
    	});
    }
}

function show_ward(qh_id) 
{
	$("#select_phuong_xa").empty();	
	$("#select_phuong_xa").append("<option value='0'>Chọn</option>");
	
	if ( qh_id != "0" )
	{
		sendRequest(qh_id,"px_select.php",function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			$("#select_phuong_xa").append(xmlhttp.responseText);
    		}
		});		 		
	}
}


function display_price(value,span)
{
			
		if(!isNaN(value))
		{
			if ((y = value/1000) >= 1 )
				span.text( y + " tỷ");
			else
				span.text(value + " triệu");
		}
		else
			span.text("Vui lòng nhập số");

}

function display_area(value,span)
{
	
	if(!isNaN(value))
	{
		
		if ((y = value/10000) >= 1 ) 
			span.text(y + " ha");
		else 
			span.text(value + " m2");
	}
	else
		span.text("Vui lòng nhập số");

}


function show_district2(tt_id)
{
	$("#select_quan_huyen2").empty();
	$("#select_quan_huyen2").append("<option value='0'>Tất cả quận huyện</option>");
	
	if ( tt_id != "0" )
    {	
    	sendRequest(tt_id,"tt.php",function() 
    	{
    		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			$("#select_quan_huyen2").append(xmlhttp.responseText);
    		}
    	});
    }
}

function remove_post(row, id)
{
	sendRequest(id,"xoa-tin.php",function() 
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    	row.remove();
	    }
	});
}
