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
			if(preg_match('#^http://(www|de|es|fr|ru).wowhead.com/(?:|\?)(item|quest|spell|achievement|npc|object)=(\d+)$#', trim($content), $data)) {
				/**
				 * $data[0] = URL
				 * $data[1] = Language
				 * $data[2] = Type
				 * $data[3] = ID
				 * $data[4] = Quality
				 * $data[5] = Name
				 */


				// get the Tooltip to extract quality and name
				$xml = file_get_contents($data[0] . "&power");

				// get quality
				$quality = '';
				if(preg_match('#quality: (\d),#', $xml, $tmp)) {
					$quality = StringUtil::encodeHtml($tmp[1]);
				}
				if($data[2] == 'spell') $quality = '';

				// get name
				$name = $data[2].' #'.$data[3];
				$lang = $data[1] != 'www' ? $data[1].$data[1] : 'enus';
				
				if(preg_match('#name_'.$lang.": '(.*)',#", $xml, $tmp)) {
					$tmp = htmlentities($tmp[1], ENT_QUOTES, 'UTF-8');
					$name = stripslashes($tmp);
				}

				// build hyperlink
				return '<a href="'. $data[0] .'" class="q'. $quality .'">['. $name .']</a>';

			} elseif(preg_match('#/script DEFAULT_CHAT_FRAME:AddMessage\("124cff([a-fA-F0-9]{6})124H(item|quest|spell|achievement|npc|object):(\d+).*124h\[(.*)\]124h124r"\);#', $content, $data)) {
				/**
				 * $data[0] = Input
				 * $data[1] = Quality Color
				 * $data[2] = Type
				 * $data[3] = ID
				 * $data[4] = Name
				 */

				// set link language
				$lang = 'www';
				if(isset($openingTag['attributes'][0])) {
					$lang = $openingTag['attributes'][0];
					if(!in_array($lang, array('de','es','fr','ru'))) $lang = 'www';
				}

				// get quality
				$color = $this->wow_quality_color($data[1]);

				// build hyperlink
				return '<a href="http://'. $lang .'.wowhead.com/'. $data[2] .'='. $data[3] .'" class="q'. $color .'">['. $data[4] .']</a>';

			} else {
				return '[wow]Error![/wow]';
			}
		}
	}

	private function wow_quality_color($var) {
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
}
?>
