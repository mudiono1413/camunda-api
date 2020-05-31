<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class camundaController extends Controller
{
    //
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $client;

    public function __construct()
    {
        //
        $this->client = new \GuzzleHttp\Client();
    }

    public function TaskStart(Request $req){
        $client = $this->client;
        $url    = env('BASE_URL')."/process-definition/key/$req->prosesName/start";
    
        $body = json_encode(
            [
                'variables' => [
                  'approved'=> [
                      'value' => 'true',
                      'type'  => 'Boolean']
                ]
            ]
              
        );
        $headers  = ['Content-Type' => 'application/json'];
        $response = $client->request('POST', $url, [
            'body'    => $body,
            'headers' => $headers
        ]); 
       
        $response = json_decode( $response->getBody()->getContents());
        $ProsesId = $response->id;
        // $req->session()->put('ProsesId',$ProsesId);
        session(['prosesId' => $ProsesId]);
        // $req->session()->put('nama','Diki Alfarabi Hadi');
        return response()->json(['message' =>session()->all()], 200);
    }
    
    public function TaskList(Request $req){
        $client = $this->client;
        $url    = env('BASE_URL')."/task";
        $body   = [
                'processInstanceId' => session()->get('prosesId')
            ];
        $headers  = ['Content-Type' => 'application/json'];
        $response = $client->request('GET', $url, [
            'query' => $body
            // 'headers' => $headers
        ]); 
       
        $response = json_decode( $response->getBody()->getContents());
        return response()->json(['message' => session()->all()], 200);
    }


    public function TaskComplate(Request $req){
        $client = $this->client;
        $url    = env('BASE_URL')."/task/$req->idTask/complete";
    
        $body = json_encode(
            [
                'variables' => [
                  'approved'=> [
                      'value' => 'true',
                      'type'  => 'Boolean']
                ]
            ]
              
        );
        $headers  = ['Content-Type' => 'application/json'];
        $response = $client->request('POST', $url, [
            'body'    => $body,
            'headers' => $headers
        ]); 
       
        $response = json_decode( $response->getBody()->getContents());
        return response()->json(['message' => $response], 200);
    }
}
