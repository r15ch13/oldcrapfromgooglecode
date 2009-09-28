<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

class AionDatabaseListener implements EventListener {

 /**
     * @see EventListener::execute()
     */
    public function execute($eventObj, $className, $eventName) {
		   WCF::getTPL()->append('userMessages', '<script type="text/javascript" src="http://www.aiondatabase.com/js/exsyndication.js"></script>');
    }
}
?>