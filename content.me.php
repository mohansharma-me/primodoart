<?php
/*echo jsondata("short-heading");
print_r($_SESSION);
unset($_SESSION["jsondata"]);
unset($_SESSION["jsondata_time"]);
exit(0);*/
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Primodo Art - Art Work, Design Work, Job Work</title>
		<?php include_once "./theme/head.php"; ?>
	</head>
	<body>
		<?php include_once "./theme/header.php"; ?>
		
		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<img src="/images/logo1.png" style="width:180px;" />
							<header style="padding:10px;background:rgba(0,0,0,0.6)">
								<h2 class="alt">
								<?=jsondata("home-heading")?> <?=editLink("home-heading","Edit main heading")?><br /></h2>
								<p><?=jsondata("short-heading")?> <?=editLink("short-heading","Edit short heading")?><br />
								<?=jsondata("long-heading")?> <?=editLink("long-heading","Edit long heading")?></p>
							</header>
							
							<footer>
								<a href="#portfolio" class="button scrolly"><?=jsondata("portfolio-link-title")?></a> <?=editLink("portfolio-link-title","Edit this text")?>
							</footer>

						</div>
						<?php
							$data=editLink("header-image","Change this header image");
							if(strlen(trim($data))>0) {
								echo "<br/><div style='background:rgba(2,2,2,0.5);padding:5px'>Change header background $data</div>";
							}
						?>
					</section>
					
				<!-- Services -->
				<section id="services" class="two">
						<div class="container">
							<div class="row">
                            	<div class="10u">
                                    <header>
                                        <h2>Services</h2>
                                    </header>
                                    
                                    <p><?=jsondata("service-heading1")?>, <?=editLink("service-heading1","Edit this heading")?><br/><?=jsondata("service-heading2")?> <?=editLink("service-heading2","Edit this heading")?></p>
                                
                                    <div class="row">
                                        <div class="12u">
                                            <ul class="services-list">
                                                <?php
                                                $res=exeData("select * from services");
                                                if($res==null) {
                                                    echo "<center>No Data!!</center>";
                                                } else {
                                                    $flag=isAdminAuthed();
                                                    while($row=mysql_fetch_assoc($res)) {
                                                        $editIt="";
                                                        $deleteIt="";
                                                        if($flag) {
                                                            $editIt='<sup><i style="font-size:0.7em;cursor:pointer" data-edit="'.$row["service_id"].'" class="edit-service-button icon fa-pencil"> </i></sup> &nbsp;<sup><i style="font-size:0.7em;cursor:pointer" data-edit="'.$row["service_id"].'" class="delete-service-button icon fa-close"> </i></sup>';
                                                        }
                                                        echo '<li>'.$deleteIt.'<a href="/services/'.$row["service_slug"].'" title="'.$row["service_desc"].'">#'.$row["service_title"].'</a> '.$editIt.'</li>';
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <?php
                                        if(isAdminAuthed()) {
                                        ?>
                                            <div class="12u">
                                                <br/>
                                                <center>
                                                    <a class="new-service-button" href=""><i class="icon fa-plus" style="vertical-align:middle"> </i> New Service</a>
                                                </center>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        
                                    </div>
								</div>
                                <div class="2u">
                                	<header style="border-bottom:1px dashed black;margin:0">
                                    	<h5>Tags</h5>
                                    </header>
                                    
                                    <div class="row">
                                    	<div class="12u">
						<ul class="tags-list">
							<?php
							$res=exeData("select group_concat(portfolio_tags separator ',') as tags from portfolios");
							if(mysql_affected_rows()>0) {
								$row=mysql_fetch_assoc($res);
								$tags=$row["tags"];
								$tags=explode(",",trim($tags));
								$slugs=array();
								foreach($tags as $tag) {
									if(strlen(trim($tag))>0) {
										if(!in_array(slug($tag),$slugs)) {
											echo '<li><a href="/tags/'.slug($tag).'">#'.ucwords($tag).'</a></li> ';
											$slugs[]=slug($tag);
										}
									}
								}
							}
							?>
						</ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="three">
						<div class="container">
					
							<header>
								<h2>Portfolio</h2>
							</header>
							
							<p><?=jsondata("portfolio-heading1")?><?=editLink("portfolio-heading1","Edit this heading")?><br/><span style="font-size:0.7em"><?=jsondata("portfolio-heading2")?><?=editLink("portfolio-heading2","Edit this heading")?></span></p>
						
							<?php
								$ps=array();
								$ps[0]=array();
								$ps[1]=array();
								$ps[2]=array();
								$res=exeData("select * from services left join (select * from portfolios order by rand()) a on portfolio_service_id=service_id group by service_id");
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
										$link="/services/".$portfolio["service_slug"]."/".slug($portfolio["portfolio_title"])."/".$portfolio["portfolio_id"];
										?>
										<article class="item">
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["service_desc"]?>" /></a>
											<header>
												<h3><?=$portfolio["service_title"]?></h3>
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
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["service_desc"]?>" /></a>
											<header>
												<h3><?=$portfolio["service_title"]?></h3>
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
											<a href="<?=$link?>" class="image fit"><img src="<?=$img?>" alt="<?=$portfolio["service_desc"]?>" /></a>
											<header>
												<h3><?=$portfolio["service_title"]?></h3>
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

				<!-- About Me --> <?php include_once "./frame.about.php"; ?>
				<!-- Contact --> <?php include_once "./frame.contact.php"; ?>

			</div>

		<?php include_once "./theme/footer.php"; ?> 
	</body>
	<?php include_once "./theme/scripts.php"; ?> 
</html>