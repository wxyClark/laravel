<?php


namespace App\Http\Controllers\AbcDemo;

use App\Enums\ErrorCodeEnums;
use App\Http\Controllers\Controller;
use App\Requests\AbcDemo\BusinessName\IndexRequest;
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
            return $this->responseJson(ErrorCodeEnums::ERROR_CODE_DEFAULT, ['params' => $request->input()], __METHOD__);
        } catch (\Exception $e) {
            return $this->responseJson($e->getCode(), [], $e->getMessage());
        }
    }

    /**
     * @desc 如果参数需要校验，必须使用 App\Requests\BaseRequest 的子类 如果参数不需要校验，直接使用 BaseRequest
     * @param  IndexRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request)
    {
        try {
            $this->validateRequest($request);

            return $this->responseJson(ErrorCodeEnums::ERROR_CODE_DEFAULT, ['params' => $request->input()]);
        } catch (\Exception $e) {
            return $this->responseJson($e->getCode(), [], $e->getMessage());
        }
    }

    /**
     * @desc 如果参数需要校验，必须使用 App\Requests\BaseRequest 的子类 如果参数不需要校验，直接使用 BaseRequest
     * @param  IndexRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request)
    {
        try {
            $rules = [
                'tenant_id' => ['required|integer|min:0', '租户ID'],
                'uniq_code' => ['required|integer|min:0', '业务编码'],
            ];
            $this->validateParams($request->input(), $rules);

            return $this->responseJson(ErrorCodeEnums::ERROR_CODE_DEFAULT, ['params' => $request->input()]);
        } catch (\Exception $e) {
            return $this->responseJson($e->getCode(), [], $e->getMessage());
        }
    }
}
