<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="" lang="fr">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Font Icon Extractor : SVG Font to SVG Icons</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
<label>SVG Font file : <input type="file" name="font" /></label><input type="submit" value="Send"></form>
<?php
if(isset($_FILES['font'])){
	move_uploaded_file($_FILES['font']['tmp_name'],dirname(__FILE__)."/tmp/tmp.svg");
	$c=str_replace("\n","",file_get_contents(	dirname(__FILE__)."/tmp/tmp.svg"));
	preg_match_all("/\<glyph (.*?)\/>/",$c,$out);
	$entete='<?xml version="1.0" standalone="no"?><svg width="1500px" height="1500px" version="1.1" xmlns="http://www.w3.org/2000/svg">';
	foreach($out[1] as $n=>$glyph){
		$svg=$entete.' <path transform="scale(1, -1) translate(0, -1500)" '.$glyph.' /></svg>';
		@preg_match("/glyph-name=\"(.*?)\"/",$glyph,$out0);
		@file_put_contents(dirname(__FILE__)."/tmp/".($out0[1]!=""?$out0[1]:$n).".svg",$svg);
	}
}
?>
</body></html>
