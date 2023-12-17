<?php
require("config.php");
function upload_files ($tag,$destn){
	global $checkValue;
	$file_name=$_FILES[$tag]["name"];
	$tmp_name=$_FILES[$tag]["tmp_name"];
	$file_err=$_FILES[$tag]["error"];

	if(!empty($_FILES[$tag])){
		if ($file_err){
			return upload_file_error($file_err);
		}else{
			$destn=create_folder($destn);
			$destn=$destn . DIR_SEPERATOR . $file_name;
			if(is_file($destn) && $checkValue != 1 )
				return "Uploading file already exist.";
			move_uploaded_file($tmp_name,$destn);
			return $destn;
		}
	}
}

function upload_banner ($tag,$destn){

	$file_name=$_FILES[$tag]["name"];
	$tmp_name=$_FILES[$tag]["tmp_name"];
	$file_err=$_FILES[$tag]["error"];


	if(strtolower(substr($file_name, stripos($file_name, ".")+1))!='zip'){
		return "Err : Bulk Upload should be in zip format";
	}

	if(!empty($_FILES[$tag])){
		if ($file_err){
			return upload_file_error($file_err);
		}else{
			$destn=create_folder($destn);
			$destn=$destn . DIR_SEPERATOR . $file_name;

			//echo "<br>" . $destn;

			move_uploaded_file($tmp_name,$destn);
			return $destn;
		}
	}
}

function create_folder($folder){
	$path=getcwd();

	//echo "<br>folder = " . $folder;

	$tmp=explode(DIR_SEPERATOR,trim($folder,DIR_SEPERATOR));
	for($i=0;$i<count($tmp);$i++){
		$path=$path . DIR_SEPERATOR . $tmp[$i];
		if(!is_dir($path)){
			//echo "<br>path = " . $path;
			mkdir($path, 0777);
		}
		
	}
	return getcwd() . DIR_SEPERATOR . $folder;
}

function delete_dir($path){
	$temp = str_replace(DIR_SEPERATOR.DIR_SEPERATOR,DIR_SEPERATOR,$path) . DIR_SEPERATOR;
	if(is_dir($temp)){
		$handle = opendir($temp);
		for (;false !== ($file = readdir($handle));){
			if($file != "." && $file != "..") {
				if(is_file($temp . $file)) {
					//echo "<BR>Unlink = " . $temp.$file;
					unlink($temp.$file);
				}else if(is_dir($temp.$file)){
					//echo "<br>Delete = " . $temp.$file;
					delete_dir($temp.$file);
				}
			}
		}
		closedir($handle);
		rmdir($path);
	}
}

function copy_dir($srcdir, $dstdir) {
	if(!is_dir($dstdir)) mkdir($dstdir,0777);
	if(is_dir($srcdir)){
		if($handle=opendir($srcdir)) {
			while($file = readdir($handle)) {
				if($file != '.' && $file != '..'){
					$srcfile=$srcdir . DIR_SEPERATOR . $file;
					$dstfile=$dstdir . DIR_SEPERATOR . $file;

					if(is_file($srcfile)){
						copy($srcfile, $dstfile);
					}else if(is_dir($srcfile)){
						copy_dir($srcfile, $dstfile);
					}
				}
			}
			closedir($handle);
		}
	}
}



function upload_file_error ($error_code){
	if($error_code == '1'){
		$error_msg = "001:The uploaded file exceeds the maximum file size in webserver!";
	}elseif ($error_code == '2'){
		$error_msg = "002:The uploaded file exceeds the maximum file size to alowed!";
	}elseif ($error_code == '3'){
		$error_msg = "003:The uploaded file was only partially uploaded!";
	}elseif ($error_code == '4'){
		$error_msg = "004:No file was uploaded!";
	}elseif ($error_code == '6'){
		$error_msg = "006:Missing a temporary folder!";
	}elseif ($error_code == '7'){
		$error_msg = "007:Failed to write file to disk!";
	}elseif ($error_code == '8'){
		$error_msg = "008:File upload stopped by extension!";
	}
	return $error_msg;
}

