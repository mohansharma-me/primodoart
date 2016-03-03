<?php
$id=filter_input(INPUT_POST,"id");
?>
<script>
$("#frmNewService").submit(function() {
	var t=$(this);
	var title=$(t).find("input[name='title']");
	var desc=$(t).find("textarea[name='desc']");
	var l=$(t).find(".loader");
	if($(title).val().trim().length==0) {
		$(title).focus();
		return false;
	}
	
	if($(desc).val().trim().length==0) {
		$(desc).focus();
		return false;
	}
	
	$(".loader").html('<img src="/images/loading.gif" />');
	
	$.ajax({
		url:"/cpu",
		data: {
			job:"service",
			title:$(title).val(),
			desc:$(desc).val()
			<?php
			if(isset($id)) {
				?>
				,id:"<?=$id?>"
				<?php
			}
			?>
		},
		type:"post",
		success:function(data) {
			try {
				var js=$.parseJSON(data);
				if(js.success) {
					$(l).html('<font color="green">Saved.</font>');					
				} else {
					if(js.error) {
						alert(js.error);
					}
					$(l).html('<font color="red">Not Saved.</font>');					
				}
			} catch(e) {
				alert("Unknown error occured, please try again.");
			} finally {

			}
		},
		error:function(e) {
			alert("Sorry, unexpected error occured, its may due to slow Internet Connection.");
		}
	});
		
	return false;
});
</script>
<?php
$title="";
$desc="";
if(isset($id)) {
	$id=addslashes($id);
	$res=exeData("select * from services where service_id=$id");
	if(is_resource($res) && mysql_affected_rows()==1) {
		$row=mysql_fetch_assoc($res);
		$title=$row["service_title"];
		$desc=$row["service_desc"];
	}
}
?>
<form id="frmNewService" class="myform" action="javascript:void">
	<label>Service Title :-</label>
	<input type="text" name="title" placeholder="Name of Service" value="<?=$title?>" />
    <label>About Service :-</label>
	<textarea name="desc" placeholder="Service description"><?=$desc?></textarea>
    <br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Save" /></div>
		<div class="6u loader"></div>
	</div>
</form>