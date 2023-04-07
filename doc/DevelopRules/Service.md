# Service服务


## Service之间调用
* 不调用其他service
* 需要调用其他Service的方法时，使用Provider配置Event-Listener解耦，使得Service间的调用可控
* Listener调用的Service方法中不应触发新的Event

## 数据处理

* 参数转换
* 主查询(多个联表才能完成查询的使用ES)
* 补充数据——补充1个关联表的数据就写一个方法处理，这些方法可能在做个Service之间共用，迁移到Trait中
> Trait不能调用Service方法，只调用Repository方法、完成数据格式处理
