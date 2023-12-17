<?php
require("template.php");
require("gui_common.php");
//header("Content-type: text/html; charset=windows-874");

$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$treeview_cod = $_REQUEST["treeview_cod"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$list_id = $_REQUEST["list_id"];

if ($list_id != "") {
	$sqlquery = "select scheduler_name,target_id,start_date,end_date,sms_id,no_of_sms,active_status,status,sender_id from list_detail where id='" . $list_id . "' and login_created='" . $login_form . "'";
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
		$a_status=$row[6];
		$status=$row[7];
		$sender_id=$row[8];
	}
}

$sqlquery = "select target_name from target_detail where target_id='" . $target_id . "' and login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

while($row = mysql_fetch_row($result)){
	$target_name = $row[0];
}

$sqlquery = "select message,sms_mode,footer_url,language from rules_detail where archive!=1 and sms_id='" . $rule_id . "' and login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

while($row = mysql_fetch_row($result)){
	$message = $row[0];
	$sms_mode = $row[1];
	$footer_url = $row[2];
	$lang_sms=$row[3];
}

if($lang_sms=='Thai'){
	$message = hexToStr($message);
	$footer_url = hexToStr($footer_url);
}
if($sms_mode == 2){
	$message = hexToStr($message);
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

if(!$schlr_name){
    $msg_alert = "Sorry!!! We Have Not Found Any Schedule Against Your Request.Please Create Schedule";
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler Creation</TD></tr>
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


<form name="list_view" id="list_view" action="list_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="28px">
					<TD width="626px" align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler Creation</TD>
					<TD width="70px" align="left" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="list_modify.php?login=<? echo $login_form ?>&sess_id=<? echo $sess_id; ?>&list_id=<? echo $list_id; ?>&sender_id=<?=$sender_id ?>&smenu=<? echo $smenu; ?>"><img onmouseover="this.src='images/ESchedule1.gif';" onmouseout="this.src='images/ESchedule0.gif'" src="images/ESchedule0.gif" border="0"/></a></TD>	<!-- <img onmouseover="this.src='images/EContest1.gif';" onmouseout="this.src='images/EContest0.gif'" src="images/EContest0.gif" border="0"/> -->
					<TD width="80px" align="left" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:if (confirm('Are you sure you want to delete <? echo $schlr_name;?> schedule?')==true){document.list_view.submit();}else{void('null');}"><img onmouseover="this.src='images/DSchedule1.gif';" onmouseout="this.src='images/DSchedule0.gif'" src="images/DSchedule0.gif" border="0"/></a></TD>	<!-- <img onmouseover="this.src='images/DContest1.gif';" onmouseout="this.src='images/DContest0.gif'" src="images/DContest0.gif" border="0"/> -->
				</tr>
				<tr>
					<td colspan="3">
						<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
							<tr height="8px" bgcolor="#D9D9A8">
                                <td width="160px"></td>
                                <td width="215px"></td>
                                <td width="160px"></td>
                                <td width="215px"></td>
							</tr>
						<? if (strlen($msg_alert) > 0){ ?>
							<tr height="16px" bgcolor="#D9D9A8">
								<TD  align="center" colspan="4" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>
						<? } ?>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Scheduler Name&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $schlr_name; ?></td>
                                <td  align="right" valign="top" class="WorkGreen">Target Name&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $target_name; ?></td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Beginning Date&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $s_date; ?></td>
								<td  align="right" valign="top" class="WorkGreen">Ending Date&nbsp;:&nbsp;</td>
								<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $e_date; ?></td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Beginning Time&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4">
									<select id="s_hour" name="s_hour" class="input" tabindex="4" disabled="disabled">
										<option value="">Hour</option><option value="<? echo $s_hour; ?>" selected="selected"><? echo $s_hour; ?></option>
									</select>
									<select id="s_minute" name="s_minute" class="input" tabindex="5" disabled="disabled">
										<option value="">Minute</option><option value="<? echo $s_minute; ?>" selected="selected"><? echo $s_minute; ?></option>
									</select>
								</td>
                               <td  align="right" valign="top" class="WorkGreen">Ending Time&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4">
									<select id="e_hour" name="e_hour" class="input" tabindex="4" disabled="disabled">
										<option value="">Hour</option><option value="<? echo $e_hour; ?>" selected="selected"><? echo $e_hour; ?></option>
									</select>
									<select id="e_minute" name="e_minute" class="input" tabindex="5" disabled="disabled">
										<option value="">Minute</option><option value="<? echo $e_minute; ?>"selected="selected"><? echo $e_minute; ?></option>
									</select>
								</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen">Choose SMS Type&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? if($sms_mode==2){echo "Wap Push";}else{echo "Text Base";} ?></td>
                                <td align="right" valign="top" class="WorkGreen"><? if($sms_mode==2){echo "Title";}else{echo "Message";} ?>&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $message; ?></td>
							</tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen"><? if($sms_mode==2){echo "URL";}else{echo "Footer Message";} ?>&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $footer_url; ?></td>
								<td  align="right" valign="top" class="WorkGreen">No of Messages&nbsp;:&nbsp;</td>
								<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $msgln; ?></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                              	<td align="right" class="WorkGreen">Sender Id&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $sender_id ?></td>
                              	<td align="right" class="WorkGreen">Active Status&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><?if ($status==1){ echo "On"; }else{echo "Off"; }?></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="4"></td></tr>
<?
	print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
	print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
	print "<input type=\"hidden\" name=\"action\" value=\"3\">";
	print "<input type=\"hidden\" name=\"rule_id\" value =" . $rule_id . ">";
	print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
	print "<input type=\"hidden\" name=\"schlr_name\" value=" . $schlr_name . ">";
	print "<input type=\"hidden\" name=\"target_id\" value=" . $target_id . ">";
	print "<input type=\"hidden\" name=\"list_id\" value=" . $list_id . ">";
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
ffooter_new();
?>
