<?php

namespace App\Repositories\AbcDemo;

use App\Repositories\BaseRepository;

class RelationNameRepository extends BaseRepository
{
    protected $model;

    public function __construct(
        RelationNameModel $model
    ) {
        $this->model = $model;
    }
}
