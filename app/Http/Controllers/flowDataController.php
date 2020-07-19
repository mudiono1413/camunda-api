<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Responses; 
use RealRashid\SweetAlert\Facades\Alert;

class flowDataController extends Controller
{
    //
    protected $client;

    public function __construct()
    {
        //
        $this->client = new \GuzzleHttp\Client();
    }

    public function Index(){
        return view('Form.index');
    }

    public function startService(Request $req){
        $messege = "";
        $flag = 0;
        $nama ="";
        $nik;
        $gender ="";
        $tgllhr ="";
        $tmplhr ="";
        $namaibu = "";
        $client = $this->client;
        $url  = "http://127.0.0.1:8085/msgeventstart";
        $headers = [
            'Content-Type'  => 'application/json'
                    ];
        $body = json_encode([
                'name'=> $req->nama,
                'gender' => $req->jk,
                "nik" => $req->nik,
                'tgllahir' => $req->tgllhr,
                'tmplahir' => $req->tmplhr,
                'namaibu' => $req->namaibu
            ]);
        $reqClient = $client->request('POST',
        $url,[
            'headers' => $headers,
            'body'=> $body
        ]);
        $reqClient = json_decode($reqClient->getBody()->getContents());
        $nik = $reqClient->nik;
        $nama = $reqClient->name;
        $gender = $reqClient->gender;
        $tgllhr = $reqClient->tgllahir;
        $tmplhr = $reqClient->tmplahir;
        $namaibu = $reqClient->namaibu;
        if ($reqClient->flagRo == "1" && $reqClient->flagDukcapil == "1" && $reqClient->matchRo == "match") {

            $messege = "Customer RO, Terdaftar di Dukcapil";
            $flag = "1";
        } else if($reqClient->flagRo == "0" && $reqClient->flagDukcapil == "1" && $reqClient->matchDukcapil == "Match") {
            $messege = "New Customer, Terdaftar di dukcapil";
            $flag = "1";
        }else if($reqClient->flagPefindo == "1" && $reqClient->matchPefindo == "Match"){
            $messege = "New Customer, Terdaftar di Pefindo";
            $flag = "1";
        }elseif ($reqClient->flagPefindo == "1" && $reqClient->matchPefindo == "Not Match") {
            $messege = 'Customer Teridentifikasi Fraud !';
            $flag = '1';
        };
        // dd($reqClient->flagRo);
        
        // return Responses::res(200,'Success','Berhasil submit!');
        // dd($messege,$flag);
        //  return view('Form.Aproval',compact('messege'));
        Alert::success('Success', $messege);
        $html = view('Form.form',compact('messege','flag','nama','gender','tgllhr','tmplhr','namaibu','nik'))->render();
        return ['html'=>$html];
        
    }
}
