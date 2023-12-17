<?php
require("gui_common.php");
require("template.php");
header("Cache-Control: no-cache, must-revalidate");

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];
$limit= $_REQUEST['limit'];
$page= $_REQUEST['page'];
$db_name='';
$db_table='';
$table_field='';
$search_map=$_REQUEST['search_map'];
$select_choice=$_REQUEST['select_choice'];
$limpage=$_REQUEST["limpage"];
if($limpage==1){
$limit='';
$page='';	
}
//echo "Map is $search_map and choice is $select_choice";
if($select_choice==1)
{
	$db_name=$search_map;
}else if($select_choice==2){
	$db_table=$search_map;
}else if($select_choice==3){
	$table_field=$search_map;
}
$cnt=0;
user_session($login_form,$sess_id,$msg);
hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

?>

<script type="text/javascript">
<!--
function search_check(){
var obj=document.view_map_form.search_map,obj1=document.view_map_form.select_choice;

if(obj.value==null||obj.value==''){
alert('Search Box Can Not Be Blank! Please Enter Keywords!');
obj.focus();
return false;
}else if(obj1.value==0){
alert('Please Select Filtered Type!');
obj1.focus();
return false;
}else{
 document.view_map_form.limpage.value=1;
 document.view_map_form.action='#';
 return true;
 }
}
//-->
</script>

 <?
