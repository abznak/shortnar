<?php
include_once('global.php');
$done_add = false;

$url = get('url');

//I miss symfony

if (!empty($url)) {
	$token = executeAdd($url);
	$shorturl = getShortUrlFromToken($token);
	$done_add = true;
}

include('header.php');

if ($done_add) {
	if (isValidProtocol($url)) {
		echo loc('en', "Long URL: ", 'es', 'Enlace completo:') .getUrlLink($url)."<br>";
	} else {
		echo loc('en',"Text: ", 'es', 'Texto: ') .($url)."<br>";
	}
?>
<?php print(loc('en', 'Short link: ', 'es', 'Eslab&#243;n corto: ') . getUrlLink($shorturl)); ?>
<br>
<br>
	<?php
echo loc('en', 'Add another? ', 'es', 'Agregar otro? ');
}
echo loc('en', 'Enter URL:', 'es', 'Ingrese enlace:');


//size = 100 looks good at 800x600
?>
	<form action="add.php" method="POST">
	<input type="text" size="100" name="url"><br><input type="submit">
	</form>
<?php
	include('footer.php');
