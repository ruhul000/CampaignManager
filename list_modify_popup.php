<? require("template.php"); ?>
<link rel="stylesheet" type="text/css" href="style/main.css" title="style">
<link rel="stylesheet" type="text/css" href="style/first.css" title="style">
<link rel="stylesheet" type="text/css" href="style/calendar.css" title="style">
<script src="script/ua.js"></script>
<script src="script/ftiens4.js"></script>
<script src="script/tooltip.js"></script>
<script src="script/client.js"></script>
<script src='script/choosedate_new.js'></script>

<?php
require("gui_common.php");

$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
//$treeview_cod = $_REQUEST["treeview_cod"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$locdt=date('m/d/Y/H/i/s', time());

$schlr_name = $_REQUEST["schlr_name"];
$target_id = $_REQUEST["target_id"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_hour=$_REQUEST["e_hour"];
$e_minute=$_REQUEST["e_minute"];
$list_id = $_REQUEST["list_id"];
$msgln = $_REQUEST["msgln"];

$sqlquery = "select target_id, target_name from target_detail where login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$cnt=0;
while($row = mysql_fetch_row($result)){
	$target_ids[$cnt] = $row[0];
	$target_name[$cnt] = $row[1];
	$cnt++;
}
$maxtg=count($target_ids);

$sqlquery = "select sms_id,message,sms_mode,footer_url,language from rules_detail where archive!=1 and login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$cbosibling="";

$cnt=0;
while($row = mysql_fetch_row($result)){
	$lang_sms=$row[4];
	$arr_sms_id[$cnt] = $row[0];
	$arr_footer_url[$cnt] = $row[3];
	if($lang_sms=='Thai'){
		$arr_message[$cnt] = hexToStr($row[1]);
		$arr_footer_url[$cnt] = hexToStr($row[3]);
	}else{
		$arr_message[$cnt] = $row[1];
	}
	$arr_sms_mode[$cnt] = $row[2];
	if($arr_sms_mode[$cnt] == 2){
                 $arr_message[$cnt] = hexToStr($row[1]);
        }
	$cbosibling=$cbosibling . $row[0] . "||" . $arr_footer_url[$cnt] . '#';
	$cnt++;
}
$cbosibling=trim($cbosibling,'#');
$maxsms=count($arr_sms_id);


if ($list_id != "") {
	$sqlquery = "select scheduler_name,target_id,start_date,end_date,rule_id,no_of_sms,status,sms_type,sender_id from list_detail where id='" . $list_id . "' and login_created='" . $login_form . "'";
	//echo $sqlquery;
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$schlr_name=$row[0];
		$target_id=$row[1];
		$start_time=explode(" ",$row[2]);
		$start_time[0]=preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $start_time[0]);
		$s_date=$start_time[0];
		$temp=explode(":",$start_time[1]);
		$s_hour=$temp[0];
		$s_minute=$temp[1];
		$end_time=explode(" ",$row[3]);
		$end_time[0]=preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $end_time[0]);
		$e_date=$end_time[0];
		$temp=array();
		$temp=explode(":",$end_time[1]);
		$e_hour=$temp[0];
		$e_minute=$temp[1];
		$rule_id=$row[4];
		$msgln=$row[5];
		$status=$row[6];
		$sms_type=$row[7];
		$sender_id = $row[8];
	}
}

user_session($login_form,$sess_id,$msg);
//hheader($smenu);
//tree_code ();
?>

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
	var indx="<? echo $rule_id; ?>";
	var cboname="sms_subs"+"<? echo $sms_type; ?>";
	var content="<? echo $cbosibling; ?>";

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

cbosibling(indx,cboname,content);

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
//workareatop_new();

