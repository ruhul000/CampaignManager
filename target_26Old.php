<?php
require("gui_common.php");
require("template.php");
header("Pragma: no-cache");
header("Cache: no-cahce");
header( "Expires: Mon, 08 Oct 1997 03:00:00 GMT" );
header( "Cache-Control: no-store,no-cache, must-revalidate" );
header( "Cache-Control: post-check=0, pre-check=0", FALSE);
header( "Pragma: no-cache" );

ClearStatCache();
?>

<script type="text/javascript">
<!--
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow1','height=280,width=790,left=400,top=200,resizable=no,scrollbars=yes,menubar=no,location=no,directories=no,status=yes')
}
//-->
</script>

<?
$login_form = $_REQUEST["login"];
$page=$_REQUEST["page"];            //1-for NEW,2-for MODIFY,3-for DELETE
$msg_alert = $_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$pop=$_REQUEST["pop"];
$trgt_name = $_REQUEST["trgt_name"];
$trgt_selctn = $_REQUEST["trgt_selctn"];
$grp_id = $_REQUEST["cbo_group"];
$sgrp_id = $_REQUEST["cbo_sgroup"];

$host_ip = $_REQUEST["host_ip"];
$db_name = $_REQUEST["db_name"];
$db_user = $_REQUEST["db_user"];
$db_pwd = $_REQUEST["db_pwd"];
$dbsatus = $_REQUEST["dbsatus"];
$target_state = $_REQUEST["target_state"];
//$dailytarget=$_REQUEST["dailytarget"];
$dailytarget=0;
$s_hour=$_REQUEST["s_hour"];
$s_minute=$_REQUEST["s_minute"];
$s_date=$_REQUEST["s_date"];
$a=1;
$fieldValue=$_REQUEST['fieldValue'];
$page = $_REQUEST["page"];
$table_desc = $_REQUEST["table_desc"];
$table_fld = $_REQUEST["table_fld"];
//$cron_start_date=$_REQUEST["cron_start_date"];
//$cron_start_date=$s_date."/".$s_hour."/".$s_minute ;
$arrgroup=array();
//echo 'page : ',$page,' trgt_name : ',$trgt_name,' grp_id : ',$grp_id, ' sgrp_id : ',$sgrp_id;

if($fieldValue !=0){
	echo $host_ip;

}
if ($page>=4){
	$sqlquery = "select file_path from target_detail where archive!=1 and  target_name='" . $trgt_name . "' and login='" . $login_form . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	while($row = mysql_fetch_row($result)){
		$target_path=$row[0];
	}
}


$sqlquery="select grp.group_id,grp.group_name,sgrp.subgroup_id,sgrp.subgroup_name from group_detail grp,subgroup_detail sgrp where grp.group_id=sgrp.group_id and grp.active_status=sgrp.active_status and grp.active_status=1  and grp.login='" . $login_form . "' order by grp.group_id";
$result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());

$cnt=0;$cnt1=0;
while($row = mysql_fetch_row($result)){
	if(!$cnt){
		$grp_ids=$row[0];
		$grp_names=$row[1];
		$cnt++;
	}
	if($grp_ids==$row[0]){
		$sgrp_ids = $sgrp_ids . "," . $row[2];
		$sgrp_names = $sgrp_names . "," . $row[3];
	}else{
		$arrgroup[$cnt1]["id"]=$grp_ids;
		$arrgroup[$cnt1]["name"]=$grp_names;
		$arrgroup[$cnt1]["sid"]=trim($sgrp_ids,",");
		$arrgroup[$cnt1]["sname"]=trim($sgrp_names,",");
		$sgrp_ids="";
		$sgrp_names="";
		$grp_ids=$row[0];
		$grp_names=$row[1];
		$sgrp_ids = $sgrp_ids . "," . $row[2];
		$sgrp_names = $sgrp_names . "," . $row[3];
		$cnt1++;
	}
}

$arrgroup[$cnt1]['id']=$grp_ids;
$arrgroup[$cnt1]['name']=$grp_names;
$arrgroup[$cnt1]['sid']=trim($sgrp_ids,",");
$arrgroup[$cnt1]['sname']=trim($sgrp_names,",");
$max_grp=count($arrgroup);
$group_js="";

