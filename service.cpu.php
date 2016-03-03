<?php
$data=array();
$data["success"]=false;
$job=filter_input(INPUT_POST,"job");
//print_r($_GET);
if(isset($job)) {
	if($job=="clients") {
		if(isset($_FILES["file"])) {
			$outputFile="./clients/".$_FILES["file"]["name"];
			$data["success"]=move_uploaded_file($_FILES["file"]["tmp_name"],$outputFile);
		} else {
			require "./admin.clients.php";
			exit(0);
		}
	} else
	if($job=="portfolio") {
		if(isAdminAuthed()) {
			$title=filter_input(INPUT_POST,"title");
			$tags=filter_input(INPUT_POST,"tags");
			$desc=filter_input(INPUT_POST,"desc");
			$service=filter_input(INPUT_POST,"service");
			$id=filter_input(INPUT_POST,"id");
			$action=filter_input(INPUT_POST,"action");
			if(isset($action) && isset($id)) {
				$sure=filter_input(INPUT_POST,"sure");
				if(isset($sure)) {
					$id=addslashes($id);
					$r=exeQuery("delete from portfolios where portfolio_id=$id");
					unlink("./portfolio/$id".".jpg");
					$data["success"]=$r>0;
				} else {
					require "./admin.delete-portfolio.php";
					exit(0);
				}
			} else
			if(isset($title) && isset($tags) && isset($desc) && isset($service) &&  (isset($id) || (!isset($id) && isset($_FILES["file"])))) {
				$title=addslashes($title);
				$tags=addslashes($tags);
				$desc=addslashes($desc);
				$service=addslashes($service);
				$q='insert into portfolios(portfolio_service_id,portfolio_title,portfolio_desc,portfolio_tags) values("'.$service.'","'.$title.'","'.$desc.'","'.$tags.'")';
				if(isset($id)) {
					$q='update portfolios set portfolio_service_id='.$service.', portfolio_title="'.$title.'", portfolio_desc="'.$desc.'", portfolio_tags="'.$tags.'" where portfolio_id='.$id;
				}
				$r=exeQuery($q);
				if($r>=0) {
					$portfolioid=0;
					if(isset($id)) {
						$portfolioid=$id;
					} else {
						$res=exeData("select last_insert_id() as id");
						$row=mysql_fetch_assoc($res);
						$portfolioid=$row["id"];
					}
					$imgPath="./portfolio/".$portfolioid.".jpg";
					if(isset($_FILES["file"]) && move_uploaded_file($_FILES["file"]["tmp_name"],$imgPath)) {
						$data["success"]=true;
					} else if(isset($id)) {
						$data["success"]=true;
					}
				}
			} else {
				require "./admin.upload-portfolio.php";
				exit(0);
			}
		}
	} else
	if($job=="service") {
		if(isAdminAuthed()) {
			$title=filter_input(INPUT_POST,"title");
			$desc=filter_input(INPUT_POST,"desc");
			$id=filter_input(INPUT_POST,"id");
			$action=filter_input(INPUT_POST,"action");
			if(isset($action) && isset($id)) {
				$sure=filter_input(INPUT_POST,"sure");
				if(isset($sure)) {
					$id=addslashes($id);
					$r=exeQuery("delete services, portfolios from services left join portfolios on portfolio_service_id=service_id where service_id=$id");
					$data["success"]=$r>0;
				} else {
					require "./admin.delete-service.php";
					exit(0);
				}
			} else
			if(isset($title) && isset($desc)) {
				$slug=strtolower(slug($title));
				$r=exeQuery("select * from services where service_slug LIKE '$slug'");
				if($r>0 && !isset($id)) {
					$data["error"]="Service title is already exists.";
				} else {					
					$title=addslashes($title);
					$desc=addslashes($desc);
					$q='insert into services(service_title,service_desc,service_slug) values("'.$title.'","'.$desc.'","'.$slug.'")';
					if(isset($id)) {
						$q='update services set service_title="'.$title.'", service_desc="'.$desc.'", service_slug="'.$slug.'" where service_id='.$id;
					}
					$r=exeQuery($q);
					if($r==1) {
						$data["success"]=true;
					} else {
						$data["error"]="Unexpected error";
					}
				}
			} else {
				require "admin.new-service.php";
				exit(0);
			}
		} else {
			echo "Invalid Request, Please try again.";
			exit(0);
		}
	} else if($job=="contact-me") {
		$data["error"]="can't send message to mailbox.";
		$name=filter_input(INPUT_POST,"nm");
		$email=filter_input(INPUT_POST,"em");
		$message=filter_input(INPUT_POST,"msg");
		if(isset($name) && isset($email) && isset($message)) {
			$to = "mail@primodoart.com";
			$subject = "Contact message from Website by $name";
			$txt = "<html><body><table><tr><td><b>Name:</b> $name</td><td><b>Email:</b>$email</td></tr><tr><td colspan=2><b>Message:</b> $message</td></tr></table></body></html>";
			$headers = "From: $email\r\n";
			$headers .= "Reply-To: $email\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			if(mail($to,$subject,$txt,$headers)) {
			    $data["success"]=true;
			    $data["error"]="Your message successfully sent to Mr. Jayesh Ramani.\nThank You.";
			}
		} else {
			$data["error"]="please provide valid contact details.";
		}
	} else if($job=="edit-link" && isAdminAuthed()) {
		$edit4=filter_input(INPUT_POST,"edit");
		$title=filter_input(INPUT_POST,"title");
		if(isset($edit4) && isset($title)) {
			$adminEditFile="./admin.invalidreq.php";
			switch($edit4) {
				case "home-heading":
				case "short-heading":
				case "long-heading":
				case "portfolio-link-title":
				case "service-heading1":
				case "service-heading2":
				case "portfolio-heading1":
				case "portfolio-heading2":
				case "about-text":
				case "contact-heading":
				case "copyright-heading":
				case "sub-title":
				case "social-twitter":
				case "social-facebook":
				case "social-email":
					$adminEditFile="./admin.single-valued.php";
					break;
				case "header-image":
				case "about-image":
					$adminEditFile="./admin.fileupload.php";
					break;
			}
			
			if(file_exists($adminEditFile)) {
				require $adminEditFile;
			} else {
				echo "Invalid request, please try again.";
			}
 		}
		exit(0);
	} else if($job=="edit" && isAdminAuthed()) {
		$way=filter_input(INPUT_POST,"way");
		$id=filter_input(INPUT_POST,"id");
		if(isset($way) && isset($id)) {
			$val=filter_input(INPUT_POST,"data");
			if($way=="sv" && isset($id) && isset($val)) {
				$json=array();
				$json=json_decode(file_get_contents("./profile.json"),true);
				if(strlen(trim($val))==0) {
					switch($id) {
						case "home-heading": $val="Hi! I'm <strong>Jayesh Rajani</strong>, an <a>cool</a> art work designer "; break;
						case "short-heading": $val="@primodoart"; break;
						case "long-heading":$val="Art, Designs, Job Work, Photoshop, All type designing and priting works"; break;
						case "portfolio-link-title":$val="OMG What i have done...!!"; break;
						case "service-heading1":$val="We are here for you with following services with our colours"; break;
						case "service-heading2":$val="please click on service name to see its example works..."; break;
						case "portfolio-heading1":$val="My work board is my face to you."; break;
						case "portfolio-heading2":$val="Here all services's random work is displayed."; break;
						case "about-text":$val="Hi I'm Jayesh Rajani, here i will write something about me..."; break;
						case "contact-heading":$val="Send your valuable message to me"; break;
						case "copyright-heading":$val="&copy; PrimodoArt. All rights reserved."; break;
						case "sub-title":$val="Art Work, Job Work"; break;
						case "social-twitter": $val="#"; break;
						case "social-facebook": $val="#"; break;
						case "social-email": $val="mail@primodoart.com"; break;
					}
				}
				$json[$id]=$val;
				file_put_contents("./profile.json",json_encode($json));
				$data["success"]=true;
			} else if($way=="img" && isset($_FILES["file"])) {
				$destFile="";
				switch($id) {
					case "header-image": $destFile="./images/banner.jpg"; break;
					case "about-image": $destFile="./images/pic08.jpg"; break;
					default:
					$destFile="./temp.upload";
				}
				$data["success"]=move_uploaded_file($_FILES["file"]["tmp_name"],$destFile);
			}
		}
	}
}

echo json_encode($data);