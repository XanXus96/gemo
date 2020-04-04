<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\GithubReposTrait;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\ValidationException;

class GithubReposController extends Controller
{
    use GithubReposTrait;

    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * 
     * @return Response
     */
    public function getTopLanguages(Request $request)
    {
        // get the current datetime
        $currentDate = Carbon::now();
        
        try {
            // validate optional query string 'date'
            request()->validate([
                'date' => ['sometimes', 'date_format:Y-m-d\TH:i:s\Z', 'before_or_equal:'.$currentDate]
            ]);
        } catch (ValidationException $e){
            // return array of errors to client with status code 422
            return response($e->errors(), 422);
        }

        // date equals the coming query string from the request or the current datetime minus one month
        $date = $request->date ?: $currentDate->subMonth()->toIso8601ZuluString();

        try {
            // hits the api
            $response = Http::get('https://api.github.com/search/repositories?q=created:>'.$date.'&sort=stars&order=desc&per_page=100');
            // throws an exception on client 4xx or server 5xx errors
            $response->throw();
        } catch (RequestException $e) {
            return response('Client or Server Error encountered', $response->status());
        } catch (Exception $e) {
            return response('Unknown Error', 501);
        }
        
        return response($this->formatResponse($response));;
    }

     /**
     * format response to the needs
     * 
     * @param Http $response
     * 
     * @return Array
     */
    private function formatResponse($response) {
        
        $grouppedArray = $this->groupBy('language', $response->json()['items']);
        $sortedArray = $this->sortByCountDesc($grouppedArray);

        $result = array();

        foreach($sortedArray as $key => $val) {
            $result[$key] = ['total' => count($val), 'items' => $val ];
        }

        return $result;
    }

}
