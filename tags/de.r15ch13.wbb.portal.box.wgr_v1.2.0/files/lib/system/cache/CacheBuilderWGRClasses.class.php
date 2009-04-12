<?php
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

class CacheBuilderWGRClasses implements CacheBuilder {
	/**
	* @see CacheBuilder :: getData ()
	*/
	public function getData($cacheResource) {
		$data = array();
		
		$sql = "SELECT
					`class_name`,
					`class_short`,
					`class_color`,
					`class_onoff_1`,
					`class_onoff_2`,
					`class_onoff_3`,
					`class_skill_1`,
					`class_skill_2`,
					`class_skill_3`
				FROM `wcf".WCF_N."_portal_wgr_classes`";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$data[] = $row;
		}
				
		return $data;
	}
}
?>