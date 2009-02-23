<?php

class WAROGRBox {
	protected $warogrList = array();



	public function __construct($data, $boxname = "") {
		$this->warogrList['templatename'] = "warogrBox";
		$this->getBoxStatus($data);
		$this->warogrList['boxID'] = $data['boxID'];

                $class = array('AM'=>'am','BW'=>'bw','EN'=>'en','IB'=>'ib','KS'=>'ks','RP'=>'rp','SM'=>'sm','SW'=>'sw','WH'=>'wh','WL'=>'wl','WP'=>'wp');
                $this->warogrList['class'] = $class;

                $skills = array('am'=>explode("\n", PORTAL_WAROGR_AM_S),'bw'=>explode("\n", PORTAL_WAROGR_BW_S),'en'=>explode("\n", PORTAL_WAROGR_EN_S),'ib'=>explode("\n", PORTAL_WAROGR_IB_S),'ks'=>explode("\n", PORTAL_WAROGR_KS_S),'rp'=>explode("\n", PORTAL_WAROGR_RP_S),'sm'=>explode("\n", PORTAL_WAROGR_SM_S),'sw'=>explode("\n", PORTAL_WAROGR_SW_S),'wh'=>explode("\n", PORTAL_WAROGR_WH_S),'wl'=>explode("\n", PORTAL_WAROGR_WL_S),'wp'=>explode("\n", PORTAL_WAROGR_WP_S));
                foreach ($skills as $k => $v) {
                  $this->warogrList[$k] = $v;
                }

                $onoff = array('am'=>PORTAL_WAROGR_AM,'bw'=>PORTAL_WAROGR_BW,'en'=>PORTAL_WAROGR_EN,'ib'=>PORTAL_WAROGR_IB,'ks'=>PORTAL_WAROGR_KS,'rp'=>PORTAL_WAROGR_RP,'sm'=>PORTAL_WAROGR_SM,'sw'=>PORTAL_WAROGR_SW,'wh'=>PORTAL_WAROGR_WH,'wl'=>PORTAL_WAROGR_WL,'wp'=>PORTAL_WAROGR_WP);
                $this->warogrList['onoff'] = $onoff;
                foreach ($onoff as $k => $v) {
                  $this->warogrList[$k."_o"] = $v;
                }

        }

        protected function getBoxStatus($data) {
		$this->warogrList['Status'] = 1;
		if (WBBCore::getUser()->userID) {
			$this->warogrList['Status'] = intval(WBBCore::getUser()->warogrbox);
		}
		else {
			if (WBBCore::getSession()->getVar('warogrbox') != false) {
				$this->warogrList['Status'] = WBBCore::getSession()->getVar('warogrbox');
			}
		}
	}

 	public function getData() {
		return $this->warogrList;
	}
 }

?>