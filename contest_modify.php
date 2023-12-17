<?php

ob_start();

require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
echo "Modify: ".$compName = $_REQUEST["cpName"];

$errorlog=($_REQUEST["errorlog"]!="")?$_REQUEST["errorlog"]:0;
$flag=($_REQUEST["flag"]!="")?$_REQUEST["flag"]:0;
$action=$_REQUEST["action"];
$treeview_cod=$_REQUEST["treeview_cod"];
$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$msg_alert=$_REQUEST["msg_alert"];
$cnts_name=$_REQUEST["contest_name"];
$cntsid=$_REQUEST["cnts_id"];
$welcome_msg=$_REQUEST["welcome_msg"];
$cnts_type=$_REQUEST["contest_type"];
$s_date=$_REQUEST["s_date"];
$e_date=$_REQUEST["e_date"];
$s_hour=$_REQUEST["s_hour"];
$e_hour=$_REQUEST["e_hour"];
$s_minute=$_REQUEST["s_minute"];
$e_minute=$_REQUEST["e_minute"];
$score=$_REQUEST["score"];
$negscore=$_REQUEST["negscore"];
$c_score=$_REQUEST["c_score"];
$t_score=$_REQUEST["t_score"];
$w_score=$_REQUEST["w_score"];
$checkbill=$_REQUEST["checkbill"];
$app_id=$_REQUEST["app_id"];
$price_pt=$_REQUEST["price_pt"];
$checksmskey=$_REQUEST["checksmskey"];
$checksmsalias=$_REQUEST["checksmsalias"];
$aliastxt=$_REQUEST["aliastxt"];
$keyword=$_REQUEST["keyword"];

$bill_type=($_REQUEST["bill_type"]=="")?'1':$_REQUEST["bill_type"];
$ques_type=($_REQUEST["ques_type"]=="")?'2':$_REQUEST["ques_type"];
$quetsno=$_REQUEST["quetsno"];
$score_type=$_REQUEST["score_type"];
$max_option=$_REQUEST["max_option"];
$fut_msg=$_REQUEST["fut_msg"];
$futchk=$_REQUEST["futchk"];
$futtxt=$_REQUEST["futtxt"];
$futlnk=$_REQUEST["futlnk"];
$futsep=$_REQUEST["futsep"];
$add_type=$_REQUEST["add_type"];
$off_msg=$_REQUEST["off_msg"];
$over_msg=$_REQUEST["over_msg"];

$checkscore=$_REQUEST["checkscore"];
$locdt=date('m/d/Y/H/i/s', time());
$msg_alert=$_REQUEST["msg_alert"];
$act_status=$_REQUEST["act_status"];


if($msg_alert=="" || stripos($msg_alert,"Contest Successfully Updated!!!")!==false){
	$msg="Contest Modification Choosess";
}else{
	$msg=$msg_alert;
}
if($flag){
	$sqlquery = "select contest_name,welcome_message,contest_type,start_date,end_date,score,score_neg_status,negative_marking,cummulative_score,today_score,weekly_score,bill_status,application_id,price_status,price_pt,smskey_status,key_alias_status,question_status,question_size,score_type,max_options,off_message,contest_over_message,contest_footer_message,active_status,footer_link,footer_sept,diplay_add from contest_detail where contest_id='" . $cntsid . "' and companyName='" . $compName. "' limit 1";
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
		$checkscore=$row[6];
		$negscore=$row[7];
		$c_score=$row[8];
		$t_score=$row[9];
		$w_score=$row[10];
		$checkbill=$row[11];
		$app_id=$row[12];
		$bill_type=$row[13];
		$price_pt=($row[14]!=0)?$row[14]:'';
		$checksmskey=$row[15];
		$checksmsalias=$row[16];
		$ques_type=$row[17];
		$quetsno=($row[18]!=0)?$row[18]:'';
		$score_type= $row[19];
		$max_option=$row[20];
		$off_msg=$row[21];
		$over_msg=$row[22];
		$fut_msg=$row[23];
		$act_status=$row[24];
		$futchk=$row[25];
		$futsep=$row[26];
		$add_type=$row[27];
	}

	if($checksmskey){
		$sqlquery = "select id,keyword,shortcode from keyword where type_id='" . $cntsid . "' and login='" . $login_form . "' limit 1";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$cnt=0;

		while($row=mysql_fetch_row($result)){
			$keyword_id=$row[0];
			$keyword=$row[1];
			$shortcode=$row[2];
		}
	}

	if($checksmskey && $checksmsalias){

		$sqlquery = "select keyword_alias from keyword_detail where keyword_id='" . $keyword_id . "' and shortcode='" . $shortcode . "' and login='" . $login_form . "' order by keyword_alias";
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$cnt=0;
		while($row=mysql_fetch_row($result)){
			if(!$cnt){
				$aliastxt = $row[0];
				$cnt=1;
			}else{
				$aliastxt = $aliastxt . '|' . $row[0];
			}
		}
	}

	if($futchk){
		$sqlquery = "select footer_text,footer_link from contest_flink where login='" . $login_form . "' and contest_id=" . $cntsid;
		$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
		$cnt=0;
		while($row=mysql_fetch_row($result)){
			if(!$cnt){
				$futtxt=$futtxt . $row[0];
				$futlnk=$futlnk . $row[1];
				$cnt=1;
			}else{
				$futtxt=$futtxt . '|' . $row[0];
				$futlnk=$futlnk . '|' . $row[1];
			}
		}
	}

}

