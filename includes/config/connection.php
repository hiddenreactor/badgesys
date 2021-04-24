<?php


define('MYSQL_USER', "b9cd122ae5026e");
 
//Our MySQL password.
define('MYSQL_PASSWORD', "287b0048");
 
//The server that MySQL is located on.
define('MYSQL_HOST', "us-cdbr-east-03.cleardb.com");
 
//The name of our database.
define('MYSQL_DATABASE', "heroku_d1dabaaefc9d538");
 
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
$connect = new PDO("mysql:host=us-cdbr-east-03.cleardb.com; dbname=heroku_d1dabaaefc9d538;", "b9cd122ae5026e", "287b0048", $pdoOptions);
?>
