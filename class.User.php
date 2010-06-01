<?php
/**
 * @package  [Argon] Corp. Mineral Calculation
 * @author   Richard Kuhnt <r15ch13@gmx.de>
 * @license  http://creativecommons.org/licenses/by-sa/3.0/de/deed.de	Creative Commons <by-sa>
 * @version  1.0.1
*/

require_once("config.php");

/*
$user = new User();
if($user->Login('r15ch13', 'asd')) {
	echo "true";
} else {
	echo "false";
}
*/

class User {
	private $name = '';
	private $salt = '';
	private $pass = '';

	public function Login($username, $password) {
		if($this->isAvailableUsername($username)) {
			$this->name = $username;
			$this->pass = $this->getPass();
			$this->salt = $this->getSalt();
			if($this->checkPassword($password) && $this->hasRights()) {
				return true;
			}
		}
	}

	private function isAvailableUsername($name) {
		$result = mysql_query("SELECT COUNT(username) AS count FROM wcf1_user WHERE username = '" . mysql_real_escape_string($name) . "';");
		$result = mysql_fetch_array($result);
		if($result['count'] > 0) {
			return true;
		}
	}

	private function getSalt(){
		$result = mysql_query("SELECT salt FROM wcf1_user WHERE username = '" . mysql_real_escape_string($this->name) . "';");
		$result = mysql_fetch_assoc($result);
		return $result['salt'];
	}

	private function getPass(){
		$result = mysql_query("SELECT password FROM wcf1_user WHERE username = '" . mysql_real_escape_string($this->name) . "';");
		$result = mysql_fetch_assoc($result);
		return $result['password'];
	}

	private function hasRights() {
		if (defined('WBB3_USER_GROUP')) {
			$result = mysql_query("SELECT COUNT(groupID) as count FROM wcf1_user_to_groups WHERE userID = (SELECT userID FROM wcf1_user WHERE username = '" . mysql_real_escape_string($this->name) . "') AND groupID = '" . mysql_real_escape_string(WBB3_USER_GROUP) . "';");
			$result = mysql_fetch_array($result);
			if($result['count'] > 0) {
				return true;
			}
		}
	}

	/**
	 * Returns true, if the given password is the correct password for this user.
	 *
	 * @param 	string		$password
	 * @return 	boolean 	password correct
	 */
	private function checkPassword($password) {
		return ($this->pass == self::getDoubleSaltedHash($password, $this->salt));
	}

	/**
	 * Returns a double salted hash of the given value.
	 *
	 * @param 	string 		$value
	 * @param	string		$salt
	 * @return 	string 		$hash
	 */
	private static function getDoubleSaltedHash($value, $salt) {
		return self::encrypt($salt . self::getSaltedHash($value, $salt));
	}

	/**
	 * Returns a salted hash of the given value.
	 *
	 * @param 	string 		$value
	 * @param	string		$salt
	 * @return 	string 		$hash
	 */
	private static function getSaltedHash($value, $salt) {
		if (!defined('WBB3_ENCRYPTION_ENABLE_SALTING') || WBB3_ENCRYPTION_ENABLE_SALTING) {
			$hash = '';
			// salt
			if (!defined('ENCRYPTION_SALT_POSITION') || WBB3_ENCRYPTION_SALT_POSITION == 'before') {
				$hash .= $salt;
			}

			// value
			if (!defined('WBB3_ENCRYPTION_ENCRYPT_BEFORE_SALTING') || WBB3_ENCRYPTION_ENCRYPT_BEFORE_SALTING) {
				$hash .= self::encrypt($value);
			}
			else {
				$hash .= $value;
			}

			// salt
			if (defined('WBB3_ENCRYPTION_SALT_POSITION') && WBB3_ENCRYPTION_SALT_POSITION == 'after') {
				$hash .= $salt;
			}

			return self::encrypt($hash);
		}
		else {
			return self::encrypt($value);
		}
	}

	/**
	 * encrypts the given value.
	 *
	 * @param 	string 		$value
	 * @return 	string 		$hash
	 */
	private static function encrypt($value) {
		if (defined('WBB3_ENCRYPTION_METHOD')) {
			switch (WBB3_ENCRYPTION_METHOD) {
				case 'sha1': return sha1($value);
				case 'md5': return md5($value);
				case 'crc32': return crc32($value);
				case 'crypt': return crypt($value);
			}
		}
		return sha1($value);
	}
}
?>