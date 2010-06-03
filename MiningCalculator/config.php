<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.1
*/
require_once("functions.inc.php");

//MySQL Zugangsdaten:
$host  = "localhost";
$user  = "user";
$pass  = "pass";
$database = "dbname";

$eveIconPath = "resource/icons/icons_items_png/32_32/";
$eveIconSize = 20;

$debug = false;
connect_db($host, $user, $pass, $database);


// WBB3 Login
define('WBB3_ENCRYPTION_ENABLE_SALTING', 1);
define('WBB3_ENCRYPTION_ENCRYPT_BEFORE_SALTING', 1);
define('WBB3_ENCRYPTION_METHOD', 'sha1');
define('WBB3_ENCRYPTION_SALT_POSITION', 'before');
define('WBB3_USER_GROUP', '7');
?>