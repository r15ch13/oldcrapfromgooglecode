<?php
require_once (WCF_DIR . 'lib/data/message/bbcode/BBCodeParser.class.php');
require_once (WCF_DIR . 'lib/data/message/bbcode/BBCode.class.php');

/**
 * Parses the [arlvl] bbcode tag.
 *
 * @author	r15ch13
 * @package	de.r15ch13.wcf.data.message.bbcode.airrivalslevelbar
 */
class AirRivalsLevelBarBBCode implements BBCode {
	protected $level = '';
	protected $prozent = '';

	/**
	 * Gibt eine Art Ladebalken bis zum naechsten LevelUp aus. (69 IIIIIIIIIIIIIIIIIIII 70)
	 * 
	 * @author r15ch13
	 * @access public
	 * @param integer $level Aktuelles Level
	 * @param integer $prozent Prozent bis LevelUp (ohne %)
	 * @return string
	 */
	public function AirRivalsLvl($level, $prozent) {
		if($prozent >= 0 AND $prozent <= 99 AND $level >= 0 AND $level <= 99){
			$tmp = $level.' <span style="color: green;">';
			$i = 0;
			while($i < 100) {
				if($i == $prozent) {
					$tmp .='</span><span style="color: red;">';
				}
				if($i == 10 OR $i == 20 OR $i == 30 OR $i == 40 OR $i == 50 OR $i == 60 OR $i == 70 OR $i == 80 OR $i == 90) {
					$tmp .= ' I';
				} else {
					$tmp .= 'I';
				}
				$i++;
			}
			$tmp .= '</span> '.($level + 1);
			return $tmp;
		}
	}
	
	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		if ($parser->getOutputType() == 'text/html') {
			// show template
			if (is_numeric($openingTag['attributes'][0])) {
				$level = $openingTag['attributes'][0];
			}
			if (is_numeric($content)) {
				$prozent = $content;
			}
			
			WCF::getTPL()->assign(array(
					'content'=>(AirRivalsLvl($level, $prozent))
			));
			return WCF::getTPL()->fetch('AirRivalsLevelBarBBCodeTag');
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $content;
		}
	}
	
	
}
?>