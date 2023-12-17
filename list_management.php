<?php
require("gui_common.php");
require("template.php");

$smenu=$_REQUEST["smenu"];
$action=$_REQUEST["action"];
$treeview_cod=$_REQUEST["treeview_cod"];
$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];

$msg_alert = $_REQUEST["msg_alert"];
$cnt = $_REQUEST["cnt"];
$lst_id = $_REQUEST["lid"];
$sg = $_REQUEST["sg"];
if ($lst_id == ""){
	$lst_id = $_REQUEST["list_id"];
}
$rule_id = $_REQUEST["rule_id"];
$treeview_cod = $_REQUEST["treeview_cod"];
$action = $_REQUEST["action"];
$v_flag = $_REQUEST["v_flag"];
$s_flag = $_REQUEST["s_flag"];
$reset = $_REQUEST["reset"];
$num_msg = $_REQUEST["num_msg"];

if ($v_flag == ""){
	$v_flag = 0;
}

/************GET LIST DETAIL***********/
$sqlquery;
$result;

$sqlquery = "select list_id, list_name from list_detail where login_created='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$i = 0;
while($row = mysql_fetch_row($result)){
	$list_id[$i] = $row[0];
	$list_name[$i] = $row[1];
	$i = $i + 1;
}

/************GET TARGET DETAIL***********/
$sqlquery;
$result;

$sqlquery = "select target_id, target_name from target_detail where login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$t = 0;
while($row = mysql_fetch_row($result)){
	$target_id[$t] = $row[0];
	$target_name[$t] = $row[1];
	$t = $t + 1;
}


/************GET RULES DETAIL***********/
$sqlquery;
$result;

$sqlquery = "select distinct ads_id, ads_name from rules_detail where login='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

$r = 0;
while($row = mysql_fetch_row($result)){
	$rules_id[$r] = $row[0];
	$rules_name[$r] = $row[1];
	$r = $r + 1;
}


$sqlquery;
$result;

$sqlquery = "select list_name, start_datetime, end_datetime, resume, resume_start_datetime, resume_stop_datetime, num_messages, unique_push, status, monday_msg, monday_status, tuesday_msg, tuesday_status, wednesday_msg, wednesday_status, thursday_msg, thursday_status, friday_msg, friday_status, saturday_msg, saturday_status, sunday_msg, sunday_status, day(start_datetime),month(start_datetime),year(start_datetime),day(end_datetime),month(end_datetime),year(end_datetime),target_id,rule_id,hour(start_datetime),minute(start_datetime),hour(end_datetime),minute(end_datetime) from list_detail where list_id='" . $lst_id . "' and login_created='" . $login_form . "'";
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

while($row = mysql_fetch_row($result)){
	$rulesid = $row[0];
	$s_datetime = $row[1];
	$e_datetime = $row[2];
	$num_msg = $row[6];

	$mon_bool = $row[10];
	$tue_bool = $row[12];
	$wed_bool = $row[14];
	$thur_bool = $row[16];
	$fri_bool = $row[18];
	$sat_bool = $row[20];
	$sun_bool = $row[22];
	$num_mon = $row[9];
	$num_tue = $row[11];
	$num_wed = $row[13];
	$num_thur = $row[15];
	$num_fri = $row[17];
	$num_sat = $row[19];
	$num_sun = $row[21];
	$s_day = $row[23];
	$s_month = $row[24];
	$s_year = $row[25];
	$e_day = $row[26];
	$e_month = $row[27];
	$e_year = $row[28];
	$targetid = $row[29];
	$rulesid = $row[30];
	$s_hour = $row[31];
	$s_minute = $row[32];
	$e_hour = $row[33];
	$e_minute = $row[34];
	if ($reset == 1){

		$err_flag = 100;
	}

	$de_show = $e_month . "/" . $e_day . "/" . $e_year . " " . $s_hour . ":" . $s_minute;
	$ds_show = $s_month . "/" . $s_day . "/" . $s_year . " " . $e. ":" . $e_minute;

	//echo "<br>" . $rulesid;

	//echo "<br>" . $ds_show;

	//echo "E_Year=" . $targetid;
}

if ($cnt == 1){
	$s_day11 = $_REQUEST["s_day"];
	$e_day11 = $_REQUEST["e_day"];
	$sub_flag = 1;
	//echo "<br>dd" . $sub_flag;
	//echo "<br>dd" . $e_day11;

	//echo "s_day=" . $s_day;
}

