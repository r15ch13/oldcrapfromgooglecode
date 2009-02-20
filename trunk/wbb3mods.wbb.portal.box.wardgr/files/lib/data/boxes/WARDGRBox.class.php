<?php

class WARDGRBox {
	protected $wardgrList = array();



	public function __construct($data, $boxname = "") {
		$this->wardgrList['templatename'] = "wardgrBox";
		$this->getBoxStatus($data);
		$this->wardgrList['boxID'] = $data['boxID'];

                $class = array('BG'=>'bg','BO'=>'bo','CH'=>'ch','DK'=>'dk','MA'=>'ma','MG'=>'mg','SH'=>'sh','SO'=>'so','SQ'=>'sq','WE'=>'we','ZE'=>'ze');
                $this->wardgrList['class'] = $class;

                $skills = array('bg'=>explode("\n", PORTAL_WARDGR_BG_S),'bo'=>explode("\n", PORTAL_WARDGR_BO_S),'ch'=>explode("\n", PORTAL_WARDGR_CH_S),'dk'=>explode("\n", PORTAL_WARDGR_DK_S),'ma'=>explode("\n", PORTAL_WARDGR_MA_S),'mg'=>explode("\n", PORTAL_WARDGR_MG_S),'sh'=>explode("\n", PORTAL_WARDGR_SH_S),'so'=>explode("\n", PORTAL_WARDGR_SO_S),'sq'=>explode("\n", PORTAL_WARDGR_SQ_S),'we'=>explode("\n", PORTAL_WARDGR_WE_S),'ze'=>explode("\n", PORTAL_WARDGR_ZE_S));
                foreach ($skills as $k => $v) {
                  $this->wardgrList[$k] = $v;
                }

                $onoff = array('bg'=>PORTAL_WARDGR_BG,'bo'=>PORTAL_WARDGR_BO,'ch'=>PORTAL_WARDGR_CH,'dk'=>PORTAL_WARDGR_DK,'ma'=>PORTAL_WARDGR_MA,'mg'=>PORTAL_WARDGR_MG,'sh'=>PORTAL_WARDGR_SH,'so'=>PORTAL_WARDGR_SO,'sq'=>PORTAL_WARDGR_SQ,'we'=>PORTAL_WARDGR_WE,'ze'=>PORTAL_WARDGR_ZE);
                $this->wardgrList['onoff'] = $onoff;
                foreach ($onoff as $k => $v) {
                  $this->wardgrList[$k."_o"] = $v;
                }

        }

        protected function getBoxStatus($data) {
		$this->wardgrList['Status'] = 1;
		if (WBBCore::getUser()->userID) {
			$this->wardgrList['Status'] = intval(WBBCore::getUser()->wardgrbox);
		}
		else {
			if (WBBCore::getSession()->getVar('wardgrbox') != false) {
				$this->wardgrList['Status'] = WBBCore::getSession()->getVar('wardgrbox');
			}
		}
	}

 	public function getData() {
		return $this->wardgrList;
	}
 }

?>