function file_parse($path,$delema){
	$imp_header=array();
	$imp_qstn=array();
	$cnt=0;
	$fh = fopen($path, 'r');

	while(!feof($fh)){
		$qstn_stream = fgets($fh);

		if(strpos($qstn_stream,"\n")!==false){
			$qstn_stream=str_replace("\n","",$qstn_stream);
			$qstn_stream=str_replace("\r","",$qstn_stream);
		}
		$qstn_stream = addslashes($qstn_stream);

		if(!$qstn_stream) continue;
		$contest_str = explode($delema, $qstn_stream);

		if(!$cnt){
			$args=count($contest_str);
			$flag=0;
			for($i=0;$i<$args;$i++){
				if($contest_str[$i]=="Question"){$imp_header["question"]=$contest_str[$i]; $flag++;}
				else if($contest_str[$i]=="Option A"){$imp_header["a"]=$contest_str[$i]; $flag++;}
				else if($contest_str[$i]=="Option B"){$imp_header["b"]=$contest_str[$i]; $flag++;}
				else if($contest_str[$i]=="Option C"){$imp_header["c"]=$contest_str[$i];}
				else if($contest_str[$i]=="Option D"){$imp_header["d"]=$contest_str[$i];}
				else if($contest_str[$i]=="Option E"){$imp_header["e"]=$contest_str[$i];}
				else if($contest_str[$i]=="Option F"){$imp_header["f"]=$contest_str[$i];}
				else if($contest_str[$i]=="Option G"){$imp_header["g"]=$contest_str[$i];}
				else if($contest_str[$i]=="Option H"){$imp_header["h"]=$contest_str[$i];}
				else if($contest_str[$i]=="Max Option"){$imp_header["max_options"]=$contest_str[$i];}
				else if($contest_str[$i]=="Answer"){$imp_header["ans"]=$contest_str[$i]; $flag++;}
			}

			if($flag!=4){
				return "nok";
			}else{
				$imp_qstn[$cnt]=$imp_header;
			}
			$cnt++;
		}else{
			$imp_qstn[$cnt]=$contest_str;
			$cnt++;
		}
	}
	fclose($fh);
	return $imp_qstn;
}

/******'****UNZIP BULK UPLOAD FILE********/
function unzip_bulk_file($zipfile, $zip_pth)
{
	
	//$zip = zip_open($zipfile);
	/*while($zip_entry = zip_read($zip))
	{
		zip_entry_open($zip, $zip_entry);
//echo zip_entry_name($zip_entry);
		if(substr(zip_entry_name($zip_entry), -1) == DIR_SEPERATOR)
		{
			$zdir = substr(zip_entry_name($zip_entry), 0, -1);
			$zdir = $zip_pth . $zdir;
			if (file_exists($zdir))
			{
				trigger_error('Directory "<b>' . $zdir . '</b>" exists', E_USER_ERROR);
				return false;
			}
			mkdir($zdir);
		}
		else
		{
			$name = str_replace('/',DIR_SEPERATOR,zip_entry_name($zip_entry));
			$name = $zip_pth . $name;
			$fopen = fopen($name, "wb+");
			fwrite($fopen, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)), zip_entry_filesize($zip_entry));
		}
		zip_entry_close($zip_entry);
	}
	zip_close($zip);*/
	return true;
}


function config_parser($field){
	$banner_size = array();

	$adconfig_filename = getcwd() . DIR_SEPERATOR . "config.txt";
	$file_name = fopen($adconfig_filename,"r");

	$file_data = fread($file_name,filesize($adconfig_filename));
	fclose($file_name);

	$linedata = explode('|##|', $file_data, -1);

	for($cnt=0,$i=0; $i<count($linedata); $i++){
		$banner_dt = explode("|#|", $linedata[$i]);
		if($banner_dt[3]==$field){
			$banner_size[$cnt] = $banner_dt[2];
			$cnt++;
		}
	}
	return $banner_size;
}


function validator ($bulk_path,$banner_size,&$sqlquery_banner,$field_type){

	global $login_form;

	$handle = opendir($bulk_path);
	$errflinefeed= 0;
	$banner_size_valid = array();
	$sqlvalue="";
	$logs=array();
	$ind=0;
	while (($file = readdir($handle))) {
		if (!is_dir($bulk_path . $file)) {
			$file = trim($file);
			$pos = stripos($file, ".");
			$file_type = strtolower(substr($file, stripos($file, ".") + 1));

			if($file_type =='gif' || $file_type =='jpeg' || $file_type =='jpg'){
				$isize = getimagesize($bulk_path . $file);

				$logs[$ind][0]=$file;
				$logs[$ind][1]=$file_type;
				$logs[$ind][2]=$isize[0];
				$logs[$ind][3]=$isize[1];
				$logs[$ind][4]=$field_type;
				$logs[$ind][5]=0;

				for($z=0; $z < count($banner_size); $z++){
					$bnr_wdth = substr($banner_size[$z], 0, stripos($banner_size[$z], 'x'));
					$bnr_wdth = trim($bnr_wdth);
					$bnr_het = substr($banner_size[$z], stripos($banner_size[$z], 'x') + 2);
					$bnr_het = trim($bnr_het);

					if($bnr_wdth == $isize[0]){
						$banner_size_valid[$z] = $banner_label_id[$z];
						$logs[$ind][5]=1;

						if($sqlvalue==""){
							$sqlvalue="('" . $file . "','" . $file_type . "','" . $isize[0] . "','" . $isize[1] . "','" . $bulk_path . $file . "','" . $field_type . "','" . $login_form . "')";
						}else{
							$sqlvalue=$sqlvalue . ",('" . $file . "','" . $file_type . "','" . $isize[0] . "','" . $isize[1] . "','" . $bulk_path . $file . "','" . $field_type . "','" . $login_form . "')";
						}
					}
				}
				$ind++;
			}
		}
	}
	if(count($banner_size_valid)!= count($banner_size)){
		$errflinefeed = 1;
		make_error_log($logs,$field_type);
	}else{
		$sqlquery_banner=$sqlquery_banner . $sqlvalue;
		make_error_log($logs,$field_type);
	}
	$errflinefeed;
	
	return $errflinefeed;
}

