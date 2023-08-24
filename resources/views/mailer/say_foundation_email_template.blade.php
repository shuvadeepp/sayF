<!DOCTYPE html>
<html>
<head>
	<title>OTP Verification For The Say Foundation</title>

	<style>
		body{margin: 0;padding: 0;font-family: sans-serif;}
	</style>
</head>
<body>
	<table>
		<tr>
			<td width="600" bgcolor="#f6f6f6" style="padding: 50px 50px 50px 50px;">
				<table>
					<tr>
						<td>
							<img src="<?php echo PUBLIC_PATH; ?>images/logo.png" width="150" alt="Say Foundation">
						</td>
					</tr>
					<tr><td style="height: 20px;">&nbsp;</td></tr>
					<!--dynamic content goes below-->
					<!-- <tr>
						<td style="font-weight: 600;">Thanks for registering at The Say Foundation.</td>
					</tr>
					<tr><td style="height: 20px;">&nbsp;</td></tr>
					<tr>
						<td style="line-height: 25px;">To complete the registration, you need verify your email ID by entering the below OTP in the portal.</td>
					</tr>
					<tr><td style="height: 20px;">&nbsp;</td></tr>
					<tr>
						<td style="font-weight: 600;font-size: 35px;letter-spacing: 10px;">123456</td>
					</tr>
					<tr><td style="height: 20px;">&nbsp;</td></tr> -->
					<tr>
						<td><?php echo @$messsage; ?></td>
					</tr>
					<!--dynamic content goes above-->
					<tr><td style="height: 5px;">&nbsp;</td></tr>
					<tr>
						<td>In case you need any help then reach out to us <a href="{{ROOT_URL}}" target="_blank">here</a>.</td>
					</tr>
					<tr><td style="height: 10px;">&nbsp;</td></tr>
					<tr>
						<td style="color: #a2a2a2;">If you didn’t request this then kindly ignore this mail.</td>
					</tr>
					<tr><td style="height: 40px;">&nbsp;</td></tr>
					<tr>
						<td style="line-height: 25px; font-weight: 600;">
							<span>Thanks</span><br>
							<span>The Say Foundation Team</span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>