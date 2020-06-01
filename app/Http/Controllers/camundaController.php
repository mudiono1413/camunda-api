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

    public function Task(Request $req){
        $status     = true;
        $prosesName = 'approveInvoice';
        if ($req->total == null) {
            return response()->json([
                'status'  => true,
                'message' => 'Jumlah tidak boleh kosong',
            ], 400);
        }

        if ($req->total > 300000) {
            $status = false;
        } else {
            $status = true;
        }

        
        $client      = $this->client;
        $url         = env('BASE_URL')."/process-definition/key/$prosesName/start";
        $urlTaskList = env('BASE_URL')."/task";

        // header
        $headers = ['Content-Type' => 'application/json'];

        // request rest api start psoses 
        $response = $client->request('POST', $url, [
            'headers' => $headers
        ]);

        $response = json_decode( $response->getBody()->getContents());
        // proses id didapat dari respon task start
        $ProsesId = $response->id;

        // request body task list
        $bodyTaskList   = [
            'processInstanceId' => $ProsesId
        ];

        // request rest api task list berdasarkan proses id yang sedang berjalan
        $responseTasklist = $client->request('GET', $urlTaskList, [
            'query' => $bodyTaskList
            // 'headers' => $headers
        ]); 

        // respon body task list yang sedang berjalan
        $responseTasklist = json_decode( $responseTasklist->getBody()->getContents());
        // mengambil task id dari respon bosy task list 
        $TaskId = $responseTasklist[0]->id;

        // set url untuk menyelesaikan task berdasarkan id task
        $urltaskComplate = env('BASE_URL')."/task/$TaskId/complete";

        // request body variable 
        //  nama variable , value dan type ditentukan sesuai kebutuhan
    
        $bodyTaskComplate = json_encode(
            [
                'variables' => [
                  'approved'=> [
                      'value' => $status,
                      'type'  => 'Boolean']
                ]
            ]
        );

        // request rest api complate task
        $responseTaskComplate = $client->request('POST', $urltaskComplate, [
            'body'    => $bodyTaskComplate,
            'headers' => $headers
        ]); 
        
        //    respon body task complate
        // secara default respon body dari task complate no content ( null )
        $responseTaskComplate = json_decode( $responseTaskComplate->getBody()->getContents());

        // custom respon body
        $responses = [
            'StatusCode'  => 200,
            'message'     => 'success',
            'status Data' => $status,
            'Data'        => 'jumlah yang di input '. $req->total,
        ];   

        return response()->json([
            'result' => $responses
        ], 200);
    }
}
