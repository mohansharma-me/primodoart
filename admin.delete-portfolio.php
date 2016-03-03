<?php
$id=filter_input(INPUT_POST,"id");
?>
<script>
$("#frmDeletePortfolio").submit(function() {
	var t=$(this);
	var l=$(t).find(".loader");
	
	if(!confirm("Are you sure to step ahead ?")) return false;
		
	$(".loader").html('<img src="/images/loading.gif" />');
	
	$.ajax({
		url:"/cpu",
		data: {
			job:"portfolio",
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
$tags="";
$service=0;
if(isset($id)) {
	$id=addslashes($id);
	$res=exeData("select * from portfolios where portfolio_id=$id");
	if(is_resource($res) && mysql_affected_rows()==1) {
		$row=mysql_fetch_assoc($res);
		$title=$row["portfolio_title"];
		$desc=$row["portfolio_desc"];
		$tags=$row["portfolio_tags"];
		$service=$row["portfolio_service_id"];
	}
}
?>
<form id="frmDeletePortfolio" class="myform" action="javascript:void">
	<center>
	<font color="red" style="color:red!important">
    	<b><h3>Are you sure to delete following portfolio permanently ?</h3></b>
        <blockquote style="line-height:1em">
        	<b>Portfolio Title:</b> <?=$title?><br/>
           	<b>Portfolio Description:</b> <?=$desc?>, Tags:<?=$tags?><br/>
		<img src="/portfolio/<?=$id?>/thumb?ap=100" />
        </blockquote>
    </font>
    </center>
    <br/>
	<div class="row">
		<div class="6u"><input type="submit" value="Yes" /></div>
		<div class="6u loader"></div>
	</div>
</form>