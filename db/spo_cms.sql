/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : spo_cms

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2014-03-15 05:29:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ca_tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `ca_tbl_menu`;
CREATE TABLE `ca_tbl_menu` (
  `MENU_ID` int(11) NOT NULL,
  `PARENT_ID` int(11) NOT NULL,
  `SL_NO` int(11) NOT NULL,
  `MENU_NAME` varchar(255) CHARACTER SET utf8 NOT NULL,
  `MENU_LINK` text CHARACTER SET utf8,
  `MENU_IAMGE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MENU_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ca_tbl_menu
-- ----------------------------
INSERT INTO `ca_tbl_menu` VALUES ('1', '0', '1', 'Admin', null, null);
INSERT INTO `ca_tbl_menu` VALUES ('2', '0', '2', 'Content', null, null);
INSERT INTO `ca_tbl_menu` VALUES ('3', '1', '1', 'Language Settings', 'LanguageUI.php', 'LanguageUI.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('4', '1', '2', 'Create User', 'UserInfoUI.php', null);
INSERT INTO `ca_tbl_menu` VALUES ('5', '1', '3', 'Create User Group', 'UserGroupUI.php', null);
INSERT INTO `ca_tbl_menu` VALUES ('6', '2', '1', 'Home Page Setup', 'HomeInfoUI.php', 'HomeContent.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('7', '2', '2', 'Image Viewer Setup', 'ImageSetupUI.php', 'ImageSetup.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('8', '2', '3', 'News & Events Setup', 'NewsEventsUI.php', 'NewsEvents.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('9', '2', '5', 'Top Menu Setup', 'MenuInfoUI.php', 'TopMenuSetup.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('10', '2', '6', 'Hot Link Setup', 'HotLinkUI.php', 'HotLink.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('11', '2', '4', 'Contact Information Setup', 'ContactsUI.php', 'ContactInformation.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('12', '0', '3', 'Help', null, null);
INSERT INTO `ca_tbl_menu` VALUES ('13', '0', '5', 'Logout', 'Logout.php', null);
INSERT INTO `ca_tbl_menu` VALUES ('14', '2', '7', 'Bottom Link Setup', 'BottomLinkUI.php', 'BottomMenuLink.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('15', '2', '8', 'Member Setup', 'MemberUI.php', 'MemberSetup.jpg');
INSERT INTO `ca_tbl_menu` VALUES ('16', '0', '4', 'Change Password', null, null);

-- ----------------------------
-- Table structure for ca_tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `ca_tbl_user`;
CREATE TABLE `ca_tbl_user` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(50) CHARACTER SET utf8 NOT NULL,
  `USER_PASSWORD` varchar(50) CHARACTER SET utf8 NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ca_tbl_user
-- ----------------------------
INSERT INTO `ca_tbl_user` VALUES ('1', 'Admin', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `ca_tbl_user` VALUES ('2', 'Moin', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `ca_tbl_user` VALUES ('3', 'Subrata', 'e10adc3949ba59abbe56e057f20f883e', '1');
INSERT INTO `ca_tbl_user` VALUES ('4', 'Taufiq', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `ca_tbl_user` VALUES ('5', 'Admin1', 'e10adc3949ba59abbe56e057f20f883e', '1');
INSERT INTO `ca_tbl_user` VALUES ('6', 'test', '0cc175b9c0f1b6a831c399e269772661', '1');

-- ----------------------------
-- Procedure structure for CA_CHQ_USER
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_CHQ_USER`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_CHQ_USER`(pUSER_NAME varchar(50), pUSER_PASSWORD varchar(50))
BEGIN
	#Routine body goes here...
	SELECT USER_ID, USER_NAME FROM ca_tbl_user WHERE USER_NAME=pUSER_NAME  AND USER_PASSWORD=pUSER_PASSWORD AND IS_ACTIVE=1;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for CA_GET_USER_PERMISSION_INFO
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_GET_USER_PERMISSION_INFO`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_GET_USER_PERMISSION_INFO`(pMENU_ID int, pUSER_ID int)
BEGIN
	SELECT A.USER_ID, B.MENU_ID, B.GROUP_ID, B.IS_VIEW, B.IS_INSERT, B.IS_EDIT_BEFORE_PUB, B.IS_EDIT_AFTER_PUB,
	B.IS_PUBLISHED, B.IS_ACTIVE FROM ca_tbl_user_group_permission A
	INNER JOIN ca_tbl_group_permission B ON A.GROUP_ID = B.GROUP_ID
	INNER JOIN ca_tbl_menu C ON C.MENU_ID = B.MENU_ID
	INNER JOIN ca_tbl_group D ON D.GROUP_ID = A.GROUP_ID
	WHERE D.IS_ACTIVE = 1	
	AND A.USER_ID = pUSER_ID	
	AND B.MENU_ID = pMENU_ID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for CA_TBL_USER_GALL
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_TBL_USER_GALL`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_TBL_USER_GALL`(pUSER_ID int)
BEGIN
	#Routine body goes here...
SELECT USER_ID,USER_NAME,
CONCAT("<a href=""javascript:;"" class='button blue' onclick=""window.showModalDialog('UserPopupUI.php?USER_ID=",USER_ID,"');"">","Reset Password</a>") IS_EDIT,
CASE 
		WHEN IS_ACTIVE = 0 THEN CONCAT("<a href=""javascript:;"" class='button green' onclick=""window.open('UserInfoUI.php?USER_ID=",USER_ID,"&StatusType=A&Status=1',  '_self');"">","Active</a>")
		WHEN IS_ACTIVE = 1 THEN CONCAT("<a href=""javascript:;"" class='button red' onclick=""window.open('UserInfoUI.php?USER_ID=",USER_ID,"&StatusType=A&Status=0',  '_self');"">","Inactive</a>")	
END AS IS_ACTIVE,
CONCAT("<a href=""javascript:;"" class='button blue' onclick=""window.showModalDialog('UserGroupPermissionPopupUI.php?USER_ID=",USER_ID,"');"">","Group Permission</a>") GRP_PERMISSION

FROM ca_tbl_user;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for CA_TBL_USER_GID
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_TBL_USER_GID`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_TBL_USER_GID`(pUSER_ID int)
BEGIN
	#Routine body goes here...
SELECT USER_ID,USER_NAME,USER_PASSWORD 
FROM ca_tbl_user WHERE USER_ID=pUSER_ID;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for CA_TBL_USER_I
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_TBL_USER_I`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_TBL_USER_I`(pUSER_ID int, pUSER_NAME varchar(50), pUSER_PASSWORD varchar(50), cUSER_ID  int, pIP_ADDRESS varchar(25))
BEGIN
	#Routine body goes here...
	IF NOT EXISTS (SELECT * FROM ca_tbl_user WHERE USER_ID=pUSER_ID) THEN
		SET pUSER_ID = (SELECT IFNULL(MAX(USER_ID),0) + 1 FROM ca_tbl_user);
		
		INSERT INTO ca_tbl_user(USER_ID,USER_NAME,USER_PASSWORD)
		VALUES(pUSER_ID, pUSER_NAME , pUSER_PASSWORD);
	ELSE
		UPDATE ca_tbl_user
		SET USER_NAME = pUSER_NAME, 
				USER_PASSWORD = pUSER_PASSWORD 
		WHERE USER_ID = pUSER_ID;
	END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for CA_TBL_USER_SC
-- ----------------------------
DROP PROCEDURE IF EXISTS `CA_TBL_USER_SC`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CA_TBL_USER_SC`(pUSER_ID smallint, pStatusType char(1), pStatus tinyint)
BEGIN
	#Routine body goes here...
IF (pStatusType = 'A') THEN
		UPDATE ca_tbl_user	
		SET IS_ACTIVE = pStatus
		WHERE USER_ID = pUSER_ID;
END IF;	
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for SP_CA_MENU_F
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CA_MENU_F`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CA_MENU_F`(pPARENT_ID smallint)
BEGIN
	#Routine body goes here...
	SELECT M.MENU_ID, M.MENU_NAME, M.PARENT_ID, M.SL_NO, M.MENU_LINK,M.MENU_IAMGE FROM CA_TBL_MENU M WHERE M.PARENT_ID=pPARENT_ID 
	ORDER BY M.SL_NO;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for SP_CA_MENU_IMAGE_VIEW_F
-- ----------------------------
DROP PROCEDURE IF EXISTS `SP_CA_MENU_IMAGE_VIEW_F`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CA_MENU_IMAGE_VIEW_F`()
BEGIN
	#Routine body goes here...
	SELECT M.MENU_ID, M.MENU_NAME, M.PARENT_ID, M.SL_NO, M.MENU_LINK,M.MENU_IAMGE 
  FROM CA_TBL_MENU M WHERE M.MENU_IAMGE <> ''
	ORDER BY M.SL_NO;

END
;;
DELIMITER ;
