<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$cntsid = $_REQUEST["cnts_id"];
$msisdn = $_REQUEST["msisdn"];
$qstn_id = $_REQUEST["question_id"];
$msg_alert = $_REQUEST["msg_alert"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$e_hour=$_REQUEST["e_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_minute=$_REQUEST["e_minute"];

$start=$_REQUEST["start"];
$start_date=$_REQUEST["start_date"];
$end_date=$_REQUEST["end_date"];
$rand =$_REQUEST["rand"];

$sms_type =$_REQUEST["sms_type"];
if ($sms_type == 1){
	$shortcode =$_REQUEST["shortcode"];
	$keyword =$_REQUEST["cbo_sgroup"];
}

$keywordmis =$_REQUEST["keywordmis"];
if ($keywordmis == 1){
	$shortcode =$_REQUEST["cbo_group"];
	if ($shortcode == ""){
		$shortcode =$_REQUEST["shortcode"];
	}
	$keyword =$_REQUEST["cbo_sgroup"];
}

if ($shortcode == ""){
	$shortcode = "all";
}

if ($cntsid == ""){
	$cntsid = "all";
}



if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}


//$start_date = $s_date;
//$to_date = $e_date . " 23:59:59";

if(!isset($start)){$start = 0;}

$eu = ($start - 0);
$limit = 12;
$c_page = $eu + $limit;
$back = $eu - $limit;
$next = $eu + $limit;


if ($keywordmis == 1){
	if ($shortcode != ""){
		if ($shortcode == "all"){
			if ($keyword == "all"){
				$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
			}else{
				$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and keyword='" . $keyword . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
			}
		}else{
			if ($keyword == "all"){
				$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
			}else{
				$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and keyword='" . $keyword . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
			}
		}
	}
}else{
	if ($cntsid == "all"){
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
				}else{
					$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1'";
				}
			}
		}else{
			$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type<>'1'";
		}
	}else{
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type='1'";
				}else{
					$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type='1'";
				}
			}
		}else{
			$sqlquery = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type<>'1'";
		}
	}
}

//$sqlquery = "select msisdn, score, question_counter, question_correctly_answered from contest_transaction_log where contest_id='" . $cntsid . "' and entry_datetime between '" . $start_date . "' and '" . $to_date . "'";
//echo $sqlquery;
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$nume = mysql_num_rows($result);

if ($keywordmis == 1){
	if ($shortcode != ""){
		if ($shortcode == "all"){
			if ($keyword == "all"){
				$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
			}else{
				$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and keyword='" . $keyword . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
			}
		}else{
			if ($keyword == "all"){
				$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
			}else{
				$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and keyword='" . $keyword . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
			}
		}
	}
}else{
	if ($cntsid == "all"){
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
				}else{
					$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type='1' limit $eu, $limit";
				}
			}
		}else{
			$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and sms_type<>'1' limit $eu, $limit";
		}
	}else{
		if ($sms_type == 1){
			if ($shortcode != ""){
				if ($shortcode == "all"){
					$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type='1' limit $eu, $limit";
				}else{
					$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and shortcode='" . $shortcode . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type='1' limit $eu, $limit";
				}
			}
		}else{
			$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' and contest_id='" . $cntsid . "' and sms_type<>'1' limit $eu, $limit";
		}
	}
}

//$sqlquery1 = "select server_response, user_request from contest_transaction_log where msisdn='" . $msisdn . "' and contest_id='" . $cntsid . "' and request_datetime>='" . $start_date . "' and request_datetime<='" . $end_date ."' limit $eu, $limit";


//echo $sqlquery1;
$result1 = mysql_query($sqlquery1) or die('mysql error:' . mysql_error());

$sqlquery = "select contest_id, contest_name from contest_detail where archive!=1";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$i = 0;
while($row = mysql_fetch_row($result)){
	$cnts_id[$i] = $row[0];
	$cntsname[$i] = $row[1];
	$i = $i + 1;
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
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="620px">
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
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26">
					<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;MIS Report for "<? echo $msisdn ?>" between <? echo $start_date?> to <? echo $end_date?>. Total Record:-<? echo $nume ?></TD>
				</TR>

				<tr>
					<td>
						<table align="left" border="0" cellspacing="1" cellpadding="1" width="748px" bgcolor="#525200" style="table-layout:fixed;">
							<tr height="16px" bgcolor="#D9D9A8">
								<td width="200px" align="center"><b>User Request</b></td>
								<td width="200px" align="center"><b>Server Response</b></td>
							</tr>

							<? if (strlen($msg_alert) > 0){ ?>
								<tr bgcolor="#D9D9A8">
									<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
								</tr>
								<tr height="8px" bgcolor="#D9D9A8"><td colspan="2"></td></tr>
							<? } ?>


							<?while ($noticia = mysql_fetch_array($result1)){
								$server_response = $noticia[0];
								$user_request = $noticia[1];
							?>
								<tr bgcolor="#D9D9A8">
									<td class="WorkBlack">
										<? echo $user_request?>
									</td>
									<td align="left" class="WorkBlack">
										<? echo $server_response?>
									</td>
								</tr>
							<?}?>

							<tr height="8px" bgcolor="#D9D9A8"><td colspan="2"></td></tr>

							<?if ($keywordmis == 1){?>
								<?if($back >=0 && $c_page < $nume){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a>|<a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
									</tr>
								<?}?>

								<?if($back >=0 && $c_page >= $nume){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>Prev</a></td>
									</tr>
								<?}?>

								<?if($c_page < $nume && $back < 0){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&cbo_sgroup=<? echo $keyword ?>&cbo_group=<? echo $shortcode ?>&keywordmis=<? echo $keywordmis ?>' class='WorkGreen'>More</a></td>
									</tr>
								<?}?>
							<?}else{?>
								<?if($back >=0 && $c_page < $nume){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a>|<a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
									</tr>
								<?}?>

								<?if($back >=0 && $c_page >= $nume){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $back ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>Prev</a></td>
									</tr>
								<?}?>

								<?if($c_page < $nume && $back < 0){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td colspan="2" align="right" class="WorkGreen"><a href='msisdndetail.php?login=<? echo $login_form ?>&start=<? echo $next ?>&sess_id=<? echo $sess_id ?>&rand=<? echo $rand ?>&cnts_id=<? echo $cntsid ?>&msisdn=<? echo $msisdn ?>&start_date=<? echo $start_date ?>&end_date=<? echo $end_date ?>&keyword=<? echo $keyword ?>&shortcode=<? echo $shortcode ?>&sms_type=<? echo $sms_type ?>' class='WorkGreen'>More</a></td>
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