/************GET Map DETAIL***********/
if($smenu==8){
	$field0= "Host IP";
	$field1 = "Database";
	$field2 = "Table";
	$field3 = "Field";
	$field4 = "Login";
	$field5 = "Value";
	$field6 = "Map";
	$field7= "Update";

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
		<form name="view_map_form" id="view_map_form" action="edit_map.php"
			method="post" enctype="multipart/form-data">
		<table align="left" border="0" style="table-layout: inherit"
			cellspacing="0" cellpadding="1" width="748px" bgcolor="#d9d9a8"
			class="sortable">

			<tr height="1px" bgcolor="#d9d9a8">
				<td width="118px"></td>
				<td width="90px"></td>
				<td width="135px"></td>
				<td width="125px"></td>
				<td width="100px"></td>
				<td width="50px"></td>
				<td width="100px"></td>
				<td width="30px"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field0; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field6; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field7; ?></td>

			</tr>
			<tr height="1px" bgcolor="#525200">
				<td colspan="8"></td>
			</tr>

			<?
			if($select_choice==1)
			{	$db_name=$search_map;
			$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0 and h.db_name='".$db_name."'";
			}else if($select_choice==2){
				$db_table=$search_map;
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0 and h.db_table='".$db_table."'";
			}else if($select_choice==3){
				$table_field=$search_map;
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0 and h.table_field='".$table_field."'";
			}else{
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0";
			}
//			echo $query;
			$result=mysql_query($query) or die('mysql error:' . mysql_error());
			$total_items=mysql_num_rows($result);
			//			echo $total_items;

			//Set default if: $limit is empty, non numerical,
			//less than 10, greater than 50

			if((!$limit)  || (is_numeric($limit) == false)|| ($limit < 10) || ($limit > 50)) {
				$limit = 10; //default
			}
			//Set default if: $page is empty, non numerical,
			//less than zero, greater than total available

			if((!$page) || (is_numeric($page) == false)|| ($page < 0) || ($page > $total_items)) {
				$page = 1; //default
			}
			//calculate total pages

			$total_pages = ceil($total_items / $limit);
			$set_limit = $page * $limit - ($limit);
			if($select_choice==1 && $search_map != '')
			{	$db_name=$search_map;
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with,v.id from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0  and h.db_name='".$db_name."' order by v.id desc limit $set_limit, $limit ";
			}else if($select_choice==2  && $search_map != ''){
				$db_table=$search_map;
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with,v.id from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0 and h.db_table='".$db_table."' order by v.id desc limit $set_limit, $limit ";
			}else if($select_choice==3  && $search_map != ''){
				$table_field=$search_map;
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with,v.id from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0  and h.table_field='".$table_field."'order by v.id desc limit $set_limit, $limit ";
			}else{
				$query="select h.host,h.db_name,h.db_table,h.table_field,h.login,v.vmap_value, v.map_with,v.id from value_map_host_detail h,value_map_info v where v.vmap_id=h.id and v.archive=0 order by v.id desc limit $set_limit, $limit ";
			}
//			echo $query;
			$result=mysql_query($query);
			if($total_items == 0){?>
			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>
			<tr height="1px" bgcolor="#d9d9a8">
				<td align="center" valign="top" class="WorkGreen" colspan="8">No
				Record Found...</td>
			</tr>
			<?}
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
				$cnts_id[$i]=$row[7];
				?>
			<tr height="1px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field0; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field4; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field5; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field6; ?></td>
				<td align="left" class="WorkGreen"><input type="checkbox"
					name="checkcnt[]" value="<? echo $cnts_id[$i]; ?>" /></td>

			</tr>

			<?
			$i++;
			}
			?>
			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>
			<?if($total_items != 0){?>
			<tr height="16" bgcolor="#D9D9A8">
				<td align="center" class="WorkGreen" colspan="8"><input
					type="submit" class="submit1" value="Update Map!"
					style="background-image: url('images/menu1.gif');" tabindex="20"
					onclick="return checkSelection();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<? } ?>


			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen"><? //For Previous Link
			$prev_page = $page - 1;
			if($prev_page >= 1) {
				?> &nbsp;&nbsp;<b><<</b> <? echo"<a href=view_map.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$prev_page&select_choice=$select_choice&search_map=$search_map>"; ?>
				<b>Prev.</b></a></td>
				<?
			}?>
				<td align="center" valign="top" class="WorkGreen">Page&nbsp;&nbsp;<? //For Middle Links...
			for($a = 1; $a <= $total_pages; $a++)
			{
				if($a == $page) {?> <? echo("<b> $a</b>  ");  //no link
				}
				else {
					echo("<a href=view_map.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limits&page=$a&select_choice=$select_choice&search_map=$search_map>$a</a>  ");
				}
			}?></td>
			<? // For Next Link...
			$next_page = $page + 1;
			if($next_page <= $total_pages) {?>
				<td align="right" valign="top" class="WorkGreen" colspan="6"><? echo("<a  href=view_map.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$next_page&select_choice=$select_choice&search_map=$search_map><b>Next>></b></a>&nbsp;&nbsp;");?>

				</td>
				<?
			}
			?>
			</tr>

			<tr height="16px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>
			<tr height="16px" bgcolor="#d9d9a8">
				<td align="right" valign="top" class="WorkGreen">Map Search:</td>
				<td align="left" valign="top" class="WorkGreen"><input type="text"
					name="search_map"></td>
				<td align="right" valign="top" class="WorkGreen">Filtered:</td>
				<td align="left" valign="top" class="WorkGreen"><select
					class="input" name="select_choice">
					<option value="0">--Select--</option>
					<option value="1">Database</option>
					<option value="2">Table</option>
					<option value="3">Field</option>
				</select></td>
				<td align="left" valign="top" class="WorkGreen" colspan="3"><input
					type="submit" class="submit1" value="Search Map!"
					onclick="return search_check();"
					style="background-image: url('images/menu1.gif');" tabindex="20" /></td>
			</tr>
			<tr height="16px" bgcolor="#d9d9a8">
				<td colspan="8"></td>
			</tr>


			<?
			print "<input type=hidden name=sess_id value=$sess_id>	";
			print "<input type=hidden name=login value=$login_form>";
			print "<input type =hidden name=smenu value =$smenu>";
			print "<input type =hidden name=limpage value =0>";
			
			?>
		</table>
		</form>
		</td>
	</tr>
</table>


			<?
} workareabottom(); ffooter_new(); ?>


