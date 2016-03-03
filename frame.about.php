					<section id="about" class="four">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>
							
							<a href="#" class="image featured"><img src="/images/pic08.jpg" alt="" /></a>
							<?php
							if(isAdminAuthed()) {
								?>
								<font style="font-size:0.5em">
								<label>Update about image <?=editLink("about-image","Change this about image")?></label>
								</font>
								<?php
							}
							?>
							
							<p><?=jsondata("about-text")?><?=editLink("about-text","Change about description")?></p>

						</div>
						<br/>
						<?php include_once "./frame.ourclients.php"; ?>
						
						
					</section>