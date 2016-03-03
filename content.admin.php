<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin Panel - Primodo Art</title>
		<?php include_once "./theme/head.php"; ?>
	</head>
	<body>
		<?php include_once "./theme/admin-header.php"; ?>
		
		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<img src="/images/logo1.png" style="width:180px;" />
							<header style="padding:10px;background:rgba(0,0,0,0.6)">
								<h2 class="alt">Hello <strong>Jayesh Ramani</strong>!!</h2>
								<?php
								if(!isAdminAuthed()) {
								?>
								<br/>
								<center><div class="row">
									<div class="6u -3u">
										<form method="post"  action="/me">
											<div class="row 50%">
												<div class="12u"><input type="text" name="username" placeholder="Username" /></div>
											</div>
											<div class="row 50%">
												<div class="12u"><input type="password" name="password" placeholder="Password" /></div>
											</div>
											
											<div class="row">
												<div class="12u">
													<input type="submit" value="Let me in &rarr;" />
												</div>
											</div>
										</form>
									</div>
								</div></center>
								<?php
								}
								?>
								<p>@primodoart<br /></p>
							</header>
							
							<footer>
								<a href="mailto:mail@samratinfosys.com" class="button scrolly">Forgot your password ?</a>
							</footer>

						</div>
					</section>

			</div>

		<?php include_once "./theme/footer.php"; ?> 
	</body>
</html>