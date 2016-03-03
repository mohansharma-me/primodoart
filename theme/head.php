<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
$_desc="";
$_title="";
if(isset($service) && is_array($service)) {
	$link="http://www.primodoart.com";
	$image="http://www.primodoart.com/images/header-logo.jpg";//portfolio/".$service["portfolio_id"]."/thumb?ap=200";
	$pdesc="";
	$ptitle="";
	if(isset($service["portfolio_id"])) {
		$pdesc=$service["portfolio_title"].", ".$service["portfolio_desc"]." , ";
		$ptitle=$service["portfolio_title"]." - ";
		$link="http://www.primodoart.com/";
		$image="http://www.primodoart.com/portfolio/".$service["portfolio_id"]."/thumb?ap=200";
	}
	$_desc=$pdesc.$service["service_title"].", ".$service["service_desc"]." - ";
	$_title=$ptitle.$service["service_title"]." - ";
}
?>
<meta name="description" content="<?=$_desc?>Jayesh Rajani @primodoart, all kinds of designing and printing works, brochure, logo designs, bill book, flex banners, leaflet, catalogue, symbol designing, letterhead, invitation cards, branding, pamphlet, bag, envelope, greeting cards, website designs, file and box designing"/>
<meta name="keywords" content="primodo art, design, art work, job work,brochure, logo designs, bill book, flex banners, leaflet, catalogue, symbol designing, letterhead, invitation cards, branding, pamphlet, bag, envelope, greeting cards, website designs, file and box designing" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta property="og:title" content="<?=$_title?>Primodo Art"/>
<meta property="og:description" content="<?=$_desc?>Jayesh Rajani @primodoart, all kinds of designing and printing works, brochure, logo designs, bill book, flex banners, leaflet, catalogue, symbol designing, letterhead, invitation cards, branding, pamphlet, bag, envelope, greeting cards, website designs, file and box designing"/>
<meta property="og:url" content="<?=$link?>" />
<meta property="og:image" content="<?=$image?>" />


<!--[if lte IE 8]><script src="/css/ie/html5shiv.js"></script><![endif]-->
<script src="/js/jquery.js"></script>
<script src="/js/jquery.ui.min.js"></script>
<script src="/js/jquery.scrolly.min.js"></script>
<script src="/js/jquery.scrollzer.min.js"></script>
<script src="/js/skel.min.js"></script>
<script src="/js/skel-layers.min.js"></script>
<script src="/js/init.js"></script>


<?php
if(isAdminAuthed()) {
	?>
<script src="/js/admin.js"></script>
<?php
}
?>

<noscript>	
	<link rel="stylesheet" href="/css/skel.css" />
	<link rel="stylesheet" href="/css/style.css" />
	<link rel="stylesheet" href="/css/style-wide.css" />
	<link href="/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
</noscript>
<link href="/css/jquery-ui.css" rel="stylesheet">
<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie/v9.css" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="/css/ie/v8.css" /><![endif]-->