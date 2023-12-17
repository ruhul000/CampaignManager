<?php
require("gui_common.php");
require("template.php");
header("Pragma: no-cache");
header("Cache: no-cahce");
header( "Expires: Mon, 08 Oct 1997 03:00:00 GMT" );
header( "Cache-Control: no-store,no-cache, must-revalidate" );
header( "Cache-Control: post-check=0, pre-check=0", FALSE);
header( "Pragma: no-cache" );
?>
<script type="text/javascript"><!--

function value_map_submit(frmname){
	var thisform=document.getElementById(frmname);
	with (thisform){
		 if(null_chk(table_fld,"Select Database Table Name!")==true){
			return false;
		}else if(null_chk(msisdn,"Select Field Name!")==true){
			return false;
		}else if(chkrowvoluemap('aliasdiv')==false){
			return false;
		}else{
		return true;
	}	
}
}

function chkrowvoluemap(strid){
var odiv=document.getElementById(strid),
objtxt=document.getElementsByName("vmaptxt[]"),
objlnk=document.getElementsByName("maplnk[]"),
ln1=objtxt.length,valtxt=Array(),
vallnk=Array(),i=0,ln=0;
for(i=0;i<ln1;i++){
ln=i+1;
if(null_chk(objtxt[i],"Please Enter Value Text : "+ln)==true||text_chk(objtxt[i],"Please Do not Use Special Character Or Space in Starting of Value : "+ln)==false){return false;}else if(null_chk(objlnk[i],"Please Enter Map Value : "+ln)==true||text_chk(objlnk[i],"Please Do not Use Special Character Or Space in Starting of  Map Value : "+ln)==false)
{
return false;};}
if(unique(objtxt)==false)
{return false;};


return true;};

function unique(arrayName)
{
	 
    for(var i=0; i<arrayName.length;i++ )
    {
    		var temp = arrayName[i].value;
         for(var j=i+1; j<arrayName.length;j++ )
          {
	           if(temp==arrayName[j].value){
	           alert("Value Should Not Be Same!");
	           arrayName[j].focus();
	         	return false;
	           }
           }
         }
      return true;
}

--></script>

<?
ClearStatCache();
$login_form = $_REQUEST["login"];
$msg_alert = $_REQUEST["msg_alert"];
$page=$_REQUEST["page"];            //1-for NEW,2-for MODIFY,3-for DELETE
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
$host_ip = $_REQUEST["host_ip"];
$db_name = $_REQUEST["db_name"];
$db_user = $_REQUEST["db_user"];
$db_pwd = $_REQUEST["db_pwd"];
$dbsatus = $_REQUEST["dbsatus"];
$table_fld = $_REQUEST["table_fld"];
$map=$_REQUEST['map'];
$arrgroup=array();
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


?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="expires" CONTENT="0">
<form name="value_map" id="value_map" action="" method="post">
<table align="center" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">

	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Value Map Creation</TD>
				<TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
			</TR>
			<tr>
				<td colspan="2">
				<table align="center" border="0" cellspacing="0" cellpadding="0"
					width="748px">
					<tr height="1px" bgcolor="#D9D9A8">
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
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Host
						Ip&nbsp;:&nbsp;</td>
						<td align="left" valign="top" class="WorkGreen" colspan="2"><input
							type='text' name='host_ip' value='<? echo $host_ip; ?>' size='20'
							maxlength='50' class='input'
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
							<? if(!$dbsatus){?><a href="#" onclick="dbase_conn('value_map');">Make
						Connection</a><?}?></td>
					</tr>
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
							type="submit" class="submit1" value="Open DBase!!!"
							style="background-image: url('images/menu1.gif');" id="makeconn"
							style="display:'none'" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<? if($page>=2){?>
					<tr height="16" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Select
						Table&nbsp;:&nbsp;</td>
						<td align="left" valign="top" class="WorkGreen" colspan="2"><select
							name='table_fld' class='input'
							onchange="document.getElementById('page').value='3'; document.value_map.action='#';document.value_map.submit();"<option value="">Select Tables</option>
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
						<td align="right" valign="top" class="WorkGreen">Select
						Field&nbsp;:&nbsp;</td>
						<td align="left" valign="top" class="WorkGreen" colspan="2"><select
							name='msisdn' class='input'
							onchange="document.getElementById('page').value='4';document.getElementById('execonn').style.display='inline'">
							<option value="">Select Field</option>
							<? for($cnt=0,$max=count($fields_arr);$cnt<$max;$cnt++){?>
							<option value="<? echo $fields_arr[$cnt]; ?>"><? echo $fields_arr[$cnt]; ?></option>
							<?}?>
						</select></td>

					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3">
						<div id="aliasdiv" name="aliasdiv" style="display: all;"><? echo "<script type='text/javascript'>addrow_valuemap('aliasdiv',25);</script>"; ?></div>
						</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<tr height="1px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
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
							type="button"
							onclick="if(value_map_submit('value_map')){document.value_map.action='ValueMapSubmit.php';document.value_map.submit();}"
							class="submit1" value="Create Map!!!" id="execonn"
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
			<?
			print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
			print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
			print "<input type=\"hidden\" id='page' name=\"page\" value=\"2\">";
			print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
			print "<input type=\"hidden\" name=\"table_desc\" value=" . $table_desc . ">";
			print "<input type=\"hidden\" name=\"msg_alert\" value=" . $msg_alert . ">";
			print "<input type=\"hidden\" name=\"map\" value=\"1\">";
			?>

		</table>
		</td>
	</tr>
</table>

</form>



<div
	id="TTipes"
	style="position: absolute; height: 25px; z-index: 1; display: none; visibility: hidden;"></div>
			<?
			workareabottom();
			ffooter;
			?>