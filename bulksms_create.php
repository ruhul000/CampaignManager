<?php
require("template.php");
require("gui_common.php");

$login_form=$_REQUEST["login"];
$msg_alert=$_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$treeview_cod = $_REQUEST["treeview_cod"];

$sms_type=$_REQUEST["sms_type"];
$sms_msg=$_REQUEST["sms_msg"];
$sms_footer=$_REQUEST["sms_footer"];
$wap_url=$_REQUEST["wap_url"];
$wap_title=$_REQUEST["wap_title"];

if($msg_alert==""){
	$msg="Bulk SMS Creation Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();
?>
<form name="bulksms_create" id="bulksms_create"
	action="bulksms_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;SMS Broadcast</TD>
				<TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
			</TR>
			<tr>
				<td colspan="2">
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8px" bgcolor="#D9D9A8">
						<td width="230px"></td>
						<td width="340px"></td>
						<td width="178px"></td>
					</tr>

					<?if (strlen($msg_alert) > 0){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?}?>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Choose SMS Type&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen">Text Base&nbsp;:&nbsp;<input
							type="radio" name="sms_type" value="1"
							<?if($sms_type==1||!$sms_type) echo "checked=\"checked\""; ?>
							onclick="document.getElementById('txtsms').style.display='inline';document.getElementById('wapsms').style.display='none';"
							onmouseover="showIT('Text based message')" onmouseout="showIT()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Wap Push&nbsp;:&nbsp;<input type="radio" name="sms_type" value="2"
						<?if($sms_type==2) echo "checked=\"checked\""; ?>
							onclick="document.getElementById('txtsms').style.display='none';document.getElementById('wapsms').style.display='inline';"
							onmouseover="showIT('Wap Push based message')"
							onmouseout="showIT()" /></td>
						<TD>&nbsp;</TD>

					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="txtsms"
						<? if($sms_type==1||!$sms_type){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="1px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>
							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Language
								Type&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><select
									name="lang_sms" class="input">
									<option value="">--Select Language--</option>
									<option value="English">English</option>
									<option value="Thai">Thai</option>
								</select></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"><input type='hidden' name='service_name' value=''></td>
							</tr>
<!--							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Service
								Name&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><select
									name="service_name" id="service_name" class="input"
									onmouseover="showIT(this.form.service_name.value)"
									onmouseout="showIT()">
									<option value="">--Select Service--</option>
									<? echo get_service(); ?>
								</select></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
 -->
							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Message&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen"><TextArea
									onmouseover="showIT('Enter SMS message')" onmouseout="showIT()"
									rows="3" cols="44" name="sms_msg" id="sms_msg" class="input"
									onKeyDown="var lenCount =800;if(this.form.lang_sms.value=='Thai'){lenCount = 350;}CountLeft(this.form.sms_msg,this.form.left1,lenCount);"
									onKeyUp="var lenCount =800;if(this.form.lang_sms.value=='Thai'){lenCount = 350;}CountLeft(this.form.sms_msg,this.form.left1,lenCount);"><? echo $sms_msg; ?></TextArea>
								<input type="text" name="left1" id="left1" size="3"
									maxlength="3" value="0" readonly="readonly" class="input" /></TD>
								<TD>&nbsp;</TD>
							</TR>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Footer
								Message&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen"><input
									type="text" name="sms_footer" value="<? echo $sms_footer; ?>"
									size="45" class="input"
									onmouseover="showIT('Enter the SMS Footer Message.')"
									onmouseout="showIT()" /></TD>
								<TD>&nbsp;</TD>
							</TR>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="wapsms"
						<? if($sms_type==2){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="1px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>

							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Title&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen"><input
									type="text" name="wap_title" value="<? echo $wap_title; ?>"
									size="45" class="input"
									onmouseover="showIT('Enter the WAP Message Title.')"
									onmouseout="showIT()" /></TD>
								<TD>&nbsp;</TD>
							</TR>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">URL&nbsp;:&nbsp;</TD>
								<td align="left" valign="top" class="WorkGreen"><input
									type="text" name="wap_url" value="<? echo $wap_url; ?>"
									size="45" class="input"
									onmouseover="showIT('Enter the WAP Message Title.')"
									onmouseout="showIT()" /></TD>
								<TD>&nbsp;</TD>
							</TR>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" class="submit1" value="Create Here!!!"
							onclick="bulksms_submit('bulksms_create');"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"page\" value=\"1\">";
					print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					?>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
<div
	id="TTipes"
	style="position: absolute; height: 25px; z-index: 1; display: none; visibility: hidden;"></div>
<script type="text/javascript">
	fillfield();
	function fillfield(){
		document.getElementById('left1').value =document.getElementById('sms_msg').value.length;
	}
</script>
					<?
					workareabottom();
					ffooter;
					?>