user_session($login_form,$sess_id,$msg);

$myFile = "conf.txt";
$fh = fopen($myFile, 'r');
$maxoption = fread($fh, filesize($myFile));
fclose($fh);
$maxoption = $maxoption + 1;

hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

?>

<script type="text/javascript">
function fillfield(ldt){
	var objdt1=document.getElementById('s_date'),objdt2=document.getElementById('e_date');
	var objhh1=document.getElementById('s_hour'),objhh2=document.getElementById('e_hour'),objmm1=document.getElementById('s_minute'),objmm2=document.getElementById('e_minute');
	var dO1=make_locdt(new Date(),ldt);
	var dO2=make_locdt(new Date(),ldt);
	dO2.setDate(dO2.getDate()+7);
	dO1.setTime(dO1.getTime()+1800000);
	var hh1=dO1.getHours();
	var hh2=dO2.getHours();
	var mm1=Math.floor(dO1.getMinutes()/10)*10;
	var mm2=Math.floor(dO2.getMinutes()/10)*10;
	var j=0;

	var strtxt="<? echo $futtxt; ?>";
	var strlnk="<? echo $futlnk; ?>";
	var stralias="<? echo $aliastxt; ?>";

	if(objdt1.value==""){
		objdt1.value=dO1.getMonth()+1+'/'+dO1.getDate()+'/'+dO1.getFullYear().toString();
	}
	if(objdt2.value==""){
		objdt2.value=dO2.getMonth()+1+'/'+dO2.getDate()+'/'+dO2.getFullYear().toString();
	}
	for(j=1; j<objhh1.options.length;j++){
		if(Number(objhh1.options[j].value)==hh1)objhh1.options[j].selected=true;
		else objhh1.options[j].selected=false;

		if(Number(objhh2.options[j].value)==hh2)objhh2.options[j].selected=true;
		else objhh2.options[j].selected=false;
	}
	for(j=1; j<objmm1.options.length;j++){
		if(Number(objmm1.options[j].value)==mm1)objmm1.options[j].selected=true;
		else objmm1.options[j].selected=false;

		if(Number(objmm2.options[j].value)==mm2)objmm2.options[j].selected=true;
		else objmm2.options[j].selected=false;
	}
	if(document.getElementById('checkbill').checked){
		document.getElementById('bill_mgr').style.display='inline';
	}else{
		document.getElementById('bill_mgr').style.display='none';
	}
	if(document.getElementById('checkscore').checked){
		document.getElementById('negcheck').style.display='inline';
	}else{
		document.getElementById('negcheck').style.display='none';
	}
	if(document.getElementById('futchk').checked){
			document.getElementById('futdiv').style.display='inline';
			addrow('futdiv',25,strtxt,strlnk);
	}else{
			document.getElementById('futdiv').style.display='none';
	}

	if(document.getElementById('checksmskey').checked){
		document.getElementById('sms_key').style.display='inline';
	}else{
		document.getElementById('sms_key').style.display='none';
	}

	if(document.getElementById('checksmsalias').checked){
				document.getElementById('futaliasdiv').style.display='inline';
				addaliasrow('futaliasdiv',25,stralias);
		}else{
				document.getElementById('futaliasdiv').style.display='none';
	}


	if(document.getElementsByName('ques_type')[1].checked){document.getElementById('quetsno').disabled=true;}
	else{document.getElementById('quetsno').disabled=false;}

	document.getElementById('left1').value =document.getElementById('welcome_msg').value.length;
	document.getElementById('left2').value =document.getElementById('off_msg').value.length;
	document.getElementById('left3').value =document.getElementById('over_msg').value.length;
	document.getElementById('left4').value =document.getElementById('fut_msg').value.length;
}

