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
	    $url = "http://csgobackpack.net/api/GetItemPrice/?currency=USD&id=AK-47%20|%20Wasteland%20Rebel%20(Battle-Scarred)&time=7&icon=1";
        $client = Services::curlrequest();
        $response = $client->request('GET', $url);
        $data = [
            "respone" => $response->getBody()
        ];
        return view('testView',$data);
    }
}
