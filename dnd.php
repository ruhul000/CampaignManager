<?php
require("gui_common.php");
require("template.php");
?>
<script laguage="javascript">
function getCheck(){
	if(document.getElementById('newUpload').checked){
		document.getElementById('checkValue').value=1;
	}else{document.getElementById('checkValue').value=0;}
}
</script>

<?

$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$grp_name = $_REQUEST["grp_name"];
$grp_desc = $_REQUEST["grp_desc"];
if($_REQUEST["display"]==1)
{
	$path=$_REQUEST["path"];
	$display=1;
}else{
	$display=0;
	$path="";
}


$arrgroup=array();

$sqlquery="select grp.group_id,grp.group_name,sgrp.subgroup_id,sgrp.subgroup_name from group_detail grp,subgroup_detail sgrp where grp.group_id=sgrp.group_id and grp.active_status=sgrp.active_status and grp.active_status=1 and grp.login='" . $login_form . "' order by grp.group_id";
$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());

$cnt=0;$cnt1=0;
while($row = mysql_fetch_row($result)){
	if(!$cnt){
		$grp_ids=$row[0];
		$grp_names=$row[1];
		$cnt++;
	}
	if($grp_ids==$row[0]){
		$sgrp_ids = $sgrp_ids . "," . $row[2];
		$sgrp_names = $sgrp_names . "," . $row[3];
	}else{
		$arrgroup[$cnt1]["id"]=$grp_ids;
		$arrgroup[$cnt1]["name"]=$grp_names;
		$arrgroup[$cnt1]["sid"]=trim($sgrp_ids,",");
		$arrgroup[$cnt1]["sname"]=trim($sgrp_names,",");
		$sgrp_ids="";
		$sgrp_names="";
		$grp_ids=$row[0];
		$grp_names=$row[1];
		$sgrp_ids = $sgrp_ids . "," . $row[2];
		$sgrp_names = $sgrp_names . "," . $row[3];
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

if($msg_alert==""){
	$msg="Group Creation Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

if(!$arrgroup[0]['id']){
	$msg_alert = "Sorry!!! We Have Not Found Any Group or Sub Group Against Your Request.Please Create Group or Sub Group";
	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;DND Formulation</TD>
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

<script laguage="javascript">
	function filldata(){
		cbo_group_chng("<? echo $grp_id; ?>","sgrpcbo","<? echo $group_js; ?>","<? echo $sgrp_id; ?>");
	}
</script>

<form name="dnd_create" id="dnd_create" action="dnd_update.php"
	enctype="multipart/form-data" method="post">
<table align="left" border="1" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;DND Formulation</TD>
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

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Group
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen" colspan="2"><select
							name="cbo_group" class="input"
							onchange="cbo_group_chng(this.value,'sgrpcbo');">
							<option value="">Select Group Name</option>
							<? for($cnt=0;$cnt<$max_grp;$cnt++){ ?>
							<option value="<? echo $arrgroup[$cnt]['id']; ?>"
							<? if($grp_id==$arrgroup[$cnt]['id']){echo "selected=\"selected\"";} ?>><? echo $arrgroup[$cnt]['name']; ?></option>
							<?}?>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Sub Group Name&nbsp;:&nbsp;
						<div id="sgrpcbo" style="display: inline"><select
							name="cbo_sgroup" class="input">
							<option value="">Select Sub Group Name</option>
						</select></div>

						</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Upload MSISDN&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" id="sgroup"><input type="file"
							name="file" size="20"
							onMouseOver="showIT('Upload msisdn txt file in one msisdn per line')"
							onMouseOut="showIT()" class="input"></td>
						<TD>&nbsp;</TD>
					</tr>
					<tr height="8">
						<td bgcolor="#D9D9A8" class="bold_red_text"></td>
						<td bgcolor="#D9D9A8">(Click here for <a class="bold_red_text"
							coords="50,20,50,20" target="_blank" href="msisdnhelp.php">Sample
						File</a>)</td>
						<TD bgcolor="#D9D9A8" align="left">&nbsp;<? if($display==1){?><a
							class="bold_red_text" href="dn_msisdn.php?path=<?echo $path;?>">Download
						Dnd Zip File</a><?}?></TD>
					</tr>
					<tr height="8">
						<td colspan="3" bgcolor="#D9D9A8"></td>
					</tr>
					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">&nbsp;&nbsp;&nbsp;Click Here
						To New Upload:</td>
						<td align="left" colspan="2">&nbsp;&nbsp;<input type="checkbox"
							id="newUpload" name="newUpload" onclick="getCheck();"><input
							type="hidden" id="checkValue" name="checkValue"></td>
					</tr>
					<tr height="8">
						<td colspan="3" bgcolor="#D9D9A8"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" onclick="dnd_submit('dnd_create')" class="submit1"
							value="Create Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";

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
</script>
<div
	id="TTipes"
	style="position: absolute; height: 25px; z-index: 1; display: none; visibility: hidden;"></div>
					<?
					workareabottom();
					ffooter;
					?>