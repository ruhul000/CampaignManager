<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$treeview_cod = $_REQUEST["treeview_cod"];
$login_form = $_REQUEST["login"];
$sess_id = $_REQUEST["sess_id"];
$cntsid = $_REQUEST["cnts_id"];
$month = $_REQUEST["month"];
$year = $_REQUEST["year"];
$msg_alert = $_REQUEST["msg_alert"];
$rand =$_REQUEST["rand"];

$curr_day = date ("d");
$curr_month = date ("m");
//echo $month;
if($msg_alert==""){
	$msg="Contest Question View Choosess";
}else{
	$msg=$msg_alert;
}

$day = day_display ($month);
//echo "<br/>". $day;

$showmonth = get_month ($month);

if ($curr_month == $month){
	if ($curr_day > $day){
		$day = $day;
	}else{
		$day = $curr_day-1;
	}
}

//echo "<br/>". $day;
if ($cntsid != 000){
	$sqlquery = "select contest_name from contest_detail where contest_id='" . $cntsid . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

	while($row = mysql_fetch_row($result)){
		$cntsname = $row[0];
	}
}else{
	$cntsname = "ALL";
}

//echo "sdfsd". $month . $year;
user_session($login_form,$sess_id,$msg);

hheader(7);
tree_code ();
workareatop_new();

$question = "1";
if($i == 10){
	$msg_alert = "Sorry!!! We Have Not Found ";
?>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
		<tr><td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="620px">
				<TR height="22px"><TD class="WorkWht" background="images/menustrip.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Msisdn Wise Report</TD></tr>
				<tr><td>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="620px">
						<tr height="8px" bgcolor="#D9D9A8"><td></td></tr>
						<tr height="22px"><TD  bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD></tr>
						<tr height="8px"><td bgcolor="#D9D9A8"></td></tr>
					</table>
				</td></tr>
			</table>
		</td></tr>
	</table>
<? die();}?>

<form name="contest_form" action="question_update.php" method="post" onsubmit="return isValid()">
	<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
				<TR height="26">
					<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;&nbsp;CDR for the month of <? echo $showmonth ?></TD>
				</TR>

				<tr>
					<td>
						<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200" style="table-layout:fixed;">
							<? if (strlen($msg_alert) > 0){ ?>
								<tr bgcolor="#D9D9A8">
									<TD  bgcolor="#D9D9A8" align="center" colspan="3" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
								</tr>
								<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
							<? } ?>

							<tr bgcolor="#D9D9A8">
								<td background="images/welcomestrip.gif" align="center" align="center" class="WorkBlk"><b>Date</b></td>
								<td background="images/welcomestrip.gif" align="center" align="center" class="WorkBlk"><b>Contest Name</b></td>
								<td background="images/welcomestrip.gif" align="center" align="center" class="WorkBlk"><b>Download</b></td>
							</tr>

							<?for ($i=1;$i<=$day;$i++){
								if ($i <10){
									$ii = "0" . $i;
								}else{
									$ii = $i;
								}
								$daytoshow = $ii . "/" . $month . "/" . $year;
								$cdr_file = "ContestCDR_" . $month . $ii . $year;

								$sqlquery = "select * from file_detail where day(cdrdate)='" . $ii . "' and month(cdrdate)='" . $month . "' and year(cdrdate)='" . $year . "' and foldername='" . $cntsname . "'";
								//echo $sqlquery;
								//die();
								$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

								$fileexist = 0;
								while($row = mysql_fetch_row($result)){
									$fileexist = 1;
								}
							?>
								<tr bgcolor="#D9D9A8">
									<td class="WorkBlack" align="center">
										<? echo $daytoshow?>
									</td>
									<td align="center" class="WorkBlack">
										<? echo $cntsname?>
									</td>
									<td align="center" class="WorkBlueNormal">
										<?if ($fileexist == 0){?>
											No CDR Exist
										<?}else{?>
											<a class="WorkBlueNormal" href='contestcdr/<? echo strtolower($cntsname)?>/<? echo $cdr_file?>.zip'>Download</a>
										<?}?>
									</td>
								</tr>
							<?}?>

							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<?
								print "<input type=hidden name=cnts_id value=$cntsid>";
								print "<input type=hidden name=login value=$login_form>";
								print "<input type=hidden name=sess_id value=$sess_id>";
								print "<input type=hidden name=question_id value=$qstn_id>";
								print "<input type=hidden name=action value=\"3\">";
								print "<input type=hidden name=treeview_cod value=$treeview_cod>";
								print "<input type=hidden name=rand value=$rand>";
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
ffooter();			//ffooter();
?>