function make_locdt(dtobj,dtstr){
	var dttmp=dtstr.split(/[\/]/);
	dtobj.setDate(dttmp[1]);
	dtobj.setMonth(dttmp[0]-1);
	dtobj.setFullYear(dttmp[2]);
	dtobj.setHours(dttmp[3]);
	dtobj.setMinutes(dttmp[4]);
	return dtobj;
};
</script>
<form name="contest_modify" id="contest_modify" action="contest_engine_update.php" enctype="multipart/form-data" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0" width="748px" bgcolor="#525200">
  <tr>
    <td>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="748px" bgcolor="#f4f4e4">
        <TR height="26">
          <TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <img src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Contest Modification</TD>
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
                <TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo ucfirst($msg_alert)?></TD>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?}?>
              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Contest Name&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen">
                  <input type="text" name="contest_name" value="<? echo $cnts_name; ?>" size=40 class="input" readonly="readonly" tabindex="1"/>
                </td>
                <td>&nbsp;</td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Introduction Message&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <textarea onmouseover="showIT('welcome message that appears while starting the contest')" onmouseout="showIT()" rows="3" cols="39" name="welcome_msg" id="welcome_msg" class="input" onKeyDown="CountLeft(this.form.welcome_msg,this.form.left1,160);" onKeyUp="CountLeft(this.form.welcome_msg,this.form.left1,160);" tabindex="1"><? echo $welcome_msg ?></textarea>
                  <input type="text" name="left1" id="left1" size="3" maxlength="3" value="0" readonly="readonly" class="input"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Contest Type&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <select name="contest_type" class="input" tabindex="2">
                    <option value="">Select Contest Type</option>
                    <option value="1" <?if($cnts_type==1){ echo "selected='selected'";}?> >Continuous</option>
                    <option value="2" <?if($cnts_type==2){ echo "selected='selected'";}?>>Stop on error</option>
                  </select>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Start Date/Time&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <input type="text" id="s_date" name='s_date' onmouseover="showIT('Starting date and time of the contest')" onmouseout="showIT()" class="input" value="<? echo $s_date; ?>" readonly="readonly">
                    <select id="s_hour" name="s_hour" class="input" tabindex="3">
                      <option value="">Hour</option>
<? hour_display($s_hour); ?>
                    </select>
                    <select id="s_minute" name="s_minute" class="input" tabindex="4">
                      <option value="">Minute</option>
<? minute_display($s_minute); ?>
                    </select>
                    <script language="javascript">
                      var basicCal = new calendar("FIELD:document.contest_modify.s_date;","document.contest_modify.s_hour;document.contest_modify.s_minute");
                      basicCal.writeCalendar();
                    </script>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">End Date/Time&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <input type="text" id="e_date" name='e_date' onmouseover="showIT('Date and time when the contest ends')" onmouseout="showIT()" class="input" value="<? echo $e_date; ?>" readonly="readonly">
                    <select id="e_hour" name="e_hour" class="input" tabindex="5">
                      <option value="">Hour</option>
<? hour_display($e_hour); ?>
                    </select>
                    <select id="e_minute" name="e_minute" class="input" tabindex="6">
                      <option value="">Minute</option>
