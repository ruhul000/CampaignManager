<?php
header("Cache-Control: no-cache, must-revalidate");
require("gui_common.php");
require("template.php");

$action = $_REQUEST["action"];
$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$smenu = $_REQUEST["smenu"];

$msg_alert = $_REQUEST["msg_alert"];

$cntsid = $_REQUEST["contest_id"];
if ($cntsid == ""){
	$cntsid = $_REQUEST["cnts_id"];
}

$qstn_type = $_REQUEST["qstn_type"];
$qstn_id = $_REQUEST["question_id"];

if($msg_alert=="" || stripos($msg_alert,"Contest Question successfully inserted!!!")!==false){
	$msg="Contest Question Implode Choosess";
}else{
	$msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

$sqlquery = "select distinct contest_id, contest_name, max_options from contest_detail where login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$i = 0;
while($row = mysql_fetch_row($result)){
	$cnts_id[$i]=$row[0];
	$cnts_name[$i]=$row[1];
	$max_option[$i]=$row[2];
	$i=$i+1;
}
?>

<form name="import_form" id="import_form" action="question_import_update.php" enctype="multipart/form-data" method="post">
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
		<tr>
			<td>
				<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
					<TR height="26">
						<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Contest Question Creation</TD>
					</TR>
					<tr>
						<td>
							<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px"  bgcolor="#525200">
								<tr height="8" bgcolor="#D9D9A8">
									<td width="230px"></td>
									<td width="340px"></td>
									<td width="178px"></td>
								</tr>

								<?if (strlen($msg_alert) > 0){?>
									<tr height="22">
										<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
										<TD  bgcolor="#D9D9A8" align="left" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
										<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
									</tr>
									<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
								<?}?>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Contest Name&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#D9D9A8">
										<select name="cnts_id" class="input">
											<option value="" >Select Contest Name</option>
											<? for($j=0,$i=count($cnts_id);$j<$i;$j++){?>
											<option value="<? echo $cnts_id[$j] ?>" <? if($cnts_id[$j]==$cntsid){ echo "selected=\"selected\"";} ?>><? echo $cnts_name[$j] ?></option>
											<?}?>
										</select>
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Question Type&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#D9D9A8">
										<select name="qstn_type" class="input">
											<option value="1" <?if($qstn_type==1){ echo "selected=\"selected\"";} ?>>Random</option>
											<option value="2" <?if($qstn_type==2){ echo "selected=\"selected\"";} ?>>Sequence</option>
										</select>
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Upload File&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#D9D9A8">
										<input type="file" name="file" size="20" onMouseOver="showIT('The file to be uploaded must be a .txt file in CSV (Comma Separated Values).eg.Question,Option A,Option B,Option C,Option D,Answer,Max Option.')" onMouseOut="showIT()" class="input">
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8">
									<td bgcolor="#D9D9A8" class="bold_red_text"></td>
									<td bgcolor="#D9D9A8">(Click here for <a class="bold_red_text" coords="50,20,50,20" target="_blank" href="quizhelp.php">Sample File</a>)</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td bgcolor="#D9D9A8" align="right" colspan="2"><input type="button" onclick="import_submit()" class="submit1" value="Import Here!!!" style="background-image:url('images/menu1.gif');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<?
	print "<input type =hidden name = login value =$login_form>";
	print "<input type =hidden name=action value=$action>";
	print "<input type =hidden name=sess_id value=$sess_id>";
	print "<input type =hidden name=treeview_cod value=$treeview_cod>";
	print "<input type=hidden name=cnts_name value=$cnts_name>";
	print "<input type=hidden name=max_option value=$max_option>";
	print "<input type=hidden name=cnts_id11 value=$cnts_id11>";
	print "<input type=hidden name=login value=$login_form>";
	print "<input type=hidden name=question_id value=$qstn_id>";
	print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";

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
ffooter_new();
?>