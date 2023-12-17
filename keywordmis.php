<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$cntsid = $_REQUEST["cnts_id"];
$qstn_id = $_REQUEST["question_id"];
$msg_alert = $_REQUEST["msg_alert"];
$rand =$_REQUEST["rand"];

if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}


$sqlquery = "select contest_id, contest_name from contest_detail where archive!=1";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$i = 0;
while($row = mysql_fetch_row($result)){
	$cnts_id[$i] = $row[0];
	$cntsname[$i] = $row[1];
	$i = $i + 1;
}

if (strtolower($login_form) == "admin"){
	$sqlquery = "select id,keyword from keyword";
}else{
	$sqlquery = "select id,keyword from keyword where login='" . $login_form . "'";
}
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$i1 = 0;
while($row = mysql_fetch_row($result)){
	$keyword_id[$i1] = $row[0];
	$keyword[$i1] = $row[1];
	$i1 = $i1 + 1;
}

if (strtolower($login_form) == "admin"){
	$sqlquery = "select distinct shortcode from keyword";
}else{
	$sqlquery = "select distinct shortcode from keyword where login='" . $login_form . "'";
}
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$i11 = 0;
while($row = mysql_fetch_row($result)){
	$shortcode[$i11] = $row[0];
	$i11 = $i11 + 1;
}



$arrgroup=array();


if (strtolower($login_form) == "admin"){
	$sqlquery = "select id,keyword,shortcode from keyword";
}else{
	$sqlquery = "select id,keyword,shortcode from keyword where login='" . $login_form . "'";
}

//$sqlquery = "select k.id,k.keyword,k.shortcode from keyword k, keyword k1 where k.shortcode=k1.shortcode";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$cnt=0;$cnt1=0;
while($row = mysql_fetch_row($result)){
	if(!$cnt){
		$grp_ids=$row[2];
		$grp_names=$row[2];
		$cnt++;
	}
	if($grp_ids==$row[2]){
		$sgrp_ids = $sgrp_ids . "," . $row[0];
		$sgrp_names = $sgrp_names . "," . $row[1];
	}else{
		$arrgroup[$cnt1]["id"]=$grp_ids;
		$arrgroup[$cnt1]["name"]=$grp_names;
		$arrgroup[$cnt1]["sid"]=trim($sgrp_ids,",");
		$arrgroup[$cnt1]["sname"]=trim($sgrp_names,",");
		$sgrp_ids="";
		$sgrp_names="";
		$grp_ids=$row[2];
		$grp_names=$row[2];
		$sgrp_ids = $sgrp_ids . "," . $row[0];
		$sgrp_names = $sgrp_names . "," . $row[1];
		$cnt1++;
	}
}

$arrgroup[$cnt1]['id']=$grp_ids;
$arrgroup[$cnt1]['name']=$grp_names;
$arrgroup[$cnt1]['sid']=trim($sgrp_ids,",");
$arrgroup[$cnt1]['sname']=trim($sgrp_names,",");
$max_grp=count($arrgroup);
$group_js="";

