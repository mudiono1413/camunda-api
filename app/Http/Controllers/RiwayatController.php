<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Responses; 
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class RiwayatController extends Controller
{
    protected $client;

    public function __construct()
    {
        //
        $this->client = new \GuzzleHttp\Client();
    }


    public function Index(Request $req){

            $client  = $this->client;
            $url     = "http://127.0.0.1:8085/historicTaskInstances";
            $headers = [
                'Content-Type' => 'application/json'
                        ];
            $param = ['processDefinitionId' => 'connector-sample:3:e7b081c9-c9a6-11ea-84df-74c63bc988c7'];

            $reqClient = $client->request('POST',
            $url,[
                'headers' => $headers,
                'query'   => $param
            ]);
            
            $reqClient = json_decode($reqClient->getBody()->getContents());
            $riwayat = $reqClient;
        return view('Riwayat.Index',compact('riwayat'));
       
        
    }
}
