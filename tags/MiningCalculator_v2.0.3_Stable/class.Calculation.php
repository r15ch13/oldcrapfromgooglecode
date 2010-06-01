<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0
*/

require_once("class.Type.php");

/**
 * A small calculation Class
 */
class Calculation {
	/**
     * the Id of type to calculate
	 *
     * @var integer
     * @access private
     */
	private $_type;

	/**
     * the Qunatity of type to calculate
	 *
     * @var integer
     * @access private
     */
	private $_quantity;


	/**
     * Sets the type and the quantity
	 *
     * @param integer $typeid the Id of type to calculate
	 * @param integer $quantity the Qunatity of type to calculate
     * @access private
     */
	public function __construct($typeid, $quantity) {
		$this->_type = new Type($typeid);
		if(is_numeric($quantity)) {
			$this->_quantity = ($quantity);
		}
	}

	/**
	 * returns the Object of Type
	 *
	 * @access public
	 * @return object
	 * @see Type
	 */
	public function Type() {
		return $this->_type;
	}

	/**
	 * returns the quantitiy
	 *
	 * @param boolean $tostring true to return quantity as formated number
	 * @access public
	 * @return integer
	 */
	public function Quantity($tostring = false) {
		if($tostring == true) {
			return number_format($this->_quantity);
		} else {
			return $this->_quantity;
		}
	}

	/**
	 * returns the calculated price
	 *
	 * @param boolean $tostring true to return price as formated number
	 * @access public
	 * @return integer
	 */
	public function Price($tostring = false) {
		if($tostring == true) {
			return number_format($this->Type()->Price() * $this->Quantity(), 2);
		} else {
			return $this->Type()->Price() * $this->Quantity();
		}
	}
}
?>