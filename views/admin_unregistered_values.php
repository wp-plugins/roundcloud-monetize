<div id="rc_register_container">
<table>
	<tbody>
		<tr>
			<td>
				<h style="font-weight:bold;">Advertiser email (username):</h>
			</td>
			<td>
				<input type="text" style="width: 300px;" value="" id="Savereg_email"></input>
			</td>
		</tr>
		<tr>
			<td>
				<h style="font-weight:bold;">Advertiser name:</h>
			</td>
			<td>
				<input type="text" style="width: 300px;" value="" id="Savereg_login"></input>
			</td>
		</tr>
		<tr>
			<td>
					<h style="font-weight:bold;">Select your country:</h>
			</td>
			<td>
				<select style="width: 300px;" value="" id="Savereg_country"></select>
			</td>
		</tr>
		<tr>
			<td>
					<h style="font-weight:bold;">Set password:</h>
			</td>
			<td>
				<input type="password" style="width: 300px;" value="" id="Savereg_password"></input>
			</td>
		</tr>
		<tr>
			<td>
				<h style="font-weight:bold;">Repeat password:</h>
			</td>
			<td>
				<input type="password" style="width: 300px;" value="" id="Repeat_Savereg_password"></input>
			</td>
		</tr>
		<tr>
			<td>
				<h>I agree with RoundCloud</br><a href="http://yourcloudaround.com/agreement-for-advertizers" target="_blank">Terms&Conditions:</a></h>
			</td>
			<td>
				<input type="checkbox" id="Savereg_chbox"/>
			</td>
		</tr>
		<tr>
			<td>
				<div style="  padding-top: 10px;  float: left;">
					<a href="javascript:sendRegistrationRequest()"  class="ecwid_admin_btn">Save&SingUp</a>
				</div>
				<p style="  float: left;">    or    </p>
				<div style="  padding-top: 10px;">
					<a href="javascript:rc_login_user()"  class="ecwid_admin_btn">Login</a>
				</div>
			</td>
			<td>
				
			</td>
		</tr>
	</tbody>
</table>

</div>
<?php
	include('admin_login.php');
?>
