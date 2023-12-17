<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$cntsid = $_REQUEST["cnts_id"];
$qstn_id = $_REQUEST["question_id"];
$sms_type =$_REQUEST["sms_type"];
if ($sms_type == 1){
	$shortcode =$_REQUEST["shortcode"];
	$keyword =$_REQUEST["cbo_sgroup"];
}
$keywordmis =$_REQUEST["keywordmis"];
if ($keywordmis == 1){
	$shortcode =$_REQUEST["cbo_group"];
	$keyword =$_REQUEST["cbo_sgroup"];
}

$msg_alert = $_REQUEST["msg_alert"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$e_hour=$_REQUEST["e_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_minute=$_REQUEST["e_minute"];
$rand =$_REQUEST["rand"];

if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}


$s_date = explode("/",$s_date);
$to_date = explode("/",$e_date);

$start_date = $s_date[2] . "-" . $s_date[0] . "-" . $s_date[1] . " " . $s_hour . ":" . $s_minute . "";
$end_date = $to_date[2] . "-" . $to_date[0] . "-" . $to_date[1] . " " . $e_hour . ":" . $e_minute . "";

$start=$_REQUEST["start"];
if ($start != ""){
	$start_date=$_REQUEST["start_date"];
	$end_date=$_REQUEST["end_date"];
}


if(!isset($start)){$start = 0;}

$eu = ($start - 0);
$limit = 20;
$c_page = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;


if ($keywordmis == 1){
	if ($shortcode != ""){
		if ($shortcode == "all"){
			if ($keyword == "all"){
				$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type='1' order by id desc";
			}else{
				$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and keyword='" . $keyword . "' and sms_type='1' order by id desc";
			}
		}else{
			if ($keyword == "all"){
				$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and sms_type='1' order by id desc";
			}else{
				$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and keyword='" . $keyword . "' and sms_type='1' order by id desc";
			}
		}
	}
}else{
	if ($cntsid == "all"){
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type='1' order by id desc";
				}else{
					$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and sms_type='1' order by id desc";
				}
			}
		}else{
			$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type<>'1' order by id desc";
		}
	}else{
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and contest_id='" . $cntsid . "' and sms_type='1' order by id desc";
				}else{
					$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and contest_id='" . $cntsid . "' and sms_type='1' order by id desc";
				}
			}
		}else{
			$sqlquery = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and contest_id='" . $cntsid . "' and sms_type<>'1' order by id desc";
		}
	}
}

//$sqlquery = "select msisdn, score, question_counter, question_correctly_answered from contest_session where contest_id='" . $cntsid . "'";
//echo $sqlquery;
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$nume = mysql_num_rows($result);
//echo $nume;

if ($keywordmis == 1){
	if ($shortcode != ""){
		if ($shortcode == "all"){
			if ($keyword == "all"){
				$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type='1' order by id desc limit $eu, $limit";
			}else{
				$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and keyword='" . $keyword . "' and sms_type='1' order by id desc limit $eu, $limit";
			}
		}else{
			if ($keyword == "all"){
				$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and sms_type='1' order by id desc limit $eu, $limit";
			}else{
				$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and keyword='" . $keyword . "' and sms_type='1' order by id desc limit $eu, $limit";
			}
		}
	}
}else{
	if ($cntsid == "all"){
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type='1' order by id desc limit $eu, $limit";
				}else{
					$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and sms_type='1' order by id desc limit $eu, $limit";
				}
			}
		}else{
			$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and sms_type<>'1' order by id desc limit $eu, $limit";
		}
	}else{
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and contest_id='" . $cntsid . "' and sms_type='1' order by id desc limit $eu, $limit";
				}else{
					$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and shortcode='" . $shortcode . "' and contest_id='" . $cntsid . "' and sms_type='1' order by id desc limit $eu, $limit";
				}
			}
		}else{
			$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, shortcode, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and contest_id='" . $cntsid . "' and sms_type<>'1' order by id desc limit $eu, $limit";
		}
	}
}
/*
if ($cntsid == "all"){
	if ($keyword == "all"){
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' order by id desc limit $eu, $limit";
	}elseif ($keyword != ""){
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and keyword='" . $keyword . "' order by id desc limit $eu, $limit";
	}else{
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' order by id desc limit $eu, $limit";
	}
}else{
	if ($keyword == "all"){
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where contest_id='" . $cntsid . "' and entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' order by id desc limit $eu, $limit";
	}elseif ($keyword != ""){
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where contest_id='" . $cntsid . "' and entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' and keyword='" . $keyword . "' order by id desc limit $eu, $limit";
	}else{
		$sqlquery1 = "select msisdn, score, question_counter, question_correctly_answered, keyword, contest_id from contest_session where contest_id='" . $cntsid . "' and entry_datetime >= '" . $start_date . "' and entry_datetime <= '" . $end_date . "' order by id desc limit $eu, $limit";
	}
}
*/

