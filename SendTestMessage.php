<?
require("connection_mmc.php"); //ADDING CONNECTION FILE
header("Content-Type: text/html; charset=UTF-8");

$sqlquery = "select message,footer_url from list_detail where id=29";

$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row = mysql_fetch_array($result)){




	 // TESTING THAI + ENGLISH UNICODE URL ID=17
	 $message = $row[0];
	 $footer = $row[1];
	 $message = str_ireplace(" ","+", $message);

	 echo "MESSAGE: ".$message."<br>";
	 echo "FOOTER: ".$footer."<br>";
	 //$new = $message . utf8_encode("\n").$footer;
	 $new = $message . urlencode("\n").$footer;
	 $callUrl = "http://192.168.6.69:8080/PUSH?esme=subpushacc&pwd=subpushacc&dcs=8&esm=0&src=testAKH&dst=66893000791&msg=$new";
	 //	$callUrl = urlencode($callUrl);
	 $response = file_get_contents($callUrl);
	 echo "UNICODE URL: ".$callUrl."<br>UNICODE RESPOSNE: " .$response . " ##TEST<br>";


}
function strToHex($string)
{
	$hex='';
	for ($i=0; $i < strlen($string); $i++)
	{
		$hex .= dechex(ord($string[$i]));
	}
	return $hex;
}

function get_wappush($waptle,$waplink)

{
	$waptle = trim($waptle, " ");
	$waplink = trim($waplink, " ");
	$len1=strlen($waptle);
	$len2=strlen($waplink);
	$len=$len1+$len2;
	if($len<115){
		$waplink_hex = get_texttohex($waplink);
		$title_hex = get_texttohex($waptle);
	}else{
		$waplink_hex = get_texttohex(substr($waplink,0,114));
		$tmpln=115-strlen($waplink_hex);
		$title_hex = get_texttohex(substr($waptle,0,$tmpln));
	}
	//	$wapheader = "BF0601AE02056A0045C60B03";
	$wapheader = "0605040B8423F0BF0601AE02056A0045C60B03";
	$waplink_end = "000103";
	$title_end = "000101";
	$result=$wapheader . $waplink_hex . $waplink_end . $title_hex . $title_end;
	return strtoupper($result);
}

function get_texttohex($txtmsg)

{
	$chararr=str_split($txtmsg);
	$len=count($chararr);
	$hexmsg="";
	for($cnt=0;$cnt<$len;$cnt++){
		$newhex=dechex(ord($chararr[$cnt]));
		if (strlen($newhex)==1){
			$newhex= "0" . $newhex;
		}
		$hexmsg = $hexmsg . $newhex;
		$newhex="";
	}
	return $hexmsg;
}



?>