function make_error_log($arr_logs,$field_type){
	if($field_type=='header'){$mode='w';}else{$mode='a';}
	$filetext="";

	for($cnt=0,$max=count($arr_logs);$cnt<$max;$cnt++){

		$filetext=$filetext . implode('|#|',$arr_logs[$cnt]) . '|##|';
	}

	$filename=getcwd() .DIR_SEPERATOR. "error.log";
	$fp=fopen($filename,$mode);
	fwrite($fp,$filetext,strlen($filetext));
	fclose($fp);
	return 1;
}


function content_sort($arrlist,$field){
	$temp=array();
	$temp_sort=array();
	$hdr=$arrlist[0];
	$arrdup=array();

	$ind=0;
	if(gettype($hdr)=="array"){
		$cnt=0;
		foreach($hdr as $key=>$val){
			$cnt++;
			if($key==$field){ $ind=$cnt; }
		}
		if(!$ind){ return "nok"; }

		$max=count($arrlist);
		$ind=$ind-1;

		for($cnt=1;$cnt<$max;$cnt++){
			$temp[$cnt]=$arrlist[$cnt][$ind];
		}
		asort($temp,3);

		$cnt=1;
		$temp_sort[0]=$arrlist[0];
		foreach($temp as $key=>$val){
			$temp_sort[$cnt]=$arrlist[$key];
			$cnt++;
		}
		return $temp_sort;
	}else{ return "nok";}
}

function find_repeat($arrlist,$field){
	$hdr=$arrlist[0];
	$arrdup=array();
	$ind=0;
	if(gettype($hdr)=="array"){
		$cnt=0;
		foreach($hdr as $key=>$val){
			$cnt++;
			if($key==$field){ $ind=$cnt; }
		}
	}
	if(!$ind){ return "nok"; }
	$max=count($arrlist);
	$ind=$ind-1;

	for($cnt=1;$cnt<$max;$cnt++){
		$arrdup[$cnt]=$arrlist[$cnt][$ind];
	}
	$arrdup=array_unique($arrdup);
	$fkey=array_keys($arrdup);
	sort($fkey);
	return $fkey;
}

function arr_insert($arr_content,$tname,$contestid,$index){
	if(gettype($arr_content)=="array"){
		$max=count($arr_content);
		$arr_content=str_replace("'", "''", $arr_content);
		$cntkey;$cntval;
		$indkey;$indval;
		foreach($contestid as $key=>$val){
			$cntkey=$key;
			$cntval=$val;
		}
		foreach($index as $key=>$val){
			$indkey=$key;
			$indval=$val;
		}

		$field=$cntkey . "," . $indkey;

		foreach($arr_content[0] as $key=>$val){
			$field=$field . "," . $key;
		}
		// add login information
		$field=$field . ", login";
		for($cnt=1;$cnt<$max;$cnt++){
			$temp="('" . $cntval ."','" . $indval ."'";
			foreach($arr_content[$cnt] as $key=>$val){
				$temp=$temp . ",'" . $val . "'";
			}

			if(!$values){
				// add value to login field
				$temp=$temp . ",'" . $_REQUEST['login'] . "'";
				$values=$values . $temp . ")";
			}else{
				// add value to login field
				$temp=$temp . ",'" . $_REQUEST['login'] . "'";
				$values=$values . "," . $temp . ")";
			}
			$indval++;
		}

		$sqlquery="insert into " . $tname . "(" . $field . ") values " . $values;
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}
}

function show_content($arr_conts,$rept_content){
	$ind=0;
	$bgcol="#ffffff";
?>

<html><body>
	<table align="center" border="1" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f4f4e4">
	<? for($cnt=0,$j=count($arr_conts)-1;$cnt<$j;$cnt++){


		if($cnt){

			if($rept_content[$ind]==$cnt){ $bgcol="#ffffff";$ind++;}

			else{$bgcol="#c1d2e3";}
		}


	?>
		<tr height="16" bgcolor="<? echo $bgcol; ?>">
		<? foreach($arr_conts[$cnt] as $val){ ?>
			<td align="left" valign="top"><? echo $val; ?></td>
		<?}?>
		</tr><tr height="8" bgcolor="#D9D9A8"><td colspan="<? echo count($arr_conts[$cnt]); ?>"></td></tr>
	<?}?>
</table></body></html>
<?}?>