<?php?>
<script>
 var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
 var lang = "<?php echo WPLANG ?>";

 </script>
 <?php

echo "<div style='padding-top:10px;' class='rc_list_desc'>";
echo "<h style='font-weight:bold;font-size: 16px;'>About RoundCloud Affiliate Network</h>";
echo "<p >Welcome to the RoundCloud Affiliate Network! This plugin will allow you to quickly and easily start using the most advanced advertising technology called \"CPA marketing\”.</br>

   After registration in the network,  you will be able to use all features of our affiliate network, as Publisher. By using the special feature \"Banner  Rotator \" you can monetize</br>

   your site in a few clicks. It's VERY SIMPLE: Register ->select matching banners for Rotator -> collect clicks and you get paid!</br>

Features of the plugin:</br>

1. Easy new affiliate registration in the RoundCloud Affiliate Network
<ul>
		<li>Is made directly from the page settings, without having to visit any sites</li>
		<li>No user pre-moderation  -  any user can become an affiliate in the network</li>
</ul>
2.Manage all of the advanced promotion functions in RoundCloud network and view full    statistics directly from the plugin settings page, without having to go to any site.</br>
<ul>
<li>Promotion features: Lists of all public campaigns, commissions  and  banners. You can select and advance promotional materials (offers) from  advertisers, earning money using   CPC, CPS, CPM.
<ul>
<li>Full statistics and detailed reports on your advertising campaigns.</li>
</ul>
</li>
			
</ul>
3.Selection of banners for a Rotator using advanced filter</br>
<ul>
		<li>Campaigns selection</li>
		<li>Add channel selection</li>
		<li>Target url selection</li>
		<li>Banner size selection etc.</li>
</ul>
4.The Rotator preview with the ability to remove banners and automatic generation of Rotator HTML code (for use at your discretion)</br>
5.Insert  Rotator on your pages using a special widget \"RoundCloud Banner Rotator\"</p>";
echo "<h style='font-weight:bold;font-size: 16px;'>Rady to Join?</h>";
echo "<p>The affiliate online registration takes only 1 minute. Immediately after registration you can start creating  your banners Rotator. Use this <a href='javascript:showRCPopup(rc_payment);'>link</a> to find out about our payment policies for affiliates.</br>
After the registration you will receive an email to your specified address. Carefully read the enclosed instruction. This will make your first steps to get acquainted with our service.</br>Good luck!</p>";
if(get_option('rc_monetize_PanAccountId')!==false){
	include('admin_registered_values.php');
}else{
	include('admin_unregistered_values.php');
	
}
echo "</div>";
?>

<div class="admin_progressbar"></div>
<div class="Toast"  style='display:none'></div>
<div class="rc_popup_window" style="display:none;"><div style="float:right;"><a href="javascript:hideRCPopup();">x</a></div><p></p></div>