<?php

$registratorIp = $_GET["registarator__ip"];
$urlRegistrator = "http://$registratorIp:2032/list";

function getChannelIdList ($urlRegistrator) {	

	$ch = curl_init($urlRegistrator);
	$result = curl_exec($ch);
	curl_close($ch);


}


getChannelIdList($urlRegistrator);


?>