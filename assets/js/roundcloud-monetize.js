
jQuery(document).ready(function(){
	rc_resize_iframe();
	get_option('rc_monetize_PanAccountId',function(output){
	rc_monetize_PanAccountId =output;
	console.log(rc_monetize_PanAccountId);

	
	});
	jQuery('#rc_login_container').hide();
	getCountryList();
	
});

window.onload = function(){
	


}

function rc_register_new_user(){
	jQuery('#rc_login_container').hide();
	jQuery('#rc_register_container').show();
}
function rc_login_user(){
	jQuery('#rc_login_container').show();
	jQuery('#rc_register_container').hide();
}


function rc_resize_iframe(){

	jQuery('#rc_manage_adv_iframe').height(jQuery('#wpwrap').height());
	
}

var rc_monetize_PanAccountId;

//validate registration data
function validate() {
	var data = Object();
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  
	if(reg.test(jQuery('#Savereg_email').val()) == true) {
		data['email']=true;
	}else{
		data['email']=false;
	}
	if(jQuery('#Savereg_login').val() !== '') {
		data['login']=true;
	}else{
		data['login']=false;
	}
	
	if(jQuery('#Savereg_country').val() !== '') {
		data['country']=true;
	}else{
		data['coutry']=false;
	}
	
	if(jQuery('#Savereg_password').val() !== '') {
		data['password']=true;
	}else{
		data['password']=false;
	}
	if(jQuery('#Repeat_Savereg_password').val() !== '') {
		data['repeat_password']=true;
	}else{
		data['repeat_password']=false;
	}
	
	var result=jQuery('#Savereg_chbox').prop('checked');
		data['checkbox']=result;
	if(!data['password'] || !data['repeat_password'] || !data['email'] || !data['login'] || !data['country']){
		return "Fill all fields";
	}
	if(jQuery('#Repeat_Savereg_password').val() !== jQuery('#Savereg_password').val()){
		
		return "Wrong password";
	}
	if(!data['checkbox']){
		return "You need to confirm agreement.";
	}else{
		return "ok";
	}
}

var rc_payment="<h>Payments</h><p>2DMart ltd. shall pay Publisher for each valid Action which is registered during the applicable billing cycle (as defined in the Invoice Frequency), as reported on the Affiliate Site, using the Preferred Method. An Action shall not be considered valid unless it is reported on the Affiliate Site. The number of valid, non-fraudulent payable Actions shall in no event exceed the number of Actions reported on the Affiliate Site.</p><h>Invoice Frequency</h><p> Unless otherwise agreed upon in writing, the Default Timing of Payment for new Affiliates shall be paid fifteen (15) days from the end of each calendar month for the commissions earned in the previous month. (Net 15) For example, if affiliate earns $100 in valid commissions in December he/she will paid $100 on January 15th. The minimum net 15 payment threshold is $100. If affiliate does not reach the threshold in any given month, the payment will be carried forward to the next month. Notwithstanding the foregoing, Affiliate and 2DMart ltd. may agree in writing to one of the following alternate Timing of Payments:</p><p>Weekly  Invoice. (Weekly Net 5) Affiliate will receive payment five (5) days after the end of each seven (7) day calendar period. For avoidance of doubt, each seven (7) day calendar period is hereby defined as Monday through Sunday. Notwithstanding the foregoing, In order for Affiliates to be approved to the Weekly Invoice Frequency affiliate must accrue at least one thousand dollars ($1000.00) per week for 2 consecutive weeks in order to qualify for weekly payments. In the event that such threshold is not met, then the payment will remain monthly net 15. Once an affiliate does qualify they must still request approval from their affiliate manager to be placed onto weekly invoice frequency. If affiliate is approved, the minimum weekly payment is $1000. If affiliate does not reach the threshold in any given week, the payment will be carried forward to the next week.</p><p> Manual Invoice. In special circumstances 2DMart ltd. and Affiliate may agree in writing to a different period of payment and timing of payment. In such case, a manual invoice will be entered into 2DMart ltd.'s system. Contact affiliate manager for details.</p><h>Payments & Fees</h><p> All affiliates shall be paid in US dollars (US$). In the event that a Payout is set in a currency other than US dollars (US$) and if payment is to be made in US dollars ($US), 2DMart ltd. shall then convert the amount owed into US dollars ($US) using the 30-day average for the currency in question against the US dollar (US$) (as reported on www.oanda.com) for the applicable month. Notwithstanding anything to the contrary contained herein, 2DMart ltd. reserves the right, in its sole discretion, to pay Affiliates in the currency in which the Payout is set.</p><p>Affiliate hereby agrees to bear the costs for the submission of payments using electronic methods including without limitation, Wire transfers, PayPal transactions, ACH transactions, Payoneer etc. For the avoidance of doubt, this includes any costs charged by your bank or 3rd party services to receive the payment.</p>";

function showProgressBar(){
	jQuery('.admin_progressbar').show();
}
function hideProgressBar(){
	jQuery('.admin_progressbar').hide();
}

