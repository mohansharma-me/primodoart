					<div class="container">

							<header>
								<h3>Our Clients</h3>
							</header>

							
							<marquee>
								<a href="#" class="image fit">
									<?php
									$files=scandir("./clients");
									foreach($files as $file) {
										if($file!="." && $file!="..")
										echo '<img src="/clients/'.$file.'" style="width:120px;float:left;margin-left:10px" alt="" />';
									}
									?>
								</a>
							</marquee>

							<?php
							if(isAdminAuthed()) {
							?>
								<br/><br/>
								<center>
									<a href="" class="new-client-button"><i class="icon fa-plus"> </i> New Client</a>
								</center>
							<?php
							}
							?>

							
					</div>