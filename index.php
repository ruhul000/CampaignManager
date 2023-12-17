<?php
require("template.php");
hheader('login');
$msg_alert=$_REQUEST["msg_alert"];
?>
		<tr height="48"><td bgcolor="#f4f4e4"></td></tr>
		<tr height="48"><td align="left" valign="top" bgcolor="#f4f4e4">
			<table border="0" cellspacing="0" cellpadding="0" width="400" align="center">
				<tr><td id="error_msg" align="center" valign="top" class="ft_arial"><? echo $msg_alert; ?></td></tr>
				<tr><td>
					<form name="index_form" id="index_form" action="mmc_management.php" method="post">
					<table border="1" cellspacing="0" cellpadding="0" width="400" align="center">
						<tr height="20" bgcolor="#505200"><td align="center" class="WorkWht">Please Enter Your Login Details</td></tr>

						<tr><td class="small">
							<table border="0" cellspacing="1" cellpadding="0" width="400" align="center">
								<tr height="16">
									<td class="small" bgcolor="#f4f4e4" width="130"></td>
									<td class="small" bgcolor="#f4f4e4" width="270"></td>
								</tr>

								<tr height="16">
									<td class="WorkGreen" align="right">User Name&nbsp;:&nbsp;</td>
									<td class="WorkGreen" align="center"><input class="input" type="text" name="login" id="login" size="22"/></td>
								</tr>
								<tr height="9"><td class="small" bgcolor="#f4f4e4" colspan="2"></td></tr>

								<tr height="16">
									<td class="WorkGreen" align="right">Password&nbsp;:&nbsp;</td>
									<td class="WorkGreen" align="center"><input class="input" type="password" name="password" id="password" size="22"/></td>
								</tr>
								<tr height="9"><td class="small" bgcolor="#f4f4e4" colspan="2"></td></tr>


								<tr height="22">
									<td class="WorkBldWht">&nbsp;</td>
									<td align="right"><input type="button" onclick="index_submit()" class="submit1" value="Login Here!!!" style="background-image:url('images/menu1.gif');"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr height="9"><td class="small" bgcolor="#f4f4e4" colspan="2"></td></tr>
							</table>
							<input type='hidden' id='login_id' name='login_id' value='" . $login_id . "'/>
							<input type='hidden' id='alertmsg' name='alertmsg' value='" . $alertmsg . "'/>
						</td></tr>
					</table>
					</form>
				</td></tr>
			</table>
		</td></tr>
<?ffooter();?>