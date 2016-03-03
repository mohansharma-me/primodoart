<?php
mysql_connect("localhost","root","");
mysql_select_db("primodoart");

function jsondata($id) {
	if(isset($_SESSION["jsondata"])) {
		$time=filemtime("./profile.json");
		if($time!=$_SESSION["jsondata_time"]) {
			unset($_SESSION["jsondata"]);
			return jsondata($id);
		}
		if(isset($_SESSION["jsondata"][$id]))
			return $_SESSION["jsondata"][$id];
		else 
			return null;
	} else {
		$_SESSION["jsondata"]=array();
		$_SESSION["jsondata_time"]=filemtime("./profile.json");
		try {
			$_SESSION["jsondata"]=json_decode(file_get_contents("./profile.json"),true);
			
		} catch(Exception $e) {
			print_r($e);
		}
		if(is_array($_SESSION["jsondata"]))
			return jsondata($id);
		else 
			return null;
	}
}

function authenticateAdmin($u,$p) {
	$u=addslashes($u);
	$p=sec(addslashes($p));
	$rows=exeQuery('select count(*) from admin where admin_username LIKE "$u" and admin_password LIKE "$p"');
	if($rows>0) {
		$_SESSION["adminAuthed"]=true;
		$_SESSION["adminTimeout"]=strtotime("now");
	}	
	return $rows>0;
}

function isAdminAuthed() {
	return isset($_SESSION["adminAuthed"]) && isset($_SESSION["adminTimeout"]) && $_SESSION["adminAuthed"];
}

function exeQuery($q) {
	$res=mysql_query($q);
	return mysql_affected_rows();
}

function exeData($q) {
	$res=mysql_query($q);
	if(mysql_affected_rows()>=0)
		return $res;
	else
		return null;
} 

function sec($data=null,$key="@primodoart") {
	if($data==null)
		$data=gethostbyname("");
	return hash_hmac("sha1",$data,$key);
}

function editLink($att,$tit,$force=false) {
	$force=$force?"font-size:0.3em!important;":"";
	if(isAdminAuthed())
	return ' <a href="javascript:void" style="'.$force.'" class="edit-link" data-edit="'.$att.'" title="'.$tit.'"><i class="icon fa-pencil"> </i></a> ';
}

function slug($text) {
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	$text = trim($text, '-');
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = strtolower($text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	if (empty($text)) {
		return 'n-a';
	}  
	return $text;
}