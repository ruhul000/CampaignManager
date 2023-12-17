<?php

ob_start();

require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1


echo "<br>Voting Q Mod: ".$compName = $_REQUEST["cpName"];
$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$msg_alert=$_REQUEST["msg_alert"];

$qutn_id = $_REQUEST["question_id"];
$cntsid = $_REQUEST["cnts_id"];
$flag=($_REQUEST["flag"]!="")?$_REQUEST["flag"]:0;


if($msg_alert=="" || stripos($msg_alert,"Voting Question Successfully Updated!!!")!==false){
	$msg="Voting Question Modification Choosess";
}else{
	$msg=$msg_alert;
}

$sqlquery = "select voting_name, max_options,welcome_message,score_type,voting_footer_message from voting_detail where voting_id='" . $cntsid . "' and companyName='" . $compName. "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row = mysql_fetch_row($result)){
	$cnts_name = $row[0];
	$m_option = $row[1];
	$welcome_header = $row[2];
	$score_type = $row[3];
	$fut_msg = $row[4];
}

if($flag){
	$sqlquery = "select voting_id, ques_no, question, a, b, c, d, active_status, max_options from voting_questions where id='" . $qutn_id . "' and voting_id='" . $cntsid . "' and companyName='" . $compName. "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row = mysql_fetch_row($result)){
		$ques_no = $row[1];
		$question = $row[2];
		$opt_a = $row[3];
		$opt_b = $row[4];
		$opt_c = $row[5];
		$opt_d = $row[6];
		$act_status = $row[7];
		$max_option = $row[8];
		$voting_seq = $row[10];
		$hdr1 = $row[11];
	}
}
if ($max_option == 2){
	$options = " Options A." . $opt_a . " B." . $opt_b;
}elseif ($max_option == 3){
	$options = " Options A." . $opt_a . " B." . $opt_b . " C." . $opt_c;
}elseif ($max_option == 4){
	$options = " Options A." . $opt_a . " B." . $opt_b . " C." . $opt_c . " D." . $opt_d;
}

if ($ques_no == 1){
	$prev_text = $welcome_header . " Your Q:" . $question . " " . $options . " " . $fut_msg;
}else if($score_type == 1){
	$prev_text = "Your score is [score]. Your next Q:" . $question . " " . $options . " " . $fut_msg;
}else{
	$prev_text = "Your Q:" . $question  . " " . $options . " " . $fut_msg;
}
user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code();
workareatop_new(); 					//workareatop();
?>

<script language="javascript" type='text/javascript'>
function PrevQuestion(f_val,f_name) {

	var q_no = "<? echo $ques_no; ?>"
	var max_opt = "<? echo $max_option; ?>"
	var fut_msg="<? echo $fut_msg; ?>";
	prev_qstn = ""
	opt = ""
	opta = ""
	optb = ""
	optc = ""
	optd = ""


	if (f_name == "question"){
		prev_qstn = f_val
	}

	if (f_name == "opt_a"){
		opta = f_val
	}

	if (f_name == "opt_b"){
		optb = f_val
	}

	if (f_name == "opt_c"){
		optc = f_val
	}

	if (f_name == "opt_d"){
		optd = f_val
	}

	if (prev_qstn == ""){
		prev_qstn = document.question_modify.question.value
	}

	if (opta == ""){
		opta = document.question_modify.opt_a.value
	}

	if (optb == ""){
		optb = document.question_modify.opt_b.value
	}

	if (max_opt == 2){
		opt = " Option A." + opta + " B." + optb
	}
	if (max_opt == 3){
		if (optc == ""){
			optc = document.question_modify.opt_c.value
		}

		opt = " Option A." + opta + " B." + optb + " C." + optc
	}
	if (max_opt == 4){
		if (optc == ""){
			optc = document.question_modify.opt_c.value
		}
		if (optd == ""){
			optd = document.question_modify.opt_d.value
		}
		opt = " Option A." + opta + " B." + optb + " C." + optc + " D." + optd
	}

	if(q_no == 1){
		header_val = "<? echo $welcome_header ?>" + "Your 1st Q: " + prev_qstn + " " + opt + " " + fut_msg
	}

	if(q_no > 1 ){
		header_val = "Your score is [score]. Your next Q: " + prev_qstn + " " + opt + " " + fut_msg
	}
	document.question_modify.prev.value = header_val

}
</Script>