<? minute_display($e_minute); ?>
                    </select>
                    <script language="javascript">
                      var basicCal = new calendar("FIELD:document.contest_modify.e_date;","document.contest_modify.e_hour;document.contest_modify.e_minute");
                      basicCal.writeCalendar();
                    </script>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">SMS Key&nbsp;:&nbsp;</td>
                <td align="left"class="WorkGreen">
                  <input type="checkbox" name ="checksmskey" id="checksmskey" onmouseover="showIT('Select to manage contest through sms keyword.')" onmouseout="showIT()" <? if($checksmskey){echo "checked='checked'";}?> onClick="var obj=document.getElementById('sms_key'),obj1=document.getElementById('futaliasdiv'),objsmspr=document.getElementById('smslavel');if(this.checked){ obj.style.display='inline';obj1.style.display='inline';addaliasrow();objsmspr.innerHTML='';}else{obj.style.display='none';document.getElementById('keyword').value='';document.getElementById('shortcode').value='';document.getElementById('keyword').className='input';obj1.style.display='none';obj1.innerHTML='';addaliasrow();objsmspr.innerHTML='';document.getElementById('checksmsalias').checked=false;}" tabindex="14"/>
                </td>
                <TD align="left" id="smslavel" class="WorkGreen"></TD>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="sms_key" style="display:none;">
                    <table border="0" cellspacing="0" cellpadding="0" width="748px">
                      <tr height="16" bgcolor="#D9D9A8">
                        <td width="230px" align="right" class="WorkGreen">Short Code&nbsp;:&nbsp;</td>
                        <td width="518px" align="left" class="WorkGreen"><input type="text" name ="shortcode" Id="shortcode" onmouseover="showIT('Enter the sort code.')" onmouseout="showIT()" onchange="validatekey(document.getElementById('shortcode'),document.getElementById('keyword'),'1')" class="input" value="<? echo $shortcode; ?>" size="8" maxlength="6" tabindex="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Keyword&nbsp;:&nbsp;<input type="text" name="keyword" Id="keyword" onmouseover="showIT('Enter the keyword.')" onmouseout="showIT()" onchange="validatekey(document.getElementById('shortcode'),document.getElementById('keyword'),'1')" class="input" value="<? echo $keyword; ?>" size="15" maxlength="20" tabindex="16"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Add Alias Keyword&nbsp;:&nbsp;<input type="checkbox" name ="checksmsalias" id="checksmsalias"  onmouseover="showIT('Select to manage contest keyword alias.')" onmouseout="showIT()" <?if($checksmsalias) echo "checked=\"checked\""; ?> onClick="var obj=document.getElementById('futaliasdiv');if(this.checked){ obj.style.display='inline';addaliasrow('futaliasdiv',25);}else{obj.style.display='none';obj.innerHTML='';addaliasrow();}" tabindex="17"/>
                        </td>
                      </tr>
                      <tr height="8px" bgcolor="#D9D9A8"><td colspan="2"></td></tr>
                    </table>
                  </div>
                </td>
              </tr>

              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="futaliasdiv" style="display:none;"></div>
                </td>
              </tr>


<!--
              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">SMS Key&nbsp;:&nbsp;</td>
                <td align="left"class="WorkGreen">
                  <input type="checkbox" name ="checksmskey" id="checksmskey" onmouseover="showIT('Select to manage contest through sms keyword.')" onmouseout="showIT()" <? if($checksmskey){echo "checked='checked'";}?> onClick="var obj=document.getElementById('sms_key').style,obj1=document.getElementById('futaliasdiv'),objsmspr=document.getElementById('smslavel');if(this.checked){ obj.display='inline';obj1.style.display='inline';addaliasrow();objsmspr.innerHTML='';}else{obj.display='none';obj1.style.display='none';obj1.innerHTML='';addaliasrow();objsmspr.innerHTML='';}" tabindex="14"/>
                </td>
                <TD align="left" id="smslavel" class="WorkGreen"></TD>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="sms_key" style="display:none;">
                    <table border="0" cellspacing="0" cellpadding="0" width="748px">
                      <tr height="16" bgcolor="#D9D9A8">
                        <td width="230px" align="right" class="WorkGreen">Short Code&nbsp;:&nbsp;</td>
                        <td width="518px" align="left" class="WorkGreen"><input type="text" name ="shortcode" Id="shortcode" onmouseover="showIT('Enter the sort code.')" onmouseout="showIT()" class="input" value="<? echo $shortcode; ?>" size="8" maxlength="6" tabindex="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Keyword&nbsp;:&nbsp;<input type="text" name="keyword" Id="keyword" onmouseover="showIT('Enter the keyword.')" onmouseout="showIT()" onchange="validatekey(document.getElementById('shortcode'),document.getElementById('keyword'),'1')" class="input" value="<? echo $keyword; ?>" size="15" maxlength="20" tabindex="16"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Add Alias Keyword&nbsp;:&nbsp;<input type="checkbox" name ="checksmsalias" id="checksmsalias"  onmouseover="showIT('Select to manage contest keyword alias.')" onmouseout="showIT()" <?if($checksmsalias) echo "checked=\"checked\""; ?> onClick="var obj=document.getElementById('futaliasdiv');if(this.checked){ obj.style.display='inline';addaliasrow('futaliasdiv',25);}else{obj.style.display='none';obj.innerHTML='';addaliasrow();}" tabindex="17"/>
                        </td>
                      </tr>
                      <tr height="8px" bgcolor="#D9D9A8"><td colspan="2"></td></tr>
                    </table>
                  </div>
                </td>
              </tr>
              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="futaliasdiv" style="display:none;"></div>
                </td>
              </tr>
