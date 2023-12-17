<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];
$checkcnt=$_REQUEST["checkcnt"];
$update=$_REQUEST['update'];
//$map_Value=$_REQUEST['map_Value'];
$map_Name=$_REQUEST['map_Name'];
$msg_alert=$_REQUEST['msg_alert'];
$id=$_REQUEST['id'];
user_session($login_form,$sess_id,$msg);
hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();
?>
<script type="text/javascript">
<!--
 function chkvoluemap(){
	var objlnk=document.getElementsByName("map_Name[]"),
	ln1=objlnk.length,i=0,ln=0;
	for(i=0;i<ln1;i++){
		ln=i+1;
		if(null_chk(objlnk[i],"Please Enter Map Value : "+ln)==true||text_chk(objlnk[i],"Please Do not Use Special Character Or Space in Starting of  Map Value : "+ln)==false)
		{
			return false;
		}
	}
	return true;
	
};

//-->
</script>
<?
if(gettype($checkcnt)=='array'){
	$ids=implode(",",$checkcnt);
}

if($update==1 && $smenu==8){
	$id=explode(",",$id[0]);
	$ids=$id;
	$ids=implode(",",$ids);
	for($cnt=0,$max=count($id);$cnt<$max;$cnt++){
		$sqlquery="update value_map_info set map_with='".$map_Name[$cnt]."' where id ='".$id[$cnt]. "'";
		$result=mysql_query($sqlquery) or die('mysql error:' . mysql_error());
	}
		
	$msg_alert= "Map Successfully Updated";
}



/************GET Map DETAIL***********/
if($smenu==8){
	$field0= "Host IP";
	$field1 = "Database Name";
	$field2 = "Table Name";
	$field3 = "Field";
	$field4 = "Login";
	$field5 = "Value";
	$field6 = "Map";

	?>
	

	
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Value Map
				Information</TD>
			</tr>

		</table>
		</td>
	</tr>




	<tr>
		<td>
		<form action="#" method="post" onsubmit="return chkvoluemap();">
		<table align="left" border="0" cellspacing="0" cellpadding="1"
			width="748px" bgcolor="#d9d9a8" class="sortable">

			<tr height="1px" bgcolor="#d9d9a8">
				<td width="128px"></td>
				<td width="100px"></td>
				<td width="145px"></td>
				<td width="125px"></td>
				<td width="100px"></td>
				<td width="50px"></td>
				<td width="100px"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field0; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field6; ?></td>

			</tr>
			<tr height="1px" bgcolor="#525200">
				<td colspan="7"></td>
			</tr>
			<? if (strlen($msg_alert)>0){ ?>
			<tr height="16px" bgcolor="#D9D9A8">
				<TD align="center" colspan="8" class="bold_red_text"><?echo ucfirst($msg_alert)?></TD>
			</tr>
			<tr height="8" bgcolor="#D9D9A8">
				<td colspan="8"></td>
			</tr>


			<?
			}
			$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.id in (" . $ids . ")";
			$result=mysql_query($query) or die('mysql error:' . mysql_error());
			$total_items=mysql_num_rows($result);
			$result=mysql_query($query);
			$i=0;
			while($i<mysql_num_rows($result)){
				$row=mysql_fetch_row($result);
				$field0=$row[0];
				$field1=$row[1];
				$field2=$row[2];
				$field3=$row[3];
				$field4=$row[4];
				$field5=$row[5];
				$field6=$row[6];

				?>
			<tr height="1px" bgcolor="#d9d9a8">
				<td colspan="7"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field0; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<input
					type="text" name="map_Name[]" value="<? echo $field6; ?>" size=10
					class="input" /></td>

			</tr>

			<?
			$i++;
			}
			?>
			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="7"></td>
			</tr>

			<tr height="16" bgcolor="#D9D9A8">
				<td align="center" class="WorkGreen" colspan="8"><input
					type="submit" class="submit1" value="Save Map!"
					onclick=""
					style="background-image: url('images/menu1.gif');" tabindex="20" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>


			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>

			<tr height="16px" bgcolor="#d9d9a8">
				<td colspan="7"></td>
			</tr>
			<?
			print "<input type=hidden name=sess_id value=$sess_id>	";
			print "<input type=hidden name=login value=$login_form>";
			print "<input type =hidden name=smenu value =$smenu>";
			print "<input type =hidden name=id[] value =$ids>";
			print "<input type =hidden name=update value =1>";
			print "<input type=\"hidden\" name=\"msg_alert\" value=" . $msg_alert . ">";
			print "<input type =hidden name=checkcnt value =$checkcnt>";

			?>

		</table>
		</form>
		</td>
	</tr>
</table>


			<?
} workareabottom(); ffooter_new();


?>


