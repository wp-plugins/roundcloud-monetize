<?php
$url = 'http://affiliate.yourcloudaround.com/scripts/savereg.php';
if($_POST["QueryType"] =="GetCountries"){

$data = array('QueryType' => 'GetCountries');

$options = array(
    'http' => array(

        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;

}elseif($_POST["QueryType"] =="PaNlogin"){
	
	
$data = array('QueryType' => 'PaNlogin','email'=>$_POST['email'],'pass'=>$_POST['pass'],'userRole'=>$_POST['userRole']);

$options = array(
    'http' => array(

        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
	
}elseif($_POST["QueryType"] =="addAffiliate"){
	
	
$data = array('QueryType' => 'addAffiliate',
'Email' => $_POST['Email'],
'AppName' => $_POST['AppName'],
'AccountName' => $_POST['AccountName'],
'roleType' => $_POST['roleType'],
'password' => $_POST['password'],
'country' => $_POST['country'],
'lang' => $_POST['lang']);


$options = array(
    'http' => array(

        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
	
}
	

?>