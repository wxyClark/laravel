<?php

namespace App\Services\AbcDemo;

use App\Repositories\AbcDemo\BusinessNameRepository;
use App\Repositories\AbcDemo\RelationNameRepository;

class BusinessNameService
{
    /** @var BusinessNameRepository  */
    protected $businessNameRe;

    /** @var RelationNameRepository  */
    protected $relationNameRe;

    public function __construct(
        BusinessNameRepository $businessNameRe,
        RelationNameRepository $relationNameRe
    ) {
        $this->businessNameRe = $businessNameRe;
        $this->relationNameRe = $relationNameRe;
    }
}
