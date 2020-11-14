<?php


define('MYSQL_USER', "b8a2927a50099e");
 
//Our MySQL password.
define('MYSQL_PASSWORD', "8036e8df");
 
//The server that MySQL is located on.
define('MYSQL_HOST', "us-cdbr-iron-east-01.cleardb.net");
 
//The name of our database.
define('MYSQL_DATABASE', "heroku_c1c6c2ef5faa08f");
 
/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
// $connect = new PDO(
//     "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
//     MYSQL_USER, //Username
//     MYSQL_PASSWORD, //Password
//     $pdoOptions //Options
// );
$connect = new PDO("mysql:host=us-cdbr-iron-east-01.cleardb.net; dbname=heroku_c1c6c2ef5faa08f;", "b8a2927a50099e", "8036e8df", $pdoOptions);
?>
