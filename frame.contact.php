				<!-- Contact -->
					<section id="contact" class="five">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<?php
							if(isAdminAuthed()) {
							?>

							<p>Please check your mailbox for your visitor's messages.</p>
							<p>You can check all your mail at <a class="_blank" href="http://webmail.primodoart.com">webmail.primodoart.com</a><br/>
							Your login access detail is as follows<br/>Username: mail@primodoart.com<br/>Password: mymail</p>
							
							<p><?=jsondata("contact-heading")?> <?=editLink("contact-heading","Edit update heading")?> <a>:)</a></p>
							
							<?php
							} else {
							?>
							
							

							<p>Send your valuable message to me <a>:)</a></p>
							
							<form method="post" action="#" id="formContact">
								<div class="row 50%">
									<div class="6u"><input type="text" name="name" placeholder="Name" /></div>
									<div class="6u"><input type="text" name="email" placeholder="Email" /></div>
								</div>
								<div class="row 50%">
									<div class="12u">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="12u">
										<input type="submit" value="Send Message" />
									</div>
								</div>
							</form>
							
							
							<?php
							}
							?>

						</div>
					</section>