<?php

class WGRBox {
	protected $wgrList = array();



	public function __construct($data, $boxname = "") {
		$this->wgrList['templatename'] = "wgrBox";
		$this->getBoxStatus($data);
		$this->wgrList['boxID'] = $data['boxID'];

                $class = array('DR'=>'dr', 'WL'=>'wl', 'HU'=>'hu', 'WA'=>'wa', 'MA'=>'ma', 'PA'=>'pa', 'PR'=>'pr', 'SA'=>'sa', 'RO'=>'ro', 'DK'=>'dk');
                $this->wgrList['class'] = $class;

                $skills = array('dr'=>explode("\n", PORTAL_WGR_DR_S),'wl'=>explode("\n", PORTAL_WGR_WL_S),'hu'=>explode("\n", PORTAL_WGR_HU_S),'wa'=>explode("\n", PORTAL_WGR_WA_S),'ma'=>explode("\n", PORTAL_WGR_MA_S),'pa'=>explode("\n", PORTAL_WGR_PA_S),'pr'=>explode("\n", PORTAL_WGR_PR_S),'sa'=>explode("\n", PORTAL_WGR_SA_S),'ro'=>explode("\n", PORTAL_WGR_RO_S),'dk'=>explode("\n", PORTAL_WGR_DK_S));
                foreach ($skills as $k => $v) {
                  $this->wgrList[$k] = $v;
                }
                            
                $onoff = array('dr'=>PORTAL_WGR_DR,'wl'=>PORTAL_WGR_WL,'hu'=>PORTAL_WGR_HU,'wa'=>PORTAL_WGR_WA,'ma'=>PORTAL_WGR_MA,'pa'=>PORTAL_WGR_PA,'pr'=>PORTAL_WGR_PR,'sa'=>PORTAL_WGR_SA,'ro'=>PORTAL_WGR_RO,'dk'=>PORTAL_WGR_DK);
                $this->wgrList['onoff'] = $onoff;
                foreach ($onoff as $k => $v) {
                  $this->wgrList[$k."_o"] = $v;
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