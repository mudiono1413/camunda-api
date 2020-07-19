<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // deklarasi proses name yang akan di jalankan
        $prosesName = 'flow';
         // deklarasi guzzle http client
         $client = $this->client;

        $validator = Validator::make($req->all(), [
            'name'    => 'required|string',
            'nik'     => 'required|string',
            'sex'     => 'required|string',
            'tgllhr'  => 'required|string',
            'tmplhr'  => 'required|string',
            'namaibu' => 'required|string',
        ]);
       

        // validasi input parameter 
        if ($validator->fails()) {
            $responses = [
                'statusCode' => 400,
                'message'    => 'Paramater total tidak boleh kosong',
            ];
            return response()->json([
               'result' => $responses
            ], 400);
        }

       
        // deklarasi url proses start dan tasklist
        $url = "http://localhost:8080/engine-rest/process-definition/key/flow/start";

        // header
        $headers = ['Content-Type' => 'application/json'];

        $bodyTaskComplate = json_encode(
            [
                'variables' => [
                  'name'=> [
                      'value' => $req->name,
                      'type'  => 'String'],
                  'nik'=> [
                      'value' => $req->nik,
                      'type'  => 'String'],
                  'tmplhr'=> [
                      'value' => $req->tmplhr,
                      'type'  => 'String'],
                  'tgllhr'=> [
                      'value' => $req->tgllhr],
                  'sex'=> [
                      'value' => $req->sex,
                      'type'  => 'String'],
                  'namaibu'=> [
                      'value' => $req->namaibu,
                      'type'  => 'String'],
                ]
            ]
        );  

        // dd($bodyTaskComplate);

        // request rest api start psoses 
        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'body'    => $bodyTaskComplate,
        ]);
        // response body start proses
        $response = json_decode( $response->getBody()->getContents());

        // custom respon body
        $responses = [
            'StatusCode'  => 200,
            'message'     => 'success',
            'status Data' => $response,
        ];   

        // menampilkan content respon body
        return response()->json([
            'result' => $responses
        ], 200);
    }


    public function apiRO(Request $req){
        $client = $this->client;
        $flag   = 0;
        $urlRo  = "http://repo.fifgroup.co.id:10702/commons/api/v2/customers";

        $urlToken = "http://testauthtoken.fifgroup.co.id:8380/auth/realms/fifgroup/protocol/openid-connect/token";
        
       
        $reqClient = $client->request('POST',
        $urlToken,[
            // 'headers'     => $headers,
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => 'fifgroup-token',
                'client_secret' => '261f1b80-7a18-438e-b9fa-2f9575c97e0b',
                'username'      => 'repo',
                'password'      => 'repo123'
            ]
        ]);

        $reqClient = json_decode($reqClient->getBody()->getContents());
        $token = "Bearer ".$reqClient->access_token;
        $body   = json_encode(
            [
                'pob'            => $req->pob,
                'dob'            => $req->dob,
                'sex'            => $req->sex,
                'motherName'     => $req->motherName,
                'name'           => $req->name,
                'identityNo'     => $req->identityNo,
                'requestBy'      => $req->requestBy,
                'requestChannel' => $req->requestChannel,
                'requestId'      => $req->requestId
            ]
        );
        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => $token
                    ];
                    
        $reqClient = $client->request(
            'POST', $urlRo, [
                'body'    => $body,
                'headers' => $headers
            ]
            );
            $reqClient = json_decode($reqClient->getBody()->getContents());
            if (count($reqClient->data) != 0) {
              $flag = 1;
            } else {
               $flag = 0;
            }
            
            return response()->json($flag, 200);
    }

    public function apiMatchingData(Request $req){
        $client          = $this->client;
        $statausData     = "Data sesuai";
        $codeStatusData  = 0;
        $urlMatchingData = "http://10.17.36.10:2020/data-compare/compareData";
        
        $body            = json_encode(
            [
                'nik'                    => $req->nik,
                'nama'                   => $req->nama,
                'tmp_lhr'                => $req->tmp_lhr,
                'tgl_lhr'                => $req->tgl_lhr,
                'jns_klm'                => $req->jns_klm,
                'nama_ibu'               => $req->nama_ibu,
                'flagRo'                 => $req->flagRo,
                'fif_branch_code'        => "00001",
                'fif_app_code'           => "FIFAPP03",
                'fif_app_ip_address'     => "10.172.176.7",
                'fif_app_admin_user_id'  => "FIFAWDA",
                'fif_app_admin_user_pwd' => "fifawda@123",
                'fif_app_user_id_login'  => "9551",
                'fif_app_kios_pos_code'  => "00001",
                'fif_app_no_permohonan'  => "123"
            ]
            );
            $headers = [
                'Content-Type' => 'application/json'
                        ];
            $reqClient = $client->request(
                'POST', $urlMatchingData, [
                    'body'    => $body,
                    'headers' => $headers
                ]
            );

            $reqClient   = json_decode($reqClient->getBody()->getContents());
            $statausData = $reqClient->statusData;

            if ($statausData == "Data Terindikasi Fraud") {
                $codeStatusData = 1 ;
            } else {
                $codeStatusData = 0 ;
            }
            
            return response()->json($codeStatusData, 200);
            
    }

    public function getToken(Request $req){
        $headers  = [
            'Content-Type' => 'application/x-www-form-urlencoded'
                    ];
        
        $client   = $this->client;
        $urlToken = "http://testauthtoken.fifgroup.co.id:8380/auth/realms/fifgroup/protocol/openid-connect/token";
        
       
        $reqClient = $client->request('POST',
        $urlToken,[
            // 'headers'     => $headers,
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => 'fifgroup-token',
                'client_secret' => '261f1b80-7a18-438e-b9fa-2f9575c97e0b',
                'username'      => 'repo',
                'password'      => 'repo123'
            ]
        ]);

        $reqClient = json_decode($reqClient->getBody()->getContents());
        $token = "Bearer ".$reqClient->access_token;
        return response()->json($token, 200);


    }
}
