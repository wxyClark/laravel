# PIS：商品智能系统(Product Intelligence System)

## SPU

* attribute1 必填。推荐：color、colour、色、颜色
* attribute2 选填。推荐: size
* attribute3 选填。

## SKC

SPU的attribute 按顺序存储，方便后续SKC的灵活处理

* 同一个SPU的attribute名称不能重复
* 颜色优先
* 尺码次优先
* 颜色、尺码缺失时按首字母顺序排序


## SKU
唯一性约束：SPU + attribute1 + attribute2 + attribute3 唯一

* attribute1-value 必填
* attribute2-value 选填
* attribute3-value 选填
