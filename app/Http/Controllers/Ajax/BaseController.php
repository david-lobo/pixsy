<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Cache;

class BaseController extends Controller
{
    protected $request;

    protected $data;

    public function __construct(Request $request)
    {
        $this->data['route'] = \Request::route()->getName();
        $this->request = $request;
    }

    public function list(Request $request, $fn = null)
    {
        $cacheKey = $this->cacheKey();
        $input = $request->all();
        $numRecords = $input['limit'] ?? 10;
        $minutes = 0;
        $data = Cache::remember($cacheKey, $minutes, $fn);
        $data = is_null($data) ? [] : $data;

        return response($data->jsonSerialize(), Response::HTTP_OK);
    }

    public function sendResponse($result, $message = 'OK')
    {
        $response = [
            'success' => true,
            'payload'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function cacheKey()
    {
        $url = request()->url();
        $queryParams = request()->query();

        // Sorting query params by key (acts by reference)
        ksort($queryParams);

        // Transforming the query array to query string
        $queryString = http_build_query($queryParams);

        $fullUrl = "{$url}?{$queryString}";

        return $fullUrl;
    }
}
