<?php


namespace App\Models\AbcDemo;


use App\Models\BaseModel;

class BusinessNameDetailModel extends BaseModel
{
    protected $table = 'demo_business_name_detail';

    protected $guarded = ['id'];

    public $timestamps = false;
}