for($cnt=0;$cnt<$max_grp;$cnt++){
	if(!$group_js){
		$group_js=$arrgroup[$cnt]['id'] . "@" . $arrgroup[$cnt]['sid'] . ":" . $arrgroup[$cnt]['sname'];
	}else{
		$group_js=$group_js . "|" . $arrgroup[$cnt]['id'] . "@" . $arrgroup[$cnt]['sid'] . ":" . $arrgroup[$cnt]['sname'];
	}
}

if($msg_alert==""){
	$msg="Group Creation Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
if($page>=2){
	include("connection/$login_form/connection.php");
	$table_desc=valid_db("table detail",$conn_mysql);
	$table_arr=explode(",",$table_desc);

	if($page>=3){
		$fields=valid_db($table_fld,$conn_mysql);
		$fields_arr=explode(",",$fields);
	}
}
workareatop_new();

if(!$arrgroup[0]['id']){
	$msg_alert = "Sorry! No Group or Sub Group found against your request. Please create Group or Sub Group.";
	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Target Creation</TD>
			</tr>
			<tr>
				<td>
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="8" bgcolor="#D9D9A8">
						<td></td>
					</tr>
					<tr height="22">
						<TD bgcolor="#D9D9A8" align="center" class="bold_red_text"><?echo $msg_alert; ?></TD>
					</tr>
					<tr height="8">
						<td bgcolor="#D9D9A8"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
	<?die();}?>
<META HTTP-EQUIV="Pragma"
	CONTENT="no-cache">
<META HTTP-EQUIV="expires"
	CONTENT="0">
<script language='javascript' type='text/javascript'>
function addcbo_valuemap(strid,grw,strcbo){

var valcbo=Array(),valtxt=Array(),fieldValue,p=0,orow='',otext='',odiv=document.getElementById(strid),
trg_chkd,opt_chkd,txt_chkd,tmp_chkd,opt_arr=Array(">","<","=");

if(addcbo_valuemap.arguments.length==2 && grw=='up')
{

cnt=cnt+1;
}

else if(addcbo_valuemap.arguments.length==2 && grw=='dwn'){cnt=cnt-1;}

else if(addcbo_valuemap.arguments.length==2 && grw!='up' && grw!='dwn')
{cnt=cnt+1;cboitem=grw.split(',');}

else if(addcbo_valuemap.arguments.length==3)
{

cboitem=grw.split(',');tmp_chkd=strcbo.split('|');trg_chkd=tmp_chkd[0].split(',');opt_chkd=tmp_chkd[1].split(',');txt_chkd=tmp_chkd[2].split(',');cnt=trg_chkd.length;}

else{cnt=0;};if(cnt>0 && cnt<cboitem.length)
{

if(addcbo_valuemap.arguments.length!=3)
{
tmp_chkd=chkcbo1();
tmp_chkd=tmp_chkd.split('|');
trg_chkd=tmp_chkd[0].split(',');
opt_chkd=tmp_chkd[1].split(',');
var txtresp;

}
otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='276px'></td><td width='242px'></td></tr>";

for(var j=0;j<cnt; j++){
otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";

for(var i=1; i<4; i++) {
if(i==1){otext = otext+"<td align='right' class='WorkGreen'>Select Field&nbsp;:&nbsp;</td><td align='left' class='WorkGreen'>";

}

else if(i==2){
otext = otext+"<select name='tarcbo[]' class='input' onchange=\"loadXMLMsisdn1('ValueMapTest.php?login='+login.value+'&host_ip='+host_ip.value+'&db_user='+db_user+'&db_name='+db_name.value+'&table_fld='+table_fld.value+'&msisdn='+this.value,'v_m_msisdn"+j+"');\"><option value=''>Select Field</option>";
var tempstr="";

	for(p=0;p<cboitem.length;p++){
		tempstr=tempstr+"<option value='"+cboitem[p]+"' ";

		if(trg_chkd[j]==cboitem[p]){
			tempstr=tempstr+"selected='selected'";
		}
		tempstr=tempstr+">"+cboitem[p]+"</option>";
	}

	otext = otext+tempstr+"</select>&nbsp;&nbsp;&nbsp;&nbsp;Operator&nbsp;:&nbsp;<select class='input' name='opt[]'><option value=''>Opt</option>";tempstr='';

	for(p=0;p<opt_arr.length;p++){
		tempstr=tempstr+"<option value='"+opt_arr[p]+"' ";
		if(opt_chkd[j]==opt_arr[p]){
			tempstr=tempstr+"selected='selected'";
		}
		tempstr=tempstr+">"+opt_arr[p]+"</option>";
	}

	otext = otext+tempstr+"</select></td>";
}

	else if(i==3){
	    		otext=otext+"<td align='left' class='WorkGreen' id='v_m_msisdn"+j+"'>";
                
                txtresp = document.getElementById("v_m_msisdn"+j);
                if(txtresp){
                  otext=otext+txtresp.innerHTML;
                }
      		otext=otext+"</td>";
	}

};
orow=orow+orow1+otext+"</tr>";
orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3' align='right' class='WorkGreen'></td></tr>";};

lpt=orow.lastIndexOf('</td>');
//lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');

if(cnt<cboitem.length-1){
orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','up');\">Add</a>|<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','dwn');\">Remove</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+orow.substr(lpt);
}
else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','dwn');\">Remove</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+orow.substr(lpt);}
orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";
odiv.innerHTML=otable+orow+"</table>";}else if(!cnt){odiv.innerHTML='';document.getElementById('conadddiv').style.display='inline';}};

function chkcbo1(){
objcbo=document.getElementsByName("tarcbo[]");
objopt=document.getElementsByName("opt[]");
ln1=objcbo.length;valcbo="";valopt="";i=0;j=0;
for(i=0;i<objcbo.length;i++){
for(j=0;j<objcbo[i].options.length;j++){
if(objcbo[i].options[j].selected==true){
if(!valcbo){valcbo=objcbo[i].options[j].value;}
else{valcbo=valcbo+','+objcbo[i].options[j].value;
}j=objcbo[i].options.length;}}
for(j=0;j<objopt[i].options.length;j++){if(objopt[i].options[j].selected==true)
{if(!valopt){valopt=objopt[i].options[j].value;}
else{valopt=valopt+','+objopt[i].options[j].value;
}j=objopt[i].options.length;}}
}return valcbo+'|'+valopt;};

//this var for to get id

var testidvalue = "";

function loadXMLMsisdn1(url,id){
testidvalue = id;
var objdiv=document.getElementById(id);
var id1=id;
xmlhttp=null;
if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change_Msisdn1;
xmlhttp.open('GET',url,true);xmlhttp.send(null);}
else{alert("Your browser does not support XMLHTTP."); return 0;}};


