<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.2
*/

require_once("class.MarketGroup.php");

/**
 * The Type Class
 */
class Type {
	/**
     * the DatabaseId of the type
	 *
     * @var integer
     * @access private
     */
	private $_dbid = 0;

	/**
     * the Name of the type
	 *
     * @var string
     * @access private
     */
	private $_name = '';

	/**
     * all Type informations
	 *
     * @var array
     * @access private
     */
	private $_data = array();

	/**
     * the marketgroupid of the type
	 *
     * @var integer
     * @access private
     */
	private $_marketgroup = 0;

	/**
     * the price
	 *
     * @var double
     * @access private
     */
	private $_price = 0;

	/**
     * the lower quartile
	 *
     * @var double
     * @access private
     */
	private $_lowerquartile = 0;

	/**
     * the median
	 *
     * @var double
     * @access private
     */
	private $_median = 0;

	/**
     * the upper quartile
	 *
     * @var double
     * @access private
     */
	private $_upperquartile = 0;

	/**
     * the average price
	 *
     * @var double
     * @access private
     */
	private $_average = 0;

	/**
     * the real average price
	 *
     * @var double
     * @access private
     */
	private $_realaverage = 0;

	/**
     * the standard deviation
	 *
     * @var double
     * @access private
     */
	private $_standarddeviation = 0;

	/**
     * the minimum price
	 *
     * @var double
     * @access private
     */
	private $_minimum = 0;

	/**
     * the maximum price
	 *
     * @var double
     * @access private
     */
	private $_maximum = 0;

	/**
     * the custom minimum set by the user
	 *
     * @var double
     * @access private
     */
	private $_customminimum = 0;

	/**
     * the custom maximum set by the user
	 *
     * @var double
     * @access private
     */
	private $_custommaximum = 0;

	/**
     * the count of all data used for price calculation
	 *
     * @var integer
     * @access private
     */
	private $_count = 0;

	/**
     * the lastupdate timestamp
	 *
     * @var integer
     * @access private
     */
	private $_timestamp = 0;

	/**
     * the icon name
	 *
     * @var string
     * @access private
     */
	private $_icon = '';

	/**
	 * price stats
	 *
	 * @var array
	 * @access private
	 */
	private $_stats = array();

	/**
     * sets the DatabaseId
	 *
	 * @param integer $databaseid the databaseid of the type
	 * @access public
	 */
	public function __construct($databaseid) {
		$this->_dbid = mysql_real_escape_string($databaseid);
	}

	/**
	 * returns the DatabaseId
	 *
	 * @access public
	 * @return integer
	 */
	public function DatabaseId() {
		return $this->_dbid;
	}

