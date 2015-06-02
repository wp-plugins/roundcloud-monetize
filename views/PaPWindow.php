<?php
include_once('PapApi.class.php');
$session2 = new Gpf_Api_Session("http://affiliate.yourcloudaround.com/scripts/server.php");
if(!$session2->login(get_option('rc_monetize_PanEmail'), get_option('rc_monetize_PanPassword'),Gpf_Api_Session::AFFILIATE)) {

 if($session2->getMessage()=='Wrong Username(E-mail) and/or Password'){
	delete_option('rc_monetize_PanEmail');
	delete_option('rc_monetize_PanAccount');
	delete_option('rc_monetize_PanAccountId');
	delete_option('rc_monetize_PanPassword');
	?>
	<script>
		window.location.reload();
	</script>
	<?php
 }
}else{
	$url = $session2->getUrlWithSessionInfo('http://affiliate.yourcloudaround.com/affiliates/panel.php');
}

?>
<script>
window.addEventListener('message', receiveMessage, false);


function receiveMessage(evt)
{
 
	if(evt.data.split('.')[0] == 'height'){
		jQuery('#rc_manage_adv_iframe').css('height',evt.data.split('.')[1]);
	}

}


</script>
<p style="color:red;font-weight:bold;">For correct work of the service disconnect extensions that block ads, popups and banners in your browser or add domen yourcloudaround.com to whitelist</p>
<iframe style="width:100%;overflow-y: hidden;overflow-x: hidden;min-height:1600px;" scrolling="no" id="rc_manage_adv_iframe" src="<?php echo $url ?>"/>