-->

              <tr height="16" bgcolor="#D9D9A8">
              <td align="right" class="WorkGreen">Score per correct Answer&nbsp;:&nbsp;</td>
              <td align="left"class="WorkGreen" colspan="2">
                <input type="text" class="input" name="score" size="3" maxlength="3" value="<? echo $score ?>" onmouseover="showIT('Enter the score per correct answer.')" onmouseout="showIT()" tabindex="7"/>
              </td>
            </tr>
            <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Allow (-ve) marking&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <input type="checkbox" name ="checkscore" Id="checkscore" onmouseover="showIT('Marks deducted per wrong answer')" onmouseout="showIT()" <? if($checkscore){echo "checked='checked'";}?> onClick="var obj=document.getElementById('negcheck').style;if(this.checked){ obj.display='inline';}else{obj.display='none';}" tabindex="8"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;<div id="negcheck" style="display:none;" align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(-ve) score per wrong Ans&nbsp;:&nbsp;<input type="text" onmouseover="showIT('Enter deduction score')" onmouseout="showIT()" class="input" value="<? echo $negscore; ?>" name="negscore" id="negscore" size="3" maxlength="3" tabindex="9"/></div>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen" bgcolor="#D9D9A8">Score Management&nbsp;:&nbsp;</td>
                <td colspan="2">
                  <table align="center" border="0" cellspacing="0" cellpadding="0" width="518px">
                    <tr height="16" bgcolor="#D9D9A8">
                      <td width="118px" align="left" class="WorkGreen">Cummulative Score&nbsp;:&nbsp;</td>
                      <td width="28px" align="left"><input type="checkbox" name ="c_score" Id="c_score" onmouseover="showIT('Select to maintain cummulative score.')" onmouseout="showIT()" <? if($c_score){echo "checked='checked'";}?> tabindex="10"/></td>
                      <td width="108px" align="right" class="WorkGreen">Today Score&nbsp;:&nbsp;</td>
                      <td width="28px" align="left"><input type="checkbox" name="t_score" Id="t_score" onmouseover="showIT('Select to maintain today score.')" onmouseout="showIT()" <? if($t_score){echo "checked='checked'";}?> tabindex="11"/></td>
                      <td width="118px" align="right" class="WorkGreen">Weekly Score&nbsp;:&nbsp;</td>
                      <td width="118px" align="left"><input type="checkbox" name ="w_score" Id="w_score" onmouseover="showIT('Select to maintain weekly score.')" onmouseout="showIT()" <? if($w_score){echo "checked='checked'";}?> tabindex="12"/></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Billing&nbsp;:&nbsp;</td>
                <td align="left"class="WorkGreen">
                  <input type="checkbox" name ="checkbill" Id="checkbill" onmouseover="showIT('Select to manage billing for contest.')" onmouseout="showIT()" <? if($checkbill){echo "checked='checked'";}?> onClick="var obj=document.getElementById('bill_mgr').style,objpr=document.getElementById('plavel');if(this.checked){ obj.display='inline';objpr.innerHTML='';}else{obj.display='none';objpr.innerHTML='';}" tabindex="13"/>
                </td>
                <TD align="left" id="plavel" class="WorkGreen"></TD>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="bill_mgr" style="display:none;">
                    <table border="0" cellspacing="0" cellpadding="0" width="748px">
                      <tr height="1px" bgcolor="#D9D9A8">
                        <td width="230px"></td>
                        <td width="340px"></td>
                        <td width="178px"></td>
                      </tr>
                      <tr height="16" bgcolor="#D9D9A8">
                        <td align="right" class="WorkGreen">Application Id&nbsp;:&nbsp;</td>
                        <td align="left" class="WorkGreen" colspan="2"><input type="text" name ="app_id" Id="app_id" onmouseover="showIT('Enter the application id.')" onmouseout="showIT()" class="input" value="<? echo $app_id; ?>" tabindex="14"/></td>
                      </tr>
                      <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

                      <tr height="16" bgcolor="#D9D9A8">
                        <td align="right" class="WorkGreen">Price Point&nbsp;:&nbsp;</td>
                        <td align="left" class="WorkGreen" colspan="2"><input type="text" name="price_pt" Id="price_pt" onmouseover="showIT('Enter the price.')" onmouseout="showIT()" class="input" value="<? echo $price_pt; ?>" size="8" maxlength="3" tabindex="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Per Question&nbsp;:&nbsp;<input type="radio" name ="bill_type" value="1" <?if($bill_type==1) echo "checked=\"checked\""; ?> onmouseover="showIT('Choose price per question.')" onmouseout="showIT()" tabindex="16"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          Per Contest&nbsp;:&nbsp;<input type="radio" name ="bill_type" value="2" <?if($bill_type==2) echo "checked=\"checked\""; ?> onmouseover="showIT('Choose price per contest.')" onmouseout="showIT()" tabindex="17"/>
                        </td>
                      </tr>
                      <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
                    </table>
                  </div>
                </td>
              </tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Questions Type&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen">Limited No’s&nbsp;:&nbsp;<input type="radio" name ="ques_type"  <?if($ques_type==1) echo "checked=\"checked\""; ?> value="1" onmouseover="showIT('Fixed number of contest questions')" onmouseout="showIT()" onClick="var obj=document.getElementById('quetsno');if(this.checked){obj.disabled=false;}" tabindex="18">&nbsp;<input type="text" name="quetsno" size="3" maxlength="3" Id="quetsno" value="<? echo $quetsno; ?>" onmouseover="showIT('Enter number of questions.')" onmouseout="showIT()" class="input" tabindex="19"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Continuous&nbsp;:&nbsp;<input type="radio" name ="ques_type" value="2"  <?if($ques_type==2) echo "checked=\"checked\""; ?> onmouseover="showIT('Choose continuous question asked.')" onmouseout="showIT()" onClick="var obj=document.getElementById('quetsno');if(this.checked){obj.disabled=true;}" tabindex="20"/></td>
                <td align="left" class="WorkGreen"></td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Display Score Status&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2"><input type="checkbox" name ="score_type" value="<? echo $score_type; ?>"  <?if($score_type) echo "checked=\"checked\""; ?> onmouseover="showIT('Select score show when question asked.')" onmouseout="showIT()" tabindex="21"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Max Options Per Question&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <select name="max_option" class="input" tabindex="22">
                    <option value="">Max Options</option>
