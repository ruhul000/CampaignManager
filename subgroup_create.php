<?php

ob_start();

require("gui_common.php");
require("template.php");

$action=$_REQUEST["action"];            //1-for NEW,2-for MODIFY,3-for DELETE
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$grp_name = $_REQUEST["grp_name"];
$grp_id = $_REQUEST["grp_id"];
$sgrp_name = $_REQUEST["sgrp_name"];
$sgrp_desc = $_REQUEST["sgrp_desc"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
echo "Sub Group: ".$compName = $_REQUEST["cpName"];

//die();
if($msg_alert==""){
    $msg="Sub Group Creation Choose";
}else{
    $msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg,$compName);

$validgroup=group_exist($grp_id,$grp_name,$compName);

hheader($smenu);
tree_code ();
workareatop_new();

if(!$validgroup){
    $msg_alert = "Sorry!!! We Have Not Found Any Group Against Your Request.Please Create Group";
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Contest Management</TD></tr>
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
<form name="subgroup_create" id="subgroup_create" action="subgroup_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26">
                    <TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Sub Group Creation</TD>
                    <TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
                </TR>
                <tr>
                    <td colspan="2">
                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
                            <tr height="8px" bgcolor="#D9D9A8">
                                <td width="230px"></td>
                                <td width="340px"></td>
                                <td width="178px"></td>
                            </tr>

                         <?if (strlen($msg_alert) > 0){?>
                            <tr height="16px" bgcolor="#D9D9A8">
                                <TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
                        <?}?>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Group Name&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen" bgcolor="#f4f4e4">
                                    <label for="female"><? echo $grp_name; ?></label>
                                </TD>
                                <TD>&nbsp;</TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen">Sub Group Name&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen" bgcolor="#D9D9A8">
                                    <input type="text" name="sgrp_name" value="<? echo $sgrp_name; ?>" size="45" class="input" onmouseover="showIT('Enter the Sub Group name.')" onmouseout="showIT()" />
                                </TD>
                                <TD>&nbsp;</TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen">Description&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
                                    <TextArea onmouseover="showIT('Please enter here the description of the group.')" onmouseout="showIT()" rows="3" cols="44" name="sgrp_desc" class="input"><? echo $sgrp_desc; ?></TextArea>
                                </TD>
                                <TD>&nbsp;</TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
 <!-- Hidden Company name field -->
                            <td align="left" valign="top" class="WorkGreen">
                                    <input type="hidden" name="companyName" value="<? echo $compName;  ?>" size="45" class="input"/>
                            </TD>
                            
                            <tr height="16" bgcolor="#D9D9A8">
                                <td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="subgroup_submit('subgroup_create');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?
    print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
    print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
    print "<input type=\"hidden\" name=\"action\" value=\"1\">";
    print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
    print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
    print "<input type=\"hidden\" name=\"grp_name\" value=" . $grp_name . ">";
    print "<input type=\"hidden\" name=\"grp_id\" value=" . $grp_id . ">";
        print "<input type=\"hidden\" name=\"cpName\" value=" . $compName . ">";
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
ffooter;

function group_exist($grp_id,$grp_name)
{
    $sqlquery="select group_id from group_detail where group_id='" . $grp_id . "' and group_name='" . $grp_name . "'";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


    $ret=0;
    while($row = mysql_fetch_row($result)){
        $ret=1;
    }
    return $ret;
}
?>