<?php
$id=filter_input(INPUT_POST,"id");
?>
<script>
$("#frmNewClient").submit(function() {
	var t=$(this);
	var file=$(t).find("input[name='file']");
	var l=$(t).find(".loader");
	
	if($(file).prop("files").length==0) {
		$(file).focus();
		return false;
	}
	
	$(l).html('<img src="/images/loader.gif" />');
	
	var fd=new FormData();
	fd.append("job","clients");
	fd.append("file",$(file).prop("files")[0]);
	
	$.ajax({
		url:"/cpu",
		data:fd,
		type:"post",
		processData:false, contentType:false,
		success:function(data) {
			try {
				var js=$.parseJSON(data);
				if(js.success) {
					$(l).html('<font color="green">Uploaded!</font>');
				} else {
					$(l).html('<font color="red">Not uploaded!</font>');
				}
			} catch(e) {
				alert("Sorry, unexpected error occured.");
			}
		},
		error:function(e) {
			alert("Unexpected error occured, please try again.");
		}
	});
		
	return false;
});
</script>
<form id="frmNewClient" class="myform" action="javascript:void">
	<label>Select logo image:- <input type="file" name="file" /></label>
	<br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Upload" /></div>
		<div class="6u loader"></div>
	</div>
</form>