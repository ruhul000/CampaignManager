<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");
//header("Content-type: text/html; charset=windows-874");

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];

$ttstr = ($smenu==2)?"Target":"Contest";

if ($smenu==2){
	$ttstr = "Target";
}elseif ($smenu==3){
	$ttstr = "Contest";
}elseif ($smenu==1){
	$ttstr = "Group";
}elseif ($smenu==4){
	$ttstr = "SMS";
}elseif ($smenu==5){
	$ttstr = "Scheduler";
}elseif ($smenu==6){
	$ttstr = "Voting";
}elseif($smenu==8){
	$ttstr = "Map";
}

$maxids=$_REQUEST["maxids"];
$checkcnt=$_REQUEST["checkcnt"];

$treeview_cod=$_REQUEST["treeview_cod"];
$msg_alert=$_REQUEST["msg_alert"];
$cntsname=$_REQUEST["cnts_name"];
$cnt=0;

$archive = 0;
$field5 = "UnArchive";

if(gettype($checkcnt)=='array'){
	$ids=implode(",",$checkcnt);
	if($smenu==2){
		$sqlquery="update target_detail set archive='" . $archive . "' where target_id in (" . $ids . ") and login='" . $login_form . "'";
		$sqlquery1="select target_name from target_detail where target_id in (" . $ids . ")";
	}else if($smenu==3){
		$sqlquery="update contest_detail set archive='" . $archive . "' where contest_id in (" . $ids . ") and login='" . $login_form . "'";
		$sqlquery1="select contest_name from contest_detail where contest_id in (" . $ids . ")";
	}else if($smenu==1){
		$sqlquery="update group_detail set archive='" . $archive . "' where group_id in (" . $ids . ") and login='" . $login_form . "'";
		$sqlquery1="select group_name from group_detail where group_id in (" . $ids . ")";
	}else if($smenu==4){
		$sqlquery="update rules_detail set archive='" . $archive . "' where sms_id in (" . $ids . ") and login='" . $login_form . "'";
		$sqlquery1="select message,language from rules_detail where sms_id in (" . $ids . ")";
	}else if($smenu==5){
		$sqlquery="update list_detail set archive='" . $archive . "' where id in (" . $ids . ") and login_created='" . $login_form . "'";
		$sqlquery1="select scheduler_name from list_detail where id in (" . $ids . ")";
	}else if($smenu==6){
		$sqlquery="update voting_detail set archive='" . $archive . "' where voting_id in (" . $ids . ") and login='" . $login_form . "'";
		$sqlquery1="select voting_name from voting_detail where voting_id in (" . $ids . ")";
	}else if($smenu==8){
		$sqlquery="update value_map_info set archive='" . $archive . "' where id in (" . $ids . ")";
	}
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	//$sqlquery1="select target_name from target_detail where target_id in (" . $ids . ")";

	if($smenu==8){
		$msg_alert=$ttstr ." Successfully " . $field5 . "!!!";
	}else{
		$result1=mysql_query($sqlquery1)or die('mysql error:' . mysql_error());
		$fname='';
		$i=0;
		while($i<mysql_num_rows($result1))
		{
			$row=mysql_fetch_row($result1);
			$lang_sms=$row[1];
			if($fname=='')
				if($lang_sms=='Thai'){
					$fname=hexToStr($row[0]);
				}else{
					$fname=$row[0];
				}

			else
				if($lang_sms=='Thai'){
					$fname=$fname.", ".hexToStr($row[0]);
				}else{
					$fname=$fname.", ".$row[0];
				}
			$i++;
		}
		$msg_alert=$ttstr . " " . $fname . " Successfully " . $field5 . "!!!";
	}

}

$cnt=0;

