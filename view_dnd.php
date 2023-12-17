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
$cnt=0;
user_session($login_form,$sess_id,$msg);
hheader($smenu);
tree_code ();
workareatop_new(); 					//workareatop();

/************GET GROUP DETAIL***********/
if($smenu==2){
	$field0= "Download MSISDN File";
	$field1 = "Uploaded File";
	$field2 = "Group Name";
	$field3 = "Sub Group Name";

	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;DND Information</TD>
			</tr>

		</table>
		</td>
	</tr>




	<tr>
		<td>
		<table align="left" border="0" cellspacing="0" cellpadding="1"
			width="748px" bgcolor="#d9d9a8" class="sortable">

			<tr height="1px" bgcolor="#d9d9a8">
				<td width="148px"></td>
				<td width="150px"></td>
				<td width="225px"></td>
				<td width="225px"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field0; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
			</tr>
			<tr height="1px" bgcolor="#525200">
				<td colspan="4"></td>
			</tr>

			<?
			$query="select file_path,group_id,subgroup_id from dnd_detail";
			$result=mysql_query($query);
			$total_items=mysql_num_rows($result);

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

			$query="select file_path,group_id,subgroup_id from dnd_detail limit $set_limit, $limit ";
			$result=mysql_query($query);
			if($total_items == 0){?>
			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="4"></td>
			</tr>
			<tr height="1px" bgcolor="#d9d9a8">
				<td align="center" valign="top" class="WorkGreen" colspan="4">No
				Record Found...</td>
			</tr>
			<?}
			$i=0;
			while($i<mysql_num_rows($result)){
				$row=mysql_fetch_array($result);
				$path=$row[0];
				$pos=strrpos($row[0],"/");
				$field1=substr($row[0],$pos+1);
				$query1="select group_name from group_detail where group_id='".$row[1]."'";
				$result1=mysql_query($query1);
				$row1=mysql_fetch_array($result1);
				$field2=$row1[0];
				$query2="select subgroup_name from subgroup_detail where subgroup_id='".$row[2]."' and group_id='".$row[1]."'";
				$result2=mysql_query($query2);
				$row2=mysql_fetch_array($result2);
				$field3=$row2[0];

				?>
			<tr height="1px" bgcolor="#d9d9a8">
				<td colspan="4"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<a
					class="bold_red_text" href="dn_msisdn.php?path=<?echo $path; ?>">Download</a></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field1; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field2; ?></td>
				<td align="left" valign="top" class="WorkGreen">&nbsp;&nbsp;<? echo $field3; ?></td>
			</tr>
			<?
			$i++;
			}
			?>
			<tr height="4px" bgcolor="#d9d9a8">
				<td colspan="4"></td>
			</tr>
			<tr height="18px" bgcolor="#d9d9a8">
				<td align="left" valign="top" class="WorkGreen"><? //For Previous Link
			$prev_page = $page - 1;
			if($prev_page >= 1) {
				?> &nbsp;&nbsp;<b><<</b> <? echo"<a href=view_dnd.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$prev_page>"; ?>
				<b>Prev.</b></a></td>
				<?
			}?>
				<td align="center" valign="top" class="WorkGreen">Page&nbsp;&nbsp;<? //For Middle Links...
			for($a = 1; $a <= $total_pages; $a++)
			{
				if($a == $page) {?> <? echo("<b> $a</b>  ");  //no link 
				}
				else {
					echo("<a href=view_dnd.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limits&page=$a>$a</a>  ");
				}
			}?></td>
			<? // For Next Link...
			$next_page = $page + 1;
			if($next_page <= $total_pages) {?>
				<td align="right" valign="top" class="WorkGreen" colspan="2"><? echo("<a  href=view_dnd.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$next_page><b>Next>></b></a>&nbsp;&nbsp;");?>

				</td>
				<?
			}
			?>
			</tr>

			<tr height="16px" bgcolor="#d9d9a8">
				<td colspan="4"></td>
			</tr>

		</table>
		</td>
	</tr>
</table>


			<?
} workareabottom(); ffooter_new(); ?>


