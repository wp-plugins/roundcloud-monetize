jQuery(document).ready(function(){
	
/*	get_affiliate_id(function(output){
	rc_PanAccountId =output;
	PostAffTracker.setAccountId('"'+rc_PanAccountId+'"');
	try {
		PostAffTracker.track();
		console.log('tracked');
	} catch (err) { 
		console.log(err.message);
	}
		
	});*/
	PostAffTracker.setAccountId('<?php echo get_option("rc_PanAccountId")?>');
	try {
		PostAffTracker.track();
		console.log('tracked');
	} catch (err) { 
		console.log(err.message);
	}
});
document.write(unescape("%3Cscript id='pap_x2s6df8d' src='" + (("https:" == document.location.protocol) ? "https://" : "http://") + 
"affiliate.yourcloudaround.com/scripts/trackjs.js' type='text/javascript'%3E%3C/script%3E"));

function get_affiliate_id(callback){
	jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'get_affiliate_id'
        },
        type: 'GET',
		success:function(response){
			callback(response);
		}
    });
}