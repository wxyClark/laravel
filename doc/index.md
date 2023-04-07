# 文档

## 结构

ERP：企业资源计划
* UUA：商品智能系统(Universally Unique Auth)
* PIS：商品智能系统(Product Intelligence System)
  > SPU = Standard Product Unit(标准化产品单元)
  > 
  > SKC = Standard Product Color(款式+颜色)
  > 
  > SKU = Stock Keeping Unit(库存量单位)
* SRM：供应商关系管理(Supplier Relationship System)
* PMS：采购管理系统(Production Management system)
* APO：自动补货系统(Automatic Purchase order)
* TMS：运营管理系统(Trader Management System)
* OMS：订单管理系统(Order Management System)
* WMS：仓库管理系统(Warehouse Management System)
* CRM：客户关系管理(Customer Relationship Management)
* DSR：卖家服务评分系统
* CFS：评价反馈系统(Comment Feedback System)
* FMS：财务管理系统(Finance Management System)
> ROI = 投资回报率(return on investment)
* CMS内容管理系统(Content Management System)

## 需求

### 1、admin
```tip
后台管理，使用OAuth2校验，使用对称加密校验数据
```

### 2、web
```tip
本系统提供给前段系统调用的接口，使用OAuth2校验，使用对称加密校验数据
```

### 2.1、Demo
```tip
模式化的代码，方便复制
```

### 3、api
```tip
本系统提供给内部系统调用的接口，使用对称加密校验
```

### 4、openApi
```tip
本系统提供给外部系统调用的开放接口，使用OAuth2校验，使用非对称加密解析数据
```



## 技术规范
