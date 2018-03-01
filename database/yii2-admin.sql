-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-01-04 14:20:54
-- 服务器版本： 5.6.36-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2-admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `adminuser`
--

CREATE TABLE `adminuser` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `adminuser`
--

INSERT INTO `adminuser` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '$2y$13$.oZ12VokconfmXeaDQHNUOtYInXK5ExbCFHY84vSwv9bKa3pWrHt6', NULL, '450102@qq.com', 10, 1512028635, 1513143760),
(3, 'admin33', 'ag61sd3DUdl-8Zgfn3S52t_oTc-W5R2x', '$2y$13$u8.D1vTQqsp/yIKOY3eyEehHd3A3.Naq.WT1sianZj2OMlHcC2mRS', NULL, '131654@qq.com', 0, 1512541300, 1513150880);

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('超级管理员', '1', 1512711826);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1512725108, 1512725108),
('/admin/*', 2, NULL, NULL, NULL, 1512718672, 1512718672),
('/admin/assignment', 2, NULL, NULL, NULL, 1513064516, 1513064516),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/default/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/default/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu', 2, NULL, NULL, NULL, 1513063790, 1513063790),
('/admin/menu/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu/create', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu/update', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/menu/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission', 2, NULL, NULL, NULL, 1513064487, 1513064487),
('/admin/permission/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/create', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/update', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/permission/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role', 2, NULL, NULL, NULL, 1513064498, 1513064498),
('/admin/role/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/create', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/update', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/role/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route', 2, NULL, NULL, NULL, 1513063749, 1513063749),
('/admin/route/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route/assign', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route/create', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/route/remove', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule', 2, NULL, NULL, NULL, 1513064528, 1513064528),
('/admin/rule/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule/create', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule/update', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/rule/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/activate', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/delete', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/index', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/login', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/logout', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/signup', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/admin/user/view', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/adminuser', 2, NULL, NULL, NULL, 1513064462, 1513064462),
('/adminuser/index', 2, NULL, NULL, NULL, 1512726862, 1512726862),
('/classroom', 2, NULL, NULL, NULL, 1513070834, 1513070834),
('/gii/*', 2, NULL, NULL, NULL, 1513068990, 1513068990),
('/gii/default/*', 2, NULL, NULL, NULL, 1513068990, 1513068990),
('/gii/default/action', 2, NULL, NULL, NULL, 1513068989, 1513068989),
('/gii/default/diff', 2, NULL, NULL, NULL, 1513068989, 1513068989),
('/gii/default/index', 2, NULL, NULL, NULL, 1513068989, 1513068989),
('/gii/default/preview', 2, NULL, NULL, NULL, 1513068989, 1513068989),
('/gii/default/view', 2, NULL, NULL, NULL, 1513068989, 1513068989),
('/gridview/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/gridview/export/*', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/gridview/export/download', 2, NULL, NULL, NULL, 1512728340, 1512728340),
('/personal/*', 2, NULL, NULL, NULL, 1513136073, 1513136073),
('/personal/change-pwd', 2, NULL, NULL, NULL, 1513136347, 1513136347),
('/personal/index', 2, NULL, NULL, NULL, 1513136313, 1513136313),
('/personal/update', 2, NULL, NULL, NULL, 1513136332, 1513136332),
('/personal/view', 2, NULL, NULL, NULL, 1513136323, 1513136323),
('/system', 2, NULL, NULL, NULL, 1513147690, 1513147690),
('/user/index', 2, NULL, NULL, NULL, 1512984496, 1512984496),
('所有权', 2, '所有权', NULL, NULL, 1512718580, 1512718580),
('用户管理', 2, '用户管理', NULL, NULL, 1512714356, 1512714356),
('超级管理员', 1, NULL, NULL, NULL, 1512355241, 1512714435);

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('所有权', '/*'),
('超级管理员', '所有权');

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(3, '管理员', NULL, NULL, 5, 0x7b2269636f6e223a22636f6773227d),
(4, '管理员列表', 3, '/adminuser/index', 10, 0x7b2269636f6e223a22757365722d706c7573227d),
(6, '路由列表', 3, '/admin/route', 15, NULL),
(7, '用户列表', NULL, '/user/index', 10, 0x7b2269636f6e223a2275736572227d),
(8, '权限管理', 3, '/admin/permission', 20, 0x7b2269636f6e223a22636865636b227d),
(9, '角色列表', 3, '/admin/role', 25, 0x7b2269636f6e223a227573657273227d),
(10, '分配权限', 3, '/admin/assignment', 30, 0x7b2269636f6e223a2272616e646f6d227d),
(11, '菜单列表', 3, '/admin/menu', 35, 0x7b2269636f6e223a22616c69676e2d6c656674227d),
(12, '规则列表', 3, '/admin/rule', 40, 0x7b2269636f6e223a2267656172227d),
(13, 'Gii 工具', NULL, '/gii/default/index', 999, 0x7b2269636f6e223a2266696c652d6f227d),
(15, '个人中心', NULL, NULL, NULL, 0x7b2269636f6e223a226d616c65227d),
(16, '个人信息', 15, '/personal/view', 5, 0x7b2269636f6e223a22666f6c646572227d),
(17, '修改密码', 15, '/personal/change-pwd', 10, 0x7b2269636f6e223a226c6f636b227d),
(18, '更新信息', 15, '/personal/update', 8, 0x7b2269636f6e223a2270656e63696c2d7371756172652d6f227d),
(19, '系统配置', NULL, '/system', 15, 0x7b2269636f6e223a226c6170746f70227d);

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1512028382),
('m130524_201442_init', 1512028430),
('m140506_102106_rbac_init', 1512101035),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1512101035);

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE `system` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '名称',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '键',
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '值'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `name`, `key`, `value`) VALUES
(1, '配置', 'peizhi', 'peizhi');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `password_reset_token` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user', 'Z42kt9GdwvGCLd81x5_jP6_AE33MnYgu', '$2y$13$9zx2Vq57R8HZJ/29AdCcEuQv0x7MfaD6az2yy1xKuJxd4Cl.WrCK2', NULL, '450513@qq.com', 10, 1512117817, 1512705266);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminuser`
--
ALTER TABLE `adminuser`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE;

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`) USING BTREE,
  ADD KEY `auth_assignment_user_id_idx` (`user_id`) USING BTREE;

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`) USING BTREE,
  ADD KEY `rule_name` (`rule_name`) USING BTREE,
  ADD KEY `idx-auth_item-type` (`type`) USING BTREE;

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`) USING BTREE,
  ADD KEY `child` (`child`) USING BTREE;

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `parent` (`parent`) USING BTREE;

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`) USING BTREE;

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `index_key` (`key`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `adminuser`
--
ALTER TABLE `adminuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
