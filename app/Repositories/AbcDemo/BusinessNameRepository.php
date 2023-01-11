<?php

namespace App\Repositories\AbcDemo;

use App\Helper\ArrayHelper;
use App\Helper\DatetimeHelper;
use App\Models\AbcDemo\BusinessNameDetailModel;
use App\Models\AbcDemo\BusinessNameLogModel;
use App\Models\AbcDemo\BusinessNameModel;
use App\Repositories\BaseRepository;

class BusinessNameRepository extends BaseRepository
{
    /** @var BusinessNameModel  */
    protected $model;

    /** @var BusinessNameDetailModel  */
    protected $detailModel;

    /** @var BusinessNameLogModel  */
    protected $logModel;

    public function __construct(
        BusinessNameModel $model,
        BusinessNameDetailModel $detailModel,
        BusinessNameLogModel $logModel
    ) {
        $this->model = $model;
        $this->detailModel = $detailModel;
        $this->logModel = $logModel;
    }

    /**
     * @desc 通用查询条件
     * @param  array  $userInfo
     * @param  array  $params
     * @return mixed
     */
    protected function condition(array $userInfo, array $params)
    {
        $query = $this->model->where('tenant_id', $userInfo['tenant_id']);

        //  ID
        if (!empty($params['id'])) {
            $idArr = ArrayHelper::paramsItemToArray($params['id']);
            $query->whereIn('id', $idArr);
        }

        //  唯一编码
        if (!empty($params['uniq_code'])) {
            $uniqCodeArr = ArrayHelper::paramsItemToArray($params['uniq_code']);
            $query->whereIn('uniq_code', $uniqCodeArr);
        }

        //  状态
        if (!empty($params['status'])) {
            $statusArr = ArrayHelper::paramsItemToArray($params['status']);
            $query->whereIn('status', $statusArr);
        }

        //  操作人 (created_by、updated_by、checked_by)
        if (!empty($params['operator_type']) && !empty($params['operator'])) {
            $operatorArr = ArrayHelper::paramsItemToArray($params['operator']);
            $query->whereIn($params['operator_type'], $operatorArr);
        }

        //  时间段(全局时间段查询只精确到日期)
        if (!empty($params['date_type'])) {
            if (!empty($params['date_start'])) {
                $query->where($params['date_type'], '>=', DatetimeHelper::getDateStart($params['date_start']));
            }
            if (!empty($params['date_end'])) {
                $query->where($params['date_type'], '<=', DatetimeHelper::getDateEnd($params['date_start']));
            }
        }

        //  模糊查询默认只支持右模糊
        if (!empty($params['keywords_type']) && !empty($params['keywords'])) {
            $query->where($params['keywords_type'], 'like', $params['keywords'].'%');
        }

        return $query;
    }
}
