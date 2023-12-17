<?php
require("template.php");
require("gui_common.php");

$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$treeview_cod = $_REQUEST["treeview_cod"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$target_id = $_REQUEST["target_id"];

if ($target_id) {
	$sqlquery = "select target_name,group_id,subgroup_id,file_path,target_status,daily_new_target,cron_start_date from target_detail where archive!=1 and target_id='" . $target_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$target_name=$row[0];
		$grp_id=$row[1];
		$sgrp_id=$row[2];
		$path=$row[3];
		$active_status=$row[4];
		$daily_target=$row[5];
		$cron_start_date=$row[6];
	}
}
$temp=explode('/',getfolder($grp_id,$sgrp_id));
$grp_name=$temp[0];
$sgrp_name=$temp[1];

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

if(!$target_name){
    $msg_alert = "Sorry!!! We Have Not Found Any Schedule Against Your Request.Please Create Schedule";
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Target View</TD></tr>
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
					<TD width="748px" align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Target View</TD>
				</tr>
				<tr>
					<td>
						<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
							<tr height="8px" bgcolor="#D9D9A8">
								<td width="250px"></td>
								<td width="388px"></td>
								<td width="110px"></td>
							</tr>
						<? if (strlen($msg_alert) > 0){ ?>
							<tr height="16px" bgcolor="#D9D9A8">
								<TD  align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
						<? } ?>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Target Name&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $target_name; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


 							<tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Group Name&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><select name="grp_id" class="input" disabled="disabled"><option value="">Select Group Name</option><option value="<? echo $grp_id; ?>" selected="selected"><? echo $grp_name; ?></option></select></td>
								<td>&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Sub Group Name&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><select name="sgrp_id" class="input" disabled="disabled"><option value="">Select Sub Group Name</option><option value="<? echo $sgrp_id; ?>" selected="selected"><? echo $sgrp_name; ?></option></select></td>
								<td>&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Uploaded MSISDN&nbsp;:&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo substr($path,strripos($path,'/')+1); ?></td>
								<td>&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<?if ($daily_target!="" && $daily_target==1){?>
								<tr height="16px" bgcolor="#D9D9A8">
									<td align="right" class="WorkGreen">Daily New Target&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#f4f4e4"><?if ($daily_target==1){ echo "On"; }else{echo "Off"; }?></td>
									<td>&nbsp;</td>
								</tr>

								<tr height="16px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
								<tr height="16px" bgcolor="#D9D9A8">
									<td align="right" class="WorkGreen">Cron Start Date&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#f4f4e4"><? echo $cron_start_date; ?></td>
									<td>&nbsp;</td>
								</tr>
								<tr height="16px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
							<?}?>


							<tr height="16px" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Active Status&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><?if ($active_status==1){ echo "On"; }else{echo "Off"; }?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="16px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="16px" bgcolor="#D9D9A8">
								<td bgcolor="#D9D9A8" ></td>
								<td align="right" class="bold_red_text"><a class="bold_red_text" href="dn_msisdn.php?path=<?echo $path; ?>">Download MSISDN zip file</a></td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

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