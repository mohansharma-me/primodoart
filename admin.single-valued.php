<?php
$heading="";
$formId="frmHomeHeading";
$placeholder="please enter here";
$value=jsondata($edit4);
switch($edit4) {
	case "home-heading": $heading="Change welcome heading";
	
	break;
	default: $heading="Change data to :- ";
}
?>
<script>
$("#<?=$formId?>").submit(function() {
	var t=$(this);
	var text=$(t).find("textarea[name='txtvalue']");
	var l=$(t).find(".loader");
	//if(text.trim().val().length==0)
	$(l).html('<img src="/images/loader.gif"/>');
	$.ajax({
		url:"/cpu",
		data: {job:"edit", id:"<?=$edit4?>",data:text.val(),way:"sv"},
		type:"post",
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
	<textarea style="color:black" name="txtvalue" placeholder="<?=$placeholder?>"><?=$value?></textarea><br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Save" /></div>
		<div class="6u loader"></div>
	</div>
</form>