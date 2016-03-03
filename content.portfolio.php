<?php
if(isset($keys[1]) && is_numeric($keys[1])) {
	$imgid=$keys[1];
	$imgFile="./portfolio/$imgid.jpg";
	if(file_exists($imgFile) && is_file($imgFile)) {
		$img=null;
		try {
			$img=@imagecreatefrompng($imgFile);
		} catch(Exception $e) {
			
		}
		
		if($img==null) {
			try {
				$img=@imagecreatefromjpeg($imgFile);
			} catch(Exception $e1) {}
		}

		if($img!=null) {
			header("Content-Type: image/png");
			list($wid,$hei)= getimagesize($imgFile);
			$o_w=$wid;
			$o_h=$hei;			
			if(in_array("thumb",$keys)) {
				$ori_size=400;
				if(isset($_GET["ap"]) && is_numeric($_GET["ap"]))
					$ori_size=$_GET["ap"];
				if($wid>$hei) {
					$hei=($hei*$ori_size)/$wid;
					$wid=$ori_size;
				} else {
					$wid=($wid*$ori_size)/$hei;
					$hei=$ori_size;
				}
				$thumb=imagecreatetruecolor($wid, $hei);
				imagesavealpha($thumb,true);
				imagefill($thumb,0,0,0xff000000);
				imagecopyresized($thumb, $img, 0, 0, 0, 0, $wid, $hei, $o_w, $o_h);
				ob_flush();ob_clean();
					imagepng($thumb,null,9,PNG_ALL_FILTERS);
				$imgData=ob_get_clean();
				echo $imgData;
				imagedestroy($thumb);
			} else {
				ob_flush();ob_clean();
					imagepng($img,null,9,PNG_ALL_FILTERS);
				$imgData=ob_get_clean();
				echo $imgData;
			}
			
			imagedestroy($img);
		} else {			
			header("Content-Type: image/png");
			echo file_get_contents($imgFile);
		}			
	} else {
		header("HTTP/1.1 404 Not Found");
	}
} else {
	header("HTTP/1.1 404 Not Found");
}