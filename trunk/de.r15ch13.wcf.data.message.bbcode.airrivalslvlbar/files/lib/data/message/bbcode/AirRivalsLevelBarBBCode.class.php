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
	private function CurrentPercent($prozent) {
		if(is_numeric($prozent)) {
			$tmp = '';
			if($prozent >= 0 AND $prozent <= 99) {
					$i = 0;
					while($i < 100) {
						if($i < $prozent) {
							if($i == 10 OR $i == 20 OR $i == 30 OR $i == 40 OR $i == 50 OR $i == 60 OR $i == 70 OR $i == 80 OR $i == 90) {
								$tmp .= ' I';
							} else {
								$tmp .= 'I';
							}
						}
						$i++;
					}
					return $tmp;
			}
		}
	}
	
	private function NeededPercent($prozent) {
		if(is_numeric($prozent)) {
			$tmp = '';
			if($prozent >= 0 AND $prozent <= 99) {
				$i = 0;
				while($i < 100) {
					if($i >= $prozent) {
						if($i == 10 OR $i == 20 OR $i == 30 OR $i == 40 OR $i == 50 OR $i == 60 OR $i == 70 OR $i == 80 OR $i == 90) {
							$tmp .= ' I';
						} else {
							$tmp .= 'I';
						}
					}
					$i++;
				}
				return $tmp;
			}
		}
	}
	
	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		if ($parser->getOutputType() == 'text/html') {
			// show template
			if (!empty($openingTag['attributes'][0]) AND !empty($content)) {
				WCF::getTPL()->assign(array(
						'level'=>($content),
						'nextlevel'=>($content + 1),
						'currentpercent'=>($this->CurrentPercent($openingTag['attributes'][0])),
						'neededpercent'=>($this->NeededPercent($openingTag['attributes'][0]))
				));
				return WCF::getTPL()->fetch('AirRivalsLevelBarBBCodeTag');
			}			
		}
		#else if ($parser->getOutputType() == 'text/plain') {
		#	return $content;
		#}
	}
}
?>