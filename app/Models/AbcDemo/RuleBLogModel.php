<?php


namespace App\Models\AbcDemo;


use App\Models\BaseModel;

class RuleBLogModel extends BaseModel
{
    protected $table = 'demo_rule_b_log';

    protected $guarded = ['id'];

    public $timestamps = false;
}
