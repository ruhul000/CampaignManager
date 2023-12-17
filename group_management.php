<?php
require("gui_common.php");
require("template.php");

$smenu=$_REQUEST["smenu"];
$action=$_REQUEST["action"];
$treeview_cod=$_REQUEST["treeview_cod"];
$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];

$msg_alert = $_REQUEST["msg_alert"];
$subgrp_name = $_REQUEST["subgrp_name"];
$subgrp_desc = $_REQUEST["subgrp_desc"];
$sg = $_REQUEST["sg"];
$gid = $_REQUEST["gid"];
$sgid = $_REQUEST["sgid"];
$act = $_REQUEST["act"];
$subgid = $sgid;
if ($act == 4){
	$sgid = "";
}

if ($subgrp_name == ""){
	$sqlquery = "select distinct subgroup_name, description, active_status from subgroup_detail where subgroup_id='" . $sgid . "' and login='" . $login_form . "' limit 1";
	//echo $sqlquery;
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	$i = 0;
	while($row = mysql_fetch_row($result)){
		$subgrp_name = $row[0];
		$subgrp_desc = $row[1];
		$subact_status = $row[2];
		$i = 1;
		//echo "sfsd" . $grp_name;
	}
}

$sqlquery = "select distinct group_name, description, active_status from group_detail where group_id='" . $gid . "' and login='" . $login_form . "' limit 1";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$j = 0;
while($row = mysql_fetch_row($result)){
	$grp_name = $row[0];
	$grp_desc = $row[1];
	$act_status = $row[2];
	$j = 1;
	//echo "sfsd" . $grp_name;
}

if ($msg_alert == ""){
	if ($act == 4){
		$subgrp_name = "";
		$subgrp_desc = "";
		$subact_status = "";
	}
}

