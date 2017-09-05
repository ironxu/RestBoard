数据字典

## 创建数据库与用户

```
-- 创建数据库与用户
drop database if exists restboard;
create database if not exists restboard default character set utf8 collate utf8_general_ci;
grant all privileges on restboard.* to 'restboard'@'localhost' identified by 'restboard';
flush privileges;
quit
```

## app 信息

### app 基本信息

```
-- app
CREATE TABLE `apps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '应用名称',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '描述',
  `remark` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '应用备注信息',
  `opname` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '操作人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

### 环境配置

```
-- env
CREATE TABLE `envs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL COMMENT '应用ID',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '环境名称',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '环境地址',
  `host` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '环境HOST',
  `color` char(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '环境标识颜色',
  `remark` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `opname` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '操作人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `envs_app_id_index` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

### 分类信息

```
-- 分类信息
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL COMMENT '应用ID',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名称',
  `pid` int(10) unsigned NOT NULL COMMENT '上级ID',
  `sort` int(10) unsigned NOT NULL COMMENT '排序值，数值越大越靠前',
  `remark` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `opname` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '操作人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_app_id_index` (`app_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

### 版本信息

```
-- 版本信息
```

## api 信息

```
-- api
CREATE TABLE `apis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(10) unsigned NOT NULL COMMENT '应用ID',
  `cate_id` int(10) unsigned NOT NULL COMMENT '分类ID',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'api名称',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'api 描述',
  `method` char(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'http method: get, post, put, delete, options, patch',
  `uri` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'api 请求资源',
  `req_header` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'api 请求头',
  `req_body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'api 请求体',
  `resp_header` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'api 响应头, 通过request 进行回填',
  `resp_body` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'api 响应体, 通过request 进行回填',
  `remark` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `opname` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '操作人',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apis_app_id_index` (`app_id`),
  KEY `apis_cate_id_index` (`cate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

## 请求记录

```
-- request
CREATE TABLE `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'request id',
  `app_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'app id',
  `api_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'api id',
  `env_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'env id',
  `cid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT 'request 名称',
  `desc` varchar(200) NOT NULL DEFAULT '' COMMENT '应用描述',
  `method` char(10) NOT NULL DEFAULT '' COMMENT '请求方法',
  `url` varchar(150) NOT NULL DEFAULT '' COMMENT '请求地址',
  `params` varchar(250) NOT NULL DEFAULT '' COMMENT '请求参数',
  `req_header` text COMMENT '请求头',
  `req_body` text COMMENT '请求体',
  `resp_header` text COMMENT '响应头',
  `resp_body` text COMMENT '响应体',
  `remarks` varchar(200) NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'create time',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'update time',
  `opname` varchar(45) NOT NULL DEFAULT '' COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='request 信息表';
```

## 文档

### API 文档

```
```

### 字段表

```
```