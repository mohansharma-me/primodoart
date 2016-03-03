<!doctype html>
<html>
<head>
	<meta name="description" content="Primodo Art"/>
	<meta name="keywords" content="primodo art, design, art work, job work" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:title" content="Primodo Art"/>
	<meta property="og:description" content="primodo art, design, art work, job work"/>
	<meta property="og:url" content="http://www.primodoart.com"/>
	<meta property="og:image" content="http://www.primodoart.com/images/header-logo.jpg"/>

	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="/css/mystyle.css" rel="stylesheet" media="screen">
	<link href="/css/particle-animation.css" media="screen" rel="stylesheet" /> 
	<title>Primodo Art</title>
</head>
<body>
	<div class="contentHolder" id="preLoader">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="content">
						<img src="/images/loader.gif" />
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="mainContent"></div>
</body>
<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
	$.startAnimation=function() {
		setTimeout(function() {
			$(".bubble").fadeIn(500,function() {
				$(".logo-circle").animate({opacity:"1"},1000,function() {
					$(".bubble").fadeOut(300,function() {
						$(".logo-circle").animate({
							
						},1000,function() {
							
						});
					});
				});
			});
		},1000);
	};
	
	$.ajax({
		url:"/content.animation.html",
		success:function(data) {
			var img=new Image();
			img.src="/images/logo1.png";
			$(img).load(function() {
				$("#preLoader .content").fadeOut(500,function() {
					$("#preLoader").hide();
					$("#mainContent").html(data);
					$.startAnimation();
				});
			});
		},
		error:function(e) {
			$("#preLoader .content img").fadeOut(300,function() {
				$("#preLoader .content").append('<div><h3>Problem in Internet Connection!!</h3><br/><a href="/" class="btn">Retry</a></div>');
			});
		}
	});
});
</script>
</html>