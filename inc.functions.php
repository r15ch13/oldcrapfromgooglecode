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
function mysql_connect_db($host, $user, $pass, $database) {
	if( !$connection = @mysql_connect($host, $user, $pass)) {
		die( "<pre>Connection to the database server couldn't be made.\nMySQL-Error: <i>".mysql_error()."</i></pre>" );
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
 * Generiert oder pr�ft einen Hash von hMailServer
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  string	Password to crypt/check
 * @param  string	Hash to check
 * @param  bool		check Hash and Password
 * @return string   generated hash || true if password matches
 * @access public
 */
function hMailPassword($plaintext, $hash = false, $check = false) {
	if($check == false) {
		$salt = microtime();
		$salt = md5($salt);
		$salt = substr($salt, 13, 6);
		$hash = $salt . hash('sha256', $salt.$plaintext);
		return $hash;
	} elseif($check == true) {
		if(!empty($hash) AND strlen($hash) == 70) {
			$salt = substr($hash, 0, 6);
			$newhash = $salt . hash('sha256', $salt.$plaintext);
			return $newhash == $hash ? true : false;
		} else {
			return false;
		}
	}
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function quotemsg($text, $von = false, $an = false, $datum = false, $betreff = false) {
	$text = wordwrap($text, 60, "\n");
	$text = explode("\n", $text);
	$quote = "\n\n\n-------- Original-Nachricht --------\n";
	$quote.= "> Datum: ".$datum."\n";
	$quote.= "> Von: ".$von."\n";
	$quote.= "> An: ".$an."\n";
	$quote.= "> Betreff: ".$betreff."\n>\n>\n";
	foreach($text as $val) {
		$quote.= "> ".$val."\n";
	}
	return $quote;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function site($arr) {
	$arr = array(
		'idx' => $arr[0],
		'kat' => $arr[1],
		'opt' => $arr[2],
		'val' => $arr[3]
	);
	return $arr;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function is_hexcolor($value) {
	return preg_match('/^[0-9a-fA-F]{6}$/', $value);
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function hexrgb($hex) {
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	return array('r' => $r, 'g' => $g, 'b' => $b);
}

/**
 * @author Richard 'r15ch13' Kuhnt
 */
function error_msg($msg, $html = false) {
	switch ($msg) {
		case "noboxname":	$error = "Keine Box angegeben"; break;
		case "nobox":		$error = "Box nicht vorhanden"; break;
		case "frombox":		$error = "Keine aktive Box angegeben"; break;
		case "tobox":		$error = "Keine Zielbox angegeben"; break;
		case "nomail":		$error = "Diese Mail exsistiert nicht"; break;
		case "nothing":		die("<pre>Um, well, ... here is nothing!</pre>"); break;
		default; 			$error = false; break;
	}
	if(!empty($error)) {
		$return = $html == true ? '<span id="error" style="color:#ff0000; font-weight:bold; background-color:#efefef;">'.$error.'</span>' : '<pre>'.$error.'</pre>';
	}
	print $return;
}

/**
 * Maskiert einen String f�r eine SQL-Abfrage
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
function get_timestamp($var) {
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
 * @param  stream  imap resource
 * @param  int     mailnumber
 * @return int     returns mail priority
 * @access public
 */
function get_prio($imapstream, $msgno) {
	$header = imap_fetchheader($imapstream, $msgno);
	$header = explode("\n",$header);
	foreach($header as $val) {
			$prio[strstrbi($val, ':', true, false, false)] = strstrbi($val, ':', false, false, false);
	}
	$return = empty($prio['X-Priority']) ? 3 : $prio['X-Priority'];
	$return = trim($return);
	return $return;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert einen Datensatz als assoziatives Array
 * @access public
 */
function assoc_query($var, $debug = false) {
	if($debug) echo "<pre>".trim(preg_replace('/\s+/', ' ', $var))."</pre>";
	$var = @mysql_query($var) OR die(mysql_error());
	$var = mysql_fetch_assoc($var);
	return !empty($var) ? $var : false;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return object   Liefert einen Datensatz
 * @access public
 */
function scalar_query($var, $debug = false) {
	if($debug) echo "<pre>".trim(preg_replace('/\s+/', ' ', $var))."</pre>";
	$var = @mysql_query($var) OR die(mysql_error());
	$var = @mysql_fetch_assoc($var);
	$var = @array_pop($var);
	return !empty($var) ? $var : false;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert einen Datensatz als indiziertes Array.
 * @access public
 */
function row_query($var, $debug = false) {
	if($debug) echo "<pre>".trim(preg_replace('/\s+/', ' ', $var))."</pre>";
	$var = @mysql_query($var) OR die(mysql_error());
	$var = mysql_fetch_row($var);
	return !empty($var) ? $var : false;
}

/**
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  SQL-Query
 * @return array   Liefert ALLE Datens�tze als assoziative Arrays.
 * @access public
 */
function mysql_fetch_all_assoc($var, $debug = false) {
	if($debug) echo "<pre>".trim(preg_replace('/\s+/', ' ', $var))."</pre>";
	$var = @mysql_query($var) OR die(mysql_error());
	while ($row = mysql_fetch_assoc($var)) {
		$data[] = $row;
	}
	return !empty($data) ? $data : false;
}

/**
 * Gibt true zur�ck wenn der Wert zwischen den beiden anderen Werten liegt.
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param numeric Wert der gepr�ft wird
 * @param numeric kleiner Wert
 * @param numeric gro�er Wert
 * @return boolean
 * @access public
 */
function between($val, $lft, $rgt) {
	if(is_numeric($val) && is_numeric($lft) && is_numeric($lft)) {
		if($lft < $rgt) {
			if($lft <= $val && $val <= $rgt) {
				return true;
			}
		} else {
			trigger_error("between(): Left argument can not be smaller than the right argument", E_USER_WARNING);
		}
	} else {
		trigger_error("between(): One argument is not numeric", E_USER_WARNING);
	}
}

/**
 * Errechnet den Median eines Arrays
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  array    Array mit numerischen Werten
 * @return double	Gibt den Median als Double zur�ck
 */
function median($arr) {
	if(is_array($arr)) {
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
 * @return double	Gibt den Wert des unteren Viertels als Double zur�ck
 */
function lowerQuartile($arr) {
	if(is_array($arr)) {
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
 * @return double	Gibt den Wert des oberen Viertels als Double zur�ck
 */
function upperQuartile($arr) {
	if(is_array($arr)) {
		$c = count($arr);
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
 * Erstellt einen Hyperlink
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param  string  linkpath
 * @param  string  displayname
 * @param  string  <a> html attributes
 * @param  bool   trailing slash
 * @param  bool   create link without htmltags
 * @return string
 * @access public
 */
function mklink($link, $name = 'Link', $attr = false, $slash = true, $wohtml=false) {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = @str_replace(PATH."/", '', "/".$uri);
	$uri = @explode('/', $uri);
	$uri = @array_cleaner($uri);
//	print_r($uri);
	$path = PATH == "/" ? false : PATH;
	$link = @substr($link, 0, 1) == "/" ? $link : "/".$link;
	//echo $uri[0];
	$menu = $uri[0] == "" ? $uri[0] : '/'.$uri[0];
	$slash = $slash == true ? "/" : "";
	$return = $wohtml==true ? $path.$menu.$link.$slash : '<a href="'.$path.$menu.$link.$slash.'"'.' '.$attr.'>'.$name.'</a>';
	return $return;
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
 * Pr�ft, ob der Wert ein g�ltiger {@link http://de.wikipedia.org/wiki/Md5 MD5-Hash} ist
 *
 * @param string MD5-Hash
 * @return string Gibt <b>true</b> zur�ck, wenn der Wert ein MD5-Hash ist.
 */
function is_md5($var) { //
	$var = preg_replace("/;;/", "", $var);
	$var = trim($var);
	if (preg_match('/^[A-Fa-f0-9]{32}$/', $var) == true)  //return preg_match('/^[A-Fa-f0-9]{32}$/',$var);
	return $var;
}

/**
 * Pr�ft, ob der Wert ein g�ltiger {@link http://de.wikipedia.org/wiki/Sha1 SHA1-Hash} ist
 *
 * @param string SHA1-Hash
 * @return string Gibt <b>true</b> zur�ck, wenn der Wert ein SHA1-Hash ist.
 */
function is_sha1($var) { //
	$var = preg_replace("/;;/", "", $var);
	$var = trim($var);
	if (preg_match('/^[A-Fa-f0-9]{40}$/', $var) == true)  //return preg_match('/^[A-Fa-f0-9]{42}$/',$var);
	return $var;
}


/**
 * Erstellt einen SHA1-Hash aus dem angegebenen Passwort und dem Salt.
 *
 * @param string Passwort
 * @param string Salt
 * @return string Gibt SHA1-Hash zur�ck;
 */
function encrypt($pass, $salt = '') {
	$hash = $pass.$salt;
	for($i = 0; $i < 9999; $i++) {
		$hash = sha1($i.$hash.$i);
	}
	return $hash;
}


/**
 * Entfernt alle leeren Werte innerhalb des angegeben Arrays
 *
 * @author Richard 'r15ch13' Kuhnt
 * @param array $arr array with empty values
 * @return array array without empty values
 * @access public
 */
function array_cleaner($arr) {
	$result = array();
	foreach($arr as $value)
	{
		$value = trim($value);
		if(strlen($value))
		$result[] = $value;
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
 * F�gt print_r den pre-Tag hinzu
 *
 * @author Richard 'r15ch13' Kuhnt
 */
function print_a($data, $style = true, $tree = true) {
	echo '<pre style="font-size: 11px; line-height: 11px;">';
	if($tree === true) {
		print_r_tree($data);
	} else {
		print_r($data);
	}
	echo '</pre>';
}

/**
 * @author Bob (http://de3.php.net/manual/de/function.print-r.php#90759)
 */
function print_r_tree($data) {
    // capture the output of print_r
    $out = print_r($data, true);

    // replace something like '[element] => <newline> (' with <a href="javascript:toggleDisplay('...');">...</a><div id="..." style="display: none;">
    $out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe',"'\\1<a href=\"javascript:toggleDisplay(\''.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\">\\2</a><div id=\"'.\$id.'\" style=\"display: none;\">'", $out);

    // replace ')' on its own on a new line (surrounded by whitespace is ok) with '</div>
    $out = preg_replace('/^\s*\)\s*$/m', '</div>', $out);

    // print the javascript function toggleDisplay() and then the transformed output
    echo '<script language="Javascript">function toggleDisplay(id) { document.getElementById(id).style.display = (document.getElementById(id).style.display == "block") ? "none" : "block"; }</script>'.$out;
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

function pharseXml($text) {
    $text = str_replace("&", "&amp;", $text);
    $text = str_replace("�", "&sect;", $text);
    $text = str_replace("\"", "&quot;", $text);
    $text = str_replace("�", "&lsquo;", $text);
    $text = str_replace("�", "&rsquo;", $text);
    $text = str_replace("�", "&sbquo;", $text);
    $text = str_replace("�", "&ldquo;", $text);
    $text = str_replace("�", "&rdquo;", $text);
    $text = str_replace("�", "&bdquo;", $text);
    $text = str_replace("�", "&lsaquo;", $text);
    $text = str_replace("�", "&rsaquo;", $text);
    $text = str_replace("�", "&laquo;", $text);
    $text = str_replace("�", "&raquo;", $text);
    $text = str_replace("�", "&circ;", $text);
    $text = str_replace("�", "&tilde;", $text);
    $text = str_replace("�", "&cedil;", $text);
    $text = str_replace("�", "&Agrave;", $text);
    $text = str_replace("�", "&agrave;", $text);
    $text = str_replace("�", "&Aacute;", $text);
    $text = str_replace("�", "&Acirc;", $text);
    $text = str_replace("�", "&Atilde;", $text);
    $text = str_replace("�", "&Auml;", $text);
    $text = str_replace("�", "&auml;", $text);
    $text = str_replace("�", "&Uuml;", $text);
    $text = str_replace("�", "&uuml;", $text);
    $text = str_replace("�", "&Ouml;", $text);
    $text = str_replace("�", "&ouml;", $text);
    $text = str_replace("�", "&Iuml;", $text);
    $text = str_replace("�", "&iuml;", $text);
    $text = str_replace("�", "&Aring;", $text);
    $text = str_replace("�", "&AElig;", $text);
    $text = str_replace("�", "&Ccedil;", $text);
    $text = str_replace("�", "&THORN;", $text);
    $text = str_replace("�", "&ETH;", $text);
    $text = str_replace("�", "&thorn;", $text);
    $text = str_replace("�", "&eth;", $text);
    $text = str_replace("�", "&Oslash; ", $text);
    $text = str_replace("�", "&OElig;", $text);
    $text = str_replace("�", "&oelig;", $text);
    $text = str_replace("�", "&Scaron;", $text);
    $text = str_replace("�", "&scaron;", $text);
    $text = str_replace("<", "&lt;", $text);
    $text = str_replace(">", "&gt;", $text);
    return trim($text);
}

?>