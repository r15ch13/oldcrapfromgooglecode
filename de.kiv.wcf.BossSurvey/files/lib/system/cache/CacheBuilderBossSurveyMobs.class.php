<?php
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

class CacheBuilderBossSurveyMobs implements CacheBuilder {
	/**
	* @see CacheBuilder :: getData ()
	*/
	public function getData($cacheResource) {
		$data = array();
		
		$sql = "SELECT 
					*
				FROM wcf".WCF_N."_bosssurvey_mob
				ORDER BY bsm_order ASC";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$data[] = $row;
		}
				
		return $data;
	}
}
?>