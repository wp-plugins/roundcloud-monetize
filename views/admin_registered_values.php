<?php
	$rc_monetize_pan_email = get_option('rc_monetize_PanEmail');
	$rc_monetize_panAccount = get_option('rc_monetize_PanAccount');
	$rc_monetize_short_code_id = get_option('rc_monetize_shortcode_id');
	$rc_monetize_PanAccountId = get_option('rc_monetize_PanAccountId');

?>
<div class="ecwid_admin_text_container">
		<h id="suc_reg_text" style="font-weight:bold;">You are successfully registered.</br> 
</div>
<div style="padding-top: 10px;"><h style="font-weight:bold;">Advertiser email (username):</h></div>
<input type="text" style="width: 300px;" value="<?php echo $rc_monetize_pan_email ?>" id="Savereg_email" disabled></input>
<div style="padding-top: 10px;"><h style="font-weight:bold;">User Id</h></div>
<input type="text" style="width: 300px;" value="<?php echo $rc_monetize_PanAccountId ?>" id="Savereg_login" disabled></input>

<!--<div style="padding-top: 10px;"><h style="font-weight:bold;">Shortcode of banner rotator </h></div>
<input type="text" style="width: 300px;" value="[rc_monetize_rotator id='<?php echo $rc_monetize_short_code_id ?>']" id="Savereg_login" disabled></input>
-->
<div class="ecwid_admin_text_container">
		<h id="suc_reg_text">Click on the tab "Manage&Reports" for get access to full functionality of the Affiliate Network, select banners and preparation of Rotator</br> 
</div>
<div style="  padding-top: 10px;">
	<a href="javascript:rc_logout()"  class="ecwid_admin_btn">Logout</a>
</div>
