<?php

namespace App\Http\Controllers\External;

use Illuminate\Http\Request;
use App\Http\Controllers\NormalizedController;
use App\Http\Requests\Weather\GetRequest;
use GuzzleHttp\Exception\BadResponseException;
use App\Services\Weather\Get as WeatherGet;
use App\RequestCountHistory;

class WeatherController extends NormalizedController
{
    public function index(GetRequest $request)
    {
        try
        {
            $this->normarize_request($request);

            // Request
            $WeatherGet = new WeatherGet($request);
            $WeatherGet->apiRequest();
            $GetResponse = $WeatherGet->get_response();
            $response = $GetResponse->formatResponse();

            // Insert a request history
            $requestCountHistory = new RequestCountHistory();
            $requestCountHistory->setHistory(RequestCountHistory::TYPE_ID['getCurrentWeather']);

            return $this->normarize_multiple_response($response);
        }
        catch (BadResponseException $e)
        {
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);
            return response()->json($response, $e->getResponse()->getStatusCode());
        }
    }
}
