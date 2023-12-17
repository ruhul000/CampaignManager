<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];

$ttstr = ($smenu==2)?"Target":"Contest";

$maxids=$_REQUEST["maxids"];
$checkcnt=$_REQUEST["checkcnt"];

$treeview_cod=$_REQUEST["treeview_cod"];
$msg_alert=$_REQUEST["msg_alert"];
$cntsname=$_REQUEST["cnts_name"];
$cnt=0;

if(gettype($checkcnt)=='array' && $action==2){
  $ids=implode(",",$checkcnt);
  if($smenu==2){
    $sqlquery="update target_detail set archive=1 where target_id in (" . $ids . ")";
  }else if($smenu==3){
    $sqlquery="update contest_detail set archive=1 where contest_id in (" . $ids . ")";
  }
  $result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
  $msg_alert=$ttstr . " " . $ids . " Successfully Archived!!!";
}

$cnt=0;

if($smenu==2){
  $sqlquery="select t.target_id,t.file_path,t.target_name,g.group_name,s.subgroup_name,t.target_status from target_detail t,group_detail g,subgroup_detail s where t.archive=0 and t.group_id=g.group_id and t.subgroup_id=s.subgroup_id order by t.target_id limit 10";
  $result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
  while($row=mysql_fetch_row($result)){
    $cnts_id[$cnt]=$row[0];
    $app_id[$cnt]=substr($row[1],strrpos($row[1],'/')+1);
    $cnts_name[$cnt]=$row[2];
    $sdate[$cnt]=$row[3];
    $edate[$cnt]=$row[4];
    $act_status[$cnt++]=$row[5];
  }
}else if($smenu==3){
  $sqlquery="select contest_id,application_id,contest_name,start_date,end_date,active_status from contest_detail where archive=0 order by contest_id limit 10";
  $result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
  while($row=mysql_fetch_row($result)){
    $cnts_id[$cnt]=$row[0];
    $app_id[$cnt]=$row[1];
    $cnts_name[$cnt]=$row[2];
    $sdate[$cnt]=$row[3];
    $edate[$cnt]=$row[4];
    $act_status[$cnt++]=$row[5];
  }
}

$max=count($cnts_id);

if($msg_alert=="" || stripos($msg_alert,"Successfully Archived!!!")===false){
	$msg=$ttstr . " Archive Choosess";
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
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;<? echo $ttstr; ?> Archive</TD></tr>
				<tr><td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px"  bgcolor="#525200">
						<tr height="8" bgcolor="#D9D9A8"><td></td></tr>
						<tr height="22"><TD  bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD></tr>
						<tr height="8"><td bgcolor="#D9D9A8"></td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr>
</table>
<?die();}?>
	<form name="archive_form" id="archive_form" action="trgarchive.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>" method="post">
		<table align="left" border="0" cellspacing="0" cellpadding="1" width="748px" bgcolor="#525200"  class="sortable">
			<tr>
				<td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
						<tr height="28">
							<TD align="left" background="images/trgt_hdr1.gif" class="WorkWht">&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;<? echo $ttstr; ?> Archive</TD>
						</tr>
						<tr>
							<td>
								<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
									<tr height="8px" bgcolor="#D9D9A8">
										<td width="160px"></td><td width="160px"></td>
										<td width="200px"></td><td width="200px"></td>
										<td width="28px"></td>
									</tr>

									<tr height="18px" bgcolor="#D9D9A8">
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo ($smenu==2)?'Uploaded File':'Application Id'; ?></td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $ttstr; ?> Name</td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo ($smenu==2)?'Group Name':'Start Time'; ?></td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo ($smenu==2)?'Sub Group Name':'Stop Time'; ?></td>
										<td align="left" valign="top" class="WorkGreen">Archive&nbsp;&nbsp;</td>
									</tr>
									<tr height="1" bgcolor="#525200"><td colspan="5"></td></tr>

<? if (strlen($msg_alert)>0){ ?>
									<tr height="16px" bgcolor="#D9D9A8">
										<TD align="center" colspan="5" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
									</tr>
									<tr height="8" bgcolor="#D9D9A8"><td colspan="5"></td></tr>
<? }

for($cnt=0;$cnt<$max;$cnt++){ ?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $app_id[$cnt]; ?></td>
										<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $cnts_name[$cnt]; ?></td>
										<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $sdate[$cnt]; ?></td>
										<td align="left" class="WorkGreen">&nbsp;&nbsp;<? echo $edate[$cnt]; ?></td>
										<td align="left" class="WorkGreen"><input type="checkbox" name ="checkcnt[]" value="<? echo $cnts_id[$cnt]; ?>"/></td>
									</tr>
<?}?>
									<tr height="16" bgcolor="#D9D9A8"><td colspan="5"></td></tr>
<?
print "<input type =hidden name = sess_id value =$sess_id>";
print "<input type =hidden name=login value =$login_form>";
print "<input type =hidden name=treeview_cod value =$treeview_cod>";
print "<input type =hidden name=action value =2>";
print "<input type =hidden name=maxids value =$maxids>";
print "<input type =hidden name=smenu value =$smenu>";
?>
									<tr height="16" bgcolor="#D9D9A8">
										<td align="center" class="WorkGreen" colspan="5"><input type="submit" class="submit1" value="Archive Here!!!" style="background-image:url('images/menu1.gif');" tabindex="20"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
									<tr height="16" bgcolor="#D9D9A8"><td colspan="5"></td></tr>
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


