<?php

ob_start();

require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");


echo "<br>Voting V: ".$compName = $_REQUEST["cpName"];
$login_form = $_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$cnts_id = $_REQUEST["cnts_id"];
$treeview_cod = $_REQUEST["treeview_cod"];
$msg_alert = $_REQUEST["msg_alert"];
$cntsname = $_REQUEST["cnts_name"];
$smenu=$_REQUEST["smenu"];

$sqlquery = "select voting_name,welcome_message,voting_type,start_date,end_date,score,score_neg_status,negative_marking,cummilative_score,today_score,weekly_score,bill_status,application_id,price_status,price_pt,question_status,question_size,score_type,max_options,off_message,voting_over_message,voting_footer_message,active_status,footer_link,footer_sept,diplay_add,header_upload,footer_upload,key_status,keyword,key_alias_status,short_code from voting_detail where voting_id='" . $cnts_id . "' and companyName='" . $compName . "' limit 1";
//echo $sqlquery . "<br/>";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
while($row=mysql_fetch_row($result)){
	$cnts_name=$row[0];
	$welcome_msg=$row[1];
	$cnts_type=$row[2];
	$start_time=explode(" ",$row[3]);
	$start_time[0]=preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $start_time[0]);
	$s_date=$start_time[0];
	$temp=explode(":",$start_time[1]);
	$s_hour=$temp[0];
	$s_minute=$temp[1];
	$end_time=explode(" ",$row[4]);
	$end_time[0]=preg_replace('/(\d{4})-(\d{1,2})-(\d{1,2})/', '$2/$3/$1', $end_time[0]);
	$e_date=$end_time[0];
	$temp=array();

	$temp=explode(":",$end_time[1]);
	$e_hour=$temp[0];
	$e_minute=$temp[1];
	$score=$row[5];
	$score_neg_status=$row[6];
	$negative_marking=$row[7];
	$c_score=$row[8];
	$t_score=$row[9];
	$w_score=$row[10];
	$checkbill=$row[11];
	$app_id=$row[12];
	$price_status=$row[13];
	if($price_status==1) $price_status="Per Question";
	else if($price_status==2) $price_status="Per Voting";
	$price_pt=$row[14];
	$question_status=$row[15];
	$question_size=$row[16];
	$score_type= $row[17];
	$max_option=$row[18];
	$off_msg=$row[19];
	$over_msg=$row[20];
	$fut_msg=$row[21];
	$act_status=$row[22];
	$futchk=$row[23];
	$futsep=$row[24];
	if($futsep==1){ $futsep="Pipe Seperated";}
	else if($futsep==2){ $futsep="New Line Seperated";}
	else{ $futsep="";}

	$add_type=$row[25];
	$header_upload=$row[26];
	$footer_upload=$row[27];
	$checkkey=$row[28];
	$keyword=$row[29];
	$alischk=$row[30];
	$shortcode=$row[31];
}

if($checkkey){
	$sqlquery = "select id,keyword,shortcode from keyword where type_id='" . $cnts_id . "' limit 1";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnt=0;

	while($row=mysql_fetch_row($result)){
		$keyword_id=$row[0];
		$keyword=$row[1];
		$shortcode=$row[2];
	}
}

if($alischk){
	$keyid = keywordid ($keyword);

	$sqlquery = "select keyword_alias from keyword_detail where keyword_id='" . $keyid . "' and shortcode='" . $shortcode . "' and type_id='" . $cnts_id . "' and login='" . $login_form . "'";
	//echo $sqlquery;


	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$alias="";

	while($row=mysql_fetch_row($result)){
		if (!$alias){
			$alias=$row[0];
		}else{
			$alias=$alias . ",".  $row[0];
		}
	}
}


if($futchk){
	$sqlquery = "select footer_text,footer_link from voting_flink where voting_id='" . $cnts_id . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$cnt=0;

	while($row=mysql_fetch_row($result)){
		$futtxt[$cnt]=$row[0];
		$futlnk[$cnt++]=$row[1];
	}
}


/************GET Voting question DETAIL***********/
$sqlquery = "select * from voting_questions where voting_id='" . $cnts_id . "' limit 1";
//echo $sqlquery;
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
$q_exit = 0;
while($row = mysql_fetch_row($result)){
	$q_exit = 1;
}

user_session($login_form,$sess_id,$msg,$compName);

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