	/**
	 * returns the Name
	 *
	 * @access public
	 * @return string
	 */
	public function Name() {
		if(empty($this->_name)) {
			$result = mysql_query("SELECT `typeName` FROM `invTypes` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_name = $result->typeName;
		}
		return $this->_name;
	}

	/**
	 * returns the marketgroup as object
	 *
	 * @access public
	 * @return object of MarketGroup
	 */
	public function MarketGroup() {
		if(empty($this->_marketgroup)) {
			$result = mysql_query("SELECT `marketGroupID` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_marketgroup = new MarketGroup($result->marketGroupID);
		}
		return $this->_marketgroup;
	}

	/**
	 * gets or sets the price
	 *
	 * @param doube $value if isset the value will be put into database
	 * @access public
	 * @return double
	 */
	public function Price($value = false) {
		if($value == false) {
			$result = mysql_query("SELECT `dPrice` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_price = $result->dPrice;
			return $this->_price;
		} else {
			if($value <> $this->Price() && is_numeric($value)) {
				mysql_query("UPDATE `z_pricing` SET `dPrice` = '" . mysql_real_escape_string($value) . "', `iTimestamp` = UNIX_TIMESTAMP() WHERE `typeID` = '" . $this->DatabaseId() . "';");
				mysql_query("INSERT INTO `z_stats` VALUES ('', '" . $this->DatabaseId() . "', '" . mysql_real_escape_string($value) . "', UNIX_TIMESTAMP());");
				$this->_price = $value;
			}
		}
	}

	/**
	 * returns the lower quartile
	 *
	 * @access public
	 * @return double
	 */
	public function LowerQuartile() {
		if(empty($this->_lowerquartile)) {
			$result = mysql_query("SELECT `dLowerQuartile` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_lowerquartile = $result->dLowerQuartile;
		}
		return $this->_lowerquartile;
	}


	/**
	 * returns the median
	 *
	 * @access public
	 * @return double
	 */
	public function Median() {
		if(empty($this->_median)) {
			$result = mysql_query("SELECT `dMedian` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_median = $result->dMedian;
		}
		return $this->_median;
	}

	/**
	 * returns the upper quartile
	 *
	 * @access public
	 * @return double
	 */
	public function UpperQuartile() {
		if(empty($this->_upperquartile)) {
			$result = mysql_query("SELECT `dUpperQuartile` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_upperquartile = $result->dUpperQuartile;
		}
		return $this->_upperquartile;
	}

	/**
	 * returns the average price
	 *
	 * @access public
	 * @return double
	 */
	public function Average() {
		if(empty($this->_average)) {
			$result = mysql_query("SELECT `dAverage` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_average = $result->dAverage;
		}
		return $this->_average;
	}

	/**
	 * returns the real average price
	 *
	 * @access public
	 * @return double
	 */
	public function RealAverage() {
		if(empty($this->_realaverage)) {
			$result = mysql_query("SELECT `dRealAverage` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_realaverage = $result->dRealAverage;
		}
		return $this->_realaverage;
	}

	/**
	 * returns the standard deviation
	 *
	 * @access public
	 * @return double
	 */
	public function StandardDeviation() {
		if(empty($this->_standarddeviation)) {
			$result = mysql_query("SELECT `dStandardDeviation` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_standarddeviation = $result->dStandardDeviation;
		}
		return $this->_standarddeviation;
	}

	/**
	 * returns the minimum price
	 *
	 * @access public
	 * @return double
	 */
	public function Minimum() {
		if(empty($this->_minimum)) {
			$result = mysql_query("SELECT `dMinimum` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_minimum = $result->dMinimum;
		}
		return $this->_minimum;
	}

	/**
	 * returns the maximum price
	 *
	 * @access public
	 * @return double
	 */
	public function Maximum() {
		if(empty($this->_maximum)) {
			$result = mysql_query("SELECT `dMaximum` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_maximum = $result->dMaximum;
		}
		return $this->_maximum;
	}

	/**
	 * gets or sets the custom minimum price
	 *
	 * @param double $value if isset the value will be put into database
	 * @access public
	 * @return double
	 */
	public function CustomMinimum($value = 'false') {
		if($value == 'false') {
			$result = mysql_query("SELECT `dCustomMinimum` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_customminimum = $result->dCustomMinimum;
			return $this->_customminimum;
		} else {
			if($value <> $this->CustomMinimum() && is_numeric($value)) {
				mysql_query("UPDATE `z_pricing` SET `dCustomMinimum` = '" . mysql_real_escape_string($value) . "', `iTimestamp` = UNIX_TIMESTAMP() WHERE `typeID` = '" . $this->DatabaseId() . "';");
				$this->_customminimum = $value;
			}
		}
	}

	/**
	 * gets or sets the custom maximum price
	 *
	 * @param double $value if isset the value will be put into database
	 * @access public
	 * @return double
	 */
	public function CustomMaximum($value = 'false') {
		if($value == 'false') {
			$result = mysql_query("SELECT `dCustomMaximum` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_custommaximum = $result->dCustomMaximum;
			return $this->_custommaximum;
		} else {
			if($value <> $this->CustomMaximum() && is_numeric($value)) {
				mysql_query("UPDATE `z_pricing` SET `dCustomMaximum` = '" . mysql_real_escape_string($value) . "', `iTimestamp` = UNIX_TIMESTAMP() WHERE `typeID` = '" . $this->DatabaseId() . "';");
				$this->_custommaximum = $value;
			}
		}
	}

	/**
	 * returns the count of all data used for calculation
	 *
	 * @access public
	 * @return integer
	 */
	public function Count() {
		if(empty($this->_count)) {
			$result = mysql_query("SELECT `iCount` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
			$result = mysql_fetch_object($result);
			$this->_count = $result->iCount;
		}
		return $this->_count;
	}

	/**
	 * gets or sets the lastupdate timestamp
	 *
	 * @param integer $value if isset the value will be put into database
	 * @access public
	 * @return integer
	 */
	public function Timestamp($value = false) {
		if($value == false) {
				if(empty($this->_timestamp)) {
				$result = mysql_query("SELECT `iTimestamp` FROM `z_pricing` WHERE `typeID` = '" . $this->DatabaseId() . "';");
				$result = mysql_fetch_object($result);
				$this->_timestamp = $result->iTimestamp;
			}
			return $this->_timestamp;
		} else {
			if($value <> $this->Timestamp() && is_numeric($value)) {
				mysql_query("UPDATE `z_pricing` SET `iTimestamp` = '" . mysql_real_escape_string($value) . "' WHERE `typeID` = '" . $this->DatabaseId() . "';");
				$this->_timestamp = $value;
			}
		}
	}

	/**
	 * gets the icon name
	 *
	 * @access public
	 * @return string
	 */
	public function Icon() {
		if(empty($this->_icon)) {
			$result = mysql_query("SELECT `icon` FROM `eveGraphics` WHERE `graphicID` = (SELECT `graphicID` FROM `invTypes` WHERE `typeID` = '" . $this->DatabaseId() . "');");
			$result = mysql_fetch_object($result);
			$this->_icon = $result->icon;
		}
		return $this->_icon;
	}

	/**
	 * gets the last 20 price changes
	 *
	 * @access public
	 * @return array
	 */
	public function Stats() {
		if(empty($this->_stats)) {
			$result = mysql_query("SELECT `dPrice`, `iTimestamp` FROM `z_stats` WHERE `typeID` = '" . $this->DatabaseId() . "' AND `iTimestamp` > (UNIX_TIMESTAMP() - 2592000) ORDER BY `iTimestamp` ASC LIMIT 15;");
			while ($row = mysql_fetch_object($result)) {
				$tmp['price'] = $row->dPrice;
				//$tmp['timestamp'] = $row->iTimestamp;
				$this->_stats[] = $tmp;
			}
		}
		return $this->_stats;
	}

	/**
	 * returns all data of this class as one array
	 *
	 * @access public
	 * @return array
	 */
 	public function Data() {
		$this->_data['Name'] 				= $this->Name();
		$this->_data['Price'] 				= $this->Price();
		$this->_data['MarketGroup'] 		= $this->MarketGroup();
		$this->_data['LowerQuartile'] 		= $this->LowerQuartile();
		$this->_data['Median'] 				= $this->Median();
		$this->_data['UpperQuartile'] 		= $this->UpperQuartile();
		$this->_data['Average'] 			= $this->Average();
		$this->_data['RealAverage'] 		= $this->RealAverage();
		$this->_data['StandardDeviation'] 	= $this->StandardDeviation();
		$this->_data['Minimum'] 			= $this->Minimum();
		$this->_data['Maximum'] 			= $this->Maximum();
		$this->_data['GetCustomMinimum'] 	= $this->GetCustomMinimum();
		$this->_data['GetCustomMaximum'] 	= $this->GetCustomMaximum();
		$this->_data['Count'] 				= $this->Count();
		$this->_data['Timestamp'] 			= $this->Timestamp();
		$this->_data['Icon'] 				= $this->Icon();
		return $this->_data;
	}

	/**
	 * returns a chart of the last 15 price changes
	 *
	 * @access public
	 * @return string
	 */
	public function PriceChart($html = false) {
		$graph = '';
		$price = array();
		//$x = '';
		$c = count($this->Stats());

		foreach($this->Stats() as $v) {
			$graph .= $v['price'];
			$price[] = $v['price'];
			$c--;

			//$x .= date('d.', $v['timestamp']);
			if($c != 0) {
				$graph .= ',';
				//$x .= '|';
			}
		}

		$min = !empty($price) ? min($price): 0;
		$max = !empty($price) ? max($price): 0;
		$med = median($price, true);
		$img  = 'http://chart.apis.google.com/chart?';
		$img .= '&cht=lc';
		$img .= '&chd=t:'. $graph;
		$img .= '&chco=329600';
		$img .= '&chs=500x200';
		$img .= '&chxt=x,y';
		$img .= '&chds='. $min .','. $max;
		$img .= '&chxl=0:|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|1:|'. $min .'|'. $med .'|'. $max;
		$img .= '&chg='. round(100 / ($c - 1), 2) .',10,1,4';
		$img .= '&chtt='. $this->Name() .':+'. $this->Price();
		if($html == false) {
			return $img;
		} else {
			return '<img src="'. $img .'" alt="'. $this->Name() .'" title="the last 15 price changes for '. $this->Name() .'" />';
		}
	}
}
?>