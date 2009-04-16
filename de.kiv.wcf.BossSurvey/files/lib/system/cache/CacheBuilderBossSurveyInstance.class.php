<?php
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

class CacheBuilderBossSurveyInstance implements CacheBuilder {
	/**
	* @see CacheBuilder :: getData ()
	*/
	public function getData($cacheResource) {
		$data = array();
		
		$sql = "SELECT * 
				FROM wcf".WCF_N."_bosssurvey_instances
				WHERE (bsi_view = 1)
				ORDER BY bsi_order ASC";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$data[] = $row;
		}
				
		return $data;
	}
}
?>