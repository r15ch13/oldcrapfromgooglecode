<?php
/**
 * @package Functions
 */

/**
 * Stellt eine Verbindung zur MySQL-Datenbank her
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  host
 * @param  string  username
 * @param  string  password
 * @param  string  database
 * @return void
 * @access public
 */
function connect_db($host, $user, $pass, $database) {
	if( !$connection = @mysql_connect($host, $user, $pass)) {
		die( "<pre>Connection to the database server couldn\'t be made.\nMySQL-Error: <i>".mysql_error()."</i></pre>" );
	}
	if( !mysql_select_db($database, $connection )) {
		die ( "<pre>The database <b>".$database."</b> cannot be used.\nMySQL-Error: <i>".mysql_error()."</i></pre>" );
	}
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function debug($var) {
	$var = DEBUG == true ? print_a($var) : null;
	return $var;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @return string
 */
function trailing_slash() {
	$var = strlen(PATH) == 1 ? '/' : PATH.'/';
	return $var;
}

/**
 * Maskiert einen String für eine SQL-Abfrage
 *
 * @author Edgar Obenaus, GFG Avantgarde mbH
 * @version 1.0
 * @param String zu maskierdender String
 * @return String maskierter String
 */
function maskSQL($var) {
	$var = trim($var);
	$var = htmlentities($var, ENT_QUOTES);
	$var = mysql_escape_string($var);
	return $var;
}

/**
 * Konvertiert SQL Datetime nach Unix Timestamp
 *
 * @param  string SQL Datetime im Format 'Y-m-d H:i:s'
 * @return string Unix Timestamp
 * @access public
 */
function get_timestamp ($var) {
	$var = mktime(
		substr($var, 11, 2),
		substr($var, 14, 2),
		substr($var, 17, 2),
		substr($var, 5, 2),
		substr($var, 8, 2),
		substr($var, 0, 4)
	);
	return $var;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * Konvertiert Unix Timestamp nach Datetime
 *
 * @param  string Unix Timestamp
 * @param  bool   Set true to convert String to Time
 * @return string Datetime im Format 'd-m-Y H:i:s'
 * @access public
 */
function make_date($var1, $var2=false) {
	$var1 = $var2==true ? strtotime($var1) : $var1;
	$var1 = date('d-m-Y H:i:s', $var1);
	return $var1;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert einen Datensatz als assoziatives Array
 * @access public
 */
function assoc_query($var) {
	$var = mysql_query($var) OR die(mysql_error());
	$var = mysql_fetch_assoc($var);
	return $var;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert einen Datensatz als indiziertes Array.
 * @access public
 */
function row_query($var) {
	$var = mysql_query($var) OR die(mysql_error());
	$var = mysql_fetch_row($var);
	return $var;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert ALLE Datensätze als assoziative Arrays.
 * @access public
 */
function mysql_fetch_all_assoc($var) {
	$var = mysql_query($var) OR die(mysql_error());
	while ($row = mysql_fetch_assoc($var)) {
		$data[] = $row;
	}
	return $data;
}


/**
 * Errechnet den Median eines Arrays
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  array    Array mit numerischen Werten
 * @param  bool     True, reinigt und sortiert das Array
 * @return double	Gibt den Median als Double zurück
 */
function median($arr, $sort = false) {
	if(is_array($arr)) {
		if($sort == true) {
			$arr = array_unique($arr);
			sort($arr);
		}
		$c = count($arr);
		if($c%2 == 0) {
			$result = ($arr[($c / 2) - 1] + $arr[($c / 2)]) / 2;
		} else {
			$result = $arr[($c -1) / 2];
		}
		return $result;
	}
}

/**
 * Errechnet den Wert des unteren Viertels eines Arrays
 * requires median()
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  array    Array mit numerischen Werten
 * @param  bool     True, reinigt und sortiert das Array
 * @return double	Gibt den Wert des unteren Viertels als Double zurück
 */
function lowerQuartile($arr, $sort = false) {
	if(is_array($arr)) {
		if($sort == true) {
			$arr = array_unique($arr);
			sort($arr);
		}
		$c = count($arr);
		if($c%2 == 0) {
			$slice = array_slice($arr, 0, $c / 2);
		} else {
			$slice = array_slice($arr, 0, ($c - 1) / 2);
		}
		$result = median($slice);
	}
	return $result;
}

/**
 * Errechnet den Wert des oberen Viertels eines Arrays
 * requires median()
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  array    Array mit numerischen Werten
 * @param  bool     True, reinigt und sortiert das Array
 * @return double	Gibt den Wert des oberen Viertels als Double zurück
 */
function upperQuartile($arr, $sort = false) {
	if(is_array($arr)) {
		$c = count($arr);
		if($sort == true) {
			$arr = array_unique($arr);
			sort($arr);
		}
		if($c%2 == 0) {
			$slice = array_slice($arr, $c / 2);

		} else {
			$slice = array_slice($arr, ($c - 1) / 2 + 1);
		}
		$result = median($slice);
	}
	return $result;
}


/**
 * Errechnet den tatsächlichen Mittelwert.
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  array   Array ([Anzahl] => 'Price')
 * @return double  Gibt den tatsächlichen als Double zurück
 */
function realAverage($arr) {
	if(is_array($arr)) {
		foreach($arr as $price => $quantity) {
			if(is_numeric($price) && is_numeric($quantity)) {
				$totalQuantitiy += $quantity;
				$totalPrice += $price * $quantity;
			}
		}
		return $totalPrice / $totalQuantitiy;
	}
}

/**
 * @param  string  home path
 * @return array
 * @access public
 */
function uri_explode($var) {
	$var = substr($_SERVER["REQUEST_URI"], strlen($var));
	//$var = $_SERVER["REQUEST_URI"];
	$var = htmlentities($var);
	$var = explode('/', $var);
	$var = array_cleaner($var);
	return $var;
}

/**
 * @param  array   array from euri()
 * @return string
 * @access public
 */
function uri_implode($var) {
	$var = implode("/", $var)."/";
	return $var;
}


/**
 * @author Richard 'r15ch13' Kuhnt
 */
function read_folder($dir) {
	if ($handle = opendir($dir)) {
		while (false !== ($output = readdir($handle))) {
			if ($output != "." && $output != "..") {
			echo $output."<br />\n";
			}
		}
		closedir($handle);
	}
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function read_file($file) {
	if (file_exists($file)) {
		$handle = fopen ($file, "r");
		$contents = fread ($handle, filesize ($file));
		fclose ($handle);
		return $contents;
	}
	else {
		echo "ERROR!\n\n".$file."\texistiert nicht!";
	}
}


/**
 * Prüft, ob der Wert ein gültiger {@link http://de.wikipedia.org/wiki/Md5 MD5-Hash} ist
 *
 * @param string MD5-Hash
 * @return string Gibt <b>true</b> zurück, wenn der Wert ein MD5-Hash ist.
 */
function is_md5($var) { //
	$var = preg_replace("/;;/", "", $var);
	$var = trim($var);
	if (preg_match('/^[A-Fa-f0-9]{32}$/', $var) == true)  //return preg_match('/^[A-Fa-f0-9]{32}$/',$var);
	return $var;
}


/**
 * Entfernt alle leeren Werte innerhalb des angegeben Arrays
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param array An array with empty values
 * @param bool Set to true if you need the Keys
 * @return array An array without empty values
 * @access public
 */
function array_cleaner($arr, $keepKey = false) {
	$result = array();
	foreach($arr as $key => $value)
	{
		$value = trim($value);
		if(strlen($value))
		if($keepKey == true) {
			$result[$key] = $value;
		} else{
			$result[] = $value;
		}
	}
	return $result;
}


/**
 * @author Richard 'r15ch13' Kuhnt
 */
function strstrbi($haystack, $needle, $before_needle=FALSE, $include_needle=TRUE, $case_sensitive=FALSE) {
	//Find the position of $needle
	if($case_sensitive) {
		$pos=strpos($haystack,$needle);
	} else {
		$pos=strpos(strtolower($haystack),strtolower($needle));
	}

	//If $needle not found, abort
	if($pos===FALSE) return FALSE;

	//Adjust $pos to include/exclude the needle
	if($before_needle==$include_needle) $pos+=strlen($needle);

	//get everything from 0 to $pos?
	if($before_needle) return substr($haystack,0,$pos);

	//otherwise, go from $pos to end
	return substr($haystack,$pos);
}


/**
 * Fügt print_r den pre-Tag hinzu
 *
 * @author Richard 'r15ch13' Kuhnt
 */
function print_a($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

/**
 * @author passtschu@freenet.de @ php.net
 */
function string2array ($string, $template){
// $string1 = 'www.something.com 66.196.91.121 - - [01/Sep/2005:04:20:39 +0200] "GET /robots.txt HTTP/1.0" 200 49 "-"';
// $string2= '%Domain% %IP% - %User% \[%Date%:%Time% %TimeZone%\] "%Method% %Request% %Protocol%" %ServerCode% %Bytes% "%Referer%"';
// string2array ($string1, $string2);

	//search defined dividers
	preg_match_all ("|%(.+)%|U", $template, $template_matches);
	//replace dividers with "real dividers"
	$template = preg_replace ("|%(.+)%|U", "(.+)", $template);
	//search matches
	preg_match ("|" . $template . "|", $string, $string_matches);
	//[template_match] => $string_match
	foreach ($template_matches[1] as $key => $value){
		$output[$value] = $string_matches[($key + 1)];
	}
	return $output;
}

?>