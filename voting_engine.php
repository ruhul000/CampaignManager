<?php
require("gui_common.php");
require("template.php");

$action=$_REQUEST["action"];
$treeview_cod=$_REQUEST["treeview_cod"];
$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];

$msg_alert=$_REQUEST["msg_alert"];
$cnts_name=$_REQUEST["voting_name"];
$cntsid=$_REQUEST["cnts_id"];
$welcome_msg=$_REQUEST["welcome_msg"];
$cnts_type=$_REQUEST["voting_type"];
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
$errorlog=$_REQUEST["errorlog"];
$checkkey=$_REQUEST["checkkey"];
$keyword=$_REQUEST["keyword"];
$alischk=$_REQUEST["alischk"];
$aliastxt=$_REQUEST["aliastxt"];
$shortcode=$_REQUEST["shortcode"];
$question_type=$_REQUEST["questiontype"];


$checkscore=$_REQUEST["checkscore"];
$locdt=date('m/d/Y/H/i/s', mktime());
$msg_alert=$_REQUEST["msg_alert"];

if($msg_alert==""){
	$msg="Voting Creation Choosess";
}else{
	$msg=$msg_alert;
}
user_session($login_form,$sess_id,$msg);

$myFile = "conf.txt";
$fh = fopen($myFile, 'r');
$maxoption = fread($fh, filesize($myFile));
fclose($fh);
$maxoption = $maxoption + 1;

hheader($smenu);
tree_code ();
workareatop_new();
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


	if(document.getElementById('checkkey').checked){
		document.getElementById('key_mgr').style.display='inline';
	}else{
		document.getElementById('key_mgr').style.display='none';
	}

	if(document.getElementById('checkbill').checked){
		document.getElementById('bill_mgr').style.display='inline';
	}else{
		document.getElementById('bill_mgr').style.display='none';
	}



	/*if(document.getElementById('checkscore').checked){
		var rd1=document.getElementsByName('bill_type')[0].checked,rd2=document.getElementsByName('bill_type')[1].checked;
		document.getElementById('negcheck').style.display='inline';
		if(!rd1 && !rd1) document.getElementsByName('bill_type')[0].checked=true;
	}else{
		document.getElementById('negcheck').style.display='none';
	}*/


	if(document.getElementById('checkkey').checked){
		if(document.getElementById('alischk').checked){
					document.getElementById('aliasdiv').style.display='inline';
					addrowalias('aliasdiv',25,stralias,strlnk);
			}else{
					document.getElementById('aliasdiv').style.display='none';
		}
	}

	if(document.getElementById('futchk').checked){
				document.getElementById('futdiv').style.display='inline';
				addrow('futdiv',25,strtxt,strlnk);
		}else{
				document.getElementById('futdiv').style.display='none';
	}

	var rd3=document.getElementsByName('futsep')[0].checked,rd4=document.getElementsByName('futsep')[1].checked;

	if(!rd3 && !rd4) document.getElementsByName('futsep')[0].checked=true;

	var vq3=document.getElementsByName('questiontype')[0].checked,vq4=document.getElementsByName('questiontype')[1].checked;

	if(!vq3 && !vq4) document.getElementsByName('questiontype')[0].checked=true;

	//if(document.getElementsByName('ques_type')[1].checked){document.getElementById('quetsno').disabled=true;}
	//else{document.getElementById('quetsno').disabled=false;}
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
}