//echo "<br/>" . $sqlquery;
$result1 = mysql_query($sqlquery1) or die('mysql error:' . mysql_error());

$sqlquery = "select contest_name from contest_detail where contest_id='" . $cntsid . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
//echo "<br/>" . $sqlquery;
while($row = mysql_fetch_row($result)){
	$cntsname = $row[0];
}

user_session($login_form,$sess_id,$msg);

hheader(7);
tree_code ();
workareatop_new();

?>
<Script language="JavaScript">
function isValid(){
	if(document.ques_view.selectedmodels.length < 3)	{
		alert("Please select at least 4 options.")
		return false
	}
	if(document.ques_view.selectedmodels.length > 6){}
	for(i=1;i<document.ques_view.selectedmodels.length;i++){
		if(document.ques_view.selected_model_numbers.value == "")
			document.ques_view.selected_model_numbers.value = document.ques_view.selectedmodels[i].value
		else
			document.ques_view.selected_model_numbers.value += "," + document.ques_view.selectedmodels[i].value
	}
return true
}
</Script>
<script type="text/javascript">
function fillfield(ldt){
	var objdt1=document.getElementById('s_date'),objdt2=document.getElementById('e_date');
	var objhh1=document.getElementById('s_hour'),objhh2=document.getElementById('e_hour'),objmm1=document.getElementById('s_minute'),objmm2=document.getElementById('e_minute');
	var dO1=make_locdt(new Date(),ldt);
	var dO2=make_locdt(new Date(),ldt);
	dO2.setDate(dO2.getDate()+7);
	dO1.setTime(dO1.getTime()+1800000);
	var hh1=dO1.getHours();
	var hh2=dO2.getHours();
	var mm1=Math.floor(dO1.getMinutes()/10)*10;
	var mm2=Math.floor(dO2.getMinutes()/10)*10;
	var j=0;

	var strtxt="<? echo $futtxt; ?>";
	var strlnk="<? echo $futlnk; ?>";

	if(objdt1.value==""){
		objdt1.value=dO1.getMonth()+1+'/'+dO1.getDate()+'/'+dO1.getFullYear().toString();
	}
	if(objdt2.value==""){
		objdt2.value=dO2.getMonth()+1+'/'+dO2.getDate()+'/'+dO2.getFullYear().toString();
	}
	for(j=1; j<objhh1.options.length;j++){
		if(Number(objhh1.options[j].value)==hh1)objhh1.options[j].selected=true;
		else objhh1.options[j].selected=false;

		if(Number(objhh2.options[j].value)==hh2)objhh2.options[j].selected=true;
		else objhh2.options[j].selected=false;
	}
	for(j=1; j<objmm1.options.length;j++){
		if(Number(objmm1.options[j].value)==mm1)objmm1.options[j].selected=true;
		else objmm1.options[j].selected=false;

		if(Number(objmm2.options[j].value)==mm2)objmm2.options[j].selected=true;
		else objmm2.options[j].selected=false;
	}
	if(document.getElementById('checkbill').checked){
		document.getElementById('bill_mgr').style.display='inline';
	}else{
		document.getElementById('bill_mgr').style.display='none';
	}
	if(document.getElementById('checkscore').checked){
		var rd1=document.getElementsByName('bill_type')[0].checked,rd2=document.getElementsByName('bill_type')[1].checked;
		document.getElementById('negcheck').style.display='inline';
		if(!rd1 && !rd1) document.getElementsByName('bill_type')[0].checked=true;
	}else{
		document.getElementById('negcheck').style.display='none';
	}
	if(document.getElementById('futchk').checked){
				document.getElementById('futdiv').style.display='inline';
				addrow('futdiv',25,strtxt,strlnk);
		}else{
				document.getElementById('futdiv').style.display='none';
	}


	var rd3=document.getElementsByName('futsep')[0].checked,rd4=document.getElementsByName('futsep')[1].checked;

	if(!rd3 && !rd4) document.getElementsByName('futsep')[0].checked=true;
	if(document.getElementsByName('ques_type')[1].checked){document.getElementById('quetsno').disabled=true;}
	else{document.getElementById('quetsno').disabled=false;}
	document.getElementById('left1').value =document.getElementById('welcome_msg').value.length;
	document.getElementById('left2').value =document.getElementById('off_msg').value.length;
	document.getElementById('left3').value =document.getElementById('over_msg').value.length;
	document.getElementById('left4').value =document.getElementById('fut_msg').value.length;
	document.getElementById('left5').value =document.getElementById('rem_msg').value.length;
}

