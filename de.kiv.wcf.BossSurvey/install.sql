DROP TABLE IF EXISTS wcf1_bosssurvey_instances;
CREATE TABLE wcf1_bosssurvey_instances(
	bsi_id			INT NOT NULL AUTO_INCREMENT,
	bsi_name		VARCHAR(255),		
	bsi_order		INT,
	bsi_view 		TINYINT(1),
	PRIMARY KEY(bsi_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS wcf1_bosssurvey_mob;
CREATE TABLE wcf1_bosssurvey_mob(
	bsm_id			INT NOT NULL AUTO_INCREMENT,
	bsm_name		VARCHAR(255),		
	bsm_desc		VARCHAR(255),
	bsm_progress	INT,
	bsm_killdate	INT,
	bsm_icon_path	VARCHAR(255),
	bsm_info_url	VARCHAR(255),
	bsm_order		INT,
	bsm_instance	INT,
	PRIMARY KEY(bsm_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- INSTANCES
INSERT INTO wcf1_bosssurvey_instances(bsi_id, bsi_name, bsi_order, bsi_view)
VALUES (1, 'Naxxramas (Heroic)', 2, 1);
INSERT INTO wcf1_bosssurvey_instances(bsi_id, bsi_name, bsi_order, bsi_view)
VALUES (2, 'The Obsidian Sanctum (Heroic)', 3, 1);
INSERT INTO wcf1_bosssurvey_instances(bsi_id, bsi_name, bsi_order, bsi_view)
VALUES (3, 'The Eye of Eternity (Heroic)', 4, 1);
INSERT INTO wcf1_bosssurvey_instances(bsi_id, bsi_name, bsi_order, bsi_view)
VALUES (4, 'Ulduar (Heroic)', 1, 1);

-- ULDUAR BOSSES
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (21, 'Flame Leviathan', 'A big vehicle.', 0, 0, 'icon/ulduar/bosssurveyLeviathan.png', '', 1, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (22, 'Razorscale', 'An Ironbound proto-drake.', 0, 0, 'icon/ulduar/bosssurveyRazorscale.png', '', 2, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (23, 'XT-002 Deconstructor', 'A robot that thinks you are a toy.', 0, 0, 'icon/ulduar/bosssurveyXT002.png', '', 3, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (24, 'Ignis the Furnace Master', 'A giant with a belly-furnace.', 0, 0, 'icon/ulduar/bosssurveyIgnis.png', '', 4, 4);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (25, 'Assembly of Iron', 'Three steel-guys.', 0, 0, 'icon/ulduar/bosssurveyIron.png', '', 5, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (26, 'Kologarn', 'He is the bridge.', 0, 0, 'icon/ulduar/bosssurveyKologarn.png', '', 6, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (27, 'Auriaya', '', 0, 0, 'icon/ulduar/bosssurveyAuriaya.png', '', 7, 4);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (28, 'Mimiron', 'Push the button!', 0, 0, 'icon/ulduar/bosssurveyMimiron.png', '', 8, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (29, 'Hodir', 'A very chilly titan.', 0, 0, 'icon/ulduar/bosssurveyHodir.png', '', 9, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (30, 'Thorim', '', 0, 0, 'icon/ulduar/bosssurveyThorim.png', '', 10, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (31, 'Freya', 'She loves flowers.', 0, 0, 'icon/ulduar/bosssurveyFreya.png', '', 11, 4);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (32, 'General Vezax', 'A manablocking Faceless one', 0, 0, 'icon/ulduar/bosssurveyVezax.png', '', 12, 4);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (33, 'Yogg-Saron', 'An Old God', 0, 0, 'icon/ulduar/bosssurveyYogg.png', '', 13, 4);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (34, 'Algalon the Observer ', 'The Raid Destroyer', 0, 0, 'icon/ulduar/bosssurveyAlgalon.png', '', 14, 4);

-- NAXX BOSSES
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (1, 'Patchwerk', 'A titanic standard Abomination.', 0, 0, 'icon/bosssurveyPatchwerk.png', '', 1, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (2, 'Grobbulus', 'A slime based Abomination.', 0, 0, 'icon/bosssurveyGrobbulus.png', '', 2, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (3, 'Gluth', 'An Abomination-Dog created from animal parts.', 0, 0, 'icon/bosssurveyGluth.png', '', 3, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (4, 'Thaddius', 'A massive Frankenstein-like Abomination with electricity based powers.', 0, 0, 'icon/bosssurveyThaddius.png', '', 4, 1);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (5, 'Anub Rekhan', 'A beetle-like Nerubian Crypt Lord. ', 0, 0, 'icon/bosssurveyAnubRekhan.png', '', 5, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (6, 'Grand Widow Faerlina', 'High ranking Cult-mistress of the Cult of the Damned.', 0, 0, 'icon/bosssurveyFaerlina.png', '', 6, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (7, 'Maexxna', 'A colossal highly poisonous Spider.', 0, 0, 'icon/bosssurveyMaexxna.png', '', 7, 1);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (8, 'Noth the Plaguebringer', 'A Necromancer specialized in curses and summoning.', 0, 0, 'icon/bosssurveyNoth.png', '', 8, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (9, 'Heigan the Unclean', 'A Necromancer specialized in diseases and dancing. ', 0, 0, 'icon/bosssurveyHeigan.png', '', 9, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (10, 'Loatheb', 'A giant Fungal Monster.', 0, 0, 'icon/bosssurveyLoatheb.png', '', 10, 1);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (11, 'Instructor Razuvious', 'The Death Knight trainer of Naxxramas. ', 0, 0, 'icon/bosssurveyRazuvious.png', '', 11, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (12, 'Gothik the Harvester', 'Grand Necromancer of the Lich King and the legions he commands.', 0, 0, 'icon/bosssurveyGothik.png', '', 12, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (13, 'The Four Horsemen', 'Four mounted high ranking Death Knight bosses at once. ', 0, 0, 'icon/bosssurveyFourHorseMen.png', '', 13, 1);

INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (14, 'Sapphiron', 'A gigantic frost wyrm.', 0, 0, 'icon/bosssurveySapphiron.png', '', 14, 1);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (15, 'Kel Thuzad', 'The dread Archlich.', 0, 0, 'icon/bosssurveyKelThuzad.png', '', 15, 1);

-- OBSI
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (16, 'Sartharion', 'He is charged to watch over the twilight eggs in the sanctum.', 0, 0, 'icon/bosssurveySartharion.png', '', 1, 2);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (17, 'Sartharion + 1 Drake', '', 0, 0, 'icon/bosssurveySartharion1.png', '', 2, 2);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (18, 'Sartharion + 2 Drakes', '', 0, 0, 'icon/bosssurveySartharion2.png', '', 3, 2);
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (19, 'Sartharion + 3 Drakes', '', 0, 0, 'icon/bosssurveySartharion3.png', '', 4, 2);

-- EYE
INSERT INTO wcf1_bosssurvey_mob(bsm_id, bsm_name, bsm_desc, bsm_progress, bsm_killdate, bsm_icon_path, bsm_info_url, bsm_order, bsm_instance)
VALUES (20, 'Malygos', 'The sinuous dragon rises from the water, a seemingly endless serpentine beast covered with crystalline scales of purest azure.', 0, 0, 'icon/bosssurveyMalygos.png', '', 1, 3);
