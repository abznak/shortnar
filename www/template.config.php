<?php

//MYSQL host, username and password

$c_mysql_host = 'localhost';
$c_mysql_username = '4gh';
$c_mysql_password = 'Sam8yaab'; #change this, obviously

$c_mysql_db = '4gh'; #name of the database
$c_mysql_prefix = '4gh_'; #prefix for the tables (in case you're sharing a database).  Note that the prefix includes the underscore.


//this is the string that goes in front of the token
//I could work it out from the env vars, but on reflection
//I'd rather always hand out the same thing regardless
//of, for example, whether they put in the www. etc
$c_shorturl_prefix = 'http://4gh.es/';

//how many characters in the token generated for the short URL
$c_token_length = 6;

//characters than can appear in the tokens
//I've removed vowels and vowel like numbers,
//with the aim of reducing the number of words
//that might randomly appear
//also removed GHgh to hold in reserve
$c_token_chars = 'BCDFJKMNPQRSTVWXYZbcdfjkmnpqrstvwxyz256789'; //42 chars

# how many tokens 42 chars get you with different lengths:
#  
#  > a = data.frame(n = seq(1,6)); a$tokens = 46^a$n;
#  > a
#    n     tokens
#  1 1         46
#  2 2       2116
#  3 3      97336
#  4 4    4477456
#  5 5  205962976
#  6 6 9474296896


//how many random tokens shall we try before we give up
//on finding an unused one
$c_max_tokencreate_attempts = 100;

//urls that don't start with one of these are echo'd rather than linked
$c_valid_protocols = array("http://", "https://", "ftp://");

$c_language = 'es';
