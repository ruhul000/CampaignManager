<link rel="stylesheet" type="text/css" href="style/main.css"
	title="style">
<link
	rel="stylesheet" type="text/css" href="style/first.css" title="style">
<link rel="stylesheet" type="text/css"
	href="style/calendar.css" title="style">

<?
require("connection_mmc.php"); //adding connection file

$login_form=$_REQUEST["login"];
$sess_id=$_REQUEST["sess_id"];
$action=$_REQUEST["action"];
$smenu=$_REQUEST["smenu"];
$limit= $_REQUEST['limit'];
$page= $_REQUEST['page'];


$s_date=$_REQUEST['s_date'];
$e_date=$_REQUEST['e_date'];
$s_date = preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $s_date);
$e_date =  preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{4})/', '$3-$1-$2', $e_date);

$query="select count(*) as num from list_detail l,target_detail t where l.login_created='".$login_form."' and t.target_id=l.target_id and date(l.start_date) >= date('".$s_date."') and  date(l.end_date) <=date('".$e_date ."')";
$result=mysql_query($query);
$row=mysql_fetch_row($result);
$total_items=$row[0];

if((!$limit)  || (is_numeric($limit) == false)|| ($limit < 10) || ($limit > 50)) {
	$limit = 10; //default
}
if((!$page) || (is_numeric($page) == false)|| ($page < 0) || ($page > $total_items)) {
	$page = 1; //default
}
$total_pages = ceil($total_items / $limit);
$set_limit = $page * $limit - ($limit);

$sqlquery="select l.start_date,l.end_date,l.scheduler_name,t.target_name from list_detail l,target_detail t where l.login_created='".$login_form."' and t.target_id=l.target_id and date(l.start_date) >= date('".$s_date."') and  date(l.end_date) <=date('".$e_date ."') order by l.id limit $set_limit, $limit";
//echo $sqlquery;
$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());



?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Scheduler
				Information</TD>
				<TD class="WorkWht" background="images/trgt_hdr1.gif" align="right"></TD>
			</TR>
			<tr>
				<td colspan="2">
				<table align="left" border="0" cellspacing="0" cellpadding="0"
					width="748px" bgcolor="#525200">
					<tr height="4px" bgcolor="#D9D9A8">
						<td width="160px"></td>
						<td width="215px"></td>
						<td width="160px"></td>
						<td width="215px"></td>
					</tr>
					<tr height="16px" bgcolor="#D9D9A8">
						<td colspan="4" align="center" class="bold_red_text">From Start
						Date(<? echo $s_date;?>) to End Date(<? echo $e_date;?>)</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>
					<tr height="1px" bgcolor="#525200">
						<td colspan="4"></td>
					</tr>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Start
						Date&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen">End
						Date&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen">Target
						Name&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen">Scheduler
						Name&nbsp;&nbsp;</TD>
					</tr>
					<tr height="1px" bgcolor="#525200">
						<td colspan="4"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>
					<?  if($total_items == 0){ ?>


					<tr height="8px" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="4">Sorry No Records
						Found...</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>

					<?
					}

					$ind=0;
					$count=mysql_num_rows($result);
					while($ind<$count){
						$row = mysql_fetch_row($result);
						?>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen"><? echo $row[0]; ?>&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen"><? echo $row[1]; ?>&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen"><? echo $row[2]; ?>&nbsp;&nbsp;</TD>
						<td align="right" valign="top" class="WorkGreen"><? echo $row[3]; ?>&nbsp;&nbsp;</TD>
					</tr>
					<?	$ind++;} ?>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="left" valign="top" class="WorkGreen"><? //For Previous Link
					$prev_page = $page - 1;
					if($prev_page >= 1) {
						?> &nbsp;&nbsp;<b><<</b> <? echo"<a href=ViewScheduledTarget.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$prev_page&action=$action&s_date=$s_date&e_date=$e_date>"; ?>
						<b>Prev.</b></a> <?
					}?></td>
						<td align="center" valign="top" class="WorkGreen">Page&nbsp;&nbsp;<? //For Middle Links...
					for($a = 1; $a <= $total_pages; $a++)
					{
						if($a == $page) {?> <? echo("<b> $a</b>  ");  //no link
						}
						else {
							echo("<a href=ViewScheduledTarget.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limits&page=$a&action=$action&s_date=$s_date&e_date=$e_date >$a</a>  ");
						}
					}?></td>
					<? // For Next Link...
					$next_page = $page + 1;
					if($next_page <= $total_pages) {?>
						<td align="right" valign="top" class="WorkGreen" colspan="2"><? echo("<a  href=ViewScheduledTarget.php?login=$login_form&sess_id=$sess_id&smenu=$smenu&limit=$limit&page=$next_page&action=$action&s_date=$s_date&e_date=$e_date><b>Next>></b></a>&nbsp;&nbsp;");?></td>
						<?}else {?>
						<td colspan="2"></td>
						<? }?>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td colspan="4" align="center" class="WorkGreen"><input
							type="button" value="Close!!" class="submit1"
							onclick="JavaScript:window.close();"
							style="background-image: url('images/menu1.gif');" tabindex="33"></td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="4"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
