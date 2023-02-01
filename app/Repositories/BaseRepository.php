<?php


namespace App\Repositories;


use App\Enums\CommonEnums;
use App\Enums\ErrorCodeEnums;

abstract class BaseRepository
{
    protected $model;

    protected $logModel;

    //  可筛选项枚举值，默认值为0,但0不用于业务逻辑
    const BOOLEAN_TRUE = 1;
    const BOOLEAN_FALSE = 2;

    const BOOLEAN_ENUMS_MAP = [
        self::BOOLEAN_TRUE  => '是',
        self::BOOLEAN_FALSE => '否',
    ];

    /**
     * @desc 通用查询方法
     * @param  array  $userInfo
     * @param  array  $params
     * @return mixed
     */
    abstract protected function condition(array $userInfo, array $params);

    /**
     * @desc 获取记录总数
     * @param  array  $userInfo
     * @param  array  $params
     * @return mixed
     */
    public function getTotal(array $userInfo, array $params)
    {
        return $this->model->contditon($userInfo, $params)->count();
    }

    /**
     * @desc 新增业务日志
     * @param  array  $userInfo
     * @param  array  $params
     * @param  array|string[]  $fields
     * @return mixed
     * @throws \Exception
     */
    public function getList(array $userInfo, array $params, array $fields = ['*'])
    {
        $query = $this->model->contditon($userInfo, $params);

        //  全局默认按更新时间排序
        if (!empty($params['sort_arr'])) {
            $params['sort_arr'] = ['updated_at' => 'DESC'];
        }
        foreach ($params['sort_arr'] as $sortColumn => $sortType) {
            $query->orderBy($sortColumn, $sortType);
        }

        //  分页
        $pageParams = $this->getPageParams($params);
        $offset = ($pageParams['page'] - 1) * $pageParams['page_size'];
        $query->offset($offset)->limit($offset);

        return $query->select($fields)->get()->toArray();
    }

    /**
     * @desc 按最小值分页获取数据(用于刷数)
     * @param  array  $userInfo
     * @param  array  $params
     * @param  int  $limit
     * @param  array|string[]  $fields
     * @return mixed
     */
    public function getListByMinId(array $userInfo, array $params, int $limit, array $fields = ['*'])
    {
        $query = $this->model->contditon($userInfo, $params);

        if (!empty($params['sort_arr'])) {
            $params['sort_arr'] = ['id' => 'ASC'];
        }
        foreach ($params['sort_arr'] as $sortColumn => $sortType) {
            $query->orderBy($sortColumn, $sortType);
        }

        return $query->offset(0)->limit($limit)->select($fields)->get()->toArray();
    }

    /**
     * @desc 通过唯一条件获取单条记录
     * @param  array  $userInfo
     * @param  array  $params
     * @param  array $fields
     * @return array
     */
    public function getRecordByUniqData(array $userInfo, array $params, array $fields)
    {
        $query = $this->model->contditon($userInfo, $params);
        if (!empty($params['sort_arr'])) {
            foreach ($params['sort_arr'] as $sortColumn => $sortType) {
                $query->orderBy($sortColumn, $sortType);
            }
        }
        $record = $query->select($fields)->first();

        return $record ? $record->toArray() : [];
    }

    /**
     * @desc 获取有效的分页参数
     * @param  array  $params
     * @return array
     * @throws \Exception
     */
    public function getPageParams(array $params)
    {
        $page = $params['page'] ?? CommonEnums::BASE_PAGE;
        $page = max($page, CommonEnums::BASE_PAGE);

        $pageSize = $params['page_size'] ?? CommonEnums::BASE_PAGE_SIZE;
        $pageSize = max($pageSize, CommonEnums::BASE_PAGE_SIZE);
        if ($pageSize > CommonEnums::MAX_PAGE_SIZE) {
            throw new \Exception('分页数超过上限：'.CommonEnums::MAX_PAGE_SIZE, ErrorCodeEnums::ERROR_CODE_PARAMS_OUT_OF_RANGE);
        }

        return [
            'page'      => $page,
            'page_size' => $pageSize,
        ];
    }

    /**
     * @desc 新增主业务记录
     * @param  array  $data
     * @return mixed
     */
    public function add(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @desc 新增业务日志
     * @param  array  $data
     * @return mixed
     */
    public function addLog(array $data)
    {
        return $this->logModel->insert($data);
    }

    /**
     * @desc 删除指定条件的记录
     * @param  array  $userInfo
     * @param  array  $uniqData
     * @return mixed
     */
    public function deleteByUniqData(array $userInfo, array $uniqData)
    {
        return $this->model->contditon($userInfo, $uniqData)->delete();
    }

    /**
     * @desc 更新指定条件的记录
     * @param  array  $userInfo
     * @param  array  $uniqData
     * @param  array  $updateData
     * @return mixed
     * @throws \Exception
     */
    public function updateByUniqData(array $userInfo, array $uniqData, array $updateData)
    {
        if (empty($uniqData)) {
            throw new \Exception('必须指定唯一条件参数', ErrorCodeEnums::ERROR_CODE_PARAMS_EMPTY);
        }

        $total = $this->getTotal($userInfo, $uniqData);
        if ($total > CommonEnums::MAX_UPDATE_LIMIT) {
            throw new \Exception('更新数据行数超出上限：'.CommonEnums::MAX_UPDATE_LIMIT, ErrorCodeEnums::ERROR_CODE_PARAMS_EMPTY);
        }

        return $this->model->contditon($userInfo, $uniqData)->update($updateData);
    }

    /**
     * @desc 批量更新
     * @param  array  $data
     * @param  string  $index
     * @return mixed
     */
    public function batchUpdate(array $data, $index = 'id')
    {
        return \Batch::update($this->model, $data, $index);
    }

}