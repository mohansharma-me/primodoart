<?php
$id=filter_input(INPUT_POST,"id");
?>
<script>
$("#frmDeleteService").submit(function() {
	var t=$(this);
	var l=$(t).find(".loader");
	
	if(!confirm("Are you sure to step ahead ?")) return false;
		
	$(".loader").html('<img src="/images/loading.gif" />');
	
	$.ajax({
		url:"/cpu",
		data: {
			job:"service",
			action:"delete"
			<?php
			if(isset($id)) {
				?>
				,id:"<?=$id?>",sure:"yes"
				<?php
			}
			?>
		},
		type:"post",
		success:function(data) {
			try {
				var js=$.parseJSON(data);
				if(js.success) {
					alert("Successfully deleted!");
					$(".ui-dialog-content").dialog("close");
				} else {
					if(js.error) {
						alert(js.error);
					}
					$(l).html('<font color="red">Not Deleted.</font>');					
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
<form id="frmDeleteService" class="myform" action="javascript:void">
	<center>
	<font color="red" style="color:red!important">
    	<b><h3>Are you sure to delete following service permanently ?</h3>
        <h4>This will also delete all its uploaded portfolio.</h4></b>
        <blockquote style="line-height:1em">
        	<b>Service Title:</b> <?=$title?><br/>
           	<b>Service Description:</b> <?=$desc?><br/>
        </blockquote>
    </font>
    </center>
    <br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Yes" /></div>
		<div class="6u loader"></div>
	</div>
</form>