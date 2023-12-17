<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];

$maxids=$_REQUEST["maxids"];
$checkcnt=$_REQUEST["checkcnt"];

$treeview_cod=$_REQUEST["treeview_cod"];
$msg_alert=$_REQUEST["msg_alert"];
$cntsname=$_REQUEST["cnts_name"];
$cnt=0;

if(gettype($checkcnt)=='array' && $action==4){
	$ids=implode(",",$checkcnt);
	$sqlquery="update voting_detail set archive=0 where voting_id in (" . $ids . ") and login='" . $login_form . "'";
	$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$msg_alert="Voting " . $ids . " Successfully UnArchived!!!";
}
$cnt=0;
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

$max=count($cnts_id);

if($msg_alert=="" || stripos($msg_alert,"Successfully UnArchived!!!")===false){
	$msg="Voting UnArchive Choosess";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,"Voting UnArchive Choosess");

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

/************GET GROUP DETAIL***********/

if(empty($cnts_id)){
	$msg_alert = "Sorry!!! We Have Not Found Any Voting Agains Your Request.Please Create Voting.";
?>
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting UnArchive</TD></tr>
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
	<form name="archive_form" id="archive_form" action="voting_unarchive.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>" method="post">
		<table align="left" border="0" cellspacing="0" cellpadding="1" width="748px" bgcolor="#525200"  class="sortable">
			<tr>
				<td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
						<tr height="28">
							<TD align="left" background="images/trgt_hdr1.gif" class="WorkWht">&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting UnArchive</TD>
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
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;Application Id</td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;Voting Name</td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;Start Time</td>
										<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;Stop Time</td>
										<td align="left" valign="top" class="WorkGreen">UnArchive&nbsp;&nbsp;</td>
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

									<tr height="16" bgcolor="#D9D9A8">
										<td align="center" class="WorkGreen" colspan="5"><input type="button" onclick="voting_archive('archive_form')" class="submit1" value="UnArchive Here!!!" style="background-image:url('images/menu1.gif');" tabindex="20"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
									<tr height="16" bgcolor="#D9D9A8"><td colspan="5"></td></tr>
<?
print "<input type =hidden name = sess_id value =$sess_id>";
print "<input type =hidden name=login value =$login_form>";
print "<input type =hidden name=treeview_cod value =$treeview_cod>";
print "<input type =hidden name=action value =4>";
print "<input type =hidden name=maxids value =$maxids>";
print "<input type =hidden name=smenu value =$smenu>";
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


