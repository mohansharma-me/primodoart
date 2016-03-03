<?php
$id=filter_input(INPUT_POST,"id");
?>
<script>
$("#frmUploadPortfolio").submit(function() {
	var t=$(this);
	var title=$(t).find("input[name='title']");
	var tags=$(t).find("input[name='tags']");
	var desc=$(t).find("input[name='desc']");
	var file=$(t).find("input[name='file']");
	var service=$(t).find("select[name='service']");
	var l=$(t).find(".loader");

	if($(service).val().trim().length==0) {
		$(service).focus();
		return false;
	}
	
	if($(title).val().trim().length==0) {
		$(title).focus();
		return false;
	}
	
	if($(tags).val().trim().length==0) {
		$(tags).focus();
		return false;
	}
	
	if($(desc).val().trim().length==0) {
		$(desc).focus();
		return false;
	}
	<?php
	if(!isset($id)) {
	?>
	if($(file).prop("files").length==0) {
		$(file).focus();
		return false;
	}
	<?php
	}
	?>
	
	var fd=new FormData();
	fd.append("job","portfolio");
	fd.append("title",$(title).val());
	fd.append("tags",$(tags).val());
	fd.append("desc",$(desc).val());
	fd.append("service",$(service).val());
	fd.append("file",$(file).prop("files")[0]);
	<?php
	if(isset($id)) {
		?>
		fd.append("id","<?=$id?>");
		<?php
	}
	?>
	
	$(l).html('<img src="/images/loader.gif" />');
	
	$.ajax({
		url:"/cpu",
		type:"post",
		processData:false, contentType:false,
		data:fd,
		success:function(data) {
			var f=false;
			try {
				var js=$.parseJSON(data);
				f=js.success;
			} catch(e) {
				alert("Sorry, unexpected error occured."+data);
			}
			if(f) {
				$(l).html('<font color="green">Uploaded</font>');
			} else {
				$(l).html('<font color="red">Not uploaded!</font>');
			}
		},
		error:function(data) {
			alert("Unexpected error occured, please try again.");
			$(l).html("");
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
<form id="frmUploadPortfolio" class="myform" action="javascript:void">
	<label>Service: <select name="service">
		<?php
		$res=exeData("select service_id, service_title from services");
		$nos=mysql_affected_rows();
		if($nos>0) {
			while($row=mysql_fetch_assoc($res)) {
				if($service!=0 && $service==$row["service_id"])
					echo "<option value='".$row["service_id"]."' selected>".$row["service_title"]."</option>";
				else
					echo "<option value='".$row["service_id"]."'>".$row["service_title"]."</option>";
			}
		}
		?>
	</select></label>
	<?php
	if($nos>0) {
	?>
	<label>Portfolio Title :- <input type="text" name="title" placeholder="Title of portfolio" value="<?=$title?>" /></label>
	<label>Tags :- <input type="text" name="tags" placeholder="portfolio tags separated by comma" value="<?=$tags?>" /></label>
	<label>Portfolio Description :- <input type="text" name="desc" placeholder="Portfolio description" value="<?=$desc?>"/></label>
	<label>Portfolio Image :- <input type="file" name="file" /> </label>
	<br/><div class="row">
		<div class="6u"><input type="submit" value="Upload" /></div>
		<div class="6u loader"></div>
	</div>
	<?php
	} else {
		echo "Please add new service first, than and than you can upload portfolios.";
	}
	?>
</form>