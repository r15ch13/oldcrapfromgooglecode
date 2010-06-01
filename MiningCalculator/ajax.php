<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.1
*/

session_start();
if($_SESSION['loggedin']) {
	require_once("config.php");
	require_once("class.Type.php");

	$type = '';
	$value = htmlentities(trim($_GET['value']));
	$databaseid = htmlentities(trim($_GET['id']));
	$c = htmlentities(trim($_GET['c']));

	if(!is_numeric($value)) {
		$value = str_replace('%2C', '.', $value);
		$value = str_replace(',', '.', $value);
	}
	if(is_numeric($databaseid) && is_numeric($value)) {
		$type = new Type($databaseid);

		switch ($c) {
			case 'price':
				$type->Price($value);
				echo number_format($value, 2, '.', '');
				break;
			case 'min':
				$type->CustomMinimum($value);
				echo number_format($value, 2, '.', '');
				break;
			case 'max':
				$type->CustomMaximum($value);
				echo number_format($value, 2, '.', '');
				break;
			default:
				echo "error";
				break;
		}
	} else {
		echo "error";
	}
} else {
	header('location: ./');
}
?>