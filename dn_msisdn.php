<?php
$path=$_REQUEST["path"];

$pt=strripos($path,'/')+1;
$source_name=substr($path,$pt);
$source_path=substr($path,0,$pt-1);

$filepath=make_zip($source_path,$source_name);
$filepath=$source_path . "/" .$filepath;

$filename=substr($source_name,0,strripos($source_name,'.')) . ".zip";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filepath));
@readfile($filepath);
unlink($filepath);


function make_zip($source_path,$source_name){
	if(is_file($source_path."/".$source_name)){
		$yr = date("Y");
		$da = date("d");
		$hor = date("H");
		$min = date("i");
		$ss = date("s");
		$tempname=$yr . $mon . $da . $hor . $min . $ss . '.zip';

		if(chdir($source_path)){
			$commd="zip " . $tempname . " ./" . $source_name;
			exec($commd);
			return $tempname;
		}

	}else{
		return $tempname;
	}
}
?>