function addaliasrow(strid,grw,strtxt){

	var valtxt=Array();

	if(addaliasrow.arguments.length==3 && typeof(grw)=='number'){
		rowsmsind=grw;	valtxt=strtxt.split('|');cntsms=valtxt.length;
	}else if(addaliasrow.arguments.length==2 && typeof(grw)=='number'){
		cntsms=1;
	}else if(addaliasrow.arguments.length==2 && grw=='up'){
		cntsms=cntsms+1;
	}else if(addaliasrow.arguments.length==2 && grw=='dwn'){
		cntsms=cntsms-1;
	}else{
		cntsms=0;
	}

	if(cntsms){
		var odiv = document.getElementById(strid);
		objtxt=document.getElementsByName("aliastxt[]");
		ln1=objtxt.length;
		orow="";
		otext="";


		if(!valtxt.length){
			for(var i=0;i<ln1;i++){
				valtxt[i]=objtxt[i].value;
			};
			valtxt[i]="";
		};
		otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='393px'></td><td width='355px'></td></tr>";

		for(var j=0;j<cntsms; j++){
			otext="";
			orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";
			otext = otext+"<td align='right' class='WorkGreen'>Alias Keyword&nbsp;:&nbsp;</td>";
			otext = otext+"<td align='left' class='WorkGreen'><input type='text' name ='aliastxt[]' value='"+valtxt[j]+"' onchange=\"validatekey(document.voting_form.shortcode,this,'2')\" size='15' maxlength='20' tabindex='"+rowind+"'";
			ttobj=objtxt[j];
			if(typeof(ttobj)=='object' && ttobj.className=='input1'){
				otext = otext+" class='input1'";
			}else{
				otext = otext+" class='input'";
			}

			otext = otext+"/></td>";
			orow=orow+orow1+otext+"</tr>";
			orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='2'></td></tr>";
		}
		lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cntsms==1){orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addaliasrow('aliasdiv','up');\" tabindex='"+rowind+"'>Add</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addaliasrow('aliasdiv','up');\" tabindex='"+rowind+"'>Add</a>|<a href=\"javascript:void('null');\" onclick=\"addaliasrow('aliasdiv','dwn');\" tabindex='"+rowind+"'>Remove</a>"+orow.substr(lpt);};orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='2'></td></tr>";odiv.innerHTML=otable+orow+"</table>";
	}
};



var keywordobj=object();
function validatekey(codeobj,keyobj,chkflg){
keywordobj=keyobj;
	if(codeobj.value==null||keyobj.value==null||codeobj.value==''||keyobj.value==''){
		return false;
	}else{
		var urllink = "validkey.php?sortcode="+codeobj.value+"&keyword="+keyobj.value+"&chkflag="+chkflg;
		loadXMLKey(urllink,keyobj);
	}
}

function loadXMLKey(url){xmlhttp=null;if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change_Key;xmlhttp.open('GET',url,true);xmlhttp.send(null);}else{alert("Your browser does not support XMLHTTP."); return 0;}};

function state_Change_Key()	{
	if (xmlhttp.readyState==1){
		window.status="Loading...!";
	}else if(xmlhttp.readyState==2){
		window.status="Loading Completed...!";
	}else if (xmlhttp.readyState==4){
		if (xmlhttp.status==200){
			var pos=xmlhttp.responseText;
			if(pos==1){
				keywordobj.className='input1';
			}else{
				keywordobj.className='input';
			}
		}else{
			alert("Problem retrieving data:" + xmlhttp.statusText);return false;
		}
	}
};
</script>

