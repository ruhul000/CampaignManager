<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$smenu = $_REQUEST["smenu"];


$cntsid = $_REQUEST["cnts_id"];
$qstn_id = $_REQUEST["question_id"];
$msg_alert = $_REQUEST["msg_alert"];

if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}

/************GET GROUP DETAIL***********/
$sqlquery = "select ques_no, question, a, b, c, d, active_status, max_options, ans from contest_questions where id='" . $qstn_id . "' and contest_id='" . $cntsid . "' and login='" . $login_form . "' order by ques_no asc";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row = mysql_fetch_row($result)){
	$ques_no = $row[0];
	$question = $row[1];
	$opt_a = $row[2];
	$opt_b = $row[3];
	$opt_c = $row[4];
	$opt_d = $row[5];
	$act_status = $row[6];
	$max_option = $row[7];
	$cnts_ans = $row[8];
}

/*****************GET contest NAME***************/
$sqlquery = "select contest_name, max_options,welcome_message,score_type,contest_footer_message from contest_detail where contest_id='" . $cntsid . "' and login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row = mysql_fetch_row($result)){
	$cnts_name = $row[0];
	$m_option = $row[1];
	$cnts_header = $row[2];
	$score_type = $row[3];
	$fut_msg = $row[4];
}

if ($max_option == 2){
	$options = " Option A." . $opt_a . " B." . $opt_b . "";
}elseif ($max_option == 3){
	$options = " Option A." . $opt_a . " B." . $opt_b . " C." . $opt_c . "";
}elseif ($max_option == 4){
	$options = " Option A." . $opt_a . " B." . $opt_b . " C." . $opt_c . " D." . $opt_d . "";
}

if ($ques_no == 1){
	$prev_text = $cnts_header . " Your 1st Q:" . $question . " " . $options . " " . $fut_msg;
}else if($score_type == 1){
	$prev_text = "Your score is [score]. Your next Q:" . $question  . " " . $options . " " . $fut_msg;
}else{
	$prev_text = "Your next Q:" . $question  . " " . $options . " " . $fut_msg;
}


user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

?>
<Script language="JavaScript">
function isValid(){
	if(document.ques_view.selectedmodels.length < 3)	{
		alert("Please select at least 4 options.")
		return false
	}
	if(document.ques_view.selectedmodels.length > 6){}
	for(i=1;i<document.ques_view.selectedmodels.length;i++){
		if(document.ques_view.selected_model_numbers.value == "")
			document.ques_view.selected_model_numbers.value = document.ques_view.selectedmodels[i].value
		else
			document.ques_view.selected_model_numbers.value += "," + document.ques_view.selectedmodels[i].value
	}
return true
}
</Script>

<? if(empty($question)){
	$msg_alert = "Sorry! No Contest Question found against your request. Please add Contest Question";
?>
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26"><TD class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Question View</TD></tr>
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
<? die();}?>

<form name="ques_view" action="question_update.php" method="post" onsubmit="return isValid()">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26">
					<TD width="354px" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Question View</TD>
					<TD width="146px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="contest_question.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&cnts_id=<? echo $cntsid; ?>&smenu=<? echo $smenu; ?>"><img onmouseover="this.src='images/AQuestion1.gif';" onmouseout="this.src='images/AQuestion0.gif'" src="images/AQuestion0.gif" border="0"/></a></TD>
					<TD width="118px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="question_modify.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&question_id=<? echo $qstn_id; ?>&cnts_id=<? echo $cntsid; ?>&flag=1&smenu=<? echo $smenu; ?>"><img onmouseover="this.src='images/EQuestion1.gif';" onmouseout="this.src='images/EQuestion0.gif'" src="images/EQuestion0.gif" border="0"/></a></TD>
					<TD width="130px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:if (confirm(' Are you sure you want to delete this contest question?')==true){document.ques_view.submit();}else{void('null');}"><img onmouseover="this.src='images/DQuestion1.gif';" onmouseout="this.src='images/DQuestion0.gif'" src="images/DQuestion0.gif" border="0"/></a></TD>
				</TR>

				<tr>
					<td colspan="4">
						<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px"  bgcolor="#525200">
							<tr height="8" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="388px"></td>
								<td width="130px"></td>
							</tr>

							<? if (strlen($msg_alert) > 0){ ?>
								<tr height="16px" bgcolor="#D9D9A8">
									<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
								</tr>
								<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
							<? } ?>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Contest Name&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $cnts_name ?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Header&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $cnts_header ?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Question&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $question; ?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

<?for ($j=0;$j<$max_option;$j++){?>
							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Option <? echo chr($j+65); ?>&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo ${'opt_' . chr($j+97)};?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<?}?>
							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Answer&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? for ($j=0;$j<$max_option;$j++){ if(ord($cnts_ans)==($j+97)){ echo chr($j+65); }}?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Preview&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4">
									<textarea READONLY rows="6" cols="49" name="prev" class="input"><? echo $prev_text; ?></textarea>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Active Status&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><?if ($act_status==1){ echo "On"; }else{ echo "Off";} ?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

<?
	print "<input type=hidden name=cnts_id value=$cntsid>";
	print "<input type =hidden name = login value =$login_form>";
	print "<input type=hidden name=sess_id value=$sess_id>";
	print "<input type=hidden name=question_id value=$qstn_id>";
	print "<input type =hidden name=action value =\"3\">";
	print "<input type =hidden name=treeview_cod value =$treeview_cod>";
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
ffooter_new();			//ffooter();
?>