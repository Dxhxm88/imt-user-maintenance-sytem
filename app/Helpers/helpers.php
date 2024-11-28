<?php

use App\Constants\Response;
use Illuminate\Http\Response as HttpResponse;

function respond($errCode = Response::ERR_CODE_SUCCESS, $errMsg = "", $data = null, $statusCode = HttpResponse::HTTP_OK)
{
    $response = [
        'errCode' => $errCode,
        'errMsg' => $errMsg
    ];

    if (!is_null($data)) {
        $response['Data'] = $data;
    }

    return response()->json($response, $statusCode);
}
