<?php
require("gui_common.php");
require("template.php");

$action=$_REQUEST["action"];            //1-for NEW,2-for MODIFY,3-for DELETE
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$grp_name = $_REQUEST["cp_name"];
$login_name = $_REQUEST["login_name"];
$password =$_REQUEST["password"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

if($msg_alert==""){
	$msg="Login Creation Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();
?>
<form name="login_create" id="login_create" action="login_update.php"
	method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Creation</TD>
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
						<td align="left" valign="top" class="WorkGreen"><input type="text"
							name="cp_name" value="<? echo $cp_name; ?>" size="45"
							class="input" onmouseover="showIT('Enter the Group name.')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>-->

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Login
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><input type="text"
							name="login_name" value="<? echo $login_name; ?>" size="45"
							class="input" onmouseover="showIT('Enter the Group name.')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Password&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><input type="password"
							name="password" value="<? echo $login_name; ?>" size="45"
							class="input" onmouseover="showIT('Enter the Group name.')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" class="submit1" value="Create Here!!!"
							onclick="login_submit('login_create');"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"action\" value=\"1\">";
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
					<?
					workareabottom();
					ffooter;
					?>