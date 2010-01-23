<?php
require_once(WCF_DIR.'lib/system/cache/CacheBuilder.class.php');

class CacheBuilderWGROptions implements CacheBuilder {
	/**
	* @see CacheBuilder :: getData ()
	*/
	public function getData($cacheResource) {
		$data = array();
		
		$sql = "SELECT
					`option_name`,
					`option_color`,
					`option_onoff`
				FROM `wcf".WCF_N."_portal_wgr_options`;";
		$result = WCF::getDB()->sendQuery($sql);
		while ($row = WCF::getDB()->fetchArray($result)) {
			$data[] = $row;
		}
				
		return $data;
	}
}
?>