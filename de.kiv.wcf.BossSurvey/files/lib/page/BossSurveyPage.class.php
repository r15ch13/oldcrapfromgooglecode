<?php
require_once(WCF_DIR.'lib/page/AbstractPage.class.php');

class BossSurveyPage extends AbstractPage{

	public $templateName = 'BossSurveyMain'; //mainpage
	public $instances = array();
	public $mobs = array();
	
	public $instanceCache = array();
	public $mobCache = array();
	
	public function readParameters() {
		parent::readParameters();
		
		//CACHE ANLEGEN
		WCF::getCache()->addResource('bsInstance',
			WCF_DIR.'cache/cache.bsInstance.php',
			WCF_DIR.'lib/system/cache/CacheBuilderBossSurveyInstance.class.php');
		WCF::getCache()->addResource('bsMobs',
			WCF_DIR.'cache/cache.bsInstance.php',
			WCF_DIR.'lib/system/cache/CacheBuilderBossSurveyMobs.class.php');
	}
	
	public function assignVariables() {
		parent::assignVariables();
		
			WCF::getTPL()->assign('TESTMSG', 'THIS IS A TEST!!');
			WCF::getTPL()->assign(array(
					'instances' => $this->instances,
					'mobs' => $this->mobs
			));
	}

	public function show() {
		require_once(WCF_DIR.'lib/page/util/menu/HeaderMenu.class.php');
		HeaderMenu::setActiveMenuItem('wbb.header.menu.BossSurvey');
	
		parent::show();
	}
	
	public function readData() {
		parent::readData();
		
		WCF::getCache()->clearResource('bsInstance');
		WCF::getCache()->clear(WCF_DIR . 'cache/', 'cache.bsInstance.php');
		
		WCF::getCache()->clearResource('bsMobs');
		WCF::getCache()->clear(WCF_DIR . 'cache/', 'cache.bsMobs.php');
		
		// Cache lesen
		$this->instanceCache = WCF::getCache()->get('bsInstance');
		$this->mobCache = WCF::getCache()->get('bsMobs');
		$this->readInstances();
		$this->readMobs();
	}
	// reads instances
	protected function readInstances() {
		foreach ($this->instanceCache as $instanceData) {
			$this->instances[] = $instanceData;
		}
	}
	protected function readMobs() {
		foreach ($this->mobCache as $mobData) {
			$mobData['conv_killdate'] = strftime('%d.%m.%Y', $mobData['bsm_killdate']);
			$this->mobs[] = $mobData;
		}
	}
}

?>