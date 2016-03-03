<?php
if(!isset($keys[1])) {
	header("Location: /me");
	exit(0);
}
$slug=str_replace("-"," ",$keys[1]);
$slugs=array();
$slugs=explode(" ",$slug);
$nq="";
$q="";
$qq=array();
foreach($slugs as $q2) {
	if(strlen(trim($q2))>0) {
		$nq.="$q2 ";
		$q="(select * from portfolios where portfolio_tags LIKE '%".addslashes($q2)."%') union ".$q;
	}
}
$q="select * from (".substr($q,0,strlen($q)-6).") a, services where service_id=portfolio_service_id";
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?=ucwords($slug)?> - Primodo Art</title>
		<?php include_once "./theme/head.php"; ?>
	</head>
	<body>
		<?php $extLink=true; include_once "./theme/header.php"; ?>
		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header style="padding:10px;background:rgba(0,0,0,0.6)">
								<h2 class="alt" style="margin:0px"><?=ucwords($slug)?> - Primodo Art</h2>
								<span><?=jsondata("long-heading")?></span>
							</header>
						
						</div>
						
					</section>
					
				<!-- Portfolio -->
				<?php
				$res=exeData($q);
				if(mysql_affected_rows()<=0) {
					?>
					<br/>
					<center>
					<h3>No portfolio founds.</h3>
					</center>
					<br/>
					<?php
				} else {
				?>
					<section id="portfolio" class="three">
						<div class="container">
					
							<h3><?=ucwords($slug)?></h3><br/>
					
							<?php
								$ps=array();
								$ps[0]=array();
								$ps[1]=array();
								$ps[2]=array();
								$cur=0;
								while($row=mysql_fetch_assoc($res)) {
									$ps[$cur++][]=$row;
									if($cur==3)
										$cur=0;
								}
							?>
							<div class="row">
								<div class="4u">
									<?php
									if(count($ps[0])>0) {
										foreach($ps[0] as $portfolio) {	
										$img="/images/pic02.jpg";
										if(isset($portfolio["portfolio_id"]))
											$img="/portfolio/".$portfolio["portfolio_id"]."/".slug($portfolio["portfolio_title"])."/".slug($portfolio["portfolio_tags"])."/thumb";
										$link="/services/".$portfolio["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
										?>
										<article class="item">
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["portfolio_desc"]?>" /></a>
											<header>
												<h3><a href="<?=$link?>"><?=$portfolio["portfolio_title"]?></a>
												<?php if(isAdminAuthed()) { ?>
												&nbsp;<sup><a href="" class="edit-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-pencil"></i></a></sup> <sup><a href="" class="delete-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-close"></i></a></sup>
												<?php } ?>
												</h3>
											</header>
										</article>										
										<?php
										}
									}
									?>
								</div>
								<div class="4u">
									<?php
									if(count($ps[1])>0) {
										foreach($ps[1] as $portfolio) {	
										$img="/images/pic02.jpg";
										if(isset($portfolio["portfolio_id"]))
											$img="/portfolio/".$portfolio["portfolio_id"]."/".slug($portfolio["portfolio_title"])."/".slug($portfolio["portfolio_tags"])."/thumb";
										$link="/services/".$portfolio["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
										?>
										<article class="item">
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["portfolio_desc"]?>" /></a>
											<header>
												<h3><a href="<?=$link?>"><?=$portfolio["portfolio_title"]?></a> 
												<?php if(isAdminAuthed()) { ?>
												&nbsp;<sup><a href="" class="edit-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-pencil"></i></a></sup> <sup><a href="" class="delete-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-close"></i></a></sup>
												<?php } ?>
												</h3>
											</header>
										</article>										
										<?php
										}
									}
									?>
								</div>
								<div class="4u">
									<?php
									if(count($ps[2])>0) {
										foreach($ps[2] as $portfolio) {	
										$img="/images/pic02.jpg";
										if(isset($portfolio["portfolio_id"]))
											$img="/portfolio/".$portfolio["portfolio_id"]."/".slug($portfolio["portfolio_title"])."/".slug($portfolio["portfolio_tags"])."/thumb";
										$link="/services/".$portfolio["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
										?>
										<article class="item">
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["portfolio_desc"]?>" /></a>
											<header>
												<h3><a href="<?=$link?>"><?=$portfolio["portfolio_title"]?></a> 
												<?php if(isAdminAuthed()) { ?>
												&nbsp;<sup><a href="" class="edit-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-pencil"></i></a></sup> <sup><a href="" class="delete-portfolio-button" data-edit="<?=$portfolio["portfolio_id"]?>"><i class="icon fa-close"></i></a></sup>
												<?php } ?>
												</h3>
											</header>
										</article>										
										<?php
										}
									}
									?>
								</div>
							</div>
							<?php
							if(isAdminAuthed()) {
							?>
							<div class="row">
								<div class="12u">
									<center>
										<a class="upload-portfolio-button" href=""><i class="icon fa-plus"> </i> Upload Portfolio</a>
									</center>
								</div>
							</div>
							<?php } ?>
						</div>
					</section>
				<?php
				}
				?>
				<!-- About Me -->  <?php include_once "./frame.about.php"; ?>
				<!-- Contact --> <?php include_once "./frame.contact.php"; ?>
			</div>

		<?php include_once "./theme/footer.php"; ?> 
	</body>
	<?php include_once "./theme/scripts.php"; ?> 
</html>