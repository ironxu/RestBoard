1. 获取APP 所有分类
2. 获取某个分类下的API 列表
3. 获取某个API 详情
4. 新增API
5. 修改API
6. 删除API

---

## 1. 获取APP 所有分类

| 属性   | 描述                                |
| ---- | --------------------------------- |
| 请求地址 | categories/app/{app_id} |
| 请发方法 | GET                               |
| 是否登录 | 否                                 |
| 开发者  | 徐刚                                |

### 请求

| 参数名    | 字段类型   | 参数值                                  | 备注        |
| ------ | ------ | ------------------------------------ | --------- |
| app_id | int    | app id                               | -         |
| type   | string | tree: 格式化为树形组件数据; cascader: 格式化为级联组件;可以为空 | 格式化组件所需数据 |

**请求示例**

```
http://rb.local.com/categories/app/4
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
[
  {
    "id": 1,
    "name": "一级1",
    "pid": 0,
    "path": [
      0
    ],
    "children": [
      {
        "id": 3,
        "name": "二级1.1",
        "pid": 1,
        "path": [
          0,
          1
        ],
        "children": []
      }
    ]
  },
  {
    "id": 2,
    "name": "一级2",
    "pid": 0,
    "path": [
      0
    ],
    "children": []
  },
  {
    "id": 4,
    "name": "第二个一级分类",
    "pid": 0,
    "path": [
      0
    ],
    "children": []
  }
]
```

**异常返回**

http status 不等于200

---


## 2. 获取某个分类下的API 列表

| 属性   | 描述               |
| ---- | ---------------- |
| 请求地址 | apis?app_id={app_id}&cate_id={cate_id} |
| 请发方法 | GET           |
| 是否登录 | 否                |
| 开发者  | 徐刚               |

### 请求

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| app_id   | int  | app ID | -    |
| cate_id   | int  | 分类ID | -    |

**请求示例**

```
http://rb.local.com/apis?app_id=4&cate_id=2
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
[
  {
    "id": 1,
    "app_id": 4,
    "cate_id": 2,
    "name": "APP1",
    "description": "description of app3",
    "method": "GET",
    "uri": "apps",
    "req_header": "",
    "req_body": "",
    "resp_header": "",
    "resp_body": "",
    "remark": "remark of api1",
    "opname": "admin",
    "created_at": "2017-08-16 13:08:36",
    "updated_at": "2017-08-16 13:08:36",
    "deleted_at": null
  },
  {
    "id": 2,
    "app_id": 4,
    "cate_id": 2,
    "name": "APP2",
    "description": "description of app3",
    "method": "GET",
    "uri": "apps",
    "req_header": "",
    "req_body": "",
    "resp_header": "",
    "resp_body": "",
    "remark": "remark of api1",
    "opname": "admin",
    "created_at": "2017-08-16 13:08:36",
    "updated_at": "2017-08-16 13:08:36",
    "deleted_at": null
  },
  {
    "id": 3,
    "app_id": 4,
    "cate_id": 2,
    "name": "APP3",
    "description": "description of app3",
    "method": "GET",
    "uri": "apps",
    "req_header": "",
    "req_body": "",
    "resp_header": "",
    "resp_body": "",
    "remark": "remark of api1",
    "opname": "admin",
    "created_at": "2017-08-16 13:08:36",
    "updated_at": "2017-08-16 13:08:36",
    "deleted_at": null
  }
]
```

**异常返回**

http status 不等于200

---

## 3. 获取某个API 详情

| 属性   | 描述               |
| ---- | ---------------- |
| 请求地址 | apis/{id} |
| 请发方法 | GET           |
| 是否登录 | 否                |
| 开发者  | 徐刚               |

### 请求

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| id   | int  | api ID | -    |

**请求示例**

```
http://rb.local.com/apis/1
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
{
  "id": 1,
  "app_id": 4,
  "cate_id": 2,
  "name": "APP1",
  "description": "description of app3",
  "method": "GET",
  "uri": "apps",
  "req_header": "",
  "req_body": "",
  "resp_header": "",
  "resp_body": "",
  "remark": "remark of api1",
  "opname": "admin",
  "created_at": "2017-08-16 13:08:36",
  "updated_at": "2017-08-16 13:08:36",
  "deleted_at": null
}
```

**异常返回**

http status 不等于200

---

## 4. 新增API

| 属性   | 描述               |
| ---- | ---------------- |
| 请求地址 | apis |
| 请发方法 | POST           |
| 是否登录 | 否                |
| 开发者  | 徐刚               |

### 请求

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
|app_id| int| app id | - |
|cate_id| int| 分类id | - |
|name| string | 名称 | - |
|description| string| 描述 | - |
|method| string| 方法 GET | - |
|uri| string| 请求地址 | - |
|req_header| string| 请求头 |- |
|req_body| string| 请求体 | -|
|resp_header| string| 响应头 |- |
|resp_body| string| 响应体 |- |
|remark| string| 备注 | -|

**请求示例**

```
http://rb.local.com/apis
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
{
  "id": 4
}
```

**异常返回**

http status 不等于200

## 5. 修改API

| 属性   | 描述               |
| ---- | ---------------- |
| 请求地址 | /apis/{id} |
| 请发方法 | PUT           |
| 是否登录 | 否                |
| 开发者  | 徐刚               |

### 请求

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
|app_id| int| app id | - |
|cate_id| int| 分类id | - |
|name| string | 名称 | - |
|description| string| 描述 | - |
|method| string| 方法 GET | - |
|uri| string| 请求地址 | - |
|req_header| string| 请求头 |- |
|req_body| string| 请求体 | -|
|resp_header| string| 响应头 |- |
|resp_body| string| 响应体 |- |
|remark| string| 备注 | -|

**请求示例**

```
PUT http://rb.local.com/apis/4
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
{
  "id": 4,
  "app_id": "4",
  "cate_id": "2",
  "name": "第二个api",
  "description": "描述",
  "method": "GET",
  "uri": "apis",
  "req_header": "",
  "req_body": "",
  "resp_header": "",
  "resp_body": "",
  "remark": "xxx",
  "opname": "admin",
  "created_at": "2017-09-03 20:53:51",
  "updated_at": "2017-09-03 21:02:36",
  "deleted_at": null
}
```

**异常返回**

http status 不等于200

## 6. 删除API

| 属性   | 描述               |
| ---- | ---------------- |
| 请求地址 | /apis/{id} |
| 请发方法 | DELETE           |
| 是否登录 | 否                |
| 开发者  | 徐刚               |

### 请求

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
|id| int| api id | - |

**请求示例**

```
http://rb.local.com/apis/7
```

### 响应

| 参数名  | 字段类型 | 参数值  | 备注   |
| ---- | ---- | ---- | ---- |
| -    | -    | -    | -    |

**响应示例**

```
{
  "id": "7"
}
```

**异常返回**

http status 不等于200