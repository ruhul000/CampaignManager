<?php
require("gui_common.php");
require("template.php");

$action = $_REQUEST["action"];
$login_form = $_REQUEST["login"];
$grp_id = $_REQUEST["grp_id"];
$msg_alert = $_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$sqlquery = "select cp_name,login from access_detail where id='" . $grp_id . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

while($row = mysql_fetch_row($result)){
	$grp_name = $row[0];
	$grp_desc = $row[1];
}

if($msg_alert==""){
	$msg="Login Modify Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();                     //workareatop();

if(!$grp_id){
	$msg_alert = "Sorry!!! We Have Not Found Any CP Against Your Request.Please Create CP.";
	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Management</TD>
			</tr>
			<tr>
				<td>
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8" bgcolor="#D9D9A8">
						<td></td>
					</tr>
					<tr height="22">
						<TD bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo $msg_alert; ?></TD>
					</tr>
					<tr height="8">
						<td bgcolor="#D9D9A8"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
	<?die();}?>

<form name="login_modify" id="login_modify" action="login_update.php"
	method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Modification</TD>
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

					<!--<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">CP
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $grp_name; ?></TD>
						<TD>&nbsp;</TD>
					</TR>-->

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Login
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><input type="text"
							name="login_name" value="<? echo $grp_desc; ?>" size="45"
							class="input" onmouseover="showIT('Enter the Login name.')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Password&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><input type="password"
							name="password" value="" size="45"
							class="input" onmouseover="showIT('Enter the password.')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" class="submit1"
							onclick="login_submit_modify('login_modify');" value="Modify Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"action\" value=\"2\">";
					print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					print "<input type=\"hidden\" name=\"grp_id\" value=" . $grp_id . ">";
					print "<input type=\"hidden\" name=\"cp_name\" value=" . $grp_name . ">";
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
					<?
					workareabottom();
					ffooter;
					?>