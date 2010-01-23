<?php
require_once (WCF_DIR . 'lib/data/message/bbcode/BBCodeParser.class.php');
require_once (WCF_DIR . 'lib/data/message/bbcode/BBCode.class.php');

/**
 * Parses the [wolframalpha] bbcode tag.
 *
 * @author	r15ch13
 * @package	de.r15ch13.wcf.data.message.bbcode.wolframalpha
 */
class WolframAlphaBBCode implements BBCode {
	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		if ($parser->getOutputType() == 'text/html') {
			// show template
			WCF::getTPL()->assign(array(
					'querystring'=>urlencode($content),
					'content'=>($content)
			));
			return WCF::getTPL()->fetch('WolframAlphaBBCodeTag');
		}
		else if ($parser->getOutputType() == 'text/plain') {
			return $content;
		}
	}
}
?>