<?php
$heading="";
$formId="frmHomeHeading";
$placeholder="please enter here";
$value=jsondata($edit4);
$way="sv";
switch($edit4) {
	case "home-heading": 
		$heading="Upload file :-";
		break;
	case "about-image": case "header-image":
		$way="img";
		break;
	default: $heading="Change data to :- ";
}
?>
<script>
$("#<?=$formId?>").submit(function() {
	var t=$(this);
	var text=$(t).find("input[name='file']");
	var l=$(t).find(".loader");
	
	if($(text).prop("files").length==0)
	{
		$(l).html("<font color='red'>Select File*</font>");
		return;
	}

	var fd=new FormData();
	fd.append("file",$(text).prop("files")[0]);
	fd.append("job","edit");
	fd.append("id","<?=$edit4?>");
	fd.append("way","<?=$way?>");
	
	//if(text.trim().val().length==0)
	$(l).html('<img src="/images/loader.gif"/>');
	$.ajax({
		url:"/cpu",
		data: fd,
		type:"post",
		processData:false, contentType: false,
		success:function(d) {
			try {
				var js=$.parseJSON(d);
				if(js.success) {
					$(l).html('<font color="green">Saved.</font>');
				} else {
					$(l).html('<font color="red">Not saved.</font>');					
				}
			} catch(e) {
				alert("Ohh, unexpected error occured");
			}
		},
		error:function(e) {
			$(l).html('<font color="red">Please try again.</font>');
		}
	});
	//$(".ui-dialog-content").dialog("close");
});
</script>
<form id="<?=$formId?>" class="myform" action="javascript:void">
	<label><?=$heading?></label>
	<input type="file" name="file" />
	<br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Upload" /></div>
		<div class="6u loader"></div>
	</div>
</form>