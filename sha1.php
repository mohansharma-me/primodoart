<?php
$data=$_GET["data"];
$key="@primodoart";
echo hash_hmac("sha1",$data,$key);