if($smenu==2){
	$sqlquery="select t.target_id,t.file_path,t.target_name,g.group_name,s.subgroup_name,t.target_status from target_detail t,group_detail g,subgroup_detail s where t.archive=1 and t.group_id=g.group_id and t.subgroup_id=s.subgroup_id and t.login='" . $login_form . "' order by t.target_id limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$app_id[$cnt]=substr($row[1],strrpos($row[1],'/')+1);
		$cnts_name[$cnt]=$row[2];
		$sdate[$cnt]=$row[3];
		$edate[$cnt]=$row[4];
		$act_status[$cnt++]=$row[5];
	}
	$field1 = "Uploaded File";
	$field2 = "Target Name";
	$field3 = "Group Name";
	$field4 = "Sub Group Name";
}else if($smenu==3){
	$sqlquery="select contest_id,application_id,contest_name,start_date,end_date,active_status from contest_detail where archive=1 and login='" . $login_form . "' order by contest_id limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$app_id[$cnt]=$row[1];
		$cnts_name[$cnt]=$row[2];
		$sdate[$cnt]=$row[3];
		$edate[$cnt]=$row[4];
		$act_status[$cnt++]=$row[5];
	}
	$field1 = "Application Id";
	$field2 = "Contest Name";
	$field3 = "Start Time";
	$field4 = "Stop Time";
}else if($smenu==6){
	$sqlquery="select voting_id,application_id,voting_name,start_date,end_date,active_status from voting_detail where archive=1 and login='" . $login_form . "' limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$app_id[$cnt]=$row[1];
		$cnts_name[$cnt]=$row[2];
		$sdate[$cnt]=$row[3];
		$edate[$cnt]=$row[4];
		$act_status[$cnt++]=$row[5];
	}
	$field1 = "Application Id";
	$field2 = "Voting Name";
	$field3 = "Start Time";
	$field4 = "Stop Time";
}else if($smenu==1){
	$sqlquery="select group_id,group_name,description,active_status from group_detail where archive=1 and login='" . $login_form . "' order by group_id limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$cnts_name[$cnt]=$row[1];
		$cnts_desc[$cnt]=$row[2];
		$act_status[$cnt++]=$row[3];
	}
	$field1 = "Group Name";
	$field2 = "Group Description";
}else if($smenu==4){
	$sqlquery="select sms_id,message,sms_mode,language from rules_detail where archive=1 and login='" . $login_form . "' order by sms_id limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$lang_sms=$row[3];
		$cnts_id[$cnt]=$row[0];
		if($lang_sms=='Thai'){
			$cnts_name[$cnt] = hexToStr($row[1]);
		}else{
			$cnts_name[$cnt]=$row[1];
		}
		if ($row[2] == 1){
			$cnts_desc[$cnt++]="Text Base";
		}else{
			$cnts_desc[$cnt++]="Wap Push";
		}
	}
	$field1 = "Message";
	$field2 = "SMS Mode";
}else if($smenu==5){
	$sqlquery="select id,no_of_sms,scheduler_name,start_date,end_date,status from list_detail where archive=1 and login_created='" . $login_form . "' order by id limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$app_id[$cnt]=$row[2];
		$cnts_name[$cnt]=$row[1];
		$sdate[$cnt]=$row[3];
		$edate[$cnt]=$row[4];
		$act_status[$cnt++]=$row[5];
	}
	$field1 = "Scheduler Name";
	$field2 = "No of SMS";
	$field3 = "Start Time";
	$field4 = "Stop Time";
}else if($smenu==8){
	$sqlquery="select v.id,h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=1 order by v.id desc limit 10";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row=mysql_fetch_row($result)){
		$cnts_id[$cnt]=$row[0];
		$host_ip[$cnt]=$row[1];
		$db_name[$cnt]=$row[2];
		$table_name[$cnt]=$row[3];
		$table_field[$cnt]=$row[4];
		$login_name[$cnt]=$row[5];
		$map_value[$cnt]=$row[6];
		$map_name[$cnt++]=$row[7];
	}

	$field1= "Host IP";
	$field2 = "Database Name";
	$field3 = "Table Name";
	$field4 = "Field";
	$field6 = "Login";
	$field7 = "Value";
	$field8 = "Map";


}

$max=count($cnts_id);