function showRCPopup(text){
	
	jQuery('.rc_popup_window p').html(text);
	jQuery('.rc_popup_window').show();
	
}
function hideRCPopup(){
	
	jQuery('.rc_popup_window').hide();
	
}

if (window.addEventListener) {
  window.addEventListener("message", rc_monetize_listener);
} else {
  // IE8
  window.attachEvent("onmessage", rc_monetize_listener);
}

function rc_monetize_listener(event){
	
	if( event.data.split('&,')[0]=="post_rotator_code"){
		var code = event.data.split('&,')[1];
		rc_monetize_post_code(rc_monetize_PanAccountId,code);
		
	}
	
	
}

//function show message
function showToast(message,reload){
	
	if(reload){
		jQuery('.Toast').text(message).fadeIn(400).delay(3000).fadeOut(400,function(){location.reload();}); 
	}else{
		jQuery('.Toast').text(message).fadeIn(400).delay(3000).fadeOut(400); 
	}
	
}

function rc_logout(){
	
	 jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'rc_monetize_logout'
			
        },
        type: 'GET',
		success:function(response){
			location.reload();
		}
    });
	
}

function rc_monetize_post_code(_user_id,_code){
	
	 jQuery.ajax({
        url: ajaxurl,
	
        data: {
            action: 'rc_monetize_write_rotator_code_to_db',
			code:_code,
			user_id:_user_id,
			
        },
        type: 'GET',
		success:function(response){
			if(response!=='update'){
				var rc_shortcode_id = response;
				update_option('rc_monetize_shortcode_id',rc_shortcode_id);
				
			}
			
		}
    });
	
}



//set_option function wordpress
function set_option(name,val){
	
	 jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'rc_monetize_set_option',
			option_name:name,
			option_value:val
        },
        type: 'GET',
		success:function(response){
			
		}
    });
}

//get_option function wordpress
function get_option(name,callback){
	
	 jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'rc_monetize_get_option',
			option_name:name
        },
        type: 'GET',
		success:function(response){
			callback(response);
		}
    });
}

//update_option function wordpress
function update_option(name,val,reload){
	
	 jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'rc_monetize_update_option',
			option_name:name,
			option_value:val
        },
        type: 'GET',
		success:function(response){
			if(reload){
				location.reload();
			}
		}
    });
}


function get_shortcode_id(){
	
	 jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'rc_monetize_get_shortcode_id',
			accountId:rc_monetize_PanAccountId
        },
        type: 'GET',
		success:function(response){
		
		}
    });
}




var DMap = {0: 0, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5, 6: 6, 7: 7, 8: 8, 9: 9, 10: 10, 11: 11, 12: 12, 13: 13, 14: 14, 15: 15, 16: 16, 17: 17, 18: 18, 19: 19, 20: 20, 21: 21, 22: 22, 23: 23, 24: 24, 25: 25, 26: 26, 27: 27, 28: 28, 29: 29, 30: 30, 31: 31, 32: 32, 33: 33, 34: 34, 35: 35, 36: 36, 37: 37, 38: 38, 39: 39, 40: 40, 41: 41, 42: 42, 43: 43, 44: 44, 45: 45, 46: 46, 47: 47, 48: 48, 49: 49, 50: 50, 51: 51, 52: 52, 53: 53, 54: 54, 55: 55, 56: 56, 57: 57, 58: 58, 59: 59, 60: 60, 61: 61, 62: 62, 63: 63, 64: 64, 65: 65, 66: 66, 67: 67, 68: 68, 69: 69, 70: 70, 71: 71, 72: 72, 73: 73, 74: 74, 75: 75, 76: 76, 77: 77, 78: 78, 79: 79, 80: 80, 81: 81, 82: 82, 83: 83, 84: 84, 85: 85, 86: 86, 87: 87, 88: 88, 89: 89, 90: 90, 91: 91, 92: 92, 93: 93, 94: 94, 95: 95, 96: 96, 97: 97, 98: 98, 99: 99, 100: 100, 101: 101, 102: 102, 103: 103, 104: 104, 105: 105, 106: 106, 107: 107, 108: 108, 109: 109, 110: 110, 111: 111, 112: 112, 113: 113, 114: 114, 115: 115, 116: 116, 117: 117, 118: 118, 119: 119, 120: 120, 121: 121, 122: 122, 123: 123, 124: 124, 125: 125, 126: 126, 127: 127, 1027: 129, 8225: 135, 1046: 198, 8222: 132, 1047: 199, 1168: 165, 1048: 200, 1113: 154, 1049: 201, 1045: 197, 1050: 202, 1028: 170, 160: 160, 1040: 192, 1051: 203, 164: 164, 166: 166, 167: 167, 169: 169, 171: 171, 172: 172, 173: 173, 174: 174, 1053: 205, 176: 176, 177: 177, 1114: 156, 181: 181, 182: 182, 183: 183, 8221: 148, 187: 187, 1029: 189, 1056: 208, 1057: 209, 1058: 210, 8364: 136, 1112: 188, 1115: 158, 1059: 211, 1060: 212, 1030: 178, 1061: 213, 1062: 214, 1063: 215, 1116: 157, 1064: 216, 1065: 217, 1031: 175, 1066: 218, 1067: 219, 1068: 220, 1069: 221, 1070: 222, 1032: 163, 8226: 149, 1071: 223, 1072: 224, 8482: 153, 1073: 225, 8240: 137, 1118: 162, 1074: 226, 1110: 179, 8230: 133, 1075: 227, 1033: 138, 1076: 228, 1077: 229, 8211: 150, 1078: 230, 1119: 159, 1079: 231, 1042: 194, 1080: 232, 1034: 140, 1025: 168, 1081: 233, 1082: 234, 8212: 151, 1083: 235, 1169: 180, 1084: 236, 1052: 204, 1085: 237, 1035: 142, 1086: 238, 1087: 239, 1088: 240, 1089: 241, 1090: 242, 1036: 141, 1041: 193, 1091: 243, 1092: 244, 8224: 134, 1093: 245, 8470: 185, 1094: 246, 1054: 206, 1095: 247, 1096: 248, 8249: 139, 1097: 249, 1098: 250, 1044: 196, 1099: 251, 1111: 191, 1055: 207, 1100: 252, 1038: 161, 8220: 147, 1101: 253, 8250: 155, 1102: 254, 8216: 145, 1103: 255, 1043: 195, 1105: 184, 1039: 143, 1026: 128, 1106: 144, 8218: 130, 1107: 131, 8217: 146, 1108: 186, 1109: 190}