/************GET GROUP DETAIL***********/

if(!$cnts_name){
	$msg_alert = "Sorry!!! We Have Not Found Any Record Agains Your Request.Please Try After Some Time.";
?>
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26"><TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Management</TD></tr>
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
<form name="voting_view" id="voting_view" action="voting_engine_update.php" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
			<tr>
				<td>
					<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
						<TR height="26">

							<?if ($q_exit == 0){?>
								<TD width="474px" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Question View</TD>
								<TD width="120px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="voting_question.php?login=<? echo $login_form ?>&smenu=<? echo $smenu; ?>&sess_id=<? echo $sess_id; ?>&v_flag=<? echo $v_flag ?>&cnts_id=<? echo $cnts_id ?>&cnt=1&sg=<? echo $sg ?>&cpName=<? echo $compName ?>" ><img onmouseover="this.src='images/Add_Voting_Question_01.gif';" onmouseout="this.src='images/Add_Voting_Question.gif'" src="images/Add_Voting_Question.gif"/></a></TD>
								
								
								<TD width="70px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="voting_modify.php?login=<? echo $login_form ?>&sess_id=<? echo $sess_id; ?>&flag=1&cnts_id=<? echo $cnts_id ?>&cpName=<? echo $compName ?>&action=2"><img onmouseover="this.src='images/Edit_Voting_01.gif';" onmouseout="this.src='images/Edit_Voting.gif'" src="images/Edit_Voting.gif"/></a></TD>
								
								
								<TD width="80px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:document.voting_view.cnt.value='1';if (confirm('Are You sure you want to delete this voting?')==true){document.voting_view.submit();}else{void('null');}"><img onmouseover="this.src='images/Delete_Voting_01.gif';" onmouseout="this.src='images/Delete_Voting.gif'" src="images/Delete_Voting.gif"/></a></TD>

								<!--<TD width="454px" align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Management</TD>
								<TD width="129px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="voting_question.php?login=<? echo $login_form ?>&smenu=<? echo $smenu; ?>&sess_id=<? echo $sess_id; ?>&v_flag=<? echo $v_flag ?>&cnts_id=<? echo $cnts_id ?>&cnt=1&sg=<? echo $sg ?>" ><img onmouseover="this.src='images/Add_Voting_Question_01.gif';" onmouseout="this.src='images/Add_Voting_Question.gif'" src="images/Add_Voting_Question.gif"/></a></TD>
								<TD width="75px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="voting_modify.php?login=<? echo $login_form ?>&sess_id=<? echo $sess_id; ?>&flag=1&cnts_id=<? echo $cnts_id ?>&action=2"><img onmouseover="this.src='images/Edit_Voting_01.gif';" onmouseout="this.src='images/Edit_Voting.gif'" src="images/Edit_Voting.gif"/></a></TD>
								<TD width="90px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:document.voting_view.cnt.value='1';if (confirm('Are You sure you want to delete this voting?')==true){document.voting_view.submit();}else{void('null');}"><img onmouseover="this.src='images/Delete_Voting_01.gif';" onmouseout="this.src='images/Delete_Voting.gif'" src="images/Delete_Voting.gif"/></a></TD>
								-->
							<?}else{?>
							
								<TD width="454px" align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Management</TD>
								<TD width="129px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"></TD>
								
								<TD width="75px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="voting_modify.php?login=<? echo $login_form ?>&sess_id=<? echo $sess_id; ?>&flag=1&cnts_id=<? echo $cnts_id ?>&cpName=<? echo $compName ?>&action=2"><img onmouseover="this.src='images/Edit_Voting_01.gif';" onmouseout="this.src='images/Edit_Voting.gif'" src="images/Edit_Voting.gif"/></a></TD>
								
								<TD width="90px" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="javascript:document.voting_view.cnt.value='1';if (confirm('Are You sure you want to delete this voting?')==true){document.voting_view.submit();}else{void('null');}"><img onmouseover="this.src='images/Delete_Voting_01.gif';" onmouseout="this.src='images/Delete_Voting.gif'" src="images/Delete_Voting.gif"/></a></TD>
							<?}?>
						</tr>
						<tr>
							<td colspan="4">
								<table align="left" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#525200">
									<tr height="8px" bgcolor="#D9D9A8">
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

									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<? if ($cnts_id != ""){ ?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Voting Name&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $cnts_name; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen" bgcolor="#D9D9A8">Introduction Message&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $welcome_msg; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Start Date Time&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4">
											<input type="text" id="s_date" class="input" name='s_date' value="<? echo $s_date; ?>" disabled="disabled"/>
											<select disabled name="s_hour" class="input"><option value="">Hour</option><option value="<? echo $s_hour; ?>" selected="selected"><? echo $s_hour; ?></option></select>
											<select disabled name="s_minute" class="input"><option value="">Minute</option><option value="<? echo $s_minute; ?>" selected="selected"><? echo $s_minute; ?></option></select>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Stop Date Time&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4">
											<input type="text" id="e_date" class="input" name='e_date' value="<? echo $e_date; ?>"  disabled="disabled">
											<select disabled name="e_hour" class="input"><option value="">Hour</option><option value="<? echo $e_hour; ?>" selected="selected"><? echo $e_hour; ?></option></select>
											<select disabled name="e_minute" class="input"><option value="">Minute</option><option value="<? echo $e_minute; ?>" selected="selected"><? echo $e_minute; ?></option></select>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

								<?if($checkkey){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen"> Keyword&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $keyword; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Short Code&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $shortcode; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<?if($alischk){?>
										<tr height="16px" bgcolor="#D9D9A8">
											<td align="right" class="WorkGreen">Keyword Alias&nbsp;:&nbsp;</td>
											<td align="left" bgcolor="#f4f4e4"><? echo $alias; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
									<?}
								}?>


								<?if($checkbill){?>
									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen"> Application Id&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $app_id; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Price Point&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $price_pt; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
								<?}?>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Display Results&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4">
											<?if ($score_type == 1){?>
												On
											<?}else{?>
												Off
											<?}?>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Max Options Per Question&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $max_option; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Voting Footer Message&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $fut_msg; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

<?
							if($futchk){
								for($i=0;$i<count($futtxt);$i++){
?>
									<tr height="16" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Footer Text &nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><input type="text" class="input" name ='futtxt[]' value="<? echo $futtxt[$i]; ?>" disabled="disabled"/>&nbsp;&nbsp;Footer Link&nbsp;:&nbsp;<input type="text" class="input" name ='futlnk[]' value="<? echo $futlnk[$i]; ?>" disabled="disabled"/></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?								}
							}
							if($futsep){
?>
									<tr height="16" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Footer Seperator&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $futsep; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?							}?>
									<tr height="16" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Display Ads&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? if($add_type==1){ echo "Add On"; }else {echo "Add Off"; }?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">End of Voting Message&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $over_msg; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Voting Expiry Message&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><? echo $off_msg; ?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

									<tr height="16px" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Active Status&nbsp;:&nbsp;</td>
										<td align="left" bgcolor="#f4f4e4"><?if ($act_status==1){ echo "On"; }else{echo "Off"; }?></td>
										<td>&nbsp;</td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Upload Header Image Zip&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $header_upload; ?></td>
								<td align="left" class="WorkGreen"></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Upload Footer Image Zip&nbsp;:&nbsp;</td>
								<td align="left" bgcolor="#f4f4e4"><? echo $footer_upload; ?></td>
								<td align="left" class="WorkGreen"></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<?}?>
							<?print "<input type =hidden name=oldcnts_name value ='$cnts_name'>";?>
							<?print "<input type =hidden name=cnts_id value =$cnts_id>";?>
							<?print "<input type =hidden name = sess_id value =$sess_id>";?>
							<?print "<input type =hidden name=cnts_id1 value =$cnts_id>";?>
							<?print "<input type =hidden name=login value =$login_form>";?>
							<?print "<input type =hidden name=cnt value='0'>";?>
							<?print "<input type =hidden name=action value =3>";?>
							<?print "<input type =hidden name = smenu value =$smenu>";?>
							<?print "<input type =hidden name=treeview_cod value =$treeview_cod>";?>
							<?print "<input type =hidden name=cpName value ='".$compName."'>";?>
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

function keywordid ($keyword)
{
	global $shortcode, $cnts_id;
	$sqlquery = "select id from keyword where keyword='" . $keyword . "' and shortcode='" . $shortcode . "' and type_id='" . $cnts_id . "'";
	//echo "<br/>" . $sqlquery . "<br/>";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	$keyid="";
	while($row=mysql_fetch_row($result)){
		$keyid=$row[0];
	}
	return $keyid;
}
?>