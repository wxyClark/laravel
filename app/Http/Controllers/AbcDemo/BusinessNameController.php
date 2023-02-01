<?php


namespace App\Http\Controllers\AbcDemo;

use App\Enums\ErrorCodeEnums;
use App\Http\Controllers\Controller;
use App\Services\AbcDemo\BusinessNameService;
use Illuminate\Http\Request;

/**
 * @desc Demo控制器
 * @package App\Http\Controllers
 */
class BusinessNameController extends Controller
{
    protected $service;

    public function __construct(BusinessNameService $service)
    {
        $this->service = $service;
    }

    /**
     * @desc demo
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function demo(Request $request)
    {
        try {
            //  如果参数不需要校验，直接使用 Illuminate\Http\Request
            return $this->responseJson(ErrorCodeEnums::ERROR_CODE_DEFAULT, ['params' => $request->input()], '');
        } catch (\Exception $e) {
            return $this->responseJson($e->getCode(), [], $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        try {
            //  如果参数需要校验，必须使用 App\Requests\BaseRequest
        } catch (\Exception $e) {
            return $this->responseJson($e->getCode(), [], $e->getMessage());
        }
    }
}
