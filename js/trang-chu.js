
$(document).ready(function(){
	$("#main_form").submit(function(){
		  return submit();
	}); 
	
	$("#select_loai_bds").change(function(){
		show_re_type($(this).val());
	});
	
	$("#select_tinh_thanh").change(function(){
		show_district($(this).val());
	});
	
	$("#select_quan_huyen").change(function(){
		show_ward($(this).val());
	});
	
	$(".link_nhu_cau").click(function(){
		$("#input_nhu_cau").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".link_vi_tri").click(function(){
		$("#input_vi_tri").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".link_huong").click(function(){
		$("#input_huong").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".link_phap_ly").click(function(){
		$("#input_phap_ly").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".link_kieu_bds").click(function(){
		$("#input_kieu_bds").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".link_px").click(function(){
		$("#input_phuong_xa").val($(this).attr("id"));
		$("#main_form").submit();
	});
	
	$(".img_submit").click(function(){
		$("#main_form").submit();
	});
	
	$("input").each(function(){
		 if ( $(this).attr("name") != "tu_khoa" ) {
			 if ( $(this).val() != "thấp nhất" & $(this).val() != "cao nhất" & $(this).val() != "từ" & $(this).val() != "đến" )
				 $(this).css("color","#000000");
		 }
	});
	
	  $("#input_giat").blur( function(){
		  blur( $(this), "thấp nhất", $("#span_giat"));
	  });
	  $("#input_giat").focus( function(){
		  focus( $(this), "thấp nhất");
	  });
	  $("#input_giat").keyup( function(){
		  display_price( $(this).val(), $("#span_giat"));
	  });
	  
	  $("#input_giac").blur( function(){
		  blur( $(this), "cao nhất", $("#span_giac"));
	  });
	  $("#input_giac").focus( function(){
		  focus( $(this), "cao nhất");
	  });
	  $("#input_giac").keyup( function(){
		  display_price( $(this).val(), $("#span_giac"));
	  });
	  
	  $("#input_dtt").blur( function(){
		  blur( $(this), "thấp nhất", $("#span_dtt"));
	  });
	  $("#input_dtt").focus( function(){
		  focus( $(this), "thấp nhất");
	  });
	  $("#input_dtt").keyup( function(){
		  display_area( $(this).val(), $("#span_dtt"));
	  });
	  
	  $("#input_dtc").blur( function(){
		  blur( $(this), "cao nhất", $("#span_dtc"));
	  });
	  $("#input_dtc").focus( function(){
		  focus( $(this), "cao nhất");
	  });
	  $("#input_dtc").keyup( function(){
		  display_area( $(this).val(), $("#span_dtc"));
	  });
	  
	  $("#input_ngangt").blur( function(){
		  blur( $(this), "từ", $("#span_ngangt"));
	  });
	  $("#input_ngangt").focus( function(){
		  focus( $(this), "từ");
	  });
	  $("#input_ngangt").keyup( function(){
		  display_dimension( $(this).val(), $("#span_ngangt"));
	  });
	  
	  $("#input_ngangc").blur( function(){
		  blur( $(this), "đến", $("#span_ngangc"));
	  });
	  $("#input_ngangc").focus( function(){
		  focus( $(this), "đến");
	  });
	  $("#input_ngangc").keyup( function(){
		  display_dimension( $(this).val(), $("#span_ngangc"));
	  });
	  
	  $("#input_doct").blur( function(){
		  blur( $(this), "từ", $("#span_doct"));
	  });
	  $("#input_doct").focus( function(){
		  focus( $(this), "từ");
	  });
	  $("#input_doct").keyup( function(){
		  display_dimension( $(this).val(), $("#span_doct"));
	  });
	  
	  $("#input_docc").blur( function(){
		  blur( $(this), "đến", $("#span_docc"));
	  });
	  $("#input_docc").focus( function(){
		  focus( $(this), "đến");
	  });
	  $("#input_docc").keyup( function(){
		  display_dimension( $(this).val(), $("#span_docc"));
	  });
	  
	  $("#input_nohaut").blur( function(){
		  blur( $(this), "từ", $("#span_nohaut"));
	  });
	  $("#input_nohaut").focus( function(){
		  focus( $(this), "từ");
	  });
	  $("#input_nohaut").keyup( function(){
		  display_dimension( $(this).val(), $("#span_nohaut"));
	  });
	  
	  $("#input_nohauc").blur( function(){
		  blur( $(this), "đến", $("#span_nohauc"));
	  });
	  $("#input_nohauc").focus( function(){
		  focus( $(this), "đến");
	  });
	  $("#input_nohauc").keyup( function(){
		  display_dimension( $(this).val(), $("#span_nohauc"));
	  });
	  
	  $("#input_tangt").blur( function(){
		  blur( $(this), "từ", $("#span_tangt"));
	  });
	  $("#input_tangt").focus( function(){
		  focus( $(this), "từ");
	  });
	  $("#input_tangt").keyup( function(){
		  display_floor( $(this).val(), $("#span_tangt"));
	  });
	  
	  $("#input_tangc").blur( function(){
		  blur( $(this), "đến", $("#span_tangc"));
	  });
	  $("#input_tangc").focus( function(){
		  focus( $(this), "đến");
	  });
	  $("#input_tangc").keyup( function(){
		  display_floor( $(this).val(), $("#span_tangc"));
	  });
	  
	  $("#input_phongt").blur( function(){
		  blur( $(this), "từ", $("#span_phongt"));
	  });
	  $("#input_phongt").focus( function(){
		  focus( $(this), "từ");
	  });
	  $("#input_phongt").keyup( function(){
		  display_room( $(this).val(), $("#span_phongt"));
	  });
	  
	  $("#input_phongc").blur( function(){
		  blur( $(this), "đến", $("#span_phongc"));
	  });
	  $("#input_phongc").focus( function(){
		  focus( $(this), "đến");
	  });
	  $("#input_phongc").keyup( function(){
		  display_room( $(this).val(), $("#span_phongc"));
	  });
	  $("#select_hien_thi").change( function(){  

		  var url = $(location).attr('search');
		  //alert("url: " + $(location).attr('search'));
		  var hien_thi = $(this).val();
		  
		  var pos1 = url.search("&hien_thi=");	
		  var pos2 = url.search("hien_thi=");	
		  var pos3 = url.search("\\?");
		  
		  url = url.replace(/&trang=\d+/, "");
		  url = url.replace(/\?trang=\d+&/, "\?");
		  url = url.replace(/trang=\d+/, "");
		 	
		  var end_char = url.charAt(url.length - 1);
		  
			if ( pos3 != -1 & end_char == '?' )
				url = url + "hien_thi=" + hien_thi;
			else if ( pos3 != -1 & end_char != '?' )
			{
				if ( pos1 != -1) 
					url = url.replace(/&hien_thi=\d+/, "&hien_thi="  + hien_thi);
				else if ( pos2 != -1)
					url = url.replace(/hien_thi=(\d)+/, "hien_thi="  + hien_thi);
				else url = url + "&hien_thi="  + hien_thi;
			}
			else if ( pos3 == -1) 
			{
				url = url + "?hien_thi="  + hien_thi;
				
			}
			  
		  $(location).attr('search',url);
	  });
	  
	  $("#select_sap_xep").change( function(){  

		  var url = $(location).attr('search');
		  var sap_xep = $(this).val();
		  
		  var pos1 = url.search("&sap_xep=");	
		  var pos2 = url.search("sap_xep=");	
		  var pos3 = url.search("\\?");
		 	
		  var end_char = url.charAt(url.length - 1);
		  
			if ( pos3 != -1 & end_char == '?' )
				url = url + "sap_xep=" + sap_xep;
			else if ( pos3 != -1 & end_char != '?' )
			{
				if ( pos1 != -1) 
					url = url.replace(/&sap_xep=\d+/, "&sap_xep="  + sap_xep);
				else if ( pos2 != -1)
					url = url.replace(/sap_xep=\d+/, "sap_xep="  + sap_xep);
				else url = url + "&sap_xep="  + sap_xep;
			}
			else if ( pos3 == -1) 
			{
				url = url + "?sap_xep="  + sap_xep;
				
			}
			  
		  $(location).attr('search',url);
	  });
	  
	  // image gallery
	  $("#thumbs #1").css("border", "1px solid red");
		$("#slider #1").show();

		var x = 1;
		var y = $(".large").size();
		
		$(".thumb").click(function(){
			$("#slider #" + x).hide();
			$("#thumbs #" + x).css("border", "0px");
			x = + $(this).attr("id");
			if ( ( x !=5 & x != 6 ) | ( x == 6 & y <= 6 ) )
			{
				$(this).css("border", "1px solid red");
				$("#slider #" + x).show();
			}
			else if ( x == 6 & y > 6 )
			{
				$("#thumbs #1").hide();
				$("#thumbs #2").hide();
				$("#thumbs #3").hide();
				$("#thumbs #4").hide();
				$(this).css("border", "1px solid red");
				$("#slider #" + x).show();
			}
			else if ( x == 5 )
			{
				$("#thumbs #1").show();
				$("#thumbs #2").show();
				$("#thumbs #3").show();
				$("#thumbs #4").show();
				$(this).css("border", "1px solid red");
				$("#slider #" + x).show();
			}
		});
		

		
		$("#next").click(function(){
			if (x < y) {
				z = x + 1;
				if ( x == 5 & y > 6 )
				{	
					$("#thumbs #1").hide();
					$("#thumbs #2").hide();
					$("#thumbs #3").hide();
					$("#thumbs #4").hide();
				}
				$("#thumbs #" + x).css("border", "0px");	
				$("#slider #" + x).hide();
				$("#thumbs #" + z).css("border", "1px solid red");	
				$("#slider #" + z).show();	
				x++;
				
			}
			else {
				if ( y > 6)
				{
					for (var i = 7; i <= y ; i++)
					{
						$("#thumbs #" + i).hide();
					}
					$("#thumbs #1").show();
					$("#thumbs #2").show();
					$("#thumbs #3").show();
					$("#thumbs #4").show();
					
				}
				$("#thumbs #" + x).css("border", "0px");
				$("#slider #" + x).hide();
				$("#thumbs #" + 1).css("border", "1px solid red");
				$("#slider #" + 1).show();	
				x = 1;
				for (var i = 7; i <= y ; i++)
				{
					$("#thumbs #" + i).show();
				}
			}
			
		});
		
		$("#prev").click(function(){
			if (x > 1) {
				z = x - 1;
				if ( x == 6 ){
					$("#thumbs #1").show();
					$("#thumbs #2").show();
					$("#thumbs #3").show();
					$("#thumbs #4").show();
				}
				$("#thumbs #" + x).css("border", "0px");	
				$("#slider #" + x).hide();
				$("#thumbs #" + z).css("border", "1px solid red");	
				$("#slider #" + z).show();	
				x--;
			}
			else {
				if ( y > 6)
				{
					$("#thumbs #1").hide();
					$("#thumbs #2").hide();
					$("#thumbs #3").hide();
					$("#thumbs #4").hide();
					
				}
			
				$("#thumbs #" + x).css("border", "0px");
				$("#slider #" + x).hide();
				$("#thumbs #" + y).css("border", "1px solid red");
				$("#slider #" + y).show();	
				x = y;
			}
			
		});
		
		
});

function submit(){
	if ( !check_input() ) return false;
	

	
	$("input").each(function() {

  	    if ( $(this).attr("name") == "tu_khoa" ) {
  	    	if ( $(this).val() == "" )
  	    		$(this).attr('disabled', 'disabled');
		
  	    }
  	    else if ( $(this).attr("class") == "gia" | $(this).attr("class") == "dt" ){
  	    	if ( $(this).val() == "thấp nhất" | $(this).val() == "cao nhất" )
  	    		$(this).attr('disabled', 'disabled');
  	    }
  	    else if ( $(this).attr("name") == "vi_tri" | $(this).attr("name") == "huong" | $(this).attr("name") == "phap_ly" |
  	  	  		  $(this).attr("name") == "nhu_cau" ){
  	    	if ( $(this).val() == "0")
				$(this).attr('disabled', 'disabled');
		}
  	    else if ( $(this).attr("name") == "kieu_bds" ){
  	    	if ( $("#select_loai_bds").val() == "0" | $("#select_loai_bds").val() == "10" | $(this).val() == "0")
  	    	{
  	    		$(this).attr('disabled', 'disabled');
  	    	}
  	    	
  	    }
  	    else if ( $(this).attr("name") == "phuong_xa" ) {
  	    	if ( $("#select_quan_huyen").val() == "0" | $(this).val() == "0")
  	    	{
  	    		$(this).attr('disabled', 'disabled');
  	    	}
  	    }
		//hidden inputs 
  	    else if ($(this).attr("name") == "ngangt" | $(this).attr("name") == "ngangc" |
  	  	  		$(this).attr("name") == "doct" | $(this).attr("name") == "docc" | $(this).attr("name") == "nohaut" | $(this).attr("name") == "nohauc" ) {
  	    	if ( $(this).val() == "từ" | $(this).val() == "đến" )
				$(this).attr('disabled', 'disabled');
  	    }
  	    else if ( $(this).attr("name") == "tangt" | $(this).attr("name") == "tangc" | $(this).attr("name") == "phongt" | $(this).attr("name") == "phongc" )
	    {
	    	if ( $("#select_loai_bds").val() == "0" | $("#select_loai_bds").val() == "4" | $("#select_loai_bds").val() == "6" | $("#select_loai_bds").val() == "10" |
	    			$(this).val() == "từ" | $(this).val() == "đến" ) 
	    	{
	    		$(this).attr('disabled', 'disabled');
	    	}
	    	
	   	}
  	    //dimensions
  	    else if ($(this).attr("class") == "ngang" | $(this).attr("class") == "doc" | $(this).attr("class") == "nohau" |
  	  	    	 $(this).attr("class") == "tang" | $(this).attr("class") == "phong") {
  	    	if ( $(this).val() == "từ" | $(this).val() == "đến" )
  	    	{
	  	    	$("#h" + $(this).attr("id")).attr('disabled', 'disabled');
  	    	}
  	    	
  	    	else {
	  	    	var x = "#h" + $(this).attr("id");
	  	    	$(x).removeAttr("disabled"); //hidden inputs were disabled before this code
	  	    	$(x).val($(this).val());
  	    	}
  	    }
  	    else if ($(this).attr("name") == "hien_thi")
  	    {
  	    	if ( $(this).val() == "20" )
  	    		$(this).attr('disabled', 'disabled');
  	    }
  	    else if ($(this).attr("name") == "sap_xep")
	    {
	    	if ( $(this).val() == "1" )
	    		$(this).attr('disabled', 'disabled');
	    }
   
	});
	
	
		$("select").each(function() {
	    
	  		if ($(this).val() == "0" ) 
	  			$(this).attr('disabled', 'disabled');
	   
		});
	return true;
}

function check_input(){
	
	
		var giat = $("#input_giat").val();
		var giac = $("#input_giac").val();
		var dtt =  $("#input_dtt").val();
		var dtc =  $("#input_dtc").val();
		var ngangt =  $("#input_ngangt");
		var ngangc =  $("#input_ngangc");
		var doct =  $("#input_doct");
		var docc =  $("#input_docc");
		var nohaut =  $("#input_nohaut");
		var nohauc =  $("#input_nohauc");		
		var tangt =  $("#input_tangt");
		var tangc =  $("#input_tangc");
		var phongt =  $("#input_phongt");
		var phongc =  $("#input_phongc");
	if ( ( isNaN(giat) & giat != "thấp nhất" ) | ( isNaN(giac) & giac != "cao nhất" ) )
	{
		alert("Giá phải là kiểu số");
		return false;
	}
	if ( parseFloat(giat) > parseFloat(giac) )
	{
		alert("Giá thấp nhất phải nhỏ hơn hoặc bằng giá cao nhất");
		return false;
	}
	if ( ( isNaN(dtt) & dtt != "thấp nhất" ) | ( isNaN(dtc) & dtc != "cao nhất" ) )
	{
		alert("Diện tích phải là kiểu số");
		return false;
	}
	if (parseFloat(dtt) > parseFloat(dtc))
	{
		alert("Diện tích thấp nhất phải nhỏ hơn hoặc bằng diện tích cao nhất");
		return false;
	}
	if ( ngangt.length != 0 & ngangc.length != 0 )
	{
		var x = ngangt.val(), y = ngangc.val();
		if ( ( isNaN(x) & x != "từ" ) | ( isNaN(y) & y != "đến" ) )
		{
			alert("Chiều ngang phải là kiểu số");
			return false;
		}
		if (parseFloat(x) > parseFloat(y))
		{
			alert("Chiều ngang từ phải nhỏ hơn hoặc bằng chiều ngang đến");
			return false;
		}
	}
	if ( doct.length != 0 & docc.length != 0 )
	{
		var x = doct.val(), y = docc.val();
		if ( ( isNaN(x) & x != "từ" ) | ( isNaN(y) & y != "đến" ) )
		{
			alert("Chiều dọc phải là kiểu số");
			return false;
		}
		if (parseFloat(x) > parseFloat(y))
		{
			alert("Chiều dọc từ phải nhỏ hơn hoặc bằng chiều dọc đến");
			return false;
		}
	}
	if ( nohaut.length != 0 & nohauc.length != 0 )
	{
		var x = nohaut.val(), y = nohauc.val();
		if ( ( isNaN(x) & x != "từ" ) | ( isNaN(y) & y != "đến" ) )
		{
			alert("Nở hậu phải là kiểu số");
			return false;
		}
		if (parseFloat(x) > parseFloat(y))
		{
			alert("Nở hậu từ phải nhỏ hơn hoặc bằng nở hậu đến");
			return false;
		}
	}
	if ( tangt.length != 0 & tangc.length != 0 )
	{
		var x = tangt.val(), y = tangc.val();
		if ( ( isNaN(x) & x != "từ" ) | ( isNaN(y) & y != "đến" ) )
		{
			alert("Số tầng phải là kiểu số");
			return false;
		}
		if ( parseFloat(x) > parseFloat(y) )
		{
			alert("Số tầng từ phải nhỏ hơn hoặc bằng số tầng đến");
			return false;
		}
		
	}
	if ( phongt.length != 0 & phongc.length != 0 )
	{
		var x = phongt.val(), y = phongc.val();
		if ( ( isNaN(x) & x != "từ" ) | ( isNaN(y) & y != "đến" ) )
		{
			alert("Số phòng ngủ phải là kiểu số");
			return false;
		}
		if ( parseFloat(x) > parseFloat(y) )
		{
			alert("Số phòng ngủ từ phải nhỏ hơn hoặc bằng số phòng ngủ đến");
			return false;
		}
		
	}
	
	return true;

}

function display_price(value,span)
{
			
		if(!isNaN(value))
		{
			if ((y = value/1000) >= 1 )
			{
				span.text( y + " tỷ");
				span.show();
			}
			else
			{
				span.text(value + " triệu");	
				span.show();
			}
		}
		else
		{
			span.text("Vui lòng nhập số");
			span.show();
		}

}

function display_area(value,span)
{
	
	if(!isNaN(value))
	{
		
		if ((y = value/10000) >= 1 ) {
			span.text(y + " ha");	
			span.show();
		}
		else {
			span.text(value + " m2");
			span.show();
		}
	}
	else
	{
		span.text("Vui lòng nhập số");
		span.show();
	}

}

function display_dimension(value,span)
{
	
	if(!isNaN(value))
	{
		span.text(value + " m");
		span.show();
	}
	else
	{
		span.text("Vui lòng nhập số");
		span.show();
	}

}
function display_floor(value, span)
{
	var intRegex = /^\d+$/;
	
	if(intRegex.test(value))
	{
		span.text(value + " tầng");
		span.show();
	}
	else
	{
		span.text("Vui lòng nhập số nguyên");
		span.show();
	}
	
}
function display_room(value, span){

	var intRegex = /^\d+$/;
			
	if(intRegex.test(value))
	{
		span.text(value + " phòng");
		span.show();
	}
	else
	{
		span.text("Vui lòng nhập số nguyên");
		span.show();
	}

}



function blur(input, value, span)
{	
	
	if( input.val() == "" ) 
	{ 
		input.css("color", "#808080");
		input.val(value);
		span.hide();
	}
	
}
function focus(input, value)
{
	
		if( input.val() == value) input.val("");
		input.css("color", "#000000");
		
}


function show_re_type(bds_id) 
{
	
		if (bds_id == "0" | bds_id == "10")
		{
			$("#div_kieu_bds").empty();
			$("#div_tang_phong").empty();
			$("#input_kieu_bds").val("0");
			$("#hinput_tangt").val("từ");
			$("#hinput_tangc").val("đến");
			$("#hinput_phongt").val("từ");
			$("#hinput_phongc").val("đến");
		}
		else if (bds_id == "1")
		{
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại nhà</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='1' href=\"javascript:void(0)\">Nhà ở</a><br/>" +
			"<a class='link_kieu_bds' id='2' href=\"javascript:void(0)\">Căn hộ, chung cư</a><br/>" +
			"<a class='link_kieu_bds' id='3' href=\"javascript:void(0)\">Biệt thự</a><br/>" +
			"<a class='link_kieu_bds' id='4' href=\"javascript:void(0)\">Loại nhà khác</a></div>";
			$("#div_kieu_bds").append(e);
			
			
		}
		else if (bds_id == 2){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại tòa nhà, cao ốc</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='5' href=\"javascript:void(0)\">Văn phòng</a><br/>" +
			"<a class='link_kieu_bds' id='6' href=\"javascript:void(0)\">Thương mại</a><br/>" +
			"<a class='link_kieu_bds' id='7' href=\"javascript:void(0)\">Dịch vụ</a><br/>" +
			"<a class='link_kieu_bds' id='8' href=\"javascript:void(0)\">Loại khác</a></div>";
			$("#div_kieu_bds").append(e);
		}
		else if (bds_id == 3){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại khách sạn</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='9' href=\"javascript:void(0)\">1 sao</a><br/>" +
			"<a class='link_kieu_bds' id='10' href=\"javascript:void(0)\">2 sao</a><br/>" +
			"<a class='link_kieu_bds' id='11' href=\"javascript:void(0)\">3 sao</a><br/>" +
			"<a class='link_kieu_bds' id='12' href=\"javascript:void(0)\">4 sao</a><br/>" +
			"<a class='link_kieu_bds' id='13' href=\"javascript:void(0)\">5 sao</a><br/>" +
			"<a class='link_kieu_bds' id='14' href=\"javascript:void(0)\">Loại khác</a></div>";
			
			$("#div_kieu_bds").append(e);
		}
		else if (bds_id == 4){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại đất</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='15' href=\"javascript:void(0)\">Đất ở</a><br/>" +
			"<a class='link_kieu_bds' id='16' href=\"javascript:void(0)\">Đất nền dự án</a><br/>" +
			"<a class='link_kieu_bds' id='17' href=\"javascript:void(0)\">Đất sản xuất</a><br/>" +
			"<a class='link_kieu_bds' id='18' href=\"javascript:void(0)\">Loại đất khác</a></div>";
			
			$("#div_kieu_bds").append(e);
			$("#div_tang_phong").empty();
			$("#hinput_tangt").val("từ");
			$("#hinput_tangc").val("đến");
			$("#hinput_phongt").val("từ");
			$("#hinput_phongc").val("đến");
		}
		else if (bds_id == 5){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại văn phòng</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='19' href=\"javascript:void(0)\">Tòa nhà, cao ốc</a><br/>" +
			"<a class='link_kieu_bds' id='20' href=\"javascript:void(0)\">Căn hộ, nhà ở</a><br/>" +
			"<a class='link_kieu_bds' id='21' href=\"javascript:void(0)\">Loại khác</a></div>";
			
			$("#div_kieu_bds").append(e);
		}
		else if (bds_id == 6){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại phòng</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='22' href=\"javascript:void(0)\">Phòng khách sạn</a><br/>" +
			"<a class='link_kieu_bds' id='23' href=\"javascript:void(0)\">Phòng trọ ở riêng</a><br/>" +
			"<a class='link_kieu_bds' id='24' href=\"javascript:void(0)\">Phòng trọ chung chủ</a><br/>" +
			"<a class='link_kieu_bds' id='25' href=\"javascript:void(0)\">Loại phòng khác</a></div>";
			
			$("#div_kieu_bds").append(e);
			$("#div_tang_phong").empty();
			$("#hinput_tangt").val("từ");
			$("#hinput_tangc").val("đến");
			$("#hinput_phongt").val("từ");
			$("#hinput_phongc").val("đến");
		}
		else if (bds_id == 7){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại cửa hàng</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='26' href=\"javascript:void(0)\">Nhà hàng, quán ăn</a><br/>" +
			"<a class='link_kieu_bds' id='27' href=\"javascript:void(0)\">Cà phê, giải khát</a><br/>" +
			"<a class='link_kieu_bds' id='28' href=\"javascript:void(0)\">Điện máy</a><br/>" +
			"<a class='link_kieu_bds' id='29' href=\"javascript:void(0)\">Thời trang, mỹ phẩm</a><br/>" +		
			"<a class='link_kieu_bds' id='30' href=\"javascript:void(0)\">Tạp hóa, bán lẽ</a><br/>" +
			"<a class='link_kieu_bds' id='31' href=\"javascript:void(0)\">Kiot, sạp</a><br/>" +
			"<a class='link_kieu_bds' id='32' href=\"javascript:void(0)\">Loại khác</a></div>";
			$("#div_kieu_bds").append(e);
		}
		else if (bds_id == 8){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại khu</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='33' href=\"javascript:void(0)\">Khu du lịch</a><br/>" +
			"<a class='link_kieu_bds' id='34' href=\"javascript:void(0)\">Khu nghỉ dưỡng</a><br/>" +
			"<a class='link_kieu_bds' id='35' href=\"javascript:void(0)\">Resort</a><br/>" +
			"<a class='link_kieu_bds' id='36' href=\"javascript:void(0)\">Sân golf</a><br/>" +
			"<a class='link_kieu_bds' id='37' href=\"javascript:void(0)\">Loại khác</a></div>";
			$("#div_kieu_bds").append(e);
		}
		else if (bds_id == 9){
			$("#div_kieu_bds").empty();
			$("#input_kieu_bds").val("0");
			var e = "<div class='selected'>Loại kho xưởng</div><div class='menu_group'>" +
			"<span class='selected'>Tất cả</span><br/>" +
			"<a class='link_kieu_bds' id='38' href=\"javascript:void(0)\">Kho</a><br/>" +
			"<a class='link_kieu_bds' id='39' href=\"javascript:void(0)\">Xưởng</a><br/>" +
			"<a class='link_kieu_bds' id='40' href=\"javascript:void(0)\">Loại khác</a></div>";
			$("#div_kieu_bds").append(e);
		}
		$(".link_kieu_bds").click(function(){
			$("#input_kieu_bds").val($(this).attr("id"));
			$("#main_form").submit();
		});
		if (bds_id != 0 & bds_id != 4 & bds_id != 6 & bds_id != 10 )
		{
			var x = $.trim( $("#div_tang_phong").html() ).length;
			if (x == 0) {
				var e1 = "<div class='selected'>Số tầng / lầu:</div><div class='menu_group'>" +
						"<table id='table_tang'><tr>" +
						"<td><input class='tang' id='input_tangt' size='5' maxlength='5' value='từ' /></td>" +
						"<td><input class='tang' id='input_tangc' size='5' maxlength='5' value='đến' /></td>" +
						"<td><a class='img_submit' href='javascript:void(0)'>" + 
						"<img src='images/arrow.gif' height='15px' width='15px' /></a></td></tr>" +
						"<tr><td><span id='span_tangt'></span></td><td><span id='span_tangc'></span></td></tr></div>";
				
				var e2 = "<div class='selected'>Số phòng ngủ:</div><div class='menu_group'>" +
						"<table id='table_phong'><tr>" +
						"<td><input class='phong' id='input_phongt' size='5' maxlength='5' value='từ' /></td>" +
						"<td><input class='phong' id='input_phongc' size='5' maxlength='5' value='đến' /></td>" +
						"<td><a class='img_submit' href='javascript:void(0)'>" + 
						"<img src='images/arrow.gif' height='15px' width='15px' /></a></td></tr>" +
						"<tr><td><span id='span_phongt'></span></td><td><span id='span_phongc'></span></td></tr></div>";
				
				$("#div_tang_phong").append(e1);
				$("#div_tang_phong").append(e2);
				
				$(".img_submit").click(function(){
					$("#main_form").submit();
				});
				
				 $("#input_tangt").blur( function(){
					  blur( $(this), "từ", $("#span_tangt"));
				  });
				  $("#input_tangt").focus( function(){
					  focus( $(this), "từ");
				  });
				  $("#input_tangt").keyup( function(){
					  display_floor( $(this).val(), $("#span_tangt"));
				  });
				
				  $("#input_tangc").blur( function(){
					  blur( $(this), "đến", $("#span_tangc"));
				  });
				  $("#input_tangc").focus( function(){
					  focus( $(this), "đến");
				  });
				  $("#input_tangc").keyup( function(){
					  display_floor( $(this).val(), $("#span_tangc"));
				  });
				  
				  $("#input_phongt").blur( function(){
					  blur( $(this), "từ", $("#span_phongt"));
				  });
				  $("#input_phongt").focus( function(){
					  focus( $(this), "từ");
				  });
				  $("#input_phongt").keyup( function(){
					  display_room( $(this).val(), $("#span_phongt"));
				  });
				  
				  $("#input_phongc").blur( function(){
					  blur( $(this), "đến", $("#span_phongc"));
				  });
				  $("#input_phongc").focus( function(){
					  focus( $(this), "đến");
				  });
				  $("#input_phongc").keyup( function(){
					  display_room( $(this).val(), $("#span_phongc"));
				  });
				  
				$("#hinput_tangt").val('từ');
				$("#hinput_tangc").val('đến');
				$("#hinput_phongt").val('từ');
				$("#hinput_phongc").val('đến');
			}
		}
		
}

/////////////////////////////////////
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

function show_district(tt_id)
{
	if (tt_id == "0")
	{
		$("#div_phuong_xa").empty();
		$("#input_phuong_xa").val("0");
		$("#select_quan_huyen").empty();
		$("#select_quan_huyen").append("<option value='0'>Tất cả quận huyện</option>");
		return;
	}
    else
    {	
    	sendRequest(tt_id,"tt.php",function() 
    	{
    		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			$("#select_quan_huyen").empty();
    			$("#div_phuong_xa").empty();
    			$("#input_phuong_xa").val("0");
    			$("#select_quan_huyen").append("<option value='0'>Tất cả quận huyện</option>" + xmlhttp.responseText);
    		}
    	});
    }
}

function show_ward(qh_id) 
{
	if (qh_id == "0") {
		$("#div_phuong_xa").empty();
		$("#input_phuong_xa").val("0");
		return;
	}
	else {
		sendRequest(qh_id,"px.php",function(){
			$("#div_phuong_xa").empty();
			$("#input_phuong_xa").val("0");
			$("#div_phuong_xa").append("<div class='selected'>Phường xã:</div><div class='menu_group'><span class='selected'>Tất cả</span><br/>" + xmlhttp.responseText + "</div>");
			$(".link_px").click(function(){
				$("#input_phuong_xa").val($(this).attr("id"));
				$("#main_form").submit();
			});
		});		 		
	}
}
