<?php

class WGRBox {
	protected $wgrList = array();

	public function __construct($data, $boxname = "") {
		$this->wgrList['templatename'] = "wgrBox";
		$this->getBoxStatus($data);
		$this->wgrList['boxID'] = $data['boxID'];
		$this->wgrList['debug'] = false;
		
		
		// read cache
		WCF::getCache()->addResource('wgrOptions', WBB_DIR.'cache/cache.wgrOptions.php', WBB_DIR.'lib/system/cache/CacheBuilderWGROptions.class.php');
		WCF::getCache()->addResource('wgrClasses', WBB_DIR.'cache/cache.wgrClasses.php', WBB_DIR.'lib/system/cache/CacheBuilderWGRClasses.class.php');
		
		$this->optionsCache = WCF::getCache()->get('wgrOptions');
		$this->classesCache = WCF::getCache()->get('wgrClasses');
		
		$this->readOptions();
		$this->readClasses();
		$this->wgrList['options'] = $this->options;
		$this->wgrList['classes'] = $this->classes;

		foreach($this->classes as $value) {
			$check[] = $value['class_onoff_1'];
			$check[].= $value['class_onoff_2'];
			$check[].= $value['class_onoff_3'];
		}
		$this->wgrList['activ'] = in_array(1, $check) ? true : false;
		
	}
	
	// reads options
	protected function readOptions() {
		foreach ($this->optionsCache as $optionsData) {
			$this->options[$optionsData['option_name']] = $optionsData;			
		}
	}
	
	// reads classes
	protected function readClasses() {
		foreach ($this->classesCache as $classesData) {
			$this->classes[] = $classesData;
		}
	}
		
	protected function getBoxStatus($data) {
		$this->wgrList['Status'] = 1;
		if (WBBCore::getUser()->userID) {
			$this->wgrList['Status'] = intval(WBBCore::getUser()->wgrbox);
		}
		else {
			if (WBBCore::getSession()->getVar('wgrbox') != false) {
				$this->wgrList['Status'] = WBBCore::getSession()->getVar('wgrbox');
			}
		}
	}

 	public function getData() {
		return $this->wgrList;
	}
 }

?>