if($msg_alert==""){
	$msg="Group Creation Choosess";
}else{
	$msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();
?>
	<script src="group_js.js"></script>

	<script language="JavaScript">
			function cnts_submit (){
			document.login_form.submit();
		}

		function chek()
		{
			document.login_form.subgrp_id_new.value=document.login_form.subgroup_id.value;
		}

		function validate()
		{
			var group_name;
			group_name = document.login_form.group_name.value;
			if (group_name == ""){
				alert("Please enter Group name!!!");
			}
		}
	</script>
	<script type="text/javascript">
		/****TO VALIDATE THE FIELD****/
		function validate_required(field,alerttxt)
		{
			with (field){
				if (value==null||value==""){
					alert(alerttxt);return false;
				}else{
					return true
				}
			}
		}

		/****TO VALIDATE EVERY FORM TEXTBOX****/
		function validate_form(thisform)
		{
			with (thisform){
				if (validate_required(group_name,"Please enter Group name!!!")==false){
					group_name.focus();
					return false;
				}else if (validate_required(group_desc,"Please enter Description!!!")==false){
					group_desc.focus();
					return false;
				}
			}
	}
	</script>
<?

if ($sg == 1){
?>

<TABLE ALIGN="left" BORDER=0 CELLSPACING=1 CELLPADDING=0 WIDTH="80%" bgcolor="#525200">
<form name=login_form action="group_create_update.php" method="post" enctype="multipart/form-data" onsubmit="return validate_form(this)">
<tr>
	<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f4f4e4">
			<TR>
				<TD height="26" width="70%" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Group Management</TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="group_management.php?login=<? echo $login_form ?>&gid=<? echo $gid ?>&sgid=<? echo $subgid ?>&act=4&sg=<? echo $sg ?>">Add New</a></TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="group_management.php?login=<? echo $login_form ?>&gid=<? echo $gid ?>&sgid=<? echo $subgid ?>&act=2&sg=<? echo $sg ?>">Edit</a></TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="group_management.php?login=<? echo $login_form ?>&gid=<? echo $gid ?>&sgid=<? echo $subgid ?>&act=3&sg=<? echo $sg ?>">Delete</a></TD>
			</TR>
			<TR>
				<TD colspan="4">
					<TABLE ALIGN="center" BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%"  bgcolor='#525200'>

					<?if (strlen($msg_alert) > 0){?>

						<TR>
						<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
						<TD  bgcolor="#D9D9A8" align="left"><?echo ucfirst($msg_alert)?></TD>
						<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
						</TR>
					<?}?>

						<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

						<TR>
							<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="40%" ALIGN="right">Group Name :&nbsp;</TD>
							<TD colspan="2">
								<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH='100%'>
									<TR>
										<TD class="WorkGreen"  bgcolor="#D9D9A8" align='left' WIDTH="40%">
											<?if ($act == 1 || $act == 3){?>
												<label for="female"><? echo $grp_name ?></label>
											<?}else{?>
												<label for="female"><? echo $grp_name ?></label>
											<?}?>
										<TD class="WorkRed" id="txtHint"  bgcolor="#D9D9A8" align='left' WIDTH="60%">&nbsp;</TD>
									</TR>
								</TABLE>
							</TD>
						</TR>

						<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

						<TR>
							<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="40%" ALIGN="right">Sub Group Name :&nbsp;</TD>
							<TD colspan="2">
								<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH='100%'>
									<TR>
										<TD class="WorkGreen"  bgcolor="#D9D9A8" align='left' WIDTH="40%">
											<?if ($act == 1 || $act == 3){?>
												<label for="female"><? echo $subgrp_name ?></label>
											<?}else{?>
												<input type="text" name="subgroup_name" value="<? echo $subgrp_name ?>" size="22" class="input" onchange="showCustomer(this.value,'<? echo $login_form ?>','8')" onmouseover="toolTip('Please enter the group name.','#000000', '#FFFF99')" onmouseout="toolTip()" /></TD>
											<?}?>
										<TD class="WorkRed" id="txtHint"  bgcolor="#D9D9A8" align='left' WIDTH="60%">&nbsp;</TD>
									</TR>
								</TABLE>
							</TD>
						</TR>

						<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

						<TR>
							<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="40%" ALIGN="right">Sub Group Description :&nbsp;</TD>
							<TD colspan="2">
								<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH='100%'>
									<TR>
										<TD class="WorkGreen"  bgcolor="#D9D9A8" align='left' WIDTH="40%">
											<?if ($act == 1 || $act == 3){?>
												<label for="female"><? echo $subgrp_desc ?></label>
											<?}else{?>
												<input type="text" name="subgroup_desc" value="<? echo $subgrp_desc ?>" size="22" class="input" onchange="showCustomer(this.value,'<? echo $login_form ?>','8')" onmouseover="toolTip('Please enter the group name.','#000000', '#FFFF99')" onmouseout="toolTip()" /></TD>
											<?}?>
										<TD class="WorkRed" id="txtHint"  bgcolor="#D9D9A8" align='left' WIDTH="60%">&nbsp;</TD>
									</TR>
								</TABLE>
							</TD>
						</TR>

						<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

						<?if ($act != 4){?>
							<TR>
								<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="40%" ALIGN="RIGHT">Active Status :&nbsp;</TD>
								<TD  bgcolor="#D9D9A8" WIDTH="50%">
									<?if ($act == 1 || $act == 3){?>
										<?if ($subact_status == 1){
											$a_st = "On";
										}else{
											$a_st = "Off";
										}?>
										<label for="female"><? echo $a_st ?></label>
									<?}elseif ($act != 4){?>
										<select name="subact_status" class="input">
											<?if ($subact_status == 1){?>
												<option value="1" selected>On</option>
												<option value="0">Off</option>
											<?}else{?>
												<option value="1">On</option>
												<option value="0" selected>Off</option>
											<?}?>
										</select>
									<?}?>

								</TD>
								<TD class="WorkBldGreen"  bgcolor="#D9D9A8" WIDTH="20%" ALIGN="RIGHT">&nbsp;</TD>
							</TR>
						<?}?>
						<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

						<?if ($act != 1){?>
							<TR>
								<TD colspan="3" ALIGN="center"  bgcolor="#D9D9A8" ><img onmouseover="this.src='images/Submit_Rollout.png';" onmouseout="this.src='images/Submit_Rollover.png'" src="images/Submit_Rollover.png" value="Submit" onClick="cnts_submit()"></TD>
							</TR>
						<?}?>
						<TR><TD  bgcolor="#D9D9A8" colspan="3">&nbsp;</TD></TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>

<?print "<input type=hidden name=login value=$login_form>";?>
<?print "<input type=hidden name=act value=$act>";?>
<?print "<input type=hidden name=group_name value=$grp_name>";?>
<?print "<input type=hidden name=sg value=$sg>";?>
<?print "<input type=hidden name=gid value=$gid>";?>
<?print "<input type=hidden name=sgid value=$subgid>";?>

</FORM>
<?}?>
	</TD>
</TR>
</TABLE>
<?
workareabottom();
ffooter_new();			//ffooter();
?>