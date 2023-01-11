<?php


namespace App\Http\Controllers;

/**
 * @desc Demo控制器

 * @package App\Http\Controllers
 */
class AbcDemoController extends Controller
{
    protected $service;

    public function __construct(AbcDemoService $service)
    {
        $this->service = $service;
    }
}
