<script>
$(document).ready(function() {
	$("#formContact").submit(function() {
		var t=$(this);
		var nm=$(t).find("input[name='name']");
		var em=$(t).find("input[name='email']");
		var msg=$(t).find("textarea[name='message']");
		if(nm.val().trim().length==0) {
			$(nm).focus();
			return false;
		}
		if(em.val().trim().length==0) {
			$(em).focus();
			return false;
		}
		if(msg.val().trim().length==0) {
			$(msg).focus();
			return false;
		}
		
		$.ajax({
			url:"/cpu",
			data:{
				job:"contact-me",
				nm:$(nm).val(),
				em:$(em).val(),
				msg:$(msg).val(),
			},
			type:"post",
			success:function(data) {
				try {
					var js=$.parseJSON(data);
					alert(js.error);
				} catch(e) {alert("Error while submitting request to server.");}
			},
			error:function(e) {
				alert(e);
			}
		});
		
		return false;
	});
});
</script>

