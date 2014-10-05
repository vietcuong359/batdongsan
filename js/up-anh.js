function upload(files){
	
	var frm = files.form;
	
	var num_files = + files.files.length;
	
	var div_images = $(".div_image");
	var num_divs = + div_images.length;
	
	if ( num_files + num_divs > 10 ) 
	{
		alert("Chỉ được upload tối đa 10 ảnh");
		return;
	}
	var max = div_images.eq(num_divs - 1).attr("id");
	if ( max == null )
		id_max = 0;
	else id_max = + max;

	

	// add image progress
	var images = $('#images_container');
	
	for ( var id = id_max + 1 ; id < id_max + 1 + num_files ; id++ )
	{
		var new_div = $("<div class='div_image' id='" + id + "'></div>");
		var new_img = $("<img class='upload' src='images/indicator2.gif' id='" + id + "' ></img>");
		var new_del = $("<a class='link_xoa' href='javascript:void(0)' onclick=\"remove_image('" + id + "')\">xóa</a>");
		new_div.append(new_img);
		new_div.append(new_del);
		images.append(new_div);
		
	}
	// clear error message
	$("#error").empty();
	// send
	frm.id_max.value = id_max;
	
	setTimeout(frm.submit(),60000);

}
//Call when upload completed
function setUploadedImage(imgSrc, fileName, divId)
{
	
	var div = $("div #" + divId);
	div.empty();
	var uploaded_img = $("<img class='upload' src='" + imgSrc + "' alt='" + fileName + "'></img>");
	var new_del = $("<a class='xoa_anh' href='javascript:void(0)' onclick=\"remove_image('" + divId + "')\">xóa</a>");
	div.append(uploaded_img);
	div.append(new_del);

}
function uploadError(divId, err)
{
	
	$("div #" + divId).remove();
	$("#error").append("<p>" + err + "</p>");

}
function unknownError(){
	
	$("#error").append("<p>Có lỗi trong quá trình xử lý!</p>");
	
}

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

function remove_image(id)
{
	
	sendRequest(id,"xoa-anh.php",function() 
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			 $("div #" + id).remove();
		}
	});
}



var xmlhttp2;
function sendRequest2(id,ma_tin,url,func)
{
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp2=new XMLHttpRequest();
}
else
  {// code for IE6, IE5
  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp2.onreadystatechange=func;
xmlhttp2.open("GET",url+"?q="+id + "&ma_tin=" + ma_tin,true);
xmlhttp2.send();
}

function remove_image2(id, ma_tin)
{
	
	sendRequest2(id, ma_tin, "xoa-anh2.php",function() 
	{
		if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
		{
			 $("div #" + id).remove();
		}
	});
}