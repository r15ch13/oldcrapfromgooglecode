<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.1
*/

require_once("class.Type.php");

/**
 * the MarketGroup Class
 */
class MarketGroup {
	/**
     * the DatabaseId of the marketgroup.
	 *
     * @var integer
     * @access private
     */
	private $_dbid;

	/**
	 * the name of the marketgroup.
	 *
	 * @var string
     * @access private
     */
	private $_name;

	/**
     * sets the DatabaseId
	 *
	 * @param integer $databaseid the databaseid of the marketgroup
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
		$result = mysql_query("SELECT `marketGroupName` FROM `invMarketGroups` WHERE `marketGroupID` = '" . $this->DatabaseId() . "';");
		$result = mysql_fetch_object($result);
		$this->_name = $result->marketGroupName;
		return $this->_name;
	}

	/**
	 * returns all types as object of the marketgroup
	 *
	 * @access public
	 * @return array
	 */
	public function Types() {
		$result = mysql_query("SELECT `typeID` FROM `invTypes` WHERE `marketGroupID` = '" . $this->DatabaseId() . "' AND `typeName` NOT LIKE 'Compressed %' ORDER BY `typeID`;");
		while ($row = mysql_fetch_object($result)) {
			$types[] = new Type($row->typeID);
		}
		return $types;
	}

	/**
	 * returns the timestamp of the last update
	 *
	 * @access public
	 * @return integer
	 */
	public function LastUpdate() {
		$result = mysql_query("SELECT `iTimestamp` FROM `z_pricing` WHERE `marketGroupID` = '" . $this->DatabaseId() . "' ORDER BY `iTimestamp` DESC LIMIT 1;");
		while ($row = mysql_fetch_object($result)) {
			$timestamp = $row->iTimestamp;
		}
		return $timestamp;
	}

	/**
	 * returns the timestamp of the last updated marketgroup
	 *
	 * @access public
	 * @static
	 * @return integer
	 */
	public static function OverallLastUpdate() {
		$result = mysql_query("SELECT `iTimestamp` FROM `z_pricing` ORDER BY `iTimestamp` DESC LIMIT 1;");
		while ($row = mysql_fetch_object($result)) {
			$timestamp = $row->iTimestamp;
		}
		return $timestamp;
	}

	/**
	 * creates an object of each marketgroup an return them in an array
	 *
	 * @access public
	 * @static
	 * @return array
	 */
	public static function GetAllGroups() {
		$result = mysql_query("SELECT `marketGroupID` FROM `z_pricing` GROUP BY `marketGroupID` ORDER BY `marketGroupID` ASC;");
		while ($row = mysql_fetch_object($result)) {
			$marketgroups[] = new MarketGroup($row->marketGroupID);
		}
		return $marketgroups;
	}

	/**
	 * returns all marketgroups and types as xml
	 *
	 * @access public
	 * @static
	 * @return string
	 */
	public static function XmlExport() {
		$xml = '<?xml version="1.0" encoding="utf-8" standalone="yes"?>'."\n";
		$xml.= '<data>'."\n";
		foreach(MarketGroup::GetAllGroups() as $group) {
			$xml.= "\t".'<marketgroup id="'.$group->DatabaseId().'" name="'.$group->Name().'" lastupdate="'.$group->LastUpdate().'">'."\n";
				foreach($group->Types() as $type) {
					$xml.= "\t\t";
					$xml.= '<type id="'.$type->DatabaseId().'" name="'.$type->Name().'" price="'.$type->Price().'" lowerquartile="'.$type->LowerQuartile().'" median="'.$type->Median().'" upperquartile="'.$type->UpperQuartile().'" average="'.$type->Average().'" realaverage="'.$type->RealAverage().'" standarddeviation="'.$type->StandardDeviation().'" minimum="'.$type->Minimum().'" maximum="'.$type->Maximum().'" lastupdate="'.$type->Timestamp().'" icon="'.$type->Icon().'" />';
					$xml.= "\n";
			}
			$xml.= "\t".'</marketgroup>'."\n";
		}
		$xml.= '</data>'."\n";
		return $xml;
	}

}
?>