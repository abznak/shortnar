<?php
include('global.php');
include('header.php');
// not proper tests, need more design, and ideally a testing framework to do that
echo "<pre>";
echo "<h1>Tokens</h1>";

$count = strlen($c_token_chars);
$len = $c_token_length;
print "chars count: $count, length: $len\n";

for ($i = 0; $i < 30; $i++) {
	print createRandomToken() ."\n";
}



echo "<h1>isValidProtocol</h1>";

$urls = array("http://good.leetmotif.net", "https://good.leetmotif.net", "ftp://good.leetmotif.net", "http://good.leetmotif.net/a/c/d", "http:/bad.leetmotif.net", "bad.gasdfasd", "steam://bad/bar/baz");

foreach ($urls as $url) {
	$v = isValidProtocol($url);
	print tf($v) . "  " . $url."\n";
}

	
function tf($b) {
	return $b ? "<font color=green>t</font>" : "<font color=red>f</font>";
}


echo "<h1>Mysql limits</h1>";
$sql = "select * from test.test limit 10;";
$res = mysql_query($sql);
var_dump($sql);
echo "\n";
var_dump($res);
echo "\n";
//print mysql_error();
echo "\n";


echo "<h1>loc</h1>";
$c_language = 'en';
echo "en first - hello = " . loc('en', 'hello', 'es', 'hola')."\n";
echo "en second - hello - " . loc('es', 'hola', 'en', 'hello')."\n";
echo "en only - hello - " . loc('en', 'hello')."\n";
echo "en missing - '' - '" . loc('es', 'hola')."'"."\n";




/// THIS BLOCK MUST BE LAST

echo "<h1>fail()</h1>";
fail("TEST: nothing after this line");
echo "FAIL FAIL";
