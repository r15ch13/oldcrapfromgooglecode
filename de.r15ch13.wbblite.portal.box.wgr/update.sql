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