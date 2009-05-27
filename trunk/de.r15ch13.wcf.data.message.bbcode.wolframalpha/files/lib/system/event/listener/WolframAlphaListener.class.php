<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

/**
 *
 * @author	r15ch13
 * @package	de.r15ch13.wcf.data.message.bbcode.wolframalpha
 */
class WolframAlphaListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
		WCF::getTPL()->append('userMessages', "<style type=\"text/css\">\n
\t.wolframalpha {background-image: url('".RELATIVE_WCF_DIR."icon/WolframAlphaEqualOff.png');background-position: center right;background-repeat: no-repeat;margin-right: 3px;padding-right: 15px;}\n
\t.wolframalpha:hover {background-image: url('".RELATIVE_WCF_DIR."icon/WolframAlphaEqual.png');background-position: center right;background-repeat: no-repeat;}\n
</style>\n");
	}
}
?>