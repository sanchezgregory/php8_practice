<?php

namespace App;

interface GetContent {
    public function getData(string $url);
}

Trait ProcessData {
    public function process($rowData)
    {
        $result = [];
        foreach ($rowData['items'] as $data) {
            $name = $data['name'];
            $ki = $data['ki'];
            $result[] = ' Name: ' . $name . ' Ki: ' . $ki ;
        }
        return $result;
    }
}
class getDataFromGetContent implements getContent {

    use ProcessData;
    public function getData($url)
    {
        $response = file_get_contents($url);
        $rowData = json_decode($response, true);
        if ($rowData) {
            echo "Get Dragon Ball chars from fileGetContent: <p>";
            $response = $this->process($rowData);
            echo implode(' ||', $response);
        } else {
            $jsonError = json_last_error_msg();
            $response = "Error al decodificar JSON: $jsonError";
        }
        return $response;
    }
}
class getDataFromCurl implements getContent {

    use ProcessData;
    public function getData(string $url)
    {
        $curl = curl_init($url);
        curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if ($response == false) {
            echo 'Error en la solicitud';
        } else {
            $data = json_decode($response, true);
            if ($data) {
                echo "Get Dragon Ball chars from Curl: <p>";
                $response = $this->process($data);
                echo implode(' ||', $response);
            }
        }
    }
}
class DragonBall
{
    private $url;
    private GetContent $getContent;
    const URL = 'https://dragonball-api.com/api/characters';

    public function __construct(GetContent $getContent){
        $this->getContent = $getContent;
        $this->url = self::URL;
    }
    public function getData()
    {
        return $this->getContent->getData($this->url);
    }
}

$apiGC = new getDataFromGetContent();
$apiCurl = new getDataFromCurl();
$DG = new DragonBall($apiCurl);
echo $DG->getData();