<form name="voting_form" id="voting_form"
	action="voting_engine_update.php" enctype="multipart/form-data"
	method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Voting Creation</TD>
				<TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
			</TR>
			<tr>
				<td colspan="2">
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8px" bgcolor="#D9D9A8">
						<td width="230px"></td>
						<td width="340px"></td>
						<td width="178px"></td>
					</tr>

					<?if (strlen($msg_alert) > 0){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo ucfirst($msg_alert)?></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?}?>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Voting Name&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen"><input
							onmouseover="showIT('Enter the name of the voting.')"
							onmouseout="showIT()" type="text" name="voting_name"
							value="<? echo $cnts_name ?>" size=40 class="input" tabindex="1" />
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Introduction
						Message&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><textarea
							onmouseover="showIT('Refers to the welcome message that appears as the user opens the voting on the mobile phone.')"
							onmouseout="showIT()" rows="3" cols="39" name="welcome_msg"
							id="welcome_msg" class="input"
							onKeyDown="CountLeft(this.form.welcome_msg,this.form.left1,160);"
							onKeyUp="CountLeft(this.form.welcome_msg,this.form.left1,160);"
							tabindex="2"><? echo $welcome_msg; ?></textarea> <input
							type="text" name="left1" id="left1" size="3" maxlength="3"
							value="0" readonly="readonly" class="input" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Start Date/Time&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input type="text"
							id="s_date" name='s_date'
							onmouseover="showIT('The time, when the voting begins.')"
							onmouseout="showIT()" class="input" value="<? echo $s_date; ?>"
							readonly="readonly"> <select id="s_hour" name="s_hour"
							class="input" tabindex="4">
							<option value="">Hour</option>
							<? hour_display($s_hour); ?>
						</select> <select id="s_minute" name="s_minute" class="input"
							tabindex="5">
							<option value="">Minute</option>
							<? minute_display($s_minute); ?>
						</select> <script language="javascript">
										var basicCal = new calendar("FIELD:document.voting_form.s_date;","document.voting_form.s_hour;document.voting_form.s_minute");
										basicCal.writeCalendar();
									</script></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">End Date/Time&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input type="text"
							id="e_date" name='e_date'
							onmouseover="showIT('The time, when the voting stop.')"
							onmouseout="showIT()" class="input" value="<? echo $e_date; ?>"
							readonly="readonly"> <select id="e_hour" name="e_hour"
							class="input" tabindex="6">
							<option value="">Hour</option>
							<? hour_display($e_hour); ?>
						</select> <select id="e_minute" name="e_minute" class="input"
							tabindex="7">
							<option value="">Minute</option>
							<? minute_display($e_minute); ?>
						</select> <script language="javascript">
										var basicCal = new calendar("FIELD:document.voting_form.e_date;","document.voting_form.e_hour;document.voting_form.e_minute");
										basicCal.writeCalendar();
									</script></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>





					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">SMS Key&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkkey" id="checkkey"
							onmouseover="showIT('Select to manage contest through sms keyword.')"
							onmouseout="showIT()"
							<? if($checkkey){echo "checked='checked'";}?>
							onClick="var obj=document.getElementById('key_mgr').style,objsmspr=document.getElementById('smslavel');if(this.checked){ obj.display='inline';objsmspr.innerHTML='';}else{obj.display='none';objsmspr.innerHTML='';}"
							tabindex="14" /></td>
						<TD align="left" id="smslavel" class="WorkGreen"></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="key_mgr" style="display: none;">
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="16" bgcolor="#D9D9A8">
								<td width="230px" align="right" class="WorkGreen">Short
								Code&nbsp;:&nbsp;</td>
								<td width="518px" align="left" class="WorkGreen"><input
									type="text" name="shortcode" Id="shortcode"
									onmouseover="showIT('Enter the sort code.')"
									onmouseout="showIT()" class="input"
									value="<? echo $shortcode; ?>" size="8" maxlength="6"
									tabindex="15" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Keyword&nbsp;:&nbsp;<input type="text" name="keyword"
									Id="keyword" onmouseover="showIT('Enter the keyword.')"
									onmouseout="showIT()" class="input"
									value="<? echo $keyword; ?>" size="15" maxlength="20"
									tabindex="16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Add Alias Keyword&nbsp;:&nbsp;<input size="15" type="checkbox"
									name="alischk" id="alischk"
									onmouseover="showIT('Select to manage contest keyword alias.')"
									onmouseout="showIT()"
									<?if($alischk) echo "checked=\"checked\""; ?>
									onClick="var obj=document.getElementById('aliasdiv');if(this.checked){ obj.style.display='inline';addrowalias('aliasdiv',25);}else{obj.style.display='none';obj.innerHTML='';addrowalias();}"
									tabindex="17" /></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="2"></td>
							</tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3">
								<div id="aliasdiv" style="display: none;"></div>
								</td>
							</tr>

						</table>


						</div>
						</td>
					</tr>



					<!--
							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Keyword&nbsp;:&nbsp;</td>
								<td align="left"class="WorkGreen">
									<input type="checkbox" name ="checkkey" Id="checkkey" onmouseover="showIT('Select to manage keyword for voting.')" onmouseout="showIT()" <? if($checkkey){echo "checked='checked'";}?> onClick="var obj=document.getElementById('key_mgr').style,objpr=document.getElementById('plavel');if(this.checked){ obj.display='inline';objpr.innerHTML='';}else{obj.display='none';objpr.innerHTML='';}" tabindex="14"/>
								</td>
								<TD align="left" id="plavel" class="WorkGreen"></TD>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3">
									<div id="key_mgr" style="display:none;">
										<table border="0" cellspacing="0" cellpadding="0" width="748px">
											<tr height="1px" bgcolor="#D9D9A8">
												<td width="230px"></td>
												<td width="340px"></td>
												<td width="178px"></td>
											</tr>

											<tr height="16" bgcolor="#D9D9A8">
												<td align="right" class="WorkGreen">Keyword&nbsp;:&nbsp;</td>
												<td align="left" class="WorkGreen" colspan="2"><input type="text" name="keyword" Id="keyword" onmouseover="showIT('Enter the keyword.')" onmouseout="showIT()" class="input" value="<? echo $keyword; ?>" size="8" tabindex="16"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>
											</tr>

											<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>


											<tr height="16" bgcolor="#D9D9A8">
												<td align="right" class="WorkGreen">Add Keyword Alias&nbsp;:&nbsp;</td>
												<td align="left"class="WorkGreen" colspan="2">
													<input type="checkbox" name ="alischk" Id="alischk" <? if($alischk){echo "checked='checked'";}?> onClick="var obj=document.getElementById('aliasdiv');if(this.checked){ obj.style.display='inline';addrowalias('aliasdiv',25);}else{obj.style.display='none';obj.innerHTML='';addrowalias();}" tabindex="25"/>
												</td>
												<TD align="left" class="WorkGreen"></TD>
											</tr>
											<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>

											<tr height="1px" bgcolor="#D9D9A8">
												<td colspan="3">
													<div id="aliasdiv" style="display:none;"></div>
												</td>
											</tr>

											<tr height="16" bgcolor="#D9D9A8">
												<td align="right" class="WorkGreen">Short Code&nbsp;:&nbsp;</td>
												<td align="left" class="WorkGreen" colspan="2"><input type="text" name ="shortcode" Id="shortcode" onmouseover="showIT('Enter the short code.')" onmouseout="showIT()" class="input" value="<? echo $shortcode; ?>" maxlength="5" size="8" tabindex="15"/></td>
											</tr>
											<tr height="8px" bgcolor="#D9D9A8"><td colspan="3"></td></tr>
										</table>
									</div>
								</td>
							</tr>


					-->







					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Billing&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen"><input type="checkbox"
							name="checkbill" Id="checkbill"
							onmouseover="showIT('Select to manage billing for voting.')"
							onmouseout="showIT()"
							<? if($checkbill){echo "checked='checked'";}?>
							onClick="var obj=document.getElementById('bill_mgr').style,objpr=document.getElementById('plavel');if(this.checked){ obj.display='inline';objpr.innerHTML='';}else{obj.display='none';objpr.innerHTML='';}"
							tabindex="14" /></td>
						<TD align="left" id="plavel" class="WorkGreen"></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="bill_mgr" style="display: none;">
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="1px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>
							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Application Id&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2"><input
									type="text" name="app_id" Id="app_id"
									onmouseover="showIT('Enter the application id.')"
									onmouseout="showIT()" class="input" value="<? echo $app_id; ?>"
									tabindex="15" /></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Price Point&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2"><input
									type="text" name="price_pt" Id="price_pt"
									onmouseover="showIT('Enter the price.')" onmouseout="showIT()"
									class="input" value="<? echo $price_pt; ?>" size="8"
									maxlength="3" tabindex="16" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Display Results&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input
							type="checkbox" name="score_type"
							<?if($score_type==1) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Select score show when question asked.')"
							onmouseout="showIT()" tabindex="22" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Max Options Per
						Question&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><select
							name="max_option" class="input" tabindex="23">
							<option value="">Max Options</option>
							<? for($cnt=2;$cnt<3;$cnt++){ ?>
							<option value="<? echo $cnt; ?>"><? echo $cnt; ?></option>
							<? } ?>
						</select></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Voting Question
						Type&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen"><input type="radio"
							name="questiontype" value="1"
							<?if($question_type==1) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Choose voting question type.')"
							onmouseout="showIT()" tabindex="28" />&nbsp;Everyday 1 Question
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
							type="radio" name="questiontype" value="2"
							<?if($question_type==2) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Choose voting question type.')"
							onmouseout="showIT()" tabindex="29" />Question in Sequence&nbsp;
						</td>
						<td align="left" class="WorkGreen"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Voting Footer
						Message&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><textarea
							onmouseover="showIT('Message that will display at end of body.')"
							onmouseout="showIT()" rows="3" cols="39" name="fut_msg"
							id="fut_msg" class="input"
							onKeyDown="CountLeft(this.form.fut_msg,this.form.left4,160);"
							onKeyUp="CountLeft(this.form.fut_msg,this.form.left4,160);"
							tabindex="24"><? echo $fut_msg ?></textarea> <input type="text"
							name="left4" id="left4" size="3" maxlength="3" value="0"
							readonly="readonly" class="input" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Add Footer Links&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input
							type="checkbox" name="futchk" Id="futchk"
							<? if($futchk){echo "checked='checked'";}?>
							onClick="var obj=document.getElementById('futdiv');if(this.checked){ obj.style.display='inline';addrow('futdiv',25);}else{obj.style.display='none';obj.innerHTML='';addrow();}"
							tabindex="25" /></td>
						<TD align="left" class="WorkGreen"></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="futdiv" style="display: none;"></div>
						</td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Footer Seperator&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen"><input type="radio"
							name="futsep" value="1"
							<?if($futsep==1) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Choose pipe seperated footer link.')"
							onmouseout="showIT()" tabindex="28" />&nbsp;Pipe&nbsp;(|)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
							type="radio" name="futsep" value="2"
							<?if($futsep==2) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Choose newline seperated footer link.')"
							onmouseout="showIT()" tabindex="29" />New Line&nbsp;(\n)</td>
						<td align="left" class="WorkGreen"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Display Ads&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input
							type="checkbox" name="add_type"
							<?if($add_type==1) echo "checked=\"checked\""; ?>
							onmouseover="showIT('Select Adds to display in voting.')"
							onmouseout="showIT()" tabindex="30" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">End of Voting
						Message&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><textarea
							onmouseover="showIT('Message that appears at the end of the voting.')"
							onmouseout="showIT()" rows="3" cols="39" name="over_msg"
							id="over_msg" class="input"
							onKeyDown="CountLeft(this.form.over_msg,this.form.left2,160);"
							onKeyUp="CountLeft(this.form.over_msg,this.form.left2,160);"
							tabindex="31"><? echo $over_msg ?></textarea> <input type="text"
							name="left2" id="left2" size="3" maxlength="3" value="0"
							readonly="readonly" class="input" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Voting Expiry
						Message&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><textarea
							onmouseover="showIT('Message, that will be displayed after stop time of voting.')"
							onmouseout="showIT()" rows="3" cols="39" name="off_msg"
							id="off_msg" class="input"
							onKeyDown="CountLeft(this.form.off_msg,this.form.left3,160);"
							onKeyUp="CountLeft(this.form.off_msg,this.form.left3,160);"
							tabindex="32"><? echo $off_msg ?></textarea> <input type="text"
							name="left3" id="left3" size="3" maxlength="3" value="0"
							readonly="readonly" class="input" /></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Upload Header Image
						Zip&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input type="file"
							name="header" size="20"
							onMouseOver="showIT('The file to be uploaded must be a .zip file in gif,jpeg or jpg format in 515x52, 295x52, 280x52, 250x52, 240x52, 230x52, 210x52, 180x52, 176x52, 165x52, 120x52, 110x52 sizes.')"
							onMouseOut="showIT()" class="input"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<tr height="8">
						<td bgcolor="#D9D9A8" class="bold_red_text"></td>
						<td bgcolor="#D9D9A8">(Click here for <a
							class="bold_red_text" href="header.zip">Header Sample File</a>)</td>
						<TD bgcolor="#D9D9A8" align="center">&nbsp;</TD>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" class="WorkGreen">Upload Footer Image
						Zip&nbsp;:&nbsp;</td>
						<td align="left" class="WorkGreen" colspan="2"><input type="file"
							name="footer" size="20"
							onMouseOver="showIT('The file to be uploaded must be a .zip file in gif,jpeg or jpg format in 515x12, 295x12, 280x12, 250x12, 240x12, 230x12, 210x12, 180x12, 176x12, 165x12, 120x12, 110x12 sizes.')"
							onMouseOut="showIT()" class="input">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
							href="javascript:void(0)"
							onClick="javascript:window.open('errorlog.php','error','width=634 height=260 scrollbars=yes')"
							class="WorkRed"
							<?if($errorlog){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";}?>>Click
						here to view error logs</a></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<tr height="8">
						<td bgcolor="#D9D9A8" class="bold_red_text"></td>
						<td bgcolor="#D9D9A8">(Click here for <a
							class="bold_red_text" href="footer.zip">Footer Sample File</a>)</td>
						<TD bgcolor="#D9D9A8" align="center">&nbsp;</TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" onclick="voting_submit('voting_form','1')"
							class="submit1" value="Create Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
	print "<input type=\"hidden\" name=\"action\" value=\"1\">";
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
<div
	id="TTipes"
	style="position: absolute; height: 25px; z-index: 1; display: none; visibility: hidden;"></div>
<script language="javascript" type='text/javascript'>
	fillfield("<? echo $locdt; ?>");
</script>
<?
workareabottom();
ffooter;
?>