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

        foreach ($items as $item){
            $response = $client->request('GET', $urlBase.$item.$urlParameters);
            $respuesta = json_decode($response->getBody(),true);

            if(isset($respuesta["icon"]) && $respuesta["icon"]!=""){
                array_push($array,$respuesta);
            }
        }

        $data = [
            "response" => $array,

        ];
        return view('testView',$data);
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
                array_push($arrayFiltrado,rawurlencode($item["name"]));
            }
        }
        $finalArray = [];
        foreach (array_rand ($arrayFiltrado,10) as $element){
            array_push($finalArray,$arrayFiltrado[$element]);
        }
	    return json_encode($finalArray);
    }
}
