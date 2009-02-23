<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

class abloadListener implements EventListener {
	/**
	 * @see EventListener::execute()
	 */
	public function execute($eventObj, $className, $eventName) {
WCF::getTPL()->append(array(
				'additionalTabs' => '<li id="abloadTab"><a onclick="tabbedPane.openTab(\'abload\');"><span>'.WCF::getLanguage()->get('wcf.abload.title').'</span></a></li>',
				'additionalSubTabs' => WCF::getTPL()->fetch('abload')
			));

	}
}
?>