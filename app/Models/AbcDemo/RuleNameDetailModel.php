<?php


namespace App\Models\AbcDemo;


use App\Models\BaseModel;

class RuleNameDetailModel extends BaseModel
{
    protected $table = 'demo_rule_name_detail';

    protected $guarded = ['id'];

    public $timestamps = true;
}
