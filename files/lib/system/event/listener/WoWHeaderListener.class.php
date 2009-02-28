<?php
require_once(WCF_DIR.'lib/system/event/EventListener.class.php');

class WoWHeaderListener implements EventListener {

 /**
     * @see EventListener::execute()
     */
    public function execute($eventObj, $className, $eventName) {
           WCF::getTPL()->append('userMessages', "<script type=\"text/javascript\" src=\"http://www.wowhead.com/widgets/power.js\"></script>");
    }
}
?>