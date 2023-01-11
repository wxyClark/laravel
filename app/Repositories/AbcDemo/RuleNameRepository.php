<?php

namespace App\Repositories\AbcDemo;

use App\Repositories\BaseRepository;

class RuleNameRepository extends BaseRepository
{
    protected $model;

    protected $detailModel;

    protected $logModel;

    public function __construct(
        BusinessBNameModel $model,
        BusinessBNameDetailModel $detailModel,
        BusinessBNameLogModel $logModel
    ) {
        $this->model = $model;
        $this->detailModel = $detailModel;
        $this->logModel = $logModel;
    }
}
