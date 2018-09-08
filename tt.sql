/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tt

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-09-08 17:12:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for df_event
-- ----------------------------
DROP TABLE IF EXISTS `df_event`;
CREATE TABLE `df_event` (
  `e_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '',
  `kfline` varchar(255) DEFAULT '',
  `appload` varchar(255) DEFAULT '',
  `gamedesc` text,
  `hdesc` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_event
-- ----------------------------

-- ----------------------------
-- Table structure for df_import
-- ----------------------------
DROP TABLE IF EXISTS `df_import`;
CREATE TABLE `df_import` (
  `i_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order` varchar(20) DEFAULT '',
  `count` char(11) DEFAULT '',
  `mg_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_import
-- ----------------------------

-- ----------------------------
-- Table structure for df_manager
-- ----------------------------
DROP TABLE IF EXISTS `df_manager`;
CREATE TABLE `df_manager` (
  `mg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(64) DEFAULT '',
  `password` char(70) DEFAULT '',
  `role_id` int(11) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT '',
  `IP` varchar(30) DEFAULT '',
  `last_login_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1' COMMENT '1,开启0,冻结',
  `remember_token` varchar(255) DEFAULT '',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_manager
-- ----------------------------
INSERT INTO `df_manager` VALUES ('1', 'admin123', '$2y$10$Cnbfxcd0OCWPklg9aw7esebnZYN96VXwsnwSwOAnJbvilRc50VIgG', null, '2X45N1pPqQBQd2xdcHUVPfzooFdwt8jOZhyJpbbJ', '127.0.0.1', '2018-09-08 14:26:50', '2018-08-19 18:47:39', '2018-09-08 14:27:47', null, '1', 'NFmVEy1Fd7yVwI2hnFXJzlaFMdUajMyUZ8lfXdWv8Jc9oZs7mSDL3i2gyzpe');
INSERT INTO `df_manager` VALUES ('2', '乐乐', '$2y$10$xVz58Z4wovBhCnEHo6kVge28z9.kna.mxicsHxUEQQADFrx.proji', '31', 'imOk1puVawQO23Zpcc7Ae2U0PC3js3NJBkQEPwUQ', '127.0.0.1', '2018-08-25 20:24:42', '2018-08-21 19:01:45', '2018-09-08 14:27:17', null, '1', 'bcHX7FFoTO9AyoXJheqwEWB9pa6tyRuihz8Ngpqr313bdSViZXazUKESH8De');
INSERT INTO `df_manager` VALUES ('4', '鹏飞', '$2y$10$11JB1VDzJJZQ7GYgs3ilMuBdC5jB0IBKE7EAl1u5cNIsR0kAUcwTy', '30', 'f89QcjHPN1uiri9ZsWoGiQa8zAmoeGRVeJgGsAg9', '127.0.0.1', null, '2018-08-22 04:31:21', '2018-08-22 15:30:43', null, '1', '');
INSERT INTO `df_manager` VALUES ('18', '阿里', '$2y$10$XrDBHCUa8DykKRBXuRps/OXs1kUKM5/tFjoN0aiEHnmpVMk3QSeOS', '31', 'epZSfELQYXU2xFUgCEKktp5q0xnnp7laGGWC45dC', '127.0.0.1', '2018-08-22 15:10:56', '2018-08-22 15:09:11', '2018-08-22 15:46:41', null, '1', 'oZ6OWY9e0m6KapDS2rQEzdEPx2KFPS6ZlCvdWXKCzlZuPlMoldKhHWBdLvb0');
INSERT INTO `df_manager` VALUES ('19', 'admin123', '$2y$10$OSmOett/850dtzkqUtPGqOH9RMljOyFPdrriW5ZVUY3zyaUTDbRXi', '30', '', '', null, '2018-08-22 15:10:18', '2018-08-22 18:17:41', '2018-08-22 18:17:41', '1', '');
INSERT INTO `df_manager` VALUES ('20', 'admin123', '$2y$10$LB6zyG42HZqPye9o94HhdO4A/KOfVftyp4ZsvvE3fDstnukKjOBim', '30', '', '', null, '2018-08-22 15:10:25', '2018-08-22 18:17:40', '2018-08-22 18:17:40', '1', '');
INSERT INTO `df_manager` VALUES ('21', 'admin123', '$2y$10$gadswg9pPwS1Jva7tHeSzeF0lQfjvPciyDgmszI.rJlMnX1gCIyA6', '30', '', '', null, '2018-08-22 15:25:40', '2018-08-22 18:17:39', '2018-08-22 18:17:39', '1', '');
INSERT INTO `df_manager` VALUES ('22', 'admin123', '$2y$10$ZCrmXOyrbkWafYIeC9IoUOY34H2im4rBgonw/BmecNq8vrIMOYXNO', '30', '', '', null, '2018-08-22 15:25:55', '2018-08-22 18:17:37', '2018-08-22 18:17:37', '1', '');
INSERT INTO `df_manager` VALUES ('23', 'admin123', '$2y$10$QQQZeXD23RhgXqXixzm7Nu7WCXrCG7vk.Lrf19UxzOZ0Shn9eayeC', '30', '', '', null, '2018-08-22 15:26:17', '2018-08-22 18:17:36', '2018-08-22 18:17:36', '0', '');
INSERT INTO `df_manager` VALUES ('24', 'admin123', '$2y$10$NgNZ1vA/SeCEedf.r2tBhu7//6Y2LB7mNIh3bOUtm3sARRb33TkoG', '30', '', '', null, '2018-08-22 15:27:44', '2018-08-22 15:29:14', '2018-08-22 16:20:57', '1', '');

-- ----------------------------
-- Table structure for df_message
-- ----------------------------
DROP TABLE IF EXISTS `df_message`;
CREATE TABLE `df_message` (
  `s_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_message` varchar(20) DEFAULT '',
  `s_count` int(20) DEFAULT '0',
  `u_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_message
-- ----------------------------

-- ----------------------------
-- Table structure for df_permission
-- ----------------------------
DROP TABLE IF EXISTS `df_permission`;
CREATE TABLE `df_permission` (
  `p_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_name` varchar(20) DEFAULT '',
  `ps_pid` int(11) DEFAULT NULL,
  `ps_c` varchar(32) DEFAULT '',
  `ps_a` varchar(32) DEFAULT '',
  `ps_route` varchar(100) DEFAULT '',
  `ps_level` char(10) DEFAULT '',
  `icon` varchar(20) DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_permission
-- ----------------------------
INSERT INTO `df_permission` VALUES ('100', '客户管理', null, '', '', '', '0', '', '2018-08-20 14:30:55', '2018-08-20 11:19:09', null);
INSERT INTO `df_permission` VALUES ('101', '短信激活', null, null, null, null, '0', '', '2018-08-20 14:30:57', '2018-08-24 21:00:12', null);
INSERT INTO `df_permission` VALUES ('102', '分配工作', null, '', '', '', '0', '', '2018-08-20 14:31:00', '2018-08-25 16:01:05', '2018-08-25 16:01:05');
INSERT INTO `df_permission` VALUES ('103', '权限管理', null, '', '', '', '0', '', '2018-08-20 14:31:02', '2018-08-20 11:20:25', null);
INSERT INTO `df_permission` VALUES ('104', '客户信息', '100', 'user', 'index', '/user/index', '1', '', '2018-08-20 14:31:05', '2018-08-24 21:51:12', null);
INSERT INTO `df_permission` VALUES ('105', '客户导入', '100', 'user', 'show', '/user/show', '1', '', '2018-08-20 15:15:07', '2018-08-23 14:27:15', null);
INSERT INTO `df_permission` VALUES ('106', '权限列表', '103', 'permission', 'index', '/permission/index', '1', '', '2018-08-20 15:17:08', '2018-08-20 11:33:53', null);
INSERT INTO `df_permission` VALUES ('107', '显示编辑权限', '106', 'permission', 'show', '/permission/show', '2', '', '2018-08-20 10:00:27', '2018-08-20 11:20:29', null);
INSERT INTO `df_permission` VALUES ('108', '显示添加权限', '106', 'permission', 'create', '/permission/create', '2', '', '2018-08-20 10:03:56', '2018-08-20 11:20:31', null);
INSERT INTO `df_permission` VALUES ('109', '用户组列表', '103', 'role', 'index', '/role/index', '1', '', '2018-08-20 10:05:13', '2018-08-20 11:33:33', null);
INSERT INTO `df_permission` VALUES ('110', '显示添加组', '109', 'role', 'create', '/role/create', '2', '', '2018-08-20 10:05:15', '2018-08-21 04:17:22', null);
INSERT INTO `df_permission` VALUES ('111', '添加保存', '109', 'role', 'store', '/role/store', '2', '', '2018-08-20 10:06:34', '2018-09-08 14:33:20', null);
INSERT INTO `df_permission` VALUES ('112', '用户管理', '103', 'manager', 'index', '/manager/index', '1', '', '2018-08-20 10:06:56', '2018-08-21 09:24:46', null);
INSERT INTO `df_permission` VALUES ('113', '删除角色', '109', 'role', 'del', '/role/del', '2', '', '2018-08-20 10:06:58', '2018-08-21 04:15:32', null);
INSERT INTO `df_permission` VALUES ('114', '删除权限', '106', 'permission', 'del', '/permission/del', '2', '', '2018-08-20 10:07:07', '2018-08-20 11:27:38', null);
INSERT INTO `df_permission` VALUES ('115', '保存编辑权限', '106', 'permission', 'save', '/permission/save', '2', '', '2018-08-20 10:07:49', '2018-08-20 10:49:30', null);
INSERT INTO `df_permission` VALUES ('116', '保存权限', '106', 'permission', 'store', '/permission/store', '2', '', '2018-08-20 10:28:48', '2018-08-20 10:28:48', null);
INSERT INTO `df_permission` VALUES ('117', '显示权限页面', '109', 'role', 'qxview', '/role/qxview', '2', '', '2018-08-21 04:25:40', '2018-08-21 08:30:59', null);
INSERT INTO `df_permission` VALUES ('118', '保存分配权限', '109', 'role', 'qxsave', '/role/qxsave', '2', '', '2018-08-21 08:31:24', '2018-08-21 08:31:33', null);
INSERT INTO `df_permission` VALUES ('119', '用户删除', '112', 'manager', 'del', '/manager/del', '2', '', '2018-08-21 08:35:24', '2018-08-21 11:37:56', null);
INSERT INTO `df_permission` VALUES ('120', '用户修改状态', '112', 'manager', 'setstatus', '/manager/setstatus', '2', '', '2018-08-21 12:25:13', '2018-08-21 12:25:13', null);
INSERT INTO `df_permission` VALUES ('121', '白名单设置', '112', 'whitelist', 'index', '/whitelist', '2', '', '2018-08-21 12:27:58', '2018-08-22 20:58:47', null);
INSERT INTO `df_permission` VALUES ('122', '用户添加页面', '112', 'manager', 'create', '/manager/create', '2', '', '2018-08-21 13:02:45', '2018-08-21 13:02:45', null);
INSERT INTO `df_permission` VALUES ('123', '用户添加保存', '112', 'manager', 'stroe', '/manager/stroe', '2', '', '2018-08-22 04:24:18', '2018-08-22 04:24:18', null);
INSERT INTO `df_permission` VALUES ('124', '用户编辑显示', '112', 'manager', 'edit', '/manager/edit', '2', '', '2018-08-22 04:46:55', '2018-08-22 04:46:55', null);
INSERT INTO `df_permission` VALUES ('125', '用户编辑更新', '112', 'manager', 'update', '/manager/update', '2', '', '2018-08-22 13:19:28', '2018-08-22 13:19:28', null);
INSERT INTO `df_permission` VALUES ('126', '修改用户密码', '112', 'manager', 'resetpwd', '/manager/resetpwd', '2', '', '2018-08-22 14:07:35', '2018-08-22 14:11:24', null);
INSERT INTO `df_permission` VALUES ('127', '保存白名单', '112', 'whitelist', 'store', '/whitelist/store', '2', '', '2018-08-22 21:53:27', '2018-08-22 21:53:27', null);
INSERT INTO `df_permission` VALUES ('128', '删除白名单', '112', 'whitelist', 'destroy', '/whitelist/destroy', '2', '', '2018-08-23 12:57:31', '2018-08-23 12:57:31', null);
INSERT INTO `df_permission` VALUES ('129', '上传csv', '105', 'user', 'import', '/import', '2', '', '2018-08-23 15:53:52', '2018-08-23 16:29:06', null);
INSERT INTO `df_permission` VALUES ('130', '数据回滚', '105', 'user', 'rollback', '/rollback', '2', '', '2018-08-24 15:50:37', '2018-08-24 15:50:37', null);
INSERT INTO `df_permission` VALUES ('131', '数据查询', '104', 'user', 'search', '/user/search', '2', '', '2018-08-24 17:39:56', '2018-08-24 17:40:06', null);
INSERT INTO `df_permission` VALUES ('132', '数据删除', '104', 'user', 'destroy', '/user/destroy', '2', '', '2018-08-24 18:49:55', '2018-08-24 18:50:05', null);
INSERT INTO `df_permission` VALUES ('133', '数据编辑', '104', 'user', 'edit', '/user/edit', '2', '', '2018-08-24 19:42:15', '2018-08-24 19:42:15', null);
INSERT INTO `df_permission` VALUES ('134', '数据编辑', '104', 'user', 'update', '/user/update', '2', '', '2018-08-24 20:34:22', '2018-08-24 20:34:22', null);
INSERT INTO `df_permission` VALUES ('135', '短信激活', '101', 'sms', 'index', '/sms/index', '1', '', '2018-08-25 12:48:41', '2018-08-25 13:00:25', null);
INSERT INTO `df_permission` VALUES ('136', '数据导出', '101', 'sms', 'show', '/sms/show', '1', '', '2018-08-25 12:49:29', '2018-08-25 17:09:39', null);
INSERT INTO `df_permission` VALUES ('137', '删除短信', '135', 'sms', 'destroy', '/sms/destroy', '2', '', '2018-08-25 14:39:41', '2018-08-25 14:39:41', null);
INSERT INTO `df_permission` VALUES ('138', '查询短信', '135', 'sms', 'search', '/sms/search', '2', '', '2018-08-25 14:54:33', '2018-08-25 15:12:13', null);
INSERT INTO `df_permission` VALUES ('139', '数据导出操作', '136', 'sms', 'export', '/sms/export', '2', '', '2018-08-25 17:08:28', '2018-08-25 17:09:53', null);
INSERT INTO `df_permission` VALUES ('140', '自带下载', '136', 'sms', 'downloadfile', '/sms/downloadfile', '2', '', '2018-08-25 20:00:29', '2018-08-25 20:15:41', null);
INSERT INTO `df_permission` VALUES ('141', '发送短信接口', '136', 'sms', 'send', '/sms/send', '2', '', '2018-08-25 20:32:44', '2018-08-25 20:35:38', '2018-08-25 20:35:38');
INSERT INTO `df_permission` VALUES ('142', '模板列表', '100', 'template', 'index', '/template/index', '1', '', '2018-09-08 12:40:21', '2018-09-08 12:40:21', null);
INSERT INTO `df_permission` VALUES ('143', '添加创建', '142', 'template', 'create', '/template/create', '2', '', '2018-09-08 12:58:45', '2018-09-08 12:58:45', null);
INSERT INTO `df_permission` VALUES ('144', '添加保存', '142', 'template', 'store', '/template/store', '2', '', '2018-09-08 14:28:42', '2018-09-08 14:28:42', null);
INSERT INTO `df_permission` VALUES ('145', '删除模板', '142', 'template', 'del', '/template/del', '2', '', '2018-09-08 14:30:22', '2018-09-08 14:34:18', null);
INSERT INTO `df_permission` VALUES ('146', '编辑模板显示', '142', 'template', 'edit', '/template/edit', '2', '', '2018-09-08 14:37:13', '2018-09-08 14:38:00', null);
INSERT INTO `df_permission` VALUES ('147', '模板数据更新', '142', 'template', 'update', '/template/update', '2', '', '2018-09-08 14:50:30', '2018-09-08 14:50:30', null);

-- ----------------------------
-- Table structure for df_role
-- ----------------------------
DROP TABLE IF EXISTS `df_role`;
CREATE TABLE `df_role` (
  `r_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `r_name` char(10) DEFAULT '',
  `ps_ids` text,
  `ps_ca` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_role
-- ----------------------------
INSERT INTO `df_role` VALUES ('30', '主管', '103,106,107,108,114,115,116,109,110,111,113,117,118,112,119,120,121,122,123,124,125,126,127,128', 'permission-index,permission-show,permission-create,role-index,role-create,role-store,manager-index,role-del,permission-del,permission-save,permission-store,role-qxview,role-qxsave,manager-del,manager-setstatus,whitelist-index,manager-create,manager-stroe,manager-edit,manager-update,manager-resetpwd,whitelist-store,whitelist-destroy', '2018-08-20 20:14:06', '2018-08-23 14:24:47', null);
INSERT INTO `df_role` VALUES ('31', '经理', '100,104,131,132,133,134,105,129,130,142,143,144,145,146,147,101,135,137,138,136,139,140', 'user-index,user-show,user-import,user-rollback,user-search,user-destroy,user-edit,user-update,sms-index,sms-show,sms-destroy,sms-search,sms-export,sms-downloadfile,template-index,template-create,template-store,template-del,template-edit,template-update', '2018-08-20 20:14:09', '2018-09-08 14:50:42', null);
INSERT INTO `df_role` VALUES ('32', '测试', null, null, '2018-08-20 13:30:21', '2018-08-20 13:31:07', '2018-08-20 13:31:07');
INSERT INTO `df_role` VALUES ('33', '测试', '100,104,131,132,133,134,105,129,130,101,135,137,138,136,139,140', 'user-index,user-show,user-import,user-rollback,user-search,user-destroy,user-edit,user-update,sms-index,sms-show,sms-destroy,sms-search,sms-export,sms-downloadfile', '2018-08-20 13:31:03', '2018-08-25 20:15:58', null);

-- ----------------------------
-- Table structure for df_username
-- ----------------------------
DROP TABLE IF EXISTS `df_username`;
CREATE TABLE `df_username` (
  `u_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(10) DEFAULT '',
  `password` char(100) DEFAULT '',
  `tel` char(20) DEFAULT '',
  `tpasspwd` varchar(12) DEFAULT '',
  `sum` varchar(50) DEFAULT '',
  `link` varchar(100) DEFAULT '',
  `createtime` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `order` varchar(20) DEFAULT '',
  `updated_at` timestamp NULL DEFAULT NULL,
  `desc` text,
  `is_activate` varchar(10) DEFAULT '0',
  `e_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `tel_` (`tel`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_username
-- ----------------------------

-- ----------------------------
-- Table structure for df_whitelist
-- ----------------------------
DROP TABLE IF EXISTS `df_whitelist`;
CREATE TABLE `df_whitelist` (
  `w_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_addr` text,
  `mg_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of df_whitelist
-- ----------------------------
INSERT INTO `df_whitelist` VALUES ('1', '113.61.46.77', '1', '2018-08-26 19:19:53', null, null);
INSERT INTO `df_whitelist` VALUES ('2', '127.0.0.1', null, null, null, null);
