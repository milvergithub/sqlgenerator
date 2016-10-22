<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

use Dingo\Api\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*Fixes dingo/api form request validation https://github.com/dingo/api/wiki/Errors-And-Error-Responses#form-requests*/
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }
    }

    public function sendResponse($result, $message,$isList=null)
    {
        if ($isList==null)
            return Response::json(ResponseUtil::makeResponse($message, $result));
        else
            return Response::json(ResponseUtil::makeResponseList($message, $result));    
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}
