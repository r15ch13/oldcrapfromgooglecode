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

	function update_stats() {
		$time_start = microtime(true);

		mysql_query("DELETE FROM `z_marketlog` WHERE (UNIX_TIMESTAMP() - `issued`) >= (`duration` * 24 * 60 * 60);");

		$sql = mysql_query("SELECT `typeID`, `dCustomMinimum`, `dCustomMaximum` FROM `z_pricing`;");
		while ($row = mysql_fetch_assoc($sql)) {
			$data = get_stats($row['typeID'], $row['dCustomMinimum'], $row['dCustomMaximum']);
			if(!empty($data)) {
				$result[] = $data;
			}
			set_stats($data);
		}

		$time_end = microtime(true);
		$time = round($time_end - $time_start, 4);
		return "Updated stats in $time seconds.";
	}

	function get_stats($typeID, $min = 0, $max = 0) {
		if(is_numeric($typeID)) {

			if(!empty($min) && !empty($max)) {
				if(is_numeric($min) && is_numeric($max)) {
					$and = "AND `price` BETWEEN ".$min." AND ".$max;
				}
			} else {
				if(!empty($min)) {
					if(is_numeric($min)) {
						$and= "AND `price` >= ".$min;
					}
				} elseif(!empty($max)) {
					if(is_numeric($min)) {
						$and = "AND `price` <= ".$max;
					}
				}
			}

			$price = mysql_fetch_all_assoc("SELECT
												`price`
											FROM
												`z_marketlog`
											WHERE `typeID` = '".$typeID."'
											".$and."
											ORDER BY `price` ASC;");
			if(count($price) > 0) {
				foreach($price as $v) {
					$data[] = $v['price'];
				}
				$result['typeID'] = $typeID;
				$result['lower'] = lowerQuartile($data);
				$result['median'] = median($data);
				$result['upper'] = upperQuartile($data);
			}

			$stats = mysql_fetch_all_assoc("SELECT
												ROUND(AVG(`price`), 2) AS `avg`,
												ROUND(STDDEV(`price`), 2) AS `stddev`,
												MIN(`price`) AS `min`,
												MAX(`price`) AS `max`,
												COUNT(`price`) AS `count`
											FROM
												`z_marketlog`
											WHERE `typeID` = '".$typeID."'
											AND `price`
											".$and."
											GROUP BY `typeID`
											ORDER BY `price` ASC;");
			if(count($stats) > 0) {
				foreach($stats as $v) {
					$result['avg'] = $v['avg'];
					$result['stddev'] = $v['stddev'];
					$result['min'] = $v['min'];
					$result['max'] = $v['max'];
					$result['count'] = $v['count'];
				}
			}

			$realaverage = mysql_fetch_all_assoc("	SELECT
														`price`,
														`volRemaining`
													FROM
														`z_marketlog`
													WHERE `typeID` = '".$typeID."'
													".$and.";");
			if(count($realaverage) > 0) {			
				foreach($realaverage as $v) {
					$newarr[$v['price']] += $v['volRemaining'];
				}
				$result['ravg'] = realAverage($newarr);
			} else {
				$result['ravg'] = 0;
			}

			return $result;
		}
	}

	function set_stats($arr) {
		if(is_numeric($arr['typeID']) && is_numeric($arr['lower']) && is_numeric($arr['median']) && is_numeric($arr['upper']) && is_numeric($arr['avg']) && is_numeric($arr['ravg']) && is_numeric($arr['stddev']) && is_numeric($arr['min']) && is_numeric($arr['max']) && is_numeric($arr['count'])) {
			mysql_query("UPDATE `z_pricing` SET
							`dLowerQuartile` = '".$arr['lower']."',
							`dMedian` = '".$arr['median']."',
							`dUpperQuartile` = '".$arr['upper']."',
							`dAverage` = '".$arr['avg']."',
							`dRealAverage` = '".$arr['ravg']."',
							`dStandardDeviation` = '".$arr['stddev']."',
							`dMinimum` = '".$arr['min']."',
							`dMaximum` = '".$arr['max']."',
							`iCount` = '".$arr['count']."',
							`iTimestamp` = UNIX_TIMESTAMP()
						WHERE `typeID` = '".$arr['typeID']."';");
		}
	}
}
?>