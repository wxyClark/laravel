<?php


namespace App\Models\AbcDemo;


use App\Models\BaseModel;

class RuleBDetailModel extends BaseModel
{
    protected $table = 'demo_rule_b_detail';

    protected $guarded = ['id'];

    public $timestamps = false;
}
