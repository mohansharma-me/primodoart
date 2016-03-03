<!-- Header -->
<div id="header" class="skel-layers-fixed">

	<div class="top">

		<!-- Logo -->
			<div id="logo">
				<span class="image avatar48"><img src="/images/logo1.png" alt="Primodo Art" style="background:#808796" /></span>
				<h1 id="title">Primodo Art</h1>
				<p><?=jsondata("sub-title")?> <?=editLink("sub-title","Edit this subtitle")?></p>
			</div>

		<!-- Nav -->
			<nav id="nav">
				<!--
				
					Prologue's nav expects links in one of two formats:
					
					1. Hash link (scrolls to a different section within the page)
					
					   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

					2. Standard link (sends the user to another page/site)

					   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>
				
				-->
				<?php
				$pageLink="";
				if(isset($extLink)  && $extLink && false) {
					$pageLink="/";
				}
				?>
				<ul>
					<li><a href="<?=$pageLink?>#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Home</span></a></li>
					<li><a href="<?=$pageLink?>#services" id="services-link" class="skel-layers-ignoreHref"><span class="icon fa-group">Services</span></a></li>
					<li><a href="<?=$pageLink?>#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Portfolio</span></a></li>
					<li><a href="<?=$pageLink?>#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">About Me</span></a></li>
					<li><a href="<?=$pageLink?>#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
					<?php
					if(isAdminAuthed()) {
					?>
					<li><a href="?getmeout=now" id="logout-link" class="skel-layers-ignoreHref"><span class="icon fa-close">Get me out &larr;</span></a></li>
					<?php
					}
					?>
				</ul>
			</nav>
			
	</div>
	
	<div class="bottom">

		<!-- Social Icons -->
			<ul class="icons">
				<li><a href="<?=jsondata("social-twitter")?>" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="<?=jsondata("social-facebook")?>" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
				<li><a href="mailto:<?=jsondata("social-email")?>" class="icon fa-envelope"><span class="label">Email</span></a></li>
			</ul>
			<?php
			if(isAdminAuthed()) {
			?>
			<center><div style="font-size:0.5em">
			<ul>
				<li><span class="label">Twitter</span> <?=editLink("social-twitter","Change twitter link")?></li>
				<li><span class="label">Facebook</span> <?=editLink("social-facebook","Change facebook link")?></li>
				<li><span class="label">Email</span> <?=editLink("social-email","Change email address")?></li>
			</ul>
			</div></center>
			<?php
			}
			?>
	</div>

</div>