if($msg_alert=="" || stripos($msg_alert,"Successfully UnArchived!!!")===false){
	$msg=$ttstr . " " . $field5 . " Choosess";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

/************GET GROUP DETAIL***********/

if(empty($cnts_id)){
	$msg_alert = "Sorry! No $ttstr found against your request. Please create $ttstr";
	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;<? echo $ttstr; ?>
					<? echo $field5; ?></TD>
			</tr>
			<tr>
				<td>
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8" bgcolor="#D9D9A8">
						<td></td>
					</tr>
					<tr height="22">
						<TD bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
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
<form name="archive_form" id="archive_form"
	action="unarchive.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>"
	method="post">
<table align="left" border="0" cellspacing="0" cellpadding="1"
	width="748px" bgcolor="#525200" class="sortable">
	<tr>
		<td>
		<table align="left" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#525200">
			<tr height="28">
				<TD align="left" background="images/trgt_hdr1.gif" class="WorkWht">&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;<? echo $ttstr; ?>
					<? echo $field5; ?></TD>
			</tr>
			<tr>
				<td>
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">

					<? if($smenu==8) {?>
					<tr height="8px" bgcolor="#D9D9A8">
						<td width="118px"></td>
						<td width="100px"></td>
						<td width="135px"></td>
						<td width="125px"></td>
						<td width="92px"></td>
						<td width="50px"></td>
						<td width="100px"></td>
						<td width="28px"></td>
					</tr>
					<?} else { ?>

					<tr height="8px" bgcolor="#D9D9A8">
						<td width="160px"></td>
						<td width="160px"></td>
						<td width="200px"></td>
						<td width="200px"></td>
						<td width="28px"></td>
					</tr>
					<? } ?>
					<tr height="18px" bgcolor="#D9D9A8">
					<?if ($smenu == 1){?>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
						<td colspan="3" align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
						<?}else if ($smenu == 4){?>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
						<td colspan="3" align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>

						<?}else if($smenu==8){?>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field6; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field7; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field8; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>

						<?}else{?>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
						<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
						<?}?>
					</tr>
					<?if($smenu==8){?>
					<tr height="1" bgcolor="#525200">
						<td colspan="8"></td>
					</tr>
					<?}else {?>
					<tr height="1" bgcolor="#525200">
						<td colspan="5"></td>
					</tr>
					<?}?>

					<? if (strlen($msg_alert)>0){ ?>
					<?if($smenu==8){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<TD align="center" colspan="8" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
					</tr>
					<tr height="8" bgcolor="#D9D9A8">
						<td colspan="8"></td>
					</tr>
					<?}else {?>
					<tr height="16px" bgcolor="#D9D9A8">
						<TD align="center" colspan="5" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
					</tr>
					<tr height="8" bgcolor="#D9D9A8">
						<td colspan="5"></td>
					</tr>
					<?} ?>

					<? } for($cnt=0;$cnt<$max;$cnt++){ ?>
					<tr height="16px" bgcolor="#D9D9A8">
					<?if ($smenu == 1){?>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_name[$cnt]; ?></td>
						<td colspan="3" align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_desc[$cnt]; ?></td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkcnt[]" value="<? echo $cnts_id[$cnt]; ?>" /></td>
							<?}else if ($smenu == 4){?>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_desc[$cnt]; ?></td>
						<td colspan="3" align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkcnt[]" value="<? echo $cnts_id[$cnt]; ?>" /></td>

							<? } else if($smenu==8){?>

						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $host_ip[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $db_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $table_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $table_field[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $login_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $map_value[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $map_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkcnt[]" value="<? echo $cnts_id[$cnt]; ?>" /></td>

							<?}else{?>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $app_id[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_name[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $sdate[$cnt]; ?></td>
						<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $edate[$cnt]; ?></td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkcnt[]" value="<? echo $cnts_id[$cnt]; ?>" /></td>
							<?}?>
					</tr>
					<?}?>

					<?if($smenu==8){?>
					<tr height="16" bgcolor="#D9D9A8">
						<td colspan="8"></td>
					</tr>
					<?}else {?>
					<tr height="16" bgcolor="#D9D9A8">
						<td colspan="5"></td>
					</tr>
					<? } ?>
					<?
					print "<input type =hidden name = sess_id value =$sess_id>";
					print "<input type =hidden name=login value =$login_form>";
					print "<input type =hidden name=treeview_cod value =$treeview_cod>";
					print "<input type =hidden name=action value =2>";
					print "<input type =hidden name=maxids value =$maxids>";
					print "<input type =hidden name=smenu value =$smenu>";
					?>
					<?if($smenu==8){?>
					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="8"><input
							type="submit" class="submit1" value="<? echo $field5; ?> Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="20" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="16" bgcolor="#D9D9A8">
						<td colspan="8"></td>
					</tr>
					<?}else {?>
					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="5"><input
							type="submit" class="submit1" value="<? echo $field5; ?> Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="20" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="16" bgcolor="#D9D9A8">
						<td colspan="5"></td>
					</tr>
					<? } ?>
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