<? for($cnt=2;$cnt<$maxoption;$cnt++){ ?>
                    <option value="<? echo $cnt; ?>" <?if($cnt==$max_option) echo "selected=\"selected\""; ?>><? echo $cnt; ?></option>
<?}?>
                  </select>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Contest Footer Message&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <textarea onmouseover="showIT('Message that will display at end of body.')" onmouseout="showIT()" rows="3" cols="39" name="fut_msg" id="fut_msg" class="input" onKeyDown="CountLeft(this.form.fut_msg,this.form.left4,160);" onKeyUp="CountLeft(this.form.fut_msg,this.form.left4,160);" tabindex="23"><? echo $fut_msg ?></textarea>
                  <input type="text" name="left4" id="left4" size="3" maxlength="3" value="0" readonly="readonly" class="input"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Add Footer Links&nbsp;:&nbsp;</td>
                <td align="left"class="WorkGreen" colspan="2">
                  <input type="checkbox" name ="futchk" Id="futchk" <? if($futchk){echo "checked='checked'";}?> onClick="var obj=document.getElementById('futdiv');if(this.checked){ obj.style.display='inline';addrow('futdiv',25);}else{obj.style.display='none';obj.innerHTML='';addrow();}" tabindex="25"/>
                </td>
                <TD align="left" class="WorkGreen"></TD>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="1px" bgcolor="#D9D9A8">
                <td colspan="3">
                  <div id="futdiv" style="display:none;"></div>
                </td>
              </tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Footer Seperator&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen">
                  <input type="radio" name ="futsep" value="1" <?if($futsep==1) echo "checked=\"checked\""; ?> onmouseover="showIT('Choose pipe seperated footer link.')" onmouseout="showIT()" tabindex="28"/>&nbsp;Pipe&nbsp;(|)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name ="futsep" value="2" <?if($futsep==2) echo "checked=\"checked\""; ?> onmouseover="showIT('Choose newline seperated footer link.')" onmouseout="showIT()" tabindex="29"/>New Line&nbsp;(\n)
                </td>
                <td align="left" class="WorkGreen"></td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Display Ads&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2"><input type="checkbox" name ="add_type" <?if($add_type==1) echo "checked=\"checked\""; ?> onmouseover="showIT('Select Adds to display in contest.')" onmouseout="showIT()" tabindex="30"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">End of Contest Message&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <textarea onmouseover="showIT('Message that appears at the end of the contest.')" onmouseout="showIT()" rows="3" cols="39" name="over_msg" id="over_msg" class="input" onKeyDown="CountLeft(this.form.over_msg,this.form.left2,160);" onKeyUp="CountLeft(this.form.over_msg,this.form.left2,160);" tabindex="24"><? echo $over_msg ?></textarea>
                  <input type="text" name="left2" id="left2" size="3" maxlength="3" value="0" readonly="readonly" class="input"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Contest Expiry Message&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <textarea onmouseover="showIT('Message, that will be displayed after stop time of contest.')" onmouseout="showIT()" rows="3" cols="39" name="off_msg" id="off_msg" class="input" onKeyDown="CountLeft(this.form.off_msg,this.form.left3,160);" onKeyUp="CountLeft(this.form.off_msg,this.form.left3,160);" tabindex="25"><? echo $off_msg ?></textarea>
                  <input type="text" name="left3" id="left3" size="3" maxlength="3" value="0" readonly="readonly" class="input"/>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16px" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Contest Status&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <select name="act_status" class="input" tabindex="26">
                    <option value="">Select Status</option>
                    <option value="1" <?if($act_status==1){ echo "selected='selected'";}?>>On</option>
                    <option value="0" <?if($act_status==0){ echo "selected='selected'";}?>>Off</option>
                  </select>
                </td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Upload Header Image Zip&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen">
                  <input type="file" name="header" size="20" onMouseOver="showIT('The file to be uploaded must be a .zip file in gif,jpeg or jpg format in 515x52, 295x52, 280x52, 250x52, 240x52, 230x52, 210x52, 180x52, 176x52, 165x52, 120x52, 110x52 sizes.')" onMouseOut="showIT()" class="input">
                </td>
                <td align="left" class="WorkGreen"></td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="right" class="WorkGreen">Upload Footer Image Zip&nbsp;:&nbsp;</td>
                <td align="left" class="WorkGreen" colspan="2">
                  <input type="file" name="footer" size="20" onMouseOver="showIT('The file to be uploaded must be a .zip file in gif,jpeg or jpg format in 515x12, 295x12, 280x12, 250x12, 240x12, 230x12, 210x12, 180x12, 176x12, 165x12, 120x12, 110x12 sizes.')" onMouseOut="showIT()" class="input">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  onClick="javascript:window.open('errorlog.php','error','width=634 height=260 scrollbars=yes')" class="WorkRed" <?if($errorlog){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";}?>>Click here to view error logs</a></td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
              
                 <!-- Hidden Company name field -->
                            <td align="left" valign="top" class="WorkGreen">
                                    <input type="hidden" name="companyName" value="<? echo $compName;  ?>" size="45" class="input"/>
                            </TD>

              <tr height="16" bgcolor="#D9D9A8">
                <td align="center" class="WorkGreen" colspan="3"><input type="button" onclick="contest_submit('contest_modify','2')" class="submit1" value="Modify Here!!!" style="background-image:url('images/menu1.gif');" tabindex="27"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
<?
	print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
	print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
	print "<input type=\"hidden\" name=\"cnts_id\" value=" . $cntsid . ">";
	print "<input type=\"hidden\" name=\"action\" value=\"2\">";
	print "<input type=\"hidden\" name=\"locdt\" value =" . $locdt . ">";
	print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
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
<script language="javascript" type='text/javascript'>
	fillfield("<? echo $locdt; ?>");
</script>
<?
workareabottom();
ffooter;
?>