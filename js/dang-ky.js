

	$(document).ready(function(){
		$("#button_xoa").click(function(){
			
			$("input").each(function(){
			
					$(this).val("");
			});
			
			$("span.red").each(function(){
				$(this).text("");
			});
			
		});
				
	});