function make_locdt(dtobj,dtstr){
	var dttmp=dtstr.split(/[\/]/);
	dtobj.setDate(dttmp[1]);
	dtobj.setMonth(dttmp[0]-1);
	dtobj.setFullYear(dttmp[2]);
	dtobj.setHours(dttmp[3]);
	dtobj.setMinutes(dttmp[4]);
	return dtobj;
}

</script>
<?

$question = "1";
if($nume == 0){
	$msg_alert = "Sorry!!! We Have Not Found Any Record.";
?>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="22px"><TD class="WorkWht" background="images/menustrip.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contest MIS</TD></tr>
				<tr><td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
						<tr height="8px" bgcolor="#D9D9A8"><td></td></tr>
						<tr height="22px"><TD  bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD></tr>
						<tr height="8px"><td bgcolor="#D9D9A8"></td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr>
	</table>
<? die();}?>

<form name="contest_form" action="question_update.php" method="post" onsubmit="return isValid()">
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26">
					<?if ($sms_type == 1){
						$cntsname = $shortcode;
					}else{
						if ($cntsid == "all"){
							$cntsname = "ALL";
						}else{
							$cntsname = $cntsname;
						}
					}?>
					<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;MIS Report from Date Between <? echo $start_date ?> and <? echo $end_date ?> for "<? echo $cntsname ?>". Total Record:-<? echo $nume ?></TD>
				</TR>

				<tr>
					<td>
						<?if ($sms_type == 1 || $keywordmis == 1){?>
								<table align="left" border="0" cellspacing="1" cellpadding="1" width="748px" bgcolor="#525200" style="table-layout:fixed;">
									<? if (strlen($msg_alert) > 0){ ?>
										<tr bgcolor="#D9D9A8">
											<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
										</tr>
										<tr height="8px" bgcolor="#D9D9A8"><td colspan="6"></td></tr>
									<? } ?>

									<tr height="16px" bgcolor="#D9D9A8">
										<td width="90px" align="center"><b>Msisdn</b></td>
										<td width="110px" align="center"><b>Contest Name</b></td>
										<td width="100px" align="center"><b>Keyword</b></td>
										<td width="100px" align="center"><b>Score</b></td>
										<td width="100px" align="center"><b>Questions Asked</b></td>
										<td width="100px" align="center"><b>Correct Answers</b></td>
									</tr>


									<?while ($noticia = mysql_fetch_array($result1)){
										$msisdn = $noticia[0];
										$score = $noticia[1];
										$question_counter = $noticia[2];
										$question_corr_ans = $noticia[3];
										$keyword1 = $noticia[4];
										if ($keyword1 == ""){
											$keyword1 = "N/A";
										}
										$short_code = $noticia[5];
										$cnts_id = $noticia[6];

										$sqlquery = "select contest_name from contest_detail where contest_id='" . $cnts_id . "'";
										$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

										while($row = mysql_fetch_row($result)){
											$cnts_name = $row[0];
										}



									?>
										<tr bgcolor="#D9D9A8">
											<td align="right" class="WorkBlack">
												<?if ($keywordmis == 1){?>
													<a target='blank' class='WorkBlueNormal' href='msisdndetail.php?msisdn=<? echo $msisdn ?>&cnts_id=<? echo $cntsid ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&login=<? echo $login_form ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>'><? echo $msisdn?></a>
												<?}else{?>
													<a target='blank' class='WorkBlueNormal' href='msisdndetail.php?msisdn=<? echo $msisdn ?>&cnts_id=<? echo $cntsid ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&login=<? echo $login_form ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>'><? echo $msisdn?></a>
												<?}?>
											</td>
											<td align="center" class="WorkBlack">
												<? echo $cnts_name?>
											</td>
											<td align="center" class="WorkBlack">
												<? echo $keyword1?>
											</td>
											<td align="left" class="WorkBlack">
												<? echo $score?>
											</td>
											<td class="WorkBlack">
												<? echo $question_counter?>
											</td>
											<td class="WorkBlack">
												<? echo $question_corr_ans?>
											</td>
										</tr>
									<?}?>

									<tr height="8px" bgcolor="#D9D9A8"><td colspan="6"></td></tr>

									<?if ($keywordmis == 1){?>
										<?if($back >=0 && $c_page < $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a>|<a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>

										<?if($back >=0 && $c_page >= $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a></td>
											</tr>
										<?}?>

										<?if($c_page < $nume && $back < 0){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>
									<?}else{?>
										<?if($back >=0 && $c_page < $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a>|<a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>

										<?if($back >=0 && $c_page >= $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a></td>
											</tr>
										<?}?>

										<?if($c_page < $nume && $back < 0){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="6" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>
									<?}?>

									<?
										print "<input type=hidden name=cnts_id value=$cntsid>";
										print "<input type=hidden name=login value=$login_form>";
										print "<input type=hidden name=sess_id value=$sess_id>";
										print "<input type=hidden name=question_id value=$qstn_id>";
										print "<input type=hidden name=action value=\"3\">";
										print "<input type=hidden name=treeview_cod value=$treeview_cod>";
										print "<input type=hidden name=rand value=$rand>";
									?>
									</table>
							<?}else{?>
								<table align="left" border="0" cellspacing="1" cellpadding="1" width="748px" bgcolor="#525200" style="table-layout:fixed;">
									<? if (strlen($msg_alert) > 0){ ?>
										<tr bgcolor="#D9D9A8">
											<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
										</tr>
										<tr height="8px" bgcolor="#D9D9A8"><td colspan="5"></td></tr>
									<? } ?>

									<tr height="16px" bgcolor="#D9D9A8">
										<td width="100px" align="center"><b>Msisdn</b></td>
										<td width="100px" align="center"><b>Contest Name</b></td>
										<td width="100px" align="center"><b>Score</b></td>
										<td width="100px" align="center"><b>Questions Asked</b></td>
										<td width="100px" align="center"><b>Correct Answers</b></td>
									</tr>


									<?while ($noticia = mysql_fetch_array($result1)){
										$msisdn = $noticia[0];
										$score = $noticia[1];
										$question_counter = $noticia[2];
										$question_corr_ans = $noticia[3];
										$keyword1 = $noticia[4];
										if ($keyword1 == ""){
											$keyword1 = "N/A";
										}
										$short_code = $noticia[5];
										$cnts_id = $noticia[6];

										$sqlquery = "select contest_name from contest_detail where contest_id='" . $cnts_id . "'";
										$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

										while($row = mysql_fetch_row($result)){
											$cnts_name = $row[0];
										}



									?>
										<tr bgcolor="#D9D9A8">
											<td align="right" class="WorkBlack">
												<?if ($keywordmis == 1){?>
													<a target='blank' class='WorkBlueNormal' href='msisdndetail.php?msisdn=<? echo $msisdn ?>&cnts_id=<? echo $cntsid ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&login=<? echo $login_form ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>'><? echo $msisdn?></a>
												<?}else{?>
													<a target='blank' class='WorkBlueNormal' href='msisdndetail.php?msisdn=<? echo $msisdn ?>&cnts_id=<? echo $cntsid ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&login=<? echo $login_form ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>'><? echo $msisdn?></a>
												<?}?>
											</td>
											<td align="center" class="WorkBlack">
												<? echo $cnts_name?>
											</td>
											<td align="left" class="WorkBlack">
												<? echo $score?>
											</td>
											<td class="WorkBlack">
												<? echo $question_counter?>
											</td>
											<td class="WorkBlack">
												<? echo $question_corr_ans?>
											</td>
										</tr>
									<?}?>

									<tr height="8px" bgcolor="#D9D9A8"><td colspan="5"></td></tr>

									<?if ($keywordmis == 1){?>
										<?if($back >=0 && $c_page < $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a>|<a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>

										<?if($back >=0 && $c_page >= $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a></td>
											</tr>
										<?}?>

										<?if($c_page < $nume && $back < 0){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>
									<?}else{?>
										<?if($back >=0 && $c_page < $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a>|<a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>

										<?if($back >=0 && $c_page >= $nume){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a></td>
											</tr>
										<?}?>

										<?if($c_page < $nume && $back < 0){?>
											<tr height="16px" bgcolor="#D9D9A8">
												<td colspan="5" align="right" class="WorkGreen"><a href='msisdnmisshow.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
											</tr>
										<?}?>
									<?}?>

									<?
										print "<input type=hidden name=cnts_id value=$cntsid>";
										print "<input type=hidden name=login value=$login_form>";
										print "<input type=hidden name=sess_id value=$sess_id>";
										print "<input type=hidden name=question_id value=$qstn_id>";
										print "<input type=hidden name=action value=\"3\">";
										print "<input type=hidden name=treeview_cod value=$treeview_cod>";
										print "<input type=hidden name=rand value=$rand>";
									?>
									</table>
							<?}?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
<?
workareabottom();
ffooter();			//ffooter();
?>