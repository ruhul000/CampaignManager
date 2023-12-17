<?php
require("gui_common.php");
require("template.php");

$login_form = $_REQUEST["login"];
$grp_id = $_REQUEST["grp_id"];
$sgrp_id = $_REQUEST["sgrp_id"];
$msg_alert = $_REQUEST["msg_alert"];
$smenu=$_REQUEST["smenu"];
$sess_id=$_REQUEST["sess_id"];

if ($grp_id && $sgrp_id) {
    $sqlquery = "select grp.group_name, sgrp.subgroup_name, sgrp.description, sgrp.active_status from group_detail grp,subgroup_detail sgrp where grp.group_id=sgrp.group_id and grp.group_id='" . $grp_id . "' and sgrp.subgroup_id='" . $sgrp_id . "' and sgrp.login='" . $login_form . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    while($row = mysql_fetch_row($result)){
        $grp_name = $row[0];
        $sgrp_name = $row[1];
        $sgrp_desc = $row[2];
        $active_status = $row[3];
    }
}

if($msg_alert==""){
    $msg="$sgrp_name Sub Group View Choose";
}else{
    $msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();                     //workareatop();

if(!$sgrp_name){
    $msg_alert = "Sorry! No Sub Group found against your request. Please create Sub Group";
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Sub Group Management</TD></tr>
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

<form name="subgroup_view" id="subgroup_view" action="subgroup_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <tr height="26">
                    <td width="430px" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Sub Group Management</TD>
                    <td width="102px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="subgroup_create.php?login=<? echo $login_form ?>&grp_id=<? echo $grp_id ?>&grp_name=<? echo $grp_name ?>&sess_id=<? echo $sess_id ?>&smenu=<? echo $smenu ?>"><img onmouseover="this.src='images/ASGroup1.gif';" onmouseout="this.src='images/ASGroup0.gif'" src="images/ASGroup0.gif" border="0"/></a></TD>
                    <td width="101px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="subgroup_modify.php?login=<? echo $login_form ?>&grp_id=<? echo $grp_id ?>&grp_name=<? echo $grp_name ?>&action=2&sess_id=<? echo $sess_id ?>&smenu=<? echo $smenu ?>&sgrp_id=<? echo $sgrp_id ?>"><img onmouseover="this.src='images/ESGroup1.gif';" onmouseout="this.src='images/ESGroup0.gif'" src="images/ESGroup0.gif" border="0"/></a></TD>
                    <td width="115px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:if (confirm('Are you sure you want to delete <? echo $sgrp_name; ?> Sub Group?')==true){document.subgroup_view.submit();}else{void('null');}"><img onmouseover="this.src='images/DSGroup1.gif';" onmouseout="this.src='images/DSGroup0.gif'" src="images/DSGroup0.gif" border="0"/></a></TD>
                </tr>
                 <tr>
                    <td colspan="4">
                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
                            <tr height="8px" bgcolor="#D9D9A8">
                                <td width="250px"></td>
                                <td width="388px"></td>
                                <td width="110px"></td>
                            </tr>

                        <?if (strlen($msg_alert) > 0){?>
                            <tr height="16px" bgcolor="#D9D9A8">
                                <TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
                        <?}?>

                        <tr height="16px" bgcolor="#D9D9A8">
                            <td  align="right" valign="top" class="WorkGreen">Group Name&nbsp;:&nbsp;</TD>
                            <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $grp_name; ?></TD>
                            <TD>&nbsp;</TD>
                        </TR>
                        <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                        <tr height="16px" bgcolor="#D9D9A8">
                            <td  align="right" valign="top" class="WorkGreen">Sub Group Name&nbsp;:&nbsp;</TD>
                            <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $sgrp_name; ?></TD>
                            <TD>&nbsp;</TD>
                        </TR>
                        <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                        <tr height="16px" bgcolor="#D9D9A8">
                            <td align="right" valign="top" class="WorkGreen">Description&nbsp;:&nbsp;</TD>
                            <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $sgrp_desc; ?></TD>
                            <TD>&nbsp;</TD>
                        </TR>

                        <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                        <tr height="16px" bgcolor="#D9D9A8">
                            <td align="right" valign="top" class="WorkGreen">Active Status&nbsp;:&nbsp;</TD>
                            <td align="left" valign="top" bgcolor="#f4f4e4"><?if ($active_status){ echo "On"; }else { echo "Off"; }?></TD>
                            <TD>&nbsp;</TD>
                        </TR>

                        <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?
    print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
    print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
    print "<input type=\"hidden\" name=\"action\" value=\"3\">";
    print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
    print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
    print "<input type=\"hidden\" name=\"grp_id\" value=" . $grp_id . ">";
    print "<input type=\"hidden\" name=\"sgrp_id\" value=" . $sgrp_id . ">";
    print "<input type=\"hidden\" name=\"sgrp_name\" value=" . $sgrp_name . ">";
?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
<div id="TTipes" style="position:absolute; height:25px; z-index:1; display: none; visibility: hidden;" ></div>
<?
workareabottom();
ffooter();
?>
