Rest Board

API 管理系统

## 安装

下载代码

```
git clone https://github.com/nusr/RestBoard.git
```

建议 fork 一份，热情期待您帮忙贡献该项目，为广大客户端开发和测试同学提供帮助。

### 1. 引入nginx 配置

nginx 配置参考 `config/restboard.conf` 然后再 `nginx.conf` 里面通过 `include` 引入。

```
include /var/www/RestBoard/config/restboard.conf;
```

配置hosts 后重启nginx `nginx -s reload`。

### 2. 创建数据库和表结构

```
-- 创建数据库与用户
drop database if exists restboard;
create database if not exists restboard default character set utf8 collate utf8_general_ci;
grant all privileges on restboard.* to 'restboard'@'localhost' identified by 'restboard';
flush privileges;
quit
```

执行如下命令创建表结构

```
php artisan migrate
```

如果希望创建表结构时增加示例数据，可以执行如下命令。创建的数据可以删除，所以建议您加上 `--seed` 参数，方便快速上手。

```
php artisan migrate --seed
```

## 功能

1. API 信息管理
1. API 测试记录
1. API 批量测试
1. API 监控
1. API 接口在APP 的信息管理
1. API 文档，文档和API 信息管理关联

## API 信息

API 信息包含两部分

- API http 信息
- API 在APP 中的信息

API 应该有版本信息

### API http 信息

- request
    - url(method + host + param)
    - header
    - body
- response
    - header
    - body

### API 在APP 中的信息

单独配置，这里进行选择即可

### 交互

列表页: 展示已有api 列表, 所有首页使用

详情页： 展示api 详情, 包含创建和修改页面

## API 测试

同步API 接口信息

列表页: 已有请求历史，根据结构划分

详情页: 只有修改页面, 包含APP信息，API http 信息，请求历史记录

请求信息可以修改，请求是否保存需要主动保存

## API 批量测试

创建批量请求列表，列表内容为需要请求的ID

批量测试列表：列出已有的所有批量测试，批量测试名和涉及API 数

批量测试详情页: 列出批量测试详情页信息, 包括标签信息，API 列表，批量检查按钮

## API 监控

可以监控单个或多个API

监控列表，列出已有API 监控

监控详情：监控的API，请求周期，备注，添加人，告警人，如何判断返回是否正确

监控创建页: 

监控统计列表页: 总体的监控情况，可以做到列表页里面

监控统计详情页: 具体一条监控的情况，可以做到详情页里面

监控入口1： 请求列表，详情页增加添加至监控

监控入口2：监控新建页面，通过api 信息进行勾选

监控基于crontab + 多进程

## API 信息管理

无限分类的方式管理APP 位置信息

## API 文档

基于markdown，结合API 信息进行管理和编写

## TODO 功能列表

1. [ ] api 迭代版本分类
1. [ ] api 模块发奋
1. [ ] api 文档
1. [ ] api 字段字典
1. [ ] api 约束文章
1. [ ] 权限管理

## 技术选型

前端: vue2, element

后端开发: php, laravel

数据库: mysql

服务器软件: nginx

## 参入开发

### 前端开发

进入 `frontend` 目录，执行如下命令

```
# 安装扩展
npm install

# 运行开发模式
npm run dev

# 文件打包
npm run build
```

### 后端开发

重启nginx 后，启动服务，然后在`app/Http/Controllers` 目录下编写代码。

`doc` 目录已有所有 `api` 的接口文档，可以参考。

## 最后

本项目基于vue, element 和laravel, 欢迎贡献。
