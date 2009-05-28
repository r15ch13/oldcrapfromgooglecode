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
		WCF::getTPL()->append('specialStyles', '<link rel="stylesheet" type="text/css" media="screen" href="'.RELATIVE_WCF_DIR.'style/WolframAlpha.css" />');
	}
}
?>