<?php
require("template.php");
require("gui_common.php");

$login_form = $_REQUEST["login"];
$smenu=$_REQUEST["smenu"];
$sess_id=$_REQUEST["sess_id"];
$msg_alert = $_REQUEST["msg_alert"];
$param =$_REQUEST["param"];

$grp_id = $_REQUEST["grp_id"];

$compName = $_REQUEST["companyName"];


if ($grp_id){
	$sqlquery = "select login,password from access_detail where id='" . $grp_id . "' and companyName='".$compName."'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	while($row = mysql_fetch_row($result)){
		$login_name = $row[0];
		$password = $row[1];
	}
}

if($msg_alert==""){
	$msg="$grp_name Login View Choosess";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();                     //workareatop();

if(!$login_name && $param!=1){
	$msg_alert = "Sorry! No Login name found against your request. Please create Login";
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

<form name="login_view" id="login_view" action="login_update.php"
	method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<tr height="26">
				<td width="479px" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Management</TD>
				<!--<td width="102px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="subgroup_create.php?login=<? echo $login_form ?>&grp_id=<? echo $grp_id ?>&grp_name=<? echo $grp_name ?>&sess_id=<? echo $sess_id ?>&smenu=<? echo $smenu ?>"><img onmouseover="this.src='images/ASGroup1.gif';" onmouseout="this.src='images/ASGroup0.gif'" src="images/ASGroup0.gif" border="0"/></a></TD>-->
				<td width="102px" align="center" background="images/trgt_hdr1.gif"
					class="WorkWht"></TD>
				<td width="76px" align="center" background="images/trgt_hdr1.gif"
					class="WorkWht"><a class="WorkWht"
					href="login_modify.php?login=<? echo $login_form ?>&grp_id=<? echo $grp_id ?>&sess_id=<? echo $sess_id ?>&smenu=<? echo $smenu ?>"><img
					src="images/Edit_Login.gif" border="0" /></a></TD>
				<td width="91px" align="center" background="images/trgt_hdr1.gif"
					class="WorkWht"><a class="WorkWht"
					href="javascript:if (confirm('Are you sure you want to delete <? echo $login_name; ?>?')==true){document.login_view.submit();}else{void('null');}"><img
					src="images/Delete_Login.gif" border="0" /></a></TD>
			</tr>
			<tr>
				<td colspan="4">
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8px" bgcolor="#D9D9A8">
						<td width="250px"></td>
						<td width="388px"></td>
						<td width="110px"></td>
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
						Name&nbsp;:&nbsp;</td>
						<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $cp_name; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>-->

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Login
						Name&nbsp;:&nbsp;</td>
						<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $login_name; ?></td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Password&nbsp;:&nbsp;</td>
						<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $password; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"action\" value=\"3\">";
					print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					print "<input type=\"hidden\" name=\"grp_id\" value=" . $grp_id . ">";
					print "<input type=\"hidden\" name=\"sgrp_id\" value=" . $sgrp_id . ">";
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
					ffooter();
					?>