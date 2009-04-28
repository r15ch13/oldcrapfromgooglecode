INSERT INTO `wcf1_group_option_value` (`groupID`, `optionID`, `optionValue`)
VALUES (
	(
		SELECT  `groupID`
		FROM  `wcf1_group`
		WHERE  `groupName` =  'Administratoren'
	), (
		SELECT  `optionID`
		FROM  `wcf1_group_option`
		WHERE  `optionName` =  'user.portal.canEditRecruitment'
	),  '1'
);