function state_Change_Msisdn1(){
if (xmlhttp.readyState==4){
if (xmlhttp.status==200){var match = xmlhttp.responseText;var objdiv=document.getElementById(testidvalue);
objdiv.innerHTML=match;
return false;}
}
};


function fillfield(ldt){
  var objdt1=document.getElementById('s_date');  
  var objhh1=document.getElementById('s_hour');
  var objmm1=document.getElementById('s_minute');
  var dO1=make_locdt(new Date(),ldt);
  var dO2=make_locdt(new Date(),ldt);
  dO2.setDate(dO2.getDate()+7);
  dO1.setTime(dO1.getTime()+1800000);
  var hh1=dO1.getHours();
  var hh2=dO2.getHours();
  var mm1=Math.floor(dO1.getMinutes()/10)*10;
  var mm2=Math.floor(dO2.getMinutes()/10)*10;
  var j=0;
  var strtxt='<? echo $futtxt; ?>';
  var strlnk='<? echo $futlnk; ?>';
  if(objdt1.value==""){
    objdt1.value=dO1.getMonth()+1+'/'+dO1.getDate()+'/'+dO1.getFullYear().toString();
  }
  for(j=1; j<objhh1.options.length;j++){
    if(Number(objhh1.options[j].value)==hh1)objhh1.options[j].selected=true;
    else objhh1.options[j].selected=false;
  }
  for(j=1; j<objmm1.options.length;j++){
    if(Number(objmm1.options[j].value)==mm1)objmm1.options[j].selected=true;
    else objmm1.options[j].selected=false;
  }
  if(document.getElementById('dailytarget').checked){
    document.getElementById('bill_mgr').style.display='inline';
  }else{
    document.getElementById('bill_mgr').style.display='none';
  }
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
</script>



<form name="target_create" id="target_create" action="target_update.php"
	enctype="multipart/form-data" method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Target Creation</TD>
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
						<TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert;	$msg_alert=""; ?></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?}?>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Target
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><input type="text"
							name="trgt_name" value="<? echo $trgt_name; ?>" size=40
							class="input" onmouseover="showIT('Enter the Target Name')"
							onmouseout="showIT()" /></TD>
						<TD>&nbsp;</TD>
					</TR>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Selection
						Criteria&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen"><select
							name="trgt_selctn" class="input"
							onchange="document.getElementById('page').value=1;var objimptxt=document.getElementById('imptxt').style,objimpdb=document.getElementById('impdb').style; if(this.value==1){objimptxt.display='inline';objimpdb.display='none';}else if(this.value==2){objimptxt.display='none';objimpdb.display='inline';}else{objimptxt.display='none';objimpdb.display='none';}">
							<option value="">Select Criteria</option>
							<option value="1"
							<? if($trgt_selctn==1){echo "selected=\"selected\"";} ?>>Ready
							User Base</option>
							<option value="2"
							<? if($trgt_selctn==2){echo "selected=\"selected\"";} ?>>Import
							External DB</option>
						</select></TD>
						<TD>&nbsp;</TD>
					</TR>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Group
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" class="WorkGreen" colspan="2"><select
							name="cbo_group" class="input"
							onchange="cbo_group_chng(this.value,'sgrpcbo');">
							<option value="">Select Group Name</option>
							<? for($cnt=0;$cnt<$max_grp;$cnt++){ ?>
							<option value="<? echo $arrgroup[$cnt]['id']; ?>"
							<? if($grp_id==$arrgroup[$cnt]['id']){echo "selected=\"selected\"";} ?>><? echo $arrgroup[$cnt]['name']; ?></option>
							<?}?>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						Sub Group Name&nbsp;:&nbsp;
						<div id="sgrpcbo" style="display: inline"><select
							name="cbo_sgroup" class="input">
							<option value="">Select Sub Group Name</option>
						</select></div>

						</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="imptxt"
						<? if($trgt_selctn==1){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="1px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Upload MSISDN&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen" colspan="2" id="sgroup"><input
									type="file" name="file" size="20" accept='text/plain'
									onMouseOver="showIT('Upload MSISDN txt file in one MSISDN per line')"
									onMouseOut="showIT()" class="input"></td>
								<TD>&nbsp;</TD>
							</tr>
							<tr height="8">
								<td bgcolor="#D9D9A8" class="bold_red_text"></td>
								<td bgcolor="#D9D9A8">(Click here for <a class="bold_red_text"
									href="msisdnhelp.php">Sample File</a>)</td>
								<TD bgcolor="#D9D9A8" align="center">&nbsp;</TD>
							</tr>
							<tr height="8">
								<td colspan="3" bgcolor="#D9D9A8"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="center" class="WorkGreen" colspan="3"><input
									type="button" onclick="target_submit('target_create')"
									class="submit1" value="Create Here!!!"
									style="background-image: url('images/menu1.gif');"
									tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
						</table>
						</div>
						</td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="impdb"
						<? if($trgt_selctn==2){echo "style=\"display:inline\"";}else{echo "style=\"display:none\"";} ?>>
						<table border="0" cellspacing="0" cellpadding="0" width="748px">
							<tr height="1px" bgcolor="#D9D9A8">
								<td width="230px"></td>
								<td width="340px"></td>
								<td width="178px"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">Host
								Ip&nbsp;:&nbsp;</td>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><input
									type='text' name='host_ip' value='<? echo $host_ip; ?>'
									size='20' maxlength='50' class='input'
									<? if($dbsatus) echo "readonly='readonly'"; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Data Base&nbsp;:&nbsp;<input type='text' name='db_name'
									value='<? echo $db_name; ?>' size='20' maxlength='50'
									class='input' <? if($dbsatus) echo "readonly='readonly'"; ?> /></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">User
								Name&nbsp;:&nbsp;</td>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><input
									type='password' name='db_user' value='<? echo $db_user; ?>'
									size='20' maxlength='50' class='input'
									<? if($dbsatus) echo "readonly='readonly'"; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Password&nbsp;:&nbsp;<input type='password' name='db_pwd'
									value='<? echo $db_pwd; ?>' size='20' maxlength='50'
									class='input' <? if($dbsatus) echo "readonly='readonly'"; ?> />&nbsp;&nbsp;&nbsp;&nbsp;
									<? if(!$dbsatus){?><a href="#"
									onclick="dbase_conn('target_create');">Make Connection</a><?}?></td>
							
							
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td>&nbsp;</td>
								<td align="center" valign="top" class="bold_red_text"
									background="images/prog1.gif" id="connect"
									style="display: inline;">
								<div id="connect_div" style="display: none;"><img
									src='images/prog0.gif' alt='connecting' /></div>
									<? echo $dbsatus; ?></td>
								<td>&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3"><input type="hidden" name="dbsatus"
									value="<? echo $dbsatus; ?>"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="center" class="WorkGreen" colspan="3"><input
									type="button" onclick="target_submit('target_create')"
									class="submit1" value="Open DBase!!!"
									style="background-image: url('images/menu1.gif');"
									id="makeconn" style="display:'none'" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<? if($page>=2){?>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">DB
								Table&nbsp;:&nbsp;</td>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><select
									name='table_fld' class='input'
									onchange="document.getElementById('page').value='3';target_submit('target_create')">
									<option value="">Select Tables</option>
									<? for($cnt=0,$max=count($table_arr);$cnt<$max;$cnt++){?>
									<option value="<? echo $table_arr[$cnt]; ?>"
									<? if ($table_arr[$cnt]==$table_fld){echo "selected='selected'";} ?>><? echo $table_arr[$cnt]; ?></option>
									<?}?>
								</select></td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<? if($page>2){?>
							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" valign="top" class="WorkGreen">MSISDN
								Field&nbsp;:&nbsp;</td>
								<td align="left" valign="top" class="WorkGreen" colspan="2"><select
									name='msisdn' class='input'
									onchange="document.getElementById('page').value='4';document.getElementById('execonn').style.display='inline'">
									<option value="">Select Field</option>
									<? for($cnt=0,$max=count($fields_arr);$cnt<$max;$cnt++){?>
									<option value="<? echo $fields_arr[$cnt]; ?>"><? echo $fields_arr[$cnt]; ?></option>
									<?}?>
								</select>&nbsp;
								<div id="conadddiv" style="display: inline"><a href="#"
									onclick="addcbo_valuemap('cbodiv','<?echo $fields; ?>'); document.getElementById('conadddiv').style.display='none';">Add
								Condition</a></div>
								</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>

							<tr height="1px" bgcolor="#D9D9A8">
								<td colspan="3">
								<div id="cbodiv" style="display: all;"></div>
								</td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="right" class="WorkGreen">Daily New
								Target&nbsp;:&nbsp;</td>
								<td align="left" class="WorkGreen"><input type="checkbox"
									name="dailytarget" id="dailytarget"
									onmouseover="showIT('Select to manage daily new target.')"
									onmouseout="showIT()"
									<? if($dailytarget){echo "checked='checked'";}?>
									onClick=" fillfield('<? echo date('m/d/Y/H/i'); ?>'); var obj=document.getElementById('bill_mgr').style,objpr=document.getElementById('plavel');if(this.checked){obj.display='inline';objpr.innerHTML='';}else{obj.display='none';objpr.innerHTML='';}"
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
									<tr height="8px" bgcolor="#D9D9A8">
										<td align='right' class='WorkGreen'>Select Date
										Field&nbsp;:&nbsp;</td>
										<td align='left' class='WorkGreen' colspan='2'><select
											class='input' name='date_field' id='date_field'>
											<option value=''>Select Date Field</option>
											<? for($cnt=0,$max=count($fields_arr);$cnt<$max;$cnt++){?>
											<option value='<? echo $fields_arr[$cnt]; ?>'><? echo $fields_arr[$cnt]; ?></option>
											<?}?>
										</select></td>
									</tr>
									<tr height='8px' bgcolor='#D9D9A8'>
										<td colspan='3'></td>
									</tr>
									<tr height="16" bgcolor="#D9D9A8">
										<td align="right" class="WorkGreen">Cron Start
										Date/Time&nbsp;:&nbsp;</td>
										<td align="left" class="WorkGreen" colspan="2"><input
											type="text" id="s_date" name='s_date'
											onmouseover="showIT('Cron Start date and time')"
											onmouseout="showIT()" class="input"
											value="<? echo $s_date; ?>" readonly="readonly"> <select
											id="s_hour" name="s_hour" class="input" tabindex="4">
											<option value="">Hour</option>
											<? hour_display1($s_hour); ?>
										</select> <select id="s_minute" name="s_minute" class="input"
											tabindex="5">
											<option value="">Minute</option>
											<? minute_display($s_minute); ?>
										</select> <script language="javascript">
													var basicCal = new calendar("FIELD:document.target_create.s_date;","document.target_create.s_hour;document.target_create.s_minute");
													basicCal.writeCalendar();
												  </script></td>
									</tr>
									<tr height="8px" bgcolor="#D9D9A8">
										<td colspan="3"></td>
									</tr>


									<tr height="8px" bgcolor="#D9D9A8">
										<td colspan="3"></td>
									</tr>
								</table>
								</div>
								</td>
							</tr>

							<?}?>

							<? if($page>=3){?>

							<tr height="8px" bgcolor="#D9D9A8">
								<td>&nbsp;</td>
								<td align="center" valign="top" class="bold_red_text"
									background="images/prog1.gif" id="conn_msisdn"
									style="display: inline;">
								<div id="msisdn_div" style="display: none;"><img
									src='images/prog0.gif' alt='connecting' /></div>
									<? echo $target_state; ?></td>
								<td>&nbsp;</td>
							</tr>

							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"><input type="hidden" name="target_state"
									value="<? echo $target_state; ?>"></td>
							</tr>

							<tr height="16" bgcolor="#D9D9A8">
								<td align="center" class="WorkGreen" colspan="3"><input
									type="button" onclick="target_submit('target_create')"
									class="submit1" value="Execute It!!!" id="execonn"
									style="background-image: url('images/menu1.gif'); display: 'none';"
									tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr height="8px" bgcolor="#D9D9A8">
								<td colspan="3"></td>
							</tr>
							<?}?>

							<?}?>


						</table>
						</div>
						</td>
					</tr>
					<? if($page>=4){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" class="bold_red_text" colspan="3"><a
							class="bold_red_text"
							href="dn_msisdn.php?path=<?echo $target_path; ?>">Download Target
							<? echo $trgt_name; ?> MSISDN zip file</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<script type="text/javascript">
// Popup window code
newPopup('<? echo "http://".$_SERVER['SERVER_NAME']."/campaign/list_create_popup.php?login=".$login_form."&sess_id=".$sess_id."&smenu=".$smenu ?>');
</script>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?}?>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"page\" value=\"1\">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					print "<input type=\"hidden\" name=\"table_desc\" value=" . $table_desc . ">";
					print "<input type=\"hidden\" name=\"msg_alert\" value=" . $msg_alert . ">";
					?>

				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
<script language='javascript' type='text/javascript'>
	filldata();
	function filldata(){
		cbo_group_chng("<? echo $grp_id; ?>","sgrpcbo","<? echo $group_js; ?>","<? echo $sgrp_id; ?>");
	}
</script>
<div
	id="TTipes"
	style="position: absolute; height: 25px; z-index: 1; display: none; visibility: hidden;"></div>
					<?
					workareabottom();
					ffooter;

					if($pop==1){?>
<script type="text/javascript">
// Popup window
newPopup('<? echo "http://".$_SERVER['SERVER_NAME']."/campaign/list_create_popup.php?login=".$login_form."&sess_id=".$sess_id."&smenu=".$smenu ?>');
</script>

					<?}	?>