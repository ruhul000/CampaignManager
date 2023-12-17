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
$mistype = $_REQUEST["mistype"];

if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}


if ($mistype == 1){
	$sqlquery = "select contest_id, contest_name from contest_detail";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$i = 0;
	while($row = mysql_fetch_row($result)){
		$cnts_id[$i] = $row[0];
		$cntsname[$i] = $row[1];
		$i = $i + 1;
	}
}else{
	$sqlquery = "select voting_id, voting_name from voting_detail";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$i = 0;
	while($row = mysql_fetch_row($result)){
		$cnts_id[$i] = $row[0];
		$cntsname[$i] = $row[1];
		$i = $i + 1;
	}
}

$sqlquery = "select distinct shortcode from keyword";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$i1 = 0;
while($row = mysql_fetch_row($result)){
	$shortcode[$i1] = $row[0];
	$i1 = $i1 + 1;
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

<form name="contest_form" action="vdatewisescore1.php" method="post" onsubmit="return isValid()">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26">
                    <TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Date Wise Report</TD>
                    <TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
                </TR>
                <tr>
                    <td colspan="2">
                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
                            <tr height="8px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
                           </tr>

                        <?if (strlen($msg_alert) > 0){?>
                            <tr height="16px" bgcolor="#D9D9A8">
                                <TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
                        <?}?>


							<tr height="26px" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Select Date&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2">
									<input type="text" id="s_date" name='s_date' class="input" value="<? echo $s_date; ?>" readonly="readonly" tabindex="-1" />


									<input type="hidden" name='s_hour'/>
									<input type="hidden" name='s_minute'/>

									<script language="javascript">
										var basicCal = new calendar("FIELD:document.contest_form.s_date;","document.contest_form.s_hour;document.contest_form.s_minute");
										basicCal.writeCalendar();
									</script>
								</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<?if ($mistype == 1){?>
								<tr bgcolor="#D9D9A8">
									<td align="right" class="WorkGreen">Contest Name&nbsp;:&nbsp;</td>
									<td align="left" class="WorkBlack">
										<select name="cnts_id" class="input">
											<option value="">Select Contest Name</option>
											<?for ($k=0;$k<$i;$k++){?>
												<option value="<? echo $cnts_id[$k]?>"><? echo $cntsname[$k]?></option>
											<?}?>
										</select>
									</td>
								<td>&nbsp;</td>
								</tr>
							<?}else{?>
								<tr bgcolor="#D9D9A8">
									<td align="right" class="WorkGreen">Voting Name&nbsp;:&nbsp;</td>
									<td align="left" class="WorkBlack">
										<select name="cnts_id" class="input">
											<option value="">Select Voting Name</option>
											<?for ($k=0;$k<$i;$k++){?>
												<option value="<? echo $cnts_id[$k]?>"><? echo $cntsname[$k]?></option>
											<?}?>
										</select>
									</td>
								<td>&nbsp;</td>
								</tr>
							<?}?>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Choose Type&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen">
									SMS&nbsp;:&nbsp;<input type="radio" name ="sms_type" value="1" <?if($sms_type==1||!$sms_type) echo "checked=\"checked\""; ?> onclick="document.getElementById('txtsms').style.display='inline';document.getElementById('wapsms').style.display='none';" onmouseover="showIT('Choose Way To Send A Message.')" onmouseout="showIT()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Wap&nbsp;:&nbsp;<input type="radio" name ="sms_type" value="2" <?if($sms_type==2) echo "checked=\"checked\""; ?> onclick="document.getElementById('txtsms').style.display='none';document.getElementById('wapsms').style.display='inline';" onmouseover="showIT('Choose Way To Send A Message.')" onmouseout="showIT()"/>
								</td>
								<TD>&nbsp;</TD>

							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3">
									<div id="txtsms" <? if($sms_type==1||!$sms_type){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
										<table border="0" cellspacing="0" cellpadding="0" width="748px">
											<tr height="1px" bgcolor="#D9D9A8">
												<td width="230px"></td>
												<td width="340px"></td>
												<td width="178px"></td>
											</tr>
											<tr height="16px" bgcolor="#D9D9A8">
												<td align="right" valign="top" class="WorkGreen">Short Code&nbsp;:&nbsp;</TD>
												<td align="left" valign="top" class="WorkGreen">
													<select name="shortcode" class="input">
														<option value="" >Select Short Code</option>
														<? for($cnt=0;$cnt<count($shortcode);$cnt++){ ?>
															<option value="<? echo $shortcode[$cnt]; ?>"><? echo $shortcode[$cnt]; ?></option>
													</select>
													<?}?>
												</TD>
												<TD>&nbsp;</TD>
											</TR>
											<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

											<?if ($mistype == 1){?>
												<tr height="16" bgcolor="#D9D9A8">
													<td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="contest_datewise('contest_form');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
												</tr>
											<?}else{?>
												<tr height="16" bgcolor="#D9D9A8">
													<td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="voting_datewise('contest_form');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
												</tr>
											<?}?>

										</table>
									</div>
								</td>
							</tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3">
									<div id="wapsms" <? if($sms_type==2){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
										<table border="0" cellspacing="0" cellpadding="0" width="748px">
											<?if ($mistype == 1){?>
												<tr height="16" bgcolor="#D9D9A8">
													<td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="contest_datewise1('contest_form');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
												</tr>
											<?}else{?>
												<tr height="16" bgcolor="#D9D9A8">
													<td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="voting_datewise1('contest_form');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
												</tr>
											<?}?>
										</table>
									</div>
								</td>
							</tr>

                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?
    print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
    print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
    print "<input type=\"hidden\" name=\"page\" value=\"1\">";
    print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
    print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
    print "<input type=\"hidden\" name=\"mistype\" value=" . $mistype . ">";
?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<div id="TTipes" style="position:absolute; height:25px; z-index:1; display: none; visibility: hidden;" ></div>
<?
workareabottom();
ffooter;
?>