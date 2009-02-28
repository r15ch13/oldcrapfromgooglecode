<?php

class WGRBox {
	protected $wgrList = array();

	public function __construct($data, $boxname = "") {
		$this->wgrList['templatename'] = "wgrBox";
		$this->getBoxStatus($data);
		$this->wgrList['boxID'] = $data['boxID'];
                $this->wgrList['debug'] = true;

                $data['class'] = array('dr'=>'dr', 'wl'=>'wl', 'hu'=>'hu', 'wa'=>'wa', 'ma'=>'ma', 'pa'=>'pa', 'pr'=>'pr', 'sa'=>'sa', 'ro'=>'ro', 'dk'=>'dk');
                $data['skill'] = array('dr'=>explode("\n", PORTAL_WGR_DR_S),'wl'=>explode("\n", PORTAL_WGR_WL_S),'hu'=>explode("\n", PORTAL_WGR_HU_S),'wa'=>explode("\n", PORTAL_WGR_WA_S),'ma'=>explode("\n", PORTAL_WGR_MA_S),'pa'=>explode("\n", PORTAL_WGR_PA_S),'pr'=>explode("\n", PORTAL_WGR_PR_S),'sa'=>explode("\n", PORTAL_WGR_SA_S),'ro'=>explode("\n", PORTAL_WGR_RO_S),'dk'=>explode("\n", PORTAL_WGR_DK_S));
                $data['onoff'] = array('dr'=>PORTAL_WGR_DR,'wl'=>PORTAL_WGR_WL,'hu'=>PORTAL_WGR_HU,'wa'=>PORTAL_WGR_WA,'ma'=>PORTAL_WGR_MA,'pa'=>PORTAL_WGR_PA,'pr'=>PORTAL_WGR_PR,'sa'=>PORTAL_WGR_SA,'ro'=>PORTAL_WGR_RO,'dk'=>PORTAL_WGR_DK);
                $data['color'] = array('dr'=>'#FF7D0A', 'wl'=>'#9482C9', 'hu'=>'#ABD473', 'wa'=>'#C79C6E', 'ma'=>'#69CCF0', 'pa'=>'#F58CBA', 'pr'=>'#FFFFFF', 'sa'=>'#2459FF', 'ro'=>'#FFF569', 'dk'=>'#C41F3B');
                $this->wgrList['data'] = $data;
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