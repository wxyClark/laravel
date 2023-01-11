<?php


namespace App\Models\AbcDemo;


use App\Models\BaseModel;

class RuleBModel extends BaseModel
{
    protected $table = 'demo_rule_b';

    protected $guarded = ['id'];

    public $timestamps = false;
}
