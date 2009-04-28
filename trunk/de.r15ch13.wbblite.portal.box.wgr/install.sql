CREATE TABLE `wcf1_portal_wgr_classes` (
  `class_id` int(11) NOT NULL auto_increment,
  `class_name` varchar(20) NOT NULL,
  `class_short` varchar(2) NOT NULL,
  `class_color` varchar(7) NOT NULL,
  `class_onoff_1` tinyint(1) NOT NULL default '0',
  `class_onoff_2` tinyint(1) NOT NULL default '0',
  `class_onoff_3` tinyint(1) NOT NULL default '0',
  `class_skill_1` tinyint(2) NOT NULL default '0',
  `class_skill_2` tinyint(2) NOT NULL default '0',
  `class_skill_3` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`class_id`),
  UNIQUE KEY `class_name` (`class_name`),
  KEY `class_short` (`class_short`),
  KEY `class_color` (`class_color`),
  KEY `class_onoff_1` (`class_onoff_1`),
  KEY `class_onoff_2` (`class_onoff_2`),
  KEY `class_onoff_3` (`class_onoff_3`),
  KEY `class_skill_1` (`class_skill_1`),
  KEY `class_skill_2` (`class_skill_2`),
  KEY `class_skill_3` (`class_skill_3`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11;


INSERT INTO `wcf1_portal_wgr_classes` VALUES (1, 'portal_wgr_dr', 'dr', '#FF7D0A', '1', '1', '1', '0', '1', '2');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (2, 'portal_wgr_wl', 'wl', '#9482C9', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (3, 'portal_wgr_hu', 'hu', '#ABD473', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (4, 'portal_wgr_wa', 'wa', '#C79C6E', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (5, 'portal_wgr_ma', 'ma', '#69CCF0', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (6, 'portal_wgr_pa', 'pa', '#F58CBA', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (7, 'portal_wgr_pr', 'pr', '#FFFFFF', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (8, 'portal_wgr_sa', 'sa', '#2459FF', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (9, 'portal_wgr_ro', 'ro', '#FFF569', '0', '0', '0', '0', '0', '0');
INSERT INTO `wcf1_portal_wgr_classes` VALUES (10, 'portal_wgr_dk', 'dk', '#C41F3B', '0', '0', '0', '0', '0', '0');


CREATE TABLE `wcf1_portal_wgr_options` (
  `option_id` int(11) NOT NULL auto_increment,
  `option_name` varchar(20) NOT NULL,
  `option_color` varchar(7) NOT NULL,
  `option_onoff` tinyint(1) NOT NULL default '0',    
  PRIMARY KEY  (`option_id`),
  UNIQUE KEY `option_name` (`option_name`),
  KEY `option_color` (`option_color`),
  KEY `option_onoff` (`option_onoff`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

INSERT INTO `wcf1_portal_wgr_options` VALUES (1, 'portal_wgr_offline', '', '0');
INSERT INTO `wcf1_portal_wgr_options` VALUES (2, 'portal_wgr_clcolor', '', '0');
INSERT INTO `wcf1_portal_wgr_options` VALUES (3, 'portal_wgr_ucolor', '', '0');
INSERT INTO `wcf1_portal_wgr_options` VALUES (4, 'portal_wgr_ccolor', '', '0');
INSERT INTO `wcf1_portal_wgr_options` VALUES (5, 'portal_wgr_woskills', '', '0');
INSERT INTO `wcf1_portal_wgr_options` VALUES (6, 'portal_wgr_he', '', '1');
INSERT INTO `wcf1_portal_wgr_options` VALUES (7, 'portal_wgr_ta', '', '1');
INSERT INTO `wcf1_portal_wgr_options` VALUES (8, 'portal_wgr_detail', '', '1');

UPDATE `wcf1_group_option_value` SET `optionValue` = '1'
WHERE `wcf1_group_option_value`.`groupID` = (
		SELECT  `groupID`
		FROM  `wcf1_group`
		WHERE  `groupName` =  'Administratoren'
)
AND `wcf1_group_option_value`.`optionID` = (
		SELECT  `optionID`
		FROM  `wcf1_group_option`
		WHERE  `optionName` =  'user.portal.canEditRecruitment'
);