if(!$maxtg or !$maxsms){
	$msg="";$msg1="SMS Traget";$msg2="SMS Message";
	if(!$maxtg && !$maxsms) {
		$msg=$msg1 . " And " . $msg2;
	}else if(!$maxtg){
		$msg=$msg1;
	}else if(!$maxsms){
		$msg=$msg2;
	}

    $msg_alert = "Sorry!!! We Have Not Found Any " . $msg . " Against Your Request.Please Create " . $msg;
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler Modification</TD></tr>
                <tr><td>
                    <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px"  bgcolor="#525200">
                        <tr height="8" bgcolor="#D9D9A8"><td></td></tr>
                        <tr height="22"><TD  bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo $msg_alert; ?></TD></tr>
                        <tr height="8"><td bgcolor="#D9D9A8"></td></tr>
                    </table>
                </td></tr>
            </table>
        </td></tr>
</table>
<?die();}?>

<form name="list_create" id="list_create" action="list_update_popup.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26">
                    <TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler Modification</TD>
                    <TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
                </TR>
                <tr>
                    <td colspan="2">
                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
                            <tr height="4px" bgcolor="#D9D9A8">
                                <td width="160px"></td>
                                <td width="215px"></td>
                                <td width="160px"></td>
                                <td width="215px"></td>
                            </tr>

                        <?if (strlen($msg_alert) > 0){?>
                            <tr height="16px" bgcolor="#D9D9A8">
                                <TD colspan="4" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>
                        <?}?>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Scheduler Name&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<input class="input" type="text" name="schlr_name" size="20" value="<? echo $schlr_name; ?>" readonly="readonly"/>
                                </TD>
                                <td  align="right" valign="top" class="WorkGreen">Target Name&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<select name="target_id" class="input">
										<option value="">Select Target Name</option>
								<? for ($cnt=0;$cnt<$maxtg;$cnt++) {?>
										<option value="<? echo $target_ids[$cnt]; ?>" <? if($target_ids[$cnt]==$target_id){ echo "selected=\"selected\"";} ?>><? echo $target_name[$cnt]; ?></option>
					            <?}?>
					            	</select>
					            </td>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Beginning Date&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<input type="text" id="s_date" name='s_date' onmouseover="showIT('Specify the dates for the list to be active. The SMS promotional message created the particular campaign is sent to the selected target on the dates mentioned here')" onmouseout="showIT()" class="input" value="<? echo $s_date; ?>" readonly="readonly">
										<script language="javascript">
											var basicCal = new calendar("FIELD:document.list_create.s_date;","document.list_create.s_hour;document.list_create.s_minute");
											basicCal.writeCalendar();
										</script>
                                </TD>
                                <td  align="right" valign="top" class="WorkGreen">Ending Date&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<input type="text" id="e_date" name='e_date' onmouseover="showIT('Specify the dates for the list to be active. The SMS promotional message created the particular campaign is sent to the selected target on the dates mentioned here.')" onmouseout="showIT()" class="input" value="<? echo $e_date; ?>" readonly="readonly">
										<script language="javascript">
											var basicCal = new calendar("FIELD:document.list_create.e_date;","document.list_create.e_hour;document.list_create.e_minute");
											basicCal.writeCalendar();
										</script>
                                </TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Beginning Time&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<select id="s_hour" name="s_hour" class="input" tabindex="4">
										<option value="">Hour</option>
										<?
										//hour_display($s_hour);
											for ($i5=0;$i5<24;$i5++){
												if(strlen($i5)==1){
													$tmpst1="0" . $i5;
													$tmpst2 = "hs0" . $i5;
												}else{
													$tmpst1= "" . $i5;
													$tmpst2= "hs" . $i5;
												}

												if ($tmpst1==$s_hour){?>
													<option value='<? echo $tmpst2 ?>' selected><? echo $tmpst1 ?></option>
												<?}else{?>
													<option value="<? echo $tmpst2 ?>"><? echo $tmpst1 ?></option>
												<?}
											}
										?>
									</select>
									<select id="s_minute" name="s_minute" class="input" tabindex="5">
										<option value="">Minute</option>
										<?
										//minute_display($s_minute);
										for ($ism=0;$ism<60;$ism+=10){
											if(strlen($ism)==1){
												$tmpsm="0" . $ism;
												$tmpsm1="ms0" . $ism;
											}else{
												$tmpsm=$ism;
												$tmpsm1="ms" . $ism;
											}

											if ($tmpsm==$s_minute){?>
												<Option value='<? echo $tmpsm1; ?>' selected='selected'><? echo $tmpsm; ?></Option>
											<?}else{?>
												<Option value='<? echo $tmpsm1; ?>'><? echo $tmpsm; ?></Option>
											<?}
										}


										?>
									</select>
                             </TD>
                                <td  align="right" valign="top" class="WorkGreen">Ending Time&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
									<select id="e_hour" name="e_hour" class="input">
										<option value="">Hour</option>
										<?
											//hour_display($e_hour);
											for ($i4=0;$i4<24;$i4++){
												if(strlen($i4)==1){
													$tmpet="0" . $i4;
													$tmpet1="he0" . $i4;
												}else{
													$tmpet=$i4;
													$tmpet1="he" . $i4;
												}

												if ($tmpet==$e_hour){?>
													<option value="<? echo $tmpet1; ?>" selected="selected"><? echo $tmpet; ?></option>
												<?}else{?>
													<option value="<? echo $tmpet1; ?>"><? echo $tmpet; ?></option>
												<?}
											}
										?>
									</select>
									<select id="e_minute" name="e_minute" class="input" tabindex="5">
										<option value="">Minute</option>
										<?
										//minute_display($e_minute);
										for ($iem=0;$iem<60;$iem+=10){
											if(strlen($iem)==1){
												$tmpem="0" . $iem;
												$tmpem1="me0" . $iem;
											}else{
												$tmpem=$iem;
												$tmpem1="me" . $iem;
											}

											if ($tmpem==$e_minute){?>
												<Option value='<? echo $tmpem1; ?>' selected='selected'><? echo $tmpem; ?></Option>
											<?}else{?>
												<Option value='<? echo $tmpem1; ?>'><? echo $tmpem; ?></Option>
											<?}
										}


										?>
									</select>
                             </TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Choose SMS Type&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen">
									Text Base&nbsp;:&nbsp;<input type="radio" name ="sms_type" value="1" <?if($sms_type==1||!$sms_type) echo "checked=\"checked\""; ?> onclick="document.getElementById('txtsms').style.display='inline';document.getElementById('wapsms').style.display='none';" onmouseover="showIT('Choose Way To Send A Message.')" onmouseout="showIT()"/>&nbsp;&nbsp;&nbsp;&nbsp;
									Wap Push&nbsp;:&nbsp;<input type="radio" name ="sms_type" value="2" <?if($sms_type==2) echo "checked=\"checked\""; ?> onclick="document.getElementById('txtsms').style.display='none';document.getElementById('wapsms').style.display='inline';" onmouseover="showIT('Choose Way To Send A Message.')" onmouseout="showIT()"/>
								</td>
                                <td  align="right" valign="top" class="WorkGreen">No of Messages&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
                                	<input class="input" type="text" name="msgln" size="8" maxlength="6" value="<? echo $msgln; ?>" onmouseover="showIT('Specify the number of times that you want the SMS message to be delivered to each contact in the target group.')" onmouseout="showIT()"/>
                                </td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>



							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="4">
                                	<div id="txtsms" <? if($sms_type==1||!$sms_type){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
										<table border="0" cellspacing="0" cellpadding="0" width="748px">
											<tr height="1px" bgcolor="#D9D9A8">
												<td width="160px"></td>
												<td width="215px"></td>
												<td width="160px"></td>
												<td width="215px"></td>
											</tr>

											<tr height="16px" bgcolor="#D9D9A8">
												<td align="right" valign="top" class="WorkGreen">Message Text&nbsp;:&nbsp;</TD>
												<td align="left" valign="top" class="WorkGreen">
                            						<select name="sms_msg_id" onchange="cbosibling(this.value,'sms_subs1')" class="input">
														<option value="">Select Message Text</option>
<? for ($cnt=0;$cnt<$maxsms;$cnt++) {
	if($arr_sms_mode[$cnt]==2){
		continue;
	}else{
?>														<option value="<? echo $arr_sms_id[$cnt]; ?>" <? if($arr_sms_id[$cnt]==$rule_id){ echo "selected=\"selected\"";} ?>><? echo substr($arr_message[$cnt],0,25); ?></option>
<?	}
}?>
					            					</select>
					            				</td>
												<td  align="right" valign="top" class="WorkGreen">Message Footer&nbsp;:&nbsp;</TD>
												<td align="left" valign="top" class="WorkGreen">
													<TextArea rows="3" cols="28" name="sms_subs1" id="sms_subs1" class="input" readonly="readonly"><?for ($cnt=0;$cnt<$maxsms;$cnt++) {if($arr_sms_id[$cnt]==$rule_id){echo $arr_footer_url[$cnt];}}?></TextArea>
 					            				</td>
					            			</tr>
					            		</table>
					            	</div>
					            	<div id="wapsms" <? if($sms_type==2){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
										<table border="0" cellspacing="0" cellpadding="0" width="748px">
											<tr height="1px" bgcolor="#D9D9A8">
												<td width="160px"></td>
												<td width="215px"></td>
												<td width="160px"></td>
												<td width="215px"></td>
											</tr>

											<tr height="16px" bgcolor="#D9D9A8">
												<td align="right" valign="top" class="WorkGreen">Message Title&nbsp;:&nbsp;</TD>
												<td align="left" valign="top" class="WorkGreen">
                            						<select name="wap_title_id" onchange="cbosibling(this.value,'sms_subs2')" class="input">
														<option value="">Select Message Title</option>
<? for ($cnt=0;$cnt<$maxsms;$cnt++) {
	if($arr_sms_mode[$cnt]==1){
		continue;
	}else{
?>														<option value="<? echo $arr_sms_id[$cnt]; ?>" <? if($arr_sms_id[$cnt]==$rule_id){ echo "selected=\"selected\"";} ?>><? echo substr($arr_message[$cnt],0,25); ?></option>
<?	}
}?>
					            					</select>
					            				</td>
												<td  align="right" valign="top" class="WorkGreen">URL&nbsp;:&nbsp;</TD>
												<td align="left" valign="top" class="WorkGreen">
													<TextArea rows="3" cols="28" name="sms_subs2" id="sms_subs2" class="input" readonly="readonly"><?for ($cnt=0;$cnt<$maxsms;$cnt++) {if($arr_sms_id[$cnt]==$rule_id){echo $arr_footer_url[$cnt];}}?></TextArea>
					            				</td>
					            			</tr>
					            		</table>
					            	</div>
					            </td>
                            </tr>
					        <tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Sender Id&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen">
									<input type="text" id="sender_id" name ="sender_id" value="<?=$sender_id ?>" onmouseover="showIT('Enter sender id.')" onmouseout="showIT()"/>&nbsp;&nbsp;&nbsp;&nbsp;
								</td>
                                <td  align="right" valign="top" class="WorkGreen">&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
                                	&nbsp;
                                </td>
							</tr>
                            <tr height="8px" bgcolor="#d9d9a8"><td colspan="4"></td></tr>
                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Active Status&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
                                    <select name="active_status" class="input">
                                        <option value="1" <?if ($status){ echo "selected='selected'"; }?>>On</option>
                                        <option value="0" <?if (!$status){ echo "selected='selected'"; }?>>Off</option>
                                    </select>
					            </td>
                                <td colspan="2"></td>
                            	</tr>
                            	<tr height="8px" bgcolor="#d9d9a8"><td colspan="4"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="center" class="WorkGreen" colspan="4"><input type="button" class="submit1" value="Modify Here!!!" onclick="list_submit('list_create');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Close!!" class="submit1" onclick="JavaScript:window.close();" style="background-image:url('images/menu1.gif');" tabindex="33">&nbsp;&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

<?
	print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
	print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
	print "<input type=\"hidden\" name=\"action\" value=\"2\">";
	print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
	print "<input type=\"hidden\" name=\"locdt\" value =" . $locdt . ">";
	print "<input type=\"hidden\" name=\"list_id\" value =" . $list_id . ">";


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
<script language="javascript" type='text/javascript'>
	fillfield("<? echo $locdt; ?>");
</script>
<?
//workareabottom();
//ffooter;
?>