function UnicodeToWin1251(s) {
    var L = []
    for (var i=0; i<s.length; i++) {
        var ord = s.charCodeAt(i)
        if (!(ord in DMap))
            throw "Character "+s.charAt(i)+" isn't supported by win1251!"
        L.push(String.fromCharCode(DMap[ord]))
    }
    return L.join('')
}


function PaNLogin(){ 
	var data = Object();
	data['QueryType']='PaNlogin';
	data['email'] = jQuery('#rc_login_username').val();
	data['pass'] = jQuery('#rc_login_password').val();
	data['userRole']='affiliate';
	showProgressBar();
	jQuery.ajax({
	
          url: '../wp-content/plugins/roundcloud-monetize/includes/roundcloudapi.php',
            data: data,
            dataType: 'json',
            type: 'POST',
            success: function (response) {
				hideProgressBar();
				if(response.status=="success"){
					rc_monetize_PanAccountId = response.account_id;
					set_option('rc_monetize_PanAccountId',response.account_id);
					set_option('rc_monetize_PanEmail',data['email']);
					set_option('rc_monetize_PanAccount',response.username);
					set_option('rc_monetize_PanPassword',data['pass']);
					get_shortcode_id();
					showToast("Logined",true);
				}else{
					showToast(response.text);
				}	
			},
				
            error: function (response) {
				console.log(response);
				showToast(response.text);
				hideProgressBar();
            }

        });
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function getCountryList(){ 
	var data = Object();
	data['QueryType']='GetCountries';
	showProgressBar();
	jQuery.ajax({
	
          url: '../wp-content/plugins/roundcloud-monetize/includes/roundcloudapi.php',
            data: data,
            dataType: 'json',
            type: 'POST',
            success: function (response) {
				hideProgressBar();
				if(response.status=="success"){
					jQuery(response.data).each(function(){
						jQuery('#Savereg_country').append('<option value="'+this.code+'">'+this.desc+'</option>');
					});
					
				
				}else{
					showToast(response.text);
				}	
			},
				
            error: function (response) {
				console.log(response);
				showToast(response.statusText);
				hideProgressBar();
            }

        });
}


//registration new merchant
function sendRegistrationRequest(){
	var data = Object();
	data['QueryType']='addAffiliate';
	data['Email'] = jQuery('#Savereg_email').val();
	data['AppName'] = 'RC_MONETIZE_V1.0';
	data['AccountName'] = jQuery('#Savereg_login').val();
	data['roleType'] = "affiliate";
	data['password'] = jQuery('#Savereg_password').val();
	data['lang']='en-US';
	data['country'] = jQuery('#Savereg_country').val();

	if(validate() =="ok"){
	showProgressBar();
	jQuery.ajax({
          url: '../wp-content/plugins/roundcloud-monetize/includes/roundcloudapi.php',
            data: data,
            dataType: 'json',
            type: 'POST',
            success: function (response) {
				hideProgressBar();
				if(response.status=="success"){
				
					set_option('rc_monetize_PanAccountId',response.accountId);
					set_option('rc_monetize_PanEmail',data['Email']);
					set_option('rc_monetize_PanAccount',data['AccountName']);
					set_option('rc_monetize_PanPassword',data['password']);
					rc_monetize_post_code(response.accountId,"");
					
					showToast("The user was created",true);
				}else{
					showToast(response.text);
					console.log(response);
				}	
			},
				
            error: function (response) {
			console.log(response);
				hideProgressBar();
                showToast(response);
            }

        });
	}else{
		showToast(validate());
	}

}



