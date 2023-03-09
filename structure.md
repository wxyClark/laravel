# 架构

## 服务器架构

* Nginx + PHP
* Mysql 1主+2从
* Redis
* ES

## 应用架构

```danger
本站请求使用 OAuth2.0校验
站内互调使用 OAuth2.0对称加密
开放平台使用 OAuth2.0不对称加密
```

* Request请求HTTP头Authorization: Bearer xxx OAuth2.0
* Request请求 数据格式
```php
[ 
    'user' => ['tenant_id' => 10001, 'user_code' => 'U1111', 'user_name' => 'userName'],
    'data' => ['uniq_code' => 10001, 'key' => 'value', 'detail_list' => ['key1' => 'value1']],
    'timestamp' => '当前时间戳',
    'signature' => 'user + data 数据签名, timestamp 用于比对时间有效性'
]
```
* Response返回 数据格式
```php
[ 
    'code' => '状态码',
    'data' => ['uniq_code' => 10001, 'key' => 'value', 'detail_list' => ['key1' => 'value1']],
    'msg' => ['type' => 'info，notice提示但不中断，warning警告，error错误', 'text' => '提示信息'],
]
```

## 功能列表

### 1.本站请求
### 2.站内互调
### 3.后台管理
### 4.开放平台

