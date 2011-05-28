<?php
include_once('config.php');

function init() {
	initSQL();
}

function initSQL() {
	global $conn, $c_mysql_host, $c_mysql_username, $c_mysql_password, $c_mysql_db;

	//  http://php.net/manual/en/function.mysql-connect.php
	$conn = mysql_connect($c_mysql_host, $c_mysql_username, $c_mysql_password);
	if ($conn === false) {
		fail("failed to connect to database");
	}

	//http://php.net/manual/en/function.mysql-query.php
	$res = mysql_query("use $c_mysql_db");
	if ($res === false) {
		fail("couldn't select db");
	}
}

//put quotes around and escape a string for mysql
//note - breaks if sql hasn't been init'd
function e($str) {
	return "'" . mysql_real_escape_string($str) ."'";
}

//get the name of the table the urls are stored in
function urlsTable() {
	global $c_mysql_prefix;
	return $c_mysql_prefix . "urls";
}

/**
 * adds a url to the database, returns the URL's token
 */
function executeAdd($url) {
	global $c_token_size, $c_max_tokencreate_attempts;
	for ($i = 0; $i < $c_max_tokencreate_attempts; $i++) {
		$token = createRandomToken();

		//insert ignore in case there's already one there
		$insertsql = "insert ignore into ".urlsTable()." (token, url) values (".e($token).",".e($url).")";
		$res = mysql_query($insertsql);  
		if ($res == false) {
			fail("couldn't insert url into table");
		}

		//check that there wasn't already one there
		$url2 = getUrlFromToken($token);
		if (trim($url2) == trim($url)) {
			//NOTE: if the db (or anything) changes the URL, this is going to break (escaping or what have you)

			//it'll also 'break' if the url happened to already be correct, but the
			//always-generate-a-new-token policy isn't important enough to worry
			//about that HIGHLY unlikely case

			return $token;
		}
	}
	fail("couldn't find an unused token");
}


function fail($str) {
	//LATER: fancy error messages

	//it's probalby a mysql error
	$err = mysql_error();

	//log a detailed error
	error_log(date("c") . "  fail in shortnar - $str - $err\n");
	print $str;
	exit();
}

function redirect($url) {
	header("Location: $url");
}
function redirectLocal($path) {
	global $c_shorturl_prefix;
	redirect("$c_shorturl_prefix$path");
}


// get the GET value for a key, or the post value if there isn't GET or
// $default if there's neither
function get($key, $default = '') {
	if (array_key_exists($key, $_GET)) {
		return $_GET[$key];
	} else if (array_key_exists($key, $_POST)) {
		return $_POST[$key];
	} else {
		return $default;
	}
}

function getShortUrlFromToken($token) {
	global $c_shorturl_prefix;
	return $c_shorturl_prefix . $token;
}
function getUrlFromToken($token) {
	$getsql = "select url from ".urlsTable()." where token = " . e($token);
	$res = mysql_query($getsql);
	if ($row = mysql_fetch_assoc($res)) {
		return $row['url'];
	} else {
		return "";
	}
}	
function getUrlLink($url, $desc = '') {
	if (empty($desc)) {
		$desc = $url;
	}
	return "<a href=\"$url\">$desc</a>";
}
function rndStr($len, $chars) {
	$charcount = strlen($chars);
	$ret = "";
	for ($i = 0; $i < $len; $i++) {
		$ret .= $chars{mt_rand(0, $charcount - 1)};
	}
	return $ret;
}
function createRandomToken() {
	global $c_token_length, $c_token_chars;
	return rndStr($c_token_length, $c_token_chars);
}
function isValidProtocol($url) {
	global $c_valid_protocols;
	foreach ($c_valid_protocols as $proto) {
		if (strpos($url, $proto) === 0) {
			return true;
		}
	}
	return false;
}

// loc is my quick localisation function
// it takes an aribtrary number of pairs of language,message arguments
// e.g.  loc('es', 'hola', 'en', 'hello')
function loc() {
	global $c_language;
	for ($i = 0; $i < func_num_args(); $i += 2) {
		if (func_get_arg($i) == $c_language) {
			$str = func_get_arg($i+1);
			if (!isset($str)) {
				//TODO: better error handling
				return "";
			}
			return $str;
		}
	}
	return ""; //site is fairly self explanatory, empty probably works as a default
}