//echo $s_day . "33<br>";

$submit_flag = 0;

if ($cnt == 2 || $s_flag == 1){
	$submit_flag = 0;
	$s_month = $_REQUEST["s_month"];
	$e_month = $_REQUEST["e_month"];
	$s_day = $_REQUEST["s_day"];
	$e_day = $_REQUEST["e_day"];
	$s_year = $_REQUEST["s_year"];
	$e_year = $_REQUEST["e_year"];
	$s_hour = $_REQUEST["s_hour"];
	$e_hour = $_REQUEST["e_hour"];
	$s_minute = $_REQUEST["s_minute"];
	$e_minute = $_REQUEST["e_minute"];
	$err_flag = 1;
	//echo $s_day . "66<br>";
}

if ($err_flag == ""){
	$err_flag = $_REQUEST["err_flag"];
}

//if ($cnt == 1){
// 	$err_flag = $_REQUEST["err_flag"];
//	$submit_flag = 0;
//	//echo $submit_flag;
//	$de_show = $e_month . "/" . $e_day . "/" . $e_year;
//}



if ($cnt == 5){
	$submit_flag = 1;
	$s_month = $_REQUEST["s_month"];
	$e_month = $_REQUEST["e_month"];
	$s_day = $_REQUEST["s_day"];
	$e_day = $_REQUEST["e_day"];
	$s_year = $_REQUEST["s_year"];
	$e_year = $_REQUEST["e_year"];
	$s_hour = $_REQUEST["s_hour"];
	$e_hour = $_REQUEST["e_hour"];
	$s_minute = $_REQUEST["s_minute"];
	$e_minute = $_REQUEST["e_minute"];
	$err_flag = 0;
	$de_show = $e_month . "/" . $e_day . "/" . $e_year;
	//echo $de_show;
	//die();

}
if($msg_alert==""){
	$msg="Scheduler Creation Choosess";
}else{
	$msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();

?>
	<script src="group_js.js"></script>
	<script src="tooltip.js"></script>
	<Script language="JavaScript">
		function form_submit ()
		{
			document.login_form.submit();
		}
	</Script>

	<script language="JavaScript">
			function cnts_submit (){
			document.login_form.submit();
		}

		function chek()
		{
			document.login_form.subgrp_id_new.value=document.login_form.subgroup_id.value;
		}

		function validate()
		{
			var group_name;
			group_name = document.login_form.group_name.value;
			if (group_name == ""){
				alert("Please enter Group name!!!");
			}
		}
	</script>
	<script type="text/javascript">
		/****TO VALIDATE THE FIELD****/
		function validate_required(field,alerttxt)
		{
			with (field){
				if (value==null||value==""){
					alert(alerttxt);return false;
				}else{
					return true
				}
			}
		}

		/****TO VALIDATE EVERY FORM TEXTBOX****/
		function validate_form(thisform)
		{
			with (thisform){
				if (validate_required(group_name,"Please enter Group name!!!")==false){
					group_name.focus();
					return false;
				}else if (validate_required(group_desc,"Please enter Description!!!")==false){
					group_desc.focus();
					return false;
				}
			}
	}
	</script>
<?
if ($sg == 1){
?>

<TABLE ALIGN="left" BORDER=0 CELLSPACING=1 CELLPADDING=0 WIDTH="80%" bgcolor="#525200">
<form name=login_form action="list_edit_update_new.php" method="post" enctype="multipart/form-data" onsubmit="return validate_form(this)">
	<tr>
		<td>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f4f4e4">
			<TR>
				<TD height="26" width="70%" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler</TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="list_create.php?login=<? echo $login_form ?>&v_flag=<? echo $v_flag ?>&lid=<? echo $lst_id ?>&act=4&cnt=1&sg=<? echo $sg ?>">Add New</a></TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="list_edit_new.php?login=<? echo $login_form ?>&v_flag=<? echo $v_flag ?>&lid=<? echo $lst_id ?>&act=4&cnt=1&sg=<? echo $sg ?>">Edit</a></TD>
				<TD height="26" width="10%" align="center" background="images/trgt_hdr1.gif" class="WorkWht"><a class="WorkWht" href="list_delete.php?login=<? echo $login_form ?>&v_flag=<? echo $v_flag ?>&lid=<? echo $lst_id ?>&act=4&cnt=1&sg=<? echo $sg ?>">Delete</a></TD>
			</TR>
			<TR>
				<TD colspan="4">
					<TABLE ALIGN="center" BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH="100%"  bgcolor='#525200'>

					<?if (strlen($msg_alert) > 0){?>

											<TR>
											<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
											<TD  bgcolor="#D9D9A8" align="left"><?echo ucfirst($msg_alert)?></TD>
											<TD  bgcolor="#D9D9A8" align="center">&nbsp;</TD>
											</TR>
										<?}?>
											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR>
												<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="30%" ALIGN="right">Scheduler Name :&nbsp;</TD>
												<TD bgcolor="#f4f4e4" colspan="2">
													<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH='100%'>
														<TR bgcolor="#f4f4e4" >
															<TD class="WorkGreen"  bgcolor="#f4f4e4" align='left' WIDTH="71%">
															<?for ($j=0;$j<=$i-1;$j++){
																if ($list_id[$j] == $lst_id){?>
																	<label for="female"><? echo $list_name[$j] ?></label>
																<?}
															}?>
															</TD>
															<TD class="WorkRed" id="txtHint"  bgcolor="#D9D9A8" align='left' WIDTH="60%">&nbsp;</TD>
														</TR>
													</TABLE>
												</TD>
											</TR>

											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR>
												<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="30%" ALIGN="RIGHT">Target Name :&nbsp;</TD>
												<TD  bgcolor="#f4f4e4" WIDTH="50%">
													<?for ($j=0;$j<=$t-1;$j++){?>
														<?if ($target_id[$j] == $targetid){?>
															<label for="female"><? echo $target_name[$j] ?></label>
														<?}
													}?>
												</TD>
												<TD class="WorkBldGreen"  bgcolor="#D9D9A8" WIDTH="20%" ALIGN="RIGHT">&nbsp;</TD>
											</TR>

											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR>
												<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="30%" ALIGN="RIGHT">Scheduler Date :&nbsp;</TD>
												<TD  bgcolor="#f4f4e4" WIDTH="50%">
														<img src="images/bullet1.gif" border="0">
													Beginning Date/Time:
													<?if ($err_flag == 100){?>
														<input onmouseover="toolTip('Specify the dates for the list to be active. The SMS promotional message created the particular campaign is sent to the selected target on the dates mentioned here.','#000000', '#FFFF99')" onmouseout="toolTip()" type="text" name="datbegin" size="10" ID="datbegin">&nbsp;
														<script language=javascript>
															var basicCal = new calendar("FIELD:document.login_form.datbegin;");
															basicCal.writeCalendar();
														</script>
														<input type =hidden name=upd value ="1">
													<?}else{
														$hide_flag = 1;
														$submit_flag = 1;
														$d_show = $s_month . "/" . $s_day . "/" . $s_year . " " . $s_hour . ":" . $s_minute;

													?>
														<input type="text" name="datbegin" size="12" ID="datbegin" disabled value="<? echo $d_show ?>">&nbsp;
														<input type =hidden name=s_year value ="<? echo $s_year ?>">
														<input type =hidden name=s_month value ="<? echo $s_month ?>">
														<input type =hidden name=s_day value ="<? echo $s_day ?>">
													<?}?>
													<br/><img src="images/bullet1.gif" border="0">
													Ending Date/Time:
													<?if ($err_flag == 100){?>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input onmouseover="toolTip('Specify the dates for the list to be active. The SMS promotional message created the particular campaign is sent to the selected target on the dates mentioned here.','#000000', '#FFFF99')" onmouseout="toolTip()" type="text" name="datend" size="10" ID="datend">&nbsp;
														<script language=javascript>
															var basicCal2 = new calendar("FIELD:document.login_form.datend;");
															basicCal2.writeCalendar();
														</script>
													<?}else{
														$de_show = $e_month . "/" . $e_day . "/" . $e_year . " " . $e_hour . ":" . $e_minute;
													?>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="datend" size="12" value="<? echo $de_show ?>" disabled>&nbsp;
														<input type =hidden name=e_year value ="<? echo $e_year ?>">
														<input type =hidden name=e_month value ="<? echo $e_month ?>">
														<input type =hidden name=e_day value ="<? echo $e_day ?>">
													<?}?>


												</TD>
												<TD class="WorkBldGreen"  bgcolor="#D9D9A8" WIDTH="20%" ALIGN="RIGHT">&nbsp;</TD>
											</TR>
												<?if ($err_flag == 100){?>
												<SCRIPT LANGUAGE="JavaScript">
													<!--
														d = new Date();
														m = d.getMonth();
														m++;
														y = d.getFullYear();
														day = d.getDate();
														time1 = m+"/"+day+"/"+y;
														var myDate=new Date()
														myDate.setDate(myDate.getDate()+1)

														var myDateLimit=new Date()
														myDateLimit.setDate(myDateLimit.getDate()+6)


														day1 = myDate.getDate();
														time2 = m+"/"+day1+"/"+y;

														dayLimit = myDateLimit.getDate();
														//monthLimit = myDateLimit.getMonth();
														timeLimit = m+"/"+dayLimit+"/"+y;

														document.login_form.datbegin.value=time1;
														document.login_form.datend.value=time2;
														document.login_form.datlimit.value=timeLimit;
														//alert (document.login_form.datlimit.value);

													function compdate()
													{
														//alert (document.login_form.datlimit.value);
														lst_name = document.login_form.list_id.value;
														if (Date.parse(document.login_form.datbegin.value) > Date.parse(document.login_form.datend.value))
														{
															alert("Invalid Date Range!\nBeginning Date cannot be after Ending date!")
															return false;
														}
														else if ((Date.parse(document.login_form.datbegin.value) > Date.parse(document.login_form.datlimit.value)) || (Date.parse(document.login_form.datend.value) > Date.parse(document.login_form.datlimit.value)))
														{
															alert("Invalid Date Range!\nYour date range must be within one week")
															return false;
														}
														else if (lst_name == ""){
															alert ("Please enter the list name!");
															return false;
														}
														else
														{
															document.login_form.cnt.value="5";
															document.login_form.err_flag.value="1";
															document.login_form.submit();
														}

													}
													-->
												</SCRIPT>
												<?}?>

											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR>
												<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="30%" ALIGN="RIGHT">Message :&nbsp;</TD>
												<TD  bgcolor="#f4f4e4" WIDTH="50%">
													<?for ($j=0;$j<=$r-1;$j++){?>
														<?if ($rules_id[$j] == $rulesid){?>
															<label for="female"><? echo $rules_name[$j] ?></label>
														<?}
													}?>
												</TD>
												<TD class="WorkBldGreen"  bgcolor="#D9D9A8" WIDTH="20%" ALIGN="RIGHT">&nbsp;</TD>
											</TR>

											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR>
												<TD class="WorkGreen"  bgcolor="#D9D9A8" WIDTH="30%" ALIGN="RIGHT">No of Messages :&nbsp;</TD>
												<TD  bgcolor="#f4f4e4" WIDTH="50%">
													<label for="female"><? echo $num_msg ?></label>
												</TD>
												<TD class="WorkBldGreen"  bgcolor="#D9D9A8" WIDTH="20%" ALIGN="RIGHT">&nbsp;</TD>
											</TR>


											<TR><TD  bgcolor="#D9D9A8" colspan="3" height="8"></TD></TR>

											<TR><TD  bgcolor="#D9D9A8" colspan="3">&nbsp;</TD></TR>
					</TABLE>
				</TD>
			</TR>
		</TABLE>

<?print "<input type =hidden name = login value =$login_form>";?>
<?print "<input type =hidden name=treeview_cod value =$treeview_cod>";?>
<?print "<input type=hidden name=cnt value='0'>";?>
<?print "<input type=hidden name=err_flag value='1'>";?>
<?print "<input type=hidden name=login value=$login_form>";?>
<?print "<input type =hidden name=action value =$action>";?>

<?if ($hide_flag == 1){?>
	<?print "<input type =hidden name=s_month value =$s_month>";?>
	<?print "<input type =hidden name=s_day value =$s_day>";?>
	<?print "<input type =hidden name=s_year value =$s_year>";?>
	<?print "<input type =hidden name=e_month value =$e_month>";?>
	<?print "<input type =hidden name=e_day value =$e_day>";?>
	<?print "<input type =hidden name=e_year value =$e_year>";?>
<?}?>
</FORM>
<?}?>
	</TD>
</TR>
</TABLE>
<?
workareabottom();
ffooter_new();			//ffooter();
?>