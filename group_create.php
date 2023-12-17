<?php

ob_start();

require("gui_common.php");
require("template.php");

$action=$_REQUEST["action"];            //1-for NEW,2-for MODIFY,3-for DELETE
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$grp_name = $_REQUEST["grp_name"];
$grp_desc = $_REQUEST["grp_desc"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$compName = $_REQUEST["cpName"];
//die();
if($msg_alert==""){
    $msg="Group Creation Choose";
}else{
    $msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg,$compName);

hheader($smenu);
tree_code ();
workareatop_new();
?>
<form name="group_create" id="group_create" action="group_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26">
                    <TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Group Creation</TD>
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
                                <td align="left" valign="top" class="WorkGreen">
                                    <input type="text" name="grp_name" value="<? echo $grp_name; ?>" size="45" class="input" onmouseover="showIT('Enter the Group name.')" onmouseout="showIT()" />
                                </TD>
                                <TD>&nbsp;</TD>
                            </TR>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen">Description&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" class="WorkGreen">
                                    <TextArea onmouseover="showIT('Please enter here the description of the group.')" onmouseout="showIT()" rows="3" cols="44" name="grp_desc" class="input"><? echo $grp_desc; ?></TextArea>

                                </TD>
                                <TD>&nbsp;</TD>
                            </TR>

                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
         <!-- Hidden Company name field -->
                            <td align="left" valign="top" class="WorkGreen">
                                    <input type="hidden" name="companyName" value="<? echo $compName;  ?>" size="45" class="input"/>
                            </TD>
                            

                            <tr height="16" bgcolor="#D9D9A8">
                                <td align="center" class="WorkGreen" colspan="3"><input type="button" class="submit1" value="Create Here!!!" onclick="group_submit('group_create');" style="background-image:url('images/menu1.gif');" tabindex="33"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?
    print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
    print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
    print "<input type=\"hidden\" name=\"action\" value=\"1\">";
    print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
    print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
     print "<input type=\"hidden\" name=\"cpName\" value=" . $compName. ">";
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
?>