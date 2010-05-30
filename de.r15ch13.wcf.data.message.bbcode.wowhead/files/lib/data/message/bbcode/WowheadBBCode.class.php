<?php
require_once(WCF_DIR.'lib/data/message/bbcode/BBCodeParser.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/BBCode.class.php');

class WowheadBBCode implements BBCode {
	protected $url = '';
	protected $defaultlang = 'en';

	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		$content = trim($content);
		$content = stripslashes($content);

		if(!empty($content)) {
			if(preg_match('#^http://(www|de|es|fr|ru).wowhead.com/(?:|\?)(item|quest|spell|achievement|npc|object)=(\d+)$#', trim($content), $tmp)) {
				/**
				 * $tmp[0] = URL
				 * $tmp[1] = Language
				 * $tmp[2] = Type
				 * $tmp[3] = ID
				 * $tmp[4] = Quality
				 * $tmp[5] = Name
				 */

				if(isset($tmp[1]) && isset($tmp[2]) && isset($tmp[3])) {
					$data = $this->get_data($tmp[1], $tmp[2], $tmp[3]);

					// build hyperlink
					return '<a href="http://'.$tmp[1].'.wowhead.com/'.$tmp[2].'='.$tmp[3].'" class="q'. $data['quality'] .'">['. $data['name'] .']</a>';
				} else {
					return '[wow]Error![/wow]';
				}

			} elseif(preg_match('#/script DEFAULT_CHAT_FRAME:AddMessage\("124cff([a-fA-F0-9]{6})124H(item|quest|spell|achievement|npc|object):(\d+).*124h\[(.*)\]124h124r"\);#', $content, $tmp)) {
				/**
				 * $tmp[0] = Input
				 * $tmp[1] = Quality Color
				 * $tmp[2] = Type
				 * $tmp[3] = ID
				 * $tmp[4] = Name
				 */

				// set link language
				$lang = 'www';
				if(isset($openingTag['attributes'][0]) && $this->is_lang($openingTag['attributes'][0])) {
					$lang = $openingTag['attributes'][0];
				}


				if(isset($tmp[2]) && isset($tmp[3])) {
					$data = $this->get_data($lang, $tmp[2], $tmp[3]);

					// build hyperlink
					return '<a href="http://'.$lang.'.wowhead.com/'.$tmp[2].'='.$tmp[3].'" class="q'. $data['quality'] .'">['. $data['name'] .']</a>';
				}
				return '[wow]Error![/wow]';

			} else {
				return '[wow]Error![/wow]';
			}
		}
	}

	/**
	 * loads the name and quality from wowhead.com
	 */
	private function get_data(&$lang, &$type, &$id) {
		$data = array();
		$data['quality'] = '';
		$data['name'] = '';

		if(is_string($lang) && $this->is_type($type) && is_numeric($id)) {

			// set link language
			if(!$this->is_lang($lang)) $lang = 'www';

			// load item info
			$xml = file_get_contents('http://'.$lang.'.wowhead.com/'.$type.'='.$id.'&power');

			// get quality
			if($type != 'spell') {
				if(preg_match('#quality: (\d),#', $xml, $tmp)) {
					if(isset($tmp[1])) $data['quality'] = StringUtil::encodeHtml($tmp[1]);
				}
			} else {
				$data['quality'] = '9';
			}

			// get name
			$data['name'] = $type.' #'.$id;
			$matchlang = $lang != 'www' ? $lang.$lang : 'enus';

			if(preg_match('#name_'.$matchlang.": '(.*)',#", $xml, $tmp)) {
				if(isset($tmp[1])) {
					$tmp = htmlentities($tmp[1], ENT_QUOTES, 'UTF-8');
					$data['name'] = stripslashes($tmp);
				}
			}
		}
		return $data;
	}

	/**
	 * is $lang a supported wowhead language?
	 */
	private function is_lang(&$lang) {
		if(in_array($lang, array('de','es','fr','ru'))) return true;
		return false;
	}

	/**
	 * is $type a supported wowhead type?
	 */
	private function is_type(&$type) {
		if(in_array($type, array('item','quest','spell','achievement','npc','object'))) return true;
		return false;
	}

	/**
	 * returns the wow quality based on given hexcolor
	 */
	/*
	private function get_quality_from_color($var) {
		$var = strToLower($var);
		$colors = array(
			'9d9d9d', '9d9d9d' => '0', // Poor
			'ffffff', 'ffffff' => '1', // Common
			'1eff00', '1eff00' => '2', // Uncommon
			'0070dd', '0070dd' => '3', // Rare
			'a335ee', 'a335ee' => '4', // Epic
			'ff8000', 'ff8000' => '5', // Legendary
			'e6cc80', 'e6cc80' => '6', // Artifact
			'e6cc80', 'e6cc80' => '7', // Heirloom
			'ffff98', 'ffff98' => '8',
			'71d5ff', '71d5ff' => '9',
			'ff0000', 'ff0000' => '10'
		);
		if(isset($colors[$var])) return $colors[$var];
		return '';
	}
	//*/
}
?>
