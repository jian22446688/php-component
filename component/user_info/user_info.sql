-- ----------------------------
-- Table structure for dm_c_user_info
-- ----------------------------

CREATE TABLE `dm_plugin_user_info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '邮箱地址',
  `site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '地址,位置',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 未读， 1 已读',
  `ip` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'ip 地址',
  `create_time` datetime(0) NULL DEFAULT NULL,
  `update_time` datetime(0) NULL DEFAULT NULL,
  `delete_time` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of dm_c_user_info
-- ----------------------------
INSERT INTO `dm_plugin_user_info` VALUES (1, 'test', 'test', 'testcary', '13688888888', '798171920@qq.com', '深圳龙华', 1, '127.0.0.1', '2018-10-02 13:35:32', '2018-10-07 00:00:00', NULL);
INSERT INTO `dm_plugin_user_info` VALUES (2, 'test', 'test', 'testCary', '13688888888', '798171920@qq.com', '深圳龙华', 1, '127.0.0.1', '2018-10-07 14:21:39', '2018-10-04 14:21:43', NULL);