# Repository

## 定义常量

## 定义增伤改查方法

## 定义私有通用查询

```php
/**
 * 每个model写一个Condition
 */
public function modelCondition(int $tenantId, array $params, array $fields = ['*'], array $sort = ['id' => 'asc'])
{

}

/**
 * 每个model写一个Condition
 */
public function detailCondition(int $tenantId, array $params, array $fields = ['*'], array $sort = ['id' => 'asc'])
{

}

/**
 * 每个model写一个Condition
 */
public function logCondition(int $tenantId, array $params, array $fields = ['*'], array $sort = ['id' => 'asc'])
{

}

```
