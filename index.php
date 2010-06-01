<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.2
*/

/*
if(!empty($_GET['s'])) {
	session_id($_GET['s']);
}
*/
session_start();
require_once("config.php");
require_once("class.MarketGroup.php");
require_once("libs/Smarty.class.php");

$smarty = new Smarty;
$smarty->compile_check = true;
$smarty->debugging = $debug;

$smarty->assign("session", session_id());
$allgroups = MarketGroup::GetAllGroups();
$smarty->assign("MarketGroups", $allgroups);
$smarty->assign("lastupdate", date('Y-m-d H:i:s', MarketGroup::OverallLastUpdate()));
$smarty->assign("eveIconPath", $eveIconPath);
$smarty->assign("eveIconSize", $eveIconSize);
$smarty->assign("version", "v2.0.3 Stable");

//$smarty->assign("bugreport", "\n\n\nDebug:\n".base64_encode(preg_replace('/\s/', '', print_r($_SESSION, true))));

/* Zwecks neuem IGB überflüssig
if (!(strpos($HTTP_SERVER_VARS["HTTP_USER_AGENT"],"EVE-minibrowser")===false)) {
	$smarty->assign("igb", true);
	$igb = true;
} else {
*/
	$smarty->assign("igb", false);
	$igb = false;
/*
}
*/


switch ($_GET['p']) {
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'editor':
		if(!$igb) {
			if($_SESSION['loggedin']) {
				$smarty->display('editor.tpl');
			} else {
				$smarty->assign("denied", true);
				$smarty->display('login.tpl');
			}
		} else {
			$smarty->display('outgame.tpl');
		}
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'login':
		if(!$igb) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				require_once("class.User.php");
				$user = new User();
				$username = htmlentities(trim($_POST['username']));
				$password = htmlentities(trim($_POST['password']));
				if($user->Login($username, $password)) {
					$_SESSION['loggedin'] = true;
					header('location: ./?p=editor');
				} else {
					$_SESSION['loggedin'] = false;
					$smarty->assign("denied", true);
					$smarty->display('login.tpl');
				}
				$username = '';
				$password = '';
			} else {
				if($_SESSION['loggedin']) {
					header('location: ./?p=editor');
				} else {
					$smarty->display('login.tpl');
				}
			}
		} else {
			$smarty->display('outgame.tpl');
		}
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'update':
		if(!$igb) {
			if($_SESSION['loggedin']) {
				require_once("median.php");
				$smarty->assign("updatetime", update_stats());
				$smarty->display('editor.tpl');
			} else {
				header('location: ./?p=login');
			}
		} else {
			$smarty->display('outgame.tpl');
		}
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'logout':
		@session_start();
		@session_destroy();
		header("location: ./");
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'reset':
		@session_start();
		@session_destroy();
		header("location: ./");
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	case 'xml':
		if(!$igb) {
			header("Content-Type: text/xml; charset=utf-8");
			echo MarketGroup::XmlExport();
		} else {
			$smarty->display('outgame.tpl');
		}
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
	default:

		if(empty($_SESSION['gid'])) {
			$_SESSION['gid'] = $allgroups[0]->DatabaseId();
		} else {
			if(!empty($_GET['g'])) {
				$gid = htmlentities(trim($_GET['g']));
				if(is_numeric($gid) && !empty($gid)) {
					$_SESSION['gid'] = $gid;
				}
			}
		}

		if($_SERVER['REQUEST_METHOD'] == "POST") {

			require_once("class.Calculation.php");
			$posted = $_POST;
			//print_a($_POST);
			$_SESSION['subtotal'] = "";
			foreach($posted as $typeId => $quantity) {

				$quantity = clean_number($quantity);
				$typeId = clean_number($typeId);

				if($typeId != 0) {
					$result = new Calculation($typeId, $quantity);
					$tmpid = $result->Type()->MarketGroup()->DatabaseId();

					$value = array();
					if($quantity != 0) {
						$value['quantityFormated'] = $result->Quantity(true);
						$value['quantity'] = $result->Quantity();
						$value['resultFormated'] = $result->Price(true);
						$value['result'] = $result->Price();

						$_SESSION['subtotal'][$tmpid] += $result->Price();
						$_SESSION['subtotalFormated'][$tmpid] = number_format($_SESSION['subtotal'][$tmpid], 2);
						$_SESSION['type'][$result->Type()->DatabaseId()] = $value;
					} else {
						$_SESSION['type'][$result->Type()->DatabaseId()] = array('quantityFormated' => 0, 'quantity' => '', 'resultFormated' => number_format(0, 2), 'result' => 0);
					}

				}
			}
		}
		if(!empty($_SESSION['type'])) {
			foreach($_SESSION['type'] as $type) {
				$total += $type['result'];
			}
		}
		$total += 10000;
		$smarty->assign("total", number_format($total, 2));
		$smarty->display('index.tpl');
		break;
///////////////////////////////////////////////////////////////////////////////////////////////////
}

function clean_number($var) {
	$var = trim($var);
	if(empty($var)) return 0;
	$var = str_replace('.', '', $var);
	$var = str_replace(',', '', $var);
	if(is_numeric($var)) return $var;
	return 0;
}


if($debug) {
	echo '<pre><h1>Debug:</h1><hr></pre>';
	print_a($_SESSION);
	print_a($_REQUEST);
}
?>