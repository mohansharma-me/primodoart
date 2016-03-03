<?php
session_start();
require "./inc.jobs.php";
$keys=array();
$__path=filter_input(INPUT_GET,"__key");
if(isset($__path)) {
	$tmp=explode("/",$__path);
	foreach($tmp as $tm)
		if(strlen(trim($tm))>0)
			$keys[]=$tm;
} else {
	$keys[]="me";
}

if(!isAdminAuthed()) {	
	$user=filter_input(INPUT_POST,"username");
	$pass=filter_input(INPUT_POST,"password");
	$isAdminLogin=isset($user) && isset($pass) && authenticateAdmin($user,$pass);
} else {
	$logout=filter_input(INPUT_GET,"getmeout");
	if(isset($logout)) {
//		session_destroy();
		unset($_SESSION["adminAuthed"]);
		unset($_SESSION["adminTimeout"]);
	}
}

$pageFile="./content.".$keys[0].".php";
if(file_exists($pageFile) && is_file($pageFile)) {
	include_once "$pageFile";
} else {
	$pageFile="./service.".$keys[0].".php";
	if(file_exists($pageFile) && is_file($pageFile)) {
		include_once "$pageFile";
	} else {
		header("HTTP/1.1 404 Not Found");
		print_r($keys);
	}
}