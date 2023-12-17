<?php

ob_start();

require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

echo "<br>Voting Q: ".$compName = $_REQUEST["cpName"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$msg_alert = $_REQUEST["msg_alert"];
$smenu = $_REQUEST["smenu"];

$cntsid = $_REQUEST["cnts_id"];
$qstn_id = $_REQUEST["question_id"];
$cnts_question = $_REQUEST["cnts_question"];
$opt_a=$_REQUEST["opt_a"];
$opt_b=$_REQUEST["opt_b"];
$opt_c=$_REQUEST["opt_c"];
$opt_d=$_REQUEST["opt_d"];
$cnts_ans=($_REQUEST["cnts_ans"]=="")?"a":$_REQUEST["cnts_ans"];
$max_option = $_REQUEST["max_option"];
$act_status = $_REQUEST["act_status"];
$score_type = $_REQUEST["score_type"];

if($msg_alert==""){
	$msg="Voting Question Add Choosess";
}else{
	$msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

$ques_no = voting_qestion_detail ($cntsid);

/************GET GROUP DETAIL***********/
$sqlquery = "select voting_name, max_options, welcome_message, voting_type, start_date, end_date, off_message, voting_over_message,active_status,score_type,voting_footer_message from voting_detail where voting_id='" . $cntsid . "' and companyName='" . $compName. "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row = mysql_fetch_row($result)){
	$cnts_name=$row[0];
	$max_option=$row[1];
	$welcome_message=$row[2];
	$voting_type=($row[3]==1)?"Continuous":"Stop on error";

	$start_time = explode(" ",$row[4]);
	$start_time[0] = preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $start_time[0]);
	$s_date = $start_time[0];
	$temp = explode(":",$start_time[1]);
	$s_hour = $temp[0];
	$s_minute = $temp[1];
	$end_time = explode(" ",$row[5]);
	$end_time[0] = preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $end_time[0]);
	$e_date = $end_time[0];
	$temp = explode(":",$end_time[1]);
	$e_hour = $temp[0];
	$e_minute = $temp[1];

	$off_msg = $row[6];
	$over_msg = $row[7];
	$act_status = $row[8];
	$score_type = $row[9];
	$fut_msg = $row[10];
}

if ($max_option == 2){
	$options = " Option A." . $opt_a . " B." . $opt_b . "";
}elseif ($max_option == 3){
	$options = " Option A." . $opt_a . " B." . $opt_b . " C." . $opt_c . "";
}elseif ($max_option == 4){
	$options = " Option A." . $opt_a . " B." . $opt_b . " C." . $opt_c . " D." . $opt_d . "";
}

if ($ques_no==1){
	$prev_text=$welcome_message . ". Your Q: " . $options . " " . $fut_msg;
}else if($score_type == 1){
	$prev_text = "Your score is [score]. Your next Q:" . $question  . " " . $options . " " . $fut_msg;
}else{
	$prev_text="Your next question is Q: " . $options . " " . $fut_msg;
}

?>
<script src="voting_js.js"></script>

<script language="javascript" type="text/javascript">
var q_no="<? echo $ques_no ?>";
var max_opt = "<? echo $max_option ?>";

function PrevQuestion(f_val,f_name) {
prev_qstn="";
opt = "";
opta = "";
optb = "";
optc = "";
optd = "";
if (f_name == "question"){prev_qstn=f_val;}
if (f_name=="opt_a"){opta=f_val;}
if (f_name=="opt_b"){optb=f_val;}
if (f_name=="opt_c"){optc=f_val;}
if (f_name=="opt_d"){optd=f_val;}

if (prev_qstn==""){prev_qstn=document.question_form.question.value;}
if (opta==""){opta=document.question_form.opt_a.value;}
if (optb == ""){optb = document.question_form.opt_b.value;}
if (max_opt == 2){opt = " Option A." + opta + " B." + optb;}
if (max_opt == 3){
	if (optc == ""){optc = document.question_form.opt_c.value;}
	opt = "Option A. "+opta+" B."+optb+" C."+optc;
}
if (max_opt == 4){
	if (optc == ""){optc = document.question_form.opt_c.value;}
	if (optd == ""){optd = document.question_form.opt_d.value;}
	opt = " Option A." + opta + " B." + optb + " C." + optc + " D." + optd
}

if(q_no==1){header_val="<? echo $welcome_message; ?>"+"Your Q: "+prev_qstn+" "+opt+" "+"<? echo  $fut_msg;?>";}
if(q_no>1 ){header_val="Your score is [score]. Your Q: "+prev_qstn+" "+opt+" "+"<? echo  $fut_msg;?>";}

document.question_form.prev.value = header_val;

}
</script>


