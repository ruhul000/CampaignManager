<?php
require("gui_common.php");
require("template.php");

$action = $_REQUEST["action"];
$login_form = $_REQUEST["login"];
$grp_id = $_REQUEST["grp_id"];
$msg_alert = $_REQUEST["msg_alert"];
$sess_id=$_REQUEST["sess_id"];
$smenu=$_REQUEST["smenu"];
//------------------------------------------- ODL ----------------------------------------
// $sqlquery = "select cp_name,login,login_type from access_detail where id='" . $grp_id . "'";
// $result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());

// while($row = mysql_fetch_row($result)){
// 	$grp_name = $row[0];
// 	$grp_desc = $row[1];
// 	$login_type = $row[2];
// }
//------------------------------------------- ODL ----------------------------------------
//------------------------------------------- NEW ----------------------------------------
	$sqlquery = "select * from access_detail where id='" . $grp_id . "'";
	$result = mysql_query($sqlquery) or die('mysql error:' . mysql_error());


	while($row = mysql_fetch_row($result)){
		$login_name = $row[2];
		$password = $row[3];
		$login_type = $row[4];
		$name = $row[9];
		$company_Name = $row[10];
		$address = $row[11];
		$email = $row[12];
		$contactNo = $row[13];
		$uType = $row[14];
	}
	echo $company_Name." | ";
	echo $uType." | " ;
//------------------------------------------- NEW ----------------------------------------
if($msg_alert==""){
	$msg="Login Modify Choose";
}else{
	$msg=$msg_alert;
}

user_session($login_form,$sess_id,$msg);

hheader($smenu);
tree_code ();
workareatop_new();                     //workareatop();

if(!$grp_id){
	$msg_alert = "Sorry!!! We Have Not Found Any CP Against Your Request.Please Create CP.";
	?>
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Management</TD>
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

<form name="login_modify" id="login_modify" action="login_update.php"
	method="post">
<table align="left" border="0" cellspacing="1" cellpadding="0"
	width="748px" bgcolor="#525200">
	<tr>
		<td>
		<table align="center" border="0" cellspacing="0" cellpadding="0"
			width="748px" bgcolor="#f4f4e4">
			<TR height="26">
				<TD align="left" class="WorkWht" background="images/trgt_hdr1.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
					src="images/3.png" border="0">&nbsp;&nbsp;&nbsp;Login Modification</TD>
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
		<!--------------------- KYC - INFORMAITION --------------------->
		
					<?if (strlen($msg_alert) > 0){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<TD colspan="3" align="center" class="bold_red_text">&nbsp;&nbsp;<?echo $msg_alert; ?></TD>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?}?>

					<!--<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">CP
						Name&nbsp;:&nbsp;</TD>
						<td align="left" valign="top" bgcolor="#f4f4e4"><? echo $grp_name; ?></TD>
						<TD>&nbsp;</TD>
					</TR>-->

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Login Name&nbsp;:&nbsp;</td>
							<td align="left" valign="top" class="WorkGreen">
								<input type="text" name="login_name" id="login_name" size="45" class="input" 
									value="<? echo $login_name; ?>"
									onmouseover="showIT('Enter the login name.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Password&nbsp;:&nbsp;</TD>
							<td align="left" valign="top" class="WorkGreen">
								<input type="password" name="password" id="password" size="45" class="input" 
									value="<? echo $password; ?>" 
									onmouseover="showIT('Enter the password.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Name&nbsp;:&nbsp;</TD>
							<td align="left" valign="top" class="WorkGreen">
								<input type="text" name="name" id="name"size="45" class="input" 
									value="<? echo $name; ?>" 
								    onmouseover="showIT('Enter the name.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Company Name&nbsp;:&nbsp;</TD>
							<td align="left" valign="top" class="WorkGreen">
							<?php if($login_type ==1){?>
								<input type="text" name="company_name" id="company_name"  size="45" class="input" 
									value="<?php echo  $company_Name; ?>" 
								    onmouseover="showIT('Enter the company name.')"
									onmouseout="showIT()" />
							<?}else{?>
							
							<input type="text" name="company_name" id="company_name"  size="45" class="input" 
									value="<?php echo  $company_Name; ?>" readonly />
							<?}?>
							</td>
						<td>&nbsp;</td>
					</tr>
					
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Address&nbsp;:&nbsp;</TD>
							<td align="left" valign="top" class="WorkGreen">
								<input type="text" name="address" id="address" size="45" class="input" 
									value="<? echo $address; ?>"
								    onmouseover="showIT('Enter the address.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Email&nbsp;:&nbsp;</TD>
							<td align="left" valign="top" class="WorkGreen">
								<input type="text" name="email" id="email" size="45" class="input" 
									value="<? echo $email; ?>"
								    onmouseover="showIT('Enter the email address.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">Contact No&nbsp;:&nbsp;</td>
							<td align="left" valign="top" class="WorkGreen">
								<input type="text" name="contact_no" id="contact_no" size="45" class="input" 
									value="<? echo $contactNo; ?>" 
								    onmouseover="showIT('Enter the contact number.')"
									onmouseout="showIT()" />
							</td>
						<td>&nbsp;</td>
					</tr>

					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>


					<?php if($login_type == 2){?>
					<tr height="16px" bgcolor="#D9D9A8">
						<td align="right" valign="top" class="WorkGreen">User Type&nbsp;:&nbsp;</td>
							<td align="left" valign="top" class="WorkGreen">
								<select name="userType" id="userType" 
								onmouseover="showIT('Select the user type.')" 		
								onmouseout="showIT()" />
					
							        <option value="Admin">Admin</option>
							        <option value="Tech">Tech</option>
							        <option value="Fin">Fin</option>
							    
							    </select>
							</td>
						<td>&nbsp;</td>
					</tr>
					<?}?>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>

					<tr height="16" bgcolor="#D9D9A8">
						<td align="center" class="WorkGreen" colspan="3"><input
							type="button" class="submit1"
							onclick="login_submit_modify('login_modify');" value="Modify Here!!!"
							style="background-image: url('images/menu1.gif');" tabindex="33" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr>
					<tr height="8px" bgcolor="#D9D9A8">
						<td colspan="3"></td>
					</tr>
					<?
					print "<input type=\"hidden\" name=\"login\" value=" . $login_form . ">";
					print "<input type=\"hidden\" name=\"sess_id\" value=" . $sess_id . ">";
					print "<input type=\"hidden\" name=\"action\" value=\"2\">";
					print "<input type=\"hidden\" name=\"treeview_cod\" value =" . $treeview_cod . ">";
					print "<input type=\"hidden\" name=\"smenu\" value=" . $smenu . ">";
					print "<input type=\"hidden\" name=\"grp_id\" value=" . $grp_id . ">";
					print "<input type=\"hidden\" name=\"cp_name\" value=" . $grp_name . ">";
					print "<input type=\"hidden\" name=\"login_type\" value=" . $login_type . ">";
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
					<?
					workareabottom();
					ffooter;
					?>