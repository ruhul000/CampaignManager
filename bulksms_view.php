<?php
require("template.php");
require("gui_common.php");
//header("Content-type: text/html; charset=windows-874");

$login_form=$_REQUEST["login"];
$msg_alert=$_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$treeview_cod = $_REQUEST["treeview_cod"];
$sms_id = $_REQUEST["sms_id"];

if ($sms_id){
    $sqlquery = "select message,footer_url,sms_mode,language from rules_detail where sms_id='" . $sms_id . "' and  archive!=1 and login='" . $login_form . "' order by sms_id";
    $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

    while($row = mysql_fetch_row($result)){
        $message=$row[0];
        $footer_url=$row[1];
        $sms_mode=$row[2];
        $lang_sms=$row[3];
    }
}
if($lang_sms=='Thai'){
	$message = hexToStr($message);
	$footer_url = hexToStr($footer_url);
}
if($sms_mode == 2){
	$message = hexToStr($message);
}


if($msg_alert==""){
    $msg="Bulk SMS View Choose";
}else{
    $msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

if(!$message){
    $msg_alert = "Sorry!!! We Have Not Found Any SMS Message Against Your Request.Please Create Bulk SMS";
    if ($action == 3){
    	$msg_alert = "SMS Message Successfully Deleted";
    }
?>
    <table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
        <tr><td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;SMS Broadcast</TD></tr>
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

<form name="bulksms_view" id="bulksms_view" action="bulksms_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
    <tr>
        <td>
            <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
                <TR height="28">
                    <TD width="598px" align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;SMS Broadcast</TD>
                    <td width="68px" align="right" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="bulksms_modify.php?login=<? echo $login_form ?>&sms_id=<? echo $sms_id ?>&sess_id=<? echo $sess_id ?>&smenu=<? echo $smenu ?>&sms_type=<? echo $sms_mode ?>"><img onmouseover="this.src='images/ESMS1.gif';" onmouseout="this.src='images/ESMS0.gif'" src="images/ESMS0.gif" border="0"/></a></TD>
                    <td width="82px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:if (confirm('Are you sure you want to delete this SMS?')==true){document.bulksms_view.submit();}else{void('null');}"><img onmouseover="this.src='images/DSMS1.gif';" onmouseout="this.src='images/DSMS0.gif'" src="images/DSMS0.gif" border="0"/></a></TD>
                </TR>
                <tr>
                    <td colspan="3">
                        <table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
                            <tr height="8px" bgcolor="#D9D9A8">
                                <td width="382px"></td>
                                <td width="490px"></td>
                                <td width="150px"></td>
                            </tr>

						<?if (strlen($msg_alert) > 0){?>
							<tr height="16px" bgcolor="#D9D9A8">
								<TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
						<?}?>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen">Choose SMS Type&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? if($sms_mode==2){echo "Wap Push";}else{echo "Text Base";} ?></td>
								<td>&nbsp;</td>
							</tr>
						<? if($sms_mode != 2){ ?>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen">Language&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $lang_sms; ?></td>
								<td>&nbsp;</td>
							</tr>
							<?} ?>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td align="right" valign="top" class="WorkGreen"><? if($sms_mode==2){echo "Title";}else{echo "Message";} ?>&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $message; ?></td>
								<td>&nbsp;</td>
							</tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                            <tr height="16px" bgcolor="#D9D9A8">
                                <td  align="right" valign="top" class="WorkGreen"><? if($sms_mode==2){echo "URL";}else{echo "Footer Message";} ?>&nbsp;:&nbsp;</TD>
                                <td align="left" valign="top" bgcolor="#f4f4e4"><? echo $footer_url; ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

<?
    print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
    print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
    print "<input type=\"hidden\" name=\"page\" value=\"3\">";
    print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
    print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
    print "<input type=\"hidden\" name=\"sms_id\" value=" . $sms_id . ">";
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