<form name="question_form" id="question_form" action="voting_question_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="100%" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f4f4e4">
				<TR>
					<TD height="26" width="80%" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Question Creation</TD>
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
									<tr height="22">
										<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
										<TD  bgcolor="#D9D9A8" align="left" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
										<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
									</tr>
									<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
								<?}?>


								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Voting Name&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#f4f4e4"><? echo $cnts_name; ?></td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<? if ($cntsid != ""){ ?>
								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Header&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#f4f4e4"><? echo $welcome_message; ?></td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Start Date Time&nbsp;:&nbsp;</td>
									<TD bgcolor="#f4f4e4" WIDTH="40%">
										<input type="text" id="s_date" class="input" name='s_date' value="<? echo $s_date; ?>" readonly="readonly"/>

										<select disabled name="s_hour" class="input">
											<option value="<? echo $s_hour; ?>"><? echo $s_hour; ?></option>
										</select>

										<select disabled name="s_minute" class="input">
											<option value="<? echo $s_minute; ?>"><? echo $s_minute; ?></option>
										</select>
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Stop Date Time&nbsp;:&nbsp;</td>
									<TD bgcolor="#f4f4e4" WIDTH="40%">
										<input type="text" id="e_date" class="input" name='e_date' value="<? echo $e_date; ?>" readonly="readonly"/>

										<select disabled name="e_hour" class="input">
											<option value="<? echo $e_hour; ?>"><? echo $e_hour; ?></option>
										</select>

										<select disabled name="e_minute" class="input">
											<option value="<? echo $e_minute; ?>"><? echo $e_minute; ?></option>
										</select>
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

								<tr>
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Question&nbsp;:&nbsp;</td>
									<td align="left" bgcolor="#D9D9A8">
										<input onMouseOver="showIT('Type the Voting Question that you want to add to the voting.')" onMouseOut="showIT()" type="text" name="question" value = "<? echo $cnts_question; ?>" size=50 class="input" onkeyup="PrevQuestion(this.value,this.name)">
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
									<td align="right" class="WorkGreen" bgcolor="#D9D9A8">&nbsp;Preview:&nbsp;</td>
									<td align="left" bgcolor="#D9D9A8">
										<textarea READONLY onMouseOver="showIT('The last line on the voting screen.')" onMouseOut="showIT()" rows="6" cols="49" name="prev" class="input"><? echo $prev_text ?></textarea>
									</td>
									<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
								</tr>
								<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>

<!-- Hidden Company name field -->
                            <td align="left" valign="top" class="WorkGreen">
                                    <input type="hidden" name="companyName" value="<? echo $compName;  ?>" size="45" class="input"/>
                            </TD>
				

									<tr>
										<td bgcolor="#D9D9A8" align="right" colspan="2"><input type="button" onclick="voting_question_submit('question_form','<? echo $max_option; ?>')" class="submit1" value="Insert Here!!!" style="background-image:url('images/menu1.gif');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<TD bgcolor="#D9D9A8" align="center">&nbsp;</TD>
									</tr><!--onClick="return validate_form()-->
									<tr height="8"><td colspan="3" bgcolor="#D9D9A8"></td></tr>
<?	}
	print "<input type=hidden name=cnts_id value=$cntsid>";
	print "<input type =hidden name = login value =$login_form>";
	print "<input type=hidden name=sess_id value=$sess_id>";
	print "<input type=hidden name=question_id value=$qstn_id>";
	print "<input type=hidden name=max_option value=$max_option>";
	print "<input type =hidden name=action value =\"1\">";
	print "<input type =hidden name=treeview_cod value =$treeview_cod>";
	print "<input type =hidden name=smenu value =$smenu>";
	print "<input type =hidden name=cpName value ='".$compName."'>";
?>

								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</form>
<div id="TTipes" style="position:absolute; height:25px; z-index:1; visibility: hidden;"></div>
<?
workareabottom();
ffooter();
?>
