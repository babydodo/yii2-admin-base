/*
 Navicat Premium Data Transfer

 Source Server         : myself
 Source Server Type    : MySQL
 Source Server Version : 50714
 Source Host           : localhost:3306
 Source Schema         : yii2-admin-base

 Target Server Type    : MySQL
 Target Server Version : 50714
 File Encoding         : 65001

 Date: 19/12/2017 22:01:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for adminuser
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES (1, 'admin', '', '$2y$13$.oZ12VokconfmXeaDQHNUOtYInXK5ExbCFHY84vSwv9bKa3pWrHt6', NULL, '450102@qq.com', 10, 1512028635, 1513143760);
INSERT INTO `adminuser` VALUES (3, 'admin33', 'ag61sd3DUdl-8Zgfn3S52t_oTc-W5R2x', '$2y$13$u8.D1vTQqsp/yIKOY3eyEehHd3A3.Naq.WT1sianZj2OMlHcC2mRS', NULL, '131654@qq.com', 0, 1512541300, 1513150880);

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  INDEX `auth_assignment_user_id_idx`(`user_id`) USING BTREE,
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('超级管理员', '1', 1512711826);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `idx-auth_item-type`(`type`) USING BTREE,
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/*', 2, NULL, NULL, NULL, 1512725108, 1512725108);
INSERT INTO `auth_item` VALUES ('/admin/*', 2, NULL, NULL, NULL, 1512718672, 1512718672);
INSERT INTO `auth_item` VALUES ('/admin/assignment', 2, NULL, NULL, NULL, 1513064516, 1513064516);
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/assignment/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/assignment/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/default/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/default/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu', 2, NULL, NULL, NULL, 1513063790, 1513063790);
INSERT INTO `auth_item` VALUES ('/admin/menu/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu/create', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu/update', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/menu/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission', 2, NULL, NULL, NULL, 1513064487, 1513064487);
INSERT INTO `auth_item` VALUES ('/admin/permission/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/create', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/update', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/permission/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role', 2, NULL, NULL, NULL, 1513064498, 1513064498);
INSERT INTO `auth_item` VALUES ('/admin/role/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/create', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/update', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/role/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route', 2, NULL, NULL, NULL, 1513063749, 1513063749);
INSERT INTO `auth_item` VALUES ('/admin/route/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route/create', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route/refresh', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/route/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule', 2, NULL, NULL, NULL, 1513064528, 1513064528);
INSERT INTO `auth_item` VALUES ('/admin/rule/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule/create', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule/update', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/rule/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/activate', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/change-password', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/index', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/login', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/logout', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/reset-password', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/signup', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/admin/user/view', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/adminuser', 2, NULL, NULL, NULL, 1513064462, 1513064462);
INSERT INTO `auth_item` VALUES ('/adminuser/index', 2, NULL, NULL, NULL, 1512726862, 1512726862);
INSERT INTO `auth_item` VALUES ('/classroom', 2, NULL, NULL, NULL, 1513070834, 1513070834);
INSERT INTO `auth_item` VALUES ('/gii/*', 2, NULL, NULL, NULL, 1513068990, 1513068990);
INSERT INTO `auth_item` VALUES ('/gii/default/*', 2, NULL, NULL, NULL, 1513068990, 1513068990);
INSERT INTO `auth_item` VALUES ('/gii/default/action', 2, NULL, NULL, NULL, 1513068989, 1513068989);
INSERT INTO `auth_item` VALUES ('/gii/default/diff', 2, NULL, NULL, NULL, 1513068989, 1513068989);
INSERT INTO `auth_item` VALUES ('/gii/default/index', 2, NULL, NULL, NULL, 1513068989, 1513068989);
INSERT INTO `auth_item` VALUES ('/gii/default/preview', 2, NULL, NULL, NULL, 1513068989, 1513068989);
INSERT INTO `auth_item` VALUES ('/gii/default/view', 2, NULL, NULL, NULL, 1513068989, 1513068989);
INSERT INTO `auth_item` VALUES ('/gridview/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/gridview/export/*', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/gridview/export/download', 2, NULL, NULL, NULL, 1512728340, 1512728340);
INSERT INTO `auth_item` VALUES ('/personal/*', 2, NULL, NULL, NULL, 1513136073, 1513136073);
INSERT INTO `auth_item` VALUES ('/personal/change-pwd', 2, NULL, NULL, NULL, 1513136347, 1513136347);
INSERT INTO `auth_item` VALUES ('/personal/index', 2, NULL, NULL, NULL, 1513136313, 1513136313);
INSERT INTO `auth_item` VALUES ('/personal/update', 2, NULL, NULL, NULL, 1513136332, 1513136332);
INSERT INTO `auth_item` VALUES ('/personal/view', 2, NULL, NULL, NULL, 1513136323, 1513136323);
INSERT INTO `auth_item` VALUES ('/system', 2, NULL, NULL, NULL, 1513147690, 1513147690);
INSERT INTO `auth_item` VALUES ('/user/index', 2, NULL, NULL, NULL, 1512984496, 1512984496);
INSERT INTO `auth_item` VALUES ('所有权', 2, '所有权', NULL, NULL, 1512718580, 1512718580);
INSERT INTO `auth_item` VALUES ('用户管理', 2, '用户管理', NULL, NULL, 1512714356, 1512714356);
INSERT INTO `auth_item` VALUES ('超级管理员', 1, NULL, NULL, NULL, 1512355241, 1512714435);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('所有权', '/*');
INSERT INTO `auth_item_child` VALUES ('超级管理员', '所有权');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `parent`(`parent`) USING BTREE,
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (3, '管理员', NULL, NULL, 5, 0x7B2269636F6E223A22636F6773227D);
INSERT INTO `menu` VALUES (4, '管理员列表', 3, '/adminuser/index', 10, 0x7B2269636F6E223A22757365722D706C7573227D);
INSERT INTO `menu` VALUES (6, '路由列表', 3, '/admin/route', 15, NULL);
INSERT INTO `menu` VALUES (7, '用户列表', NULL, '/user/index', 10, 0x7B2269636F6E223A2275736572227D);
INSERT INTO `menu` VALUES (8, '权限管理', 3, '/admin/permission', 20, 0x7B2269636F6E223A22636865636B227D);
INSERT INTO `menu` VALUES (9, '角色列表', 3, '/admin/role', 25, 0x7B2269636F6E223A227573657273227D);
INSERT INTO `menu` VALUES (10, '分配权限', 3, '/admin/assignment', 30, 0x7B2269636F6E223A2272616E646F6D227D);
INSERT INTO `menu` VALUES (11, '菜单列表', 3, '/admin/menu', 35, 0x7B2269636F6E223A22616C69676E2D6C656674227D);
INSERT INTO `menu` VALUES (12, '规则列表', 3, '/admin/rule', 40, 0x7B2269636F6E223A2267656172227D);
INSERT INTO `menu` VALUES (13, 'Gii 工具', NULL, '/gii/default/index', 999, 0x7B2269636F6E223A2266696C652D6F227D);
INSERT INTO `menu` VALUES (14, '教室管理', NULL, '/classroom', NULL, NULL);
INSERT INTO `menu` VALUES (15, '个人中心', NULL, NULL, NULL, 0x7B2269636F6E223A226D616C65227D);
INSERT INTO `menu` VALUES (16, '个人信息', 15, '/personal/view', 5, 0x7B2269636F6E223A22666F6C646572227D);
INSERT INTO `menu` VALUES (17, '修改密码', 15, '/personal/change-pwd', 10, 0x7B2269636F6E223A226C6F636B227D);
INSERT INTO `menu` VALUES (18, '更新信息', 15, '/personal/update', 8, 0x7B2269636F6E223A2270656E63696C2D7371756172652D6F227D);
INSERT INTO `menu` VALUES (19, '系统配置', NULL, '/system', 15, 0x7B2269636F6E223A226C6170746F70227D);

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', 1512028382);
INSERT INTO `migration` VALUES ('m130524_201442_init', 1512028430);
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', 1512101035);
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1512101035);

-- ----------------------------
-- Table structure for system
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '' COMMENT '名称',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '键',
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '值',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `index_key`(`key`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of system
-- ----------------------------
INSERT INTO `system` VALUES (1, '配置', 'peizhi', 'peizhi');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_hash` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_reset_token` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'user', 'Z42kt9GdwvGCLd81x5_jP6_AE33MnYgu', '$2y$13$9zx2Vq57R8HZJ/29AdCcEuQv0x7MfaD6az2yy1xKuJxd4Cl.WrCK2', NULL, '450513@qq.com', 10, 1512117817, 1512705266);

SET FOREIGN_KEY_CHECKS = 1;
