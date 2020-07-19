<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Responses; 
use RealRashid\SweetAlert\Facades\Alert;

class approveController extends Controller
{
    //
    protected $client;

    public function __construct()
    {
        //
        $this->client = new \GuzzleHttp\Client();
    }

    public function Index(){
        return view('welcome');
    }

    public function approve(Request $req){
        // dd($req->all());
        $client = $this->client;
        $url  = "http://127.0.0.1:8085/approve";
        $headers = [
            'Content-Type'  => 'application/json'
                    ];
                    
        $body = json_encode([
            'name'=> $req->nama,
            'gender' => $req->jk,
            'nik' => $req->nik,
            'tgllahir' => $req->tgllhr,
            'tmplahir' => $req->tmplhr,
            'namaibu' => $req->namaibu
        ]);
        // dd($body);
        $reqClient = $client->request('POST',$url,[
            'query' => ['approve' => $req->approve],
        ]);
        $reqClient = json_decode($reqClient->getBody()->getContents());
        Alert::success('Success', 'Data berhasil diApprove');
        $html = view('Form.index')->render();
        return ['html'=>$html];
    }
}
