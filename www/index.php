<?php 
include_once('global.php');
$state_notfound = true;

$token = get('token');
if (!empty($token)) {
	$url = getUrlFromToken($token);
	if (!empty($url)) {
		if (isValidProtocol($url)) {
			redirect($url);
		} else {
			header("Content-type: text/plain");
			print $url;
		}
		exit;
	} else {
		$state_notfound = true;
	}
} else {
	redirectLocal("add.php");
	exit;
}
//I don't like hard coding the HTTP version, but it seems to be the accepted method
header("HTTP/1.1 404 Not Found");
include('header.php'); ?>
<?php print loc('en', 'Sorry, no URL found for ', 'es', 'No se ha encontrado - ') ?><?php print($token); ?>

<?php
	include('footer.php');