<form name="question_modify" id="question_modify" action="voting_question_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="100%" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f4f4e4">
				<TR>
					<TD height="26" width="80%" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Question Modification</TD>
					<TD height="26" class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
				</TR>
				<tr>
					<td colspan="2">
						<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%"  bgcolor="#525200">
							<tr height="8" bgcolor="#D9D9A8">
								<td width="30%"></td>
								<td width="60%"></td>
								<td width="10%"></td>
							</tr>
					<?if (strlen($msg_alert) > 0){?>
							<tr height="18">
								<td align="center" class="bold_red_text" colspan="3" bgcolor="#D9D9A8">
									<?echo ucfirst($msg_alert)?>
								</td>
							</tr>
							<?}?>

							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Voting Name&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $cnts_name; ?></td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Header&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $welcome_header; ?></td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Question&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#D9D9A8">
									<input onMouseOver="showIT('Change the voting question here.')" onMouseOut="showIT()" type="text" name="question" value="<? echo $question; ?>" size=50 class="input" onkeyup="PrevQuestion(this.value,this.name)">
								</td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

<?for ($j=0;$j<$max_option;$j++){?>
							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Option <? echo chr($j+65); ?>&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#D9D9A8">
									<input onMouseOver="showIT('The answer option that you want to provide for the multiple choice voting question.')" onMouseOut="showIT()" type="text" name="<? echo 'opt_' . chr($j+97);?>" value = "<? echo ${'opt_' . chr($j+97)};?>" size=50 class="input" onkeyup="PrevQuestion(this.value,this.name)">
								</td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<?}?>
							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Active Status&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#D9D9A8">
									<textarea onFocus="this.blur()" READONLY onMouseOver="showIT('The last line on the voting screen.')" onMouseOut="showIT()" rows="6" cols="49" name="prev" class="input" onKeyDown="CountLeft(this.form.an_msg1,this.form.left1,160);" onKeyUp="CountLeft(this.form.an_msg1,this.form.left1,160);"><? echo $prev_text; ?></textarea>
								</td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>


							<tr>
								<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Active Status&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#D9D9A8">
									<select name="act_status" class="input" tabindex="26">
										<option value="">Select Status</option>
										<option value="1" <?if($act_status==1){ echo "selected='selected'";}?>>On</option>
										<option value="0" <?if($act_status==0){ echo "selected='selected'";}?>>Off</option>
									</select>
								</td>
								<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
   <!-- Hidden Company name field -->
                            <td align="left" valign="top" class="WorkGreen">
                                    <input type="hidden" name="companyName" value="<? echo $compName;  ?>" size="45" class="input"/>
                            </TD>
							<tr>
								<td bgcolor="#D9D9A8" align="right" colspan="2"><input type="button" onclick="question_submit('question_modify','<? echo $max_option; ?>')" class="submit1" value="Modify Here!!!" style="background-image:url('images/menu1.gif');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<TD bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr><!--onClick="return validate_form()-->
							<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<?
							print "<input type=hidden name=cnts_id value=$cntsid>";
							print "<input type=hidden name=max_option value=$max_option>";
							print "<input type=hidden name=question_id value=$qutn_id>";
							print "<input type=hidden name=login value=$login_form>";
							print "<input type =hidden name = sess_id value =$sess_id>";
							print "<input type =hidden name=action value=\"2\">";
							print "<input type =hidden name=treeview_cod value =$treeview_cod>";
							print "<input type =hidden name=smenu value=$smenu>";
							print "<input type =hidden name=cpName value= '".$compName."'>";

?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
	<div id="TTipes" style="position:absolute; height:25px; z-index:1; visibility: hidden;" >
	</div>
<?
workareabottom();
ffooter_new();			//ffooter();
?>