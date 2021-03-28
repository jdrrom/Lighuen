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
	    $items = json_decode($this->traerItems());
	    $urlBase = "http://csgobackpack.net/api/GetItemPrice/?currency=ARS&id=";
        $urlParameters = "&time=7&icon=1";
        $client = Services::curlrequest();
        $array = [];
        $falsos = [];

        foreach ($items as $item){
            $response = $client->request('GET', $urlBase.rawurlencode($item).$urlParameters);
            $respuesta = json_decode($response->getBody(),true);

            $respuesta["name"]=$item;
            if($respuesta["success"]=="true"){
                array_push($array,$respuesta);
            }
            else{
                array_push($falsos,$respuesta);
            }
        }

        $data = [
            "response" => $array,
            "falsos" => $falsos,

        ];
        return view('testView',$data);
//        return json_encode($data);
    }

    public function todo(){
	    $url ="http://csgobackpack.net/api/GetItemsList/v2/?no_details=1&currency=ARS";
        $client = Services::curlrequest();
        $response = $client->request('GET', $url);
        $respuesta = json_decode($response->getBody(),true)["items_list"];
        $arrayFiltrado = [];
        foreach ($respuesta as $item){
            if(isset($item["price"])){
                $item["url"]=rawurlencode($item["name"]);
                array_push($arrayFiltrado,$item);
            }
        }


        return json_encode($arrayFiltrado);
    }

    public function traerItems(){
        $url ="http://csgobackpack.net/api/GetItemsList/v2/?no_details=1&currency=ARS";
        $client = Services::curlrequest();
        $response = $client->request('GET', $url);
        $respuesta = json_decode($response->getBody(),true)["items_list"];
        $arrayFiltrado = [];
        foreach ($respuesta as $item){
            if(isset($item["price"])){
                array_push($arrayFiltrado,$item["name"]);
            }
        }
        $finalArray = [];
        foreach (array_rand ($arrayFiltrado,10) as $element){
            array_push($finalArray,$arrayFiltrado[$element]);
        }
	    return json_encode($finalArray);
    }
}
