<?php
$service=null;
if(isset($keys[1])) {
	if(isset($keys[3]) && is_numeric($keys[3])) {
		$res=exeData("select * from services, portfolios where portfolio_service_id=service_id and portfolio_id=".$keys[3]." and lower(service_slug) LIKE '".strtolower($keys[1])."'");
		if(mysql_affected_rows()==1) {
			$service=mysql_fetch_assoc($res);
		} else {
			header("Location: /me");
			exit(0);
		}
	} else {
		$res=exeData("select * from services where lower(service_slug) LIKE '".strtolower($keys[1])."'");
		if(mysql_affected_rows()==1) {
			$service=mysql_fetch_assoc($res);
		} else {
			header("Location: /me");
			exit(0);
		}
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php
		$ptitle="";
		if(isset($service["portfolio_title"])) {
			$ptitle=$service["portfolio_title"]." - ";
		}
		?>
		<title><?=$ptitle?><?=$service["service_title"]?> - <?=$service["service_desc"]?> - Primodo Art</title>
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
								<?php
								$style="";
								if(isset($service["portfolio_id"])) {
									$style='font-size:1em';
									?>
									<h2 class="alt" style="margin:0px"><?=$service["portfolio_title"]?></h2>
									<span><?=$service["portfolio_desc"]?></span>
									<?php
								}
								?>
								<h2 style="<?=$style?>" class="alt"><?=$service["service_title"]?> <?=jsondata("short-heading")?></h2>
								<span>
									<?=$service["service_desc"]?>
								</span>
							</header>
						<?php
							$data=editLink("header-image","Change this header image");
							if(strlen(trim($data))>0) {
								?>
								<footer>
									<?php
									$col="6u";
									if(isset($service["portfolio_id"])) $col="4u";
									?>
									<div class="row">
										<div class="<?=$col?>">
											<a href="" class="button scrolly edit-service-button" data-edit="<?=$service["service_id"]?>"><i class="icon fa-pencil"></i> Edit "<?=$service["service_title"]?>"</a>
										</div>
										<?php
										if(isset($service["portfolio_id"])) {
										?>
										<div class="4u">
											<a href="" class="button scrolly edit-portfolio-button" data-edit="<?=$service["portfolio_id"]?>"><i class="icon fa-pencil"></i> Edit "<?=$service["portfolio_title"]?>"</a>
										</div>
										<?php
										}
										?>
										<div class="<?=$col?>">
											<a href="" class="button scrolly upload-portfolio-button"><i class="icon fa-plus"></i> Upload Portfolio</a>
										</div>
									</div>
								</footer>
								<?php
							}
						?>	
						</div>
						
					</section>
					
				<!-- Portfolio -->
				<?php
				if(isset($service["portfolio_id"])) {
				?>
					<section id="portfolio" class="three">
						<div class="container">
							<div class="row">
								<div class="12u">
									<img style="width:100%" src="/portfolio/<?=$service["portfolio_id"]?>" alt="<?=$service["portfolio_title"]." - ".$service["portfolio_desc"]?>" /><br/>
									<ul class="tags-list">
										<?php
										if(true) {
											$tags=explode(",",$service["portfolio_tags"]);
											$arr=array();
											foreach($tags as $tag) {
												if(strlen(trim($tag))>0) {
													if(!in_array(slug($tag),$arr)) {
														echo '<li><a href="/tags/'.slug($tag).'">#'.ucwords($tag).'</a></li> ';
														$arr[]=slug($tag);
													}													
												}
											}
										}
										?>
									</ul>
									<br/>
									<a href="/services/<?=$service["service_slug"]?>">&larr; Back to "<?=$service["service_title"]?>"</a>
								</div>
							</div>
						</div>
					</section>
				<?php
				} else {
				?>
					<section id="portfolio" class="three">
						<div class="container">
					
						
							<?php
								$ps=array();
								$ps[0]=array();
								$ps[1]=array();
								$ps[2]=array();
								$res=exeData("select * from portfolios where portfolio_service_id=".$service["service_id"]." order by portfolio_id desc");
								if(is_resource($res) && mysql_affected_rows()>0) {
									$cur=0;
									while($row=mysql_fetch_assoc($res)) {
										$ps[$cur++][]=$row;
										if($cur==3)
											$cur=0;
									}
								} else {
									echo "<center>Zero portfolio uploaded! :(</center>";
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
										$link="/services/".$service["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
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
										$link="/services/".$service["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
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
										$link="/services/".$service["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
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