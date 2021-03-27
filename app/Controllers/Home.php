<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
    }

	public function test(){
	    $items = [
	        "StatTrak™%20Desert%20Eagle%20%7C%20Corinthian%20%28Minimal%20Wear%29",
            "StatTrak™%20Desert%20Eagle%20%7C%20Blue%20Ply%20%28Factory%20New%29",
            "StatTrak™%20Desert%20Eagle%20%7C%20Mecha%20Industries%20%28Field-Tested%29",
            "StatTrak™%20Desert%20Eagle%20%7C%20Conspiracy%20%28Minimal%20Wear%29"
            ];
	    $urlBase = "http://csgobackpack.net/api/GetItemPrice/?currency=ARS&id=";
        $urlParameters = "&time=7&icon=1";
        $client = Services::curlrequest();
        $array = [];

        foreach ($items as $item){
            $response = $client->request('GET', $urlBase.$item.$urlParameters);
            $respuesta = json_decode($response->getBody(),true);

            if($respuesta["icon"]!=""){
                array_push($array,$respuesta);
            }
        }

        $data = [
            "response" => $array,

        ];
        return view('testView',$data);
    }
}