for($cnt=0;$cnt<$max_grp;$cnt++){
	if(!$group_js){
		$group_js=$arrgroup[$cnt]['id'] . "@" . $arrgroup[$cnt]['sid'] . ":" . $arrgroup[$cnt]['sname'];
	}else{
		$group_js=$group_js . "|" . $arrgroup[$cnt]['id'] . "@" . $arrgroup[$cnt]['sid'] . ":" . $arrgroup[$cnt]['sname'];
	}
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
if($question == ""){
	$msg_alert = "Sorry!!! We Have Not Found ";
?>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="620px">
				<TR height="22px"><TD class="WorkWht" background="images/menustrip.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Msisdn Wise Report</TD></tr>
				<tr><td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
						<tr height="8px" bgcolor="#eeedf3"><td></td></tr>
						<tr height="22px"><TD  bgcolor="#eeedf3" align="center" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD></tr>
						<tr height="8px"><td bgcolor="#eeedf3"></td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr>
	</table>
<? die();}?>

<form name="contest_form" action="msisdnmisshow.php" method="post" onsubmit="return isValid()">
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">

				<!--<TR height="22px">
					<TD width="620px" class="WorkWht" align="left" valign="top"  background="images/menustrip.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Msisdn Wise Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</TD>
				</TR>
				-->

				<TR height="26">
					<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Keyword Wise Report</TD>
				</TR>


				<tr>
					<td>
						<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200" style="table-layout:fixed;">
							<tr height="8px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>

							<? if (strlen($msg_alert) > 0){ ?>
								<tr bgcolor="#D9D9A8">
									<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
								</tr>
								<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
							<? } ?>


							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="20px" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Select Date/Time from&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2">
									<input type="text" class="input" id="s_date" name='s_date' value="<? echo $s_date; ?>" readonly="readonly" tabindex="-1" />
									<select id="s_hour" name="s_hour" class="input">
										<option value="">Hour</option>
										<? hour_display($s_hour); ?>
									</select>
									<select id="s_minute" name="s_minute" class="input">
										<option value="">Minute</option>
										<? minute_display($s_minute); ?>
									</select>
									<script language="javascript">
										var basicCal = new calendar("FIELD:document.contest_form.s_date;","document.contest_form.s_hour;document.contest_form.s_minute");
										basicCal.writeCalendar();
									</script>
								</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="20px" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">To&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2">
									<input type="text" id="e_date" name='e_date' class="input" value="<? echo $e_date; ?>" readonly="readonly" tabindex="-1" />
									<select id="e_hour" name="e_hour" class="input">
										<option value="">Hour</option>
										<? hour_display($e_hour); ?>
									</select>
									<select id="e_minute" name="e_minute" class="input">
										<option value="">Minute</option>
										<? minute_display($e_minute); ?>
									</select>
									<script language="javascript">
										var basicCal = new calendar("FIELD:document.contest_form.e_date;","document.contest_form.e_hour;document.contest_form.e_minute");
										basicCal.writeCalendar();
									</script>
								</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Short Code&nbsp;:&nbsp;</td>
								<td align="left" class="WorkBlack">
									<select name="cbo_group" class="input" onchange="cbo_group_chng_kword(this.value,'sgrpcbo');">
										<option value="" >Select Short Code</option>
										<? for($cnt=0;$cnt<$max_grp;$cnt++){ ?>
											<option value="<? echo $arrgroup[$cnt]['id']; ?>" <? if($grp_id==$arrgroup[$cnt]['id']){echo "selected=\"selected\"";} ?>><? echo $arrgroup[$cnt]['name']; ?></option>
										<?}?>
									</select>
								</td>
							<td>&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Keyword&nbsp;:&nbsp;</td>
								<td align="left" class="WorkBlack">
									<div id="sgrpcbo" style="display:inline"><select name="cbo_sgroup" class="input">
										<option value="">Select Keyword</option>
									</select></div>
								</td>
							<td>&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<!--
							<tr bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Contest Name&nbsp;:&nbsp;</td>
								<td align="left" class="WorkBlack">
									<select name="cnts_id" class="input">
										<option value="all">All</option>
										<?for ($k=0;$k<$i;$k++){?>
											<option value="<? echo $cnts_id[$k]?>"><? echo $cntsname[$k]?></option>
										<?}?>
									</select>
								</td>
							<td>&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
							-->


							<tr height="16px" bgcolor="#D9D9A8">
								<td align="center" class="WorkGreen" colspan="3"><input type="button" onclick="contest_keyword('contest_form','1')" class="submit1" value="Submit Here!!!" style="background-image:url('images/menu1.gif');" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<!--<td align="center" class="WorkGreen" colspan="3"><input type="submit" class="submit1" value="Submit Here!!!" style="background-image:url('images/menu1.gif');" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>



<?
	print "<input type =hidden name = login value =$login_form>";
	print "<input type=hidden name=sess_id value=$sess_id>";
	print "<input type=hidden name=question_id value=$qstn_id>";
	print "<input type =hidden name=action value =\"3\">";
	print "<input type =hidden name=keywordmis value =\"1\">";
	print "<input type =hidden name=treeview_cod value =$treeview_cod>";
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
	<script laguage="javascript">
		filldata();
		function filldata(){
			cbo_group_chng_kword("<? echo $grp_id; ?>","sgrpcbo","<? echo $group_js; ?>","<? echo $sgrp_id; ?>");
		}
	</script>

<?
workareabottom();
ffooter();			//ffooter();
?>