<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.1
*/
?><html><body><form action="<?php echo $HTTP_SERVER_VARS["PHP_SELF"]; ?>" method="post">
<textarea name="items" rows="15"></textarea><br>
<input type="submit" value="send"></form>
<br>
<br>
<?php
	require_once("functions.inc.php");
	//<a href=\"showinfo:11399\">Morphite</a>
	$input = trim($HTTP_POST_VARS["items"]);
	$input = str_replace('<a href=\"showinfo:', '', $input);
	$input = str_replace('\">', '|', $input);
	$items = explode('</a>', $input);
	$items = array_cleaner($items);
	foreach($items as $key => $item) {
		$tmp = explode('|', $item);
		echo "Id: ".$tmp[0]."<br>";
		echo "Name: ".$tmp[1]."<br><br>";
	}
?>

</body></html>