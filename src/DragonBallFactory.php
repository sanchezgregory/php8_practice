<?php


namespace App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

interface GetContent {
    public function getData(string $url);

    public function getSpeed();
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
        return implode('||', $result);
    }
}
class getDataFromGetContent implements getContent {

    use ProcessData;
    private $time;
    public function getData($url)
    {
        $st = microtime(true);
        $response = file_get_contents($url);
        $rowData = json_decode($response, true);
        if ($rowData) {
            $response = $this->process($rowData);
        } else {
            $jsonError = json_last_error_msg();
            $response = "Error al decodificar JSON: $jsonError";
        }
        $this->time =  microtime(true) - $st;
        return $response;
    }

    public function getSpeed(): string
    {
        return "speed of GetContent is: " . $this->time;
    }
}
class getDataFromCurl implements getContent {

    use ProcessData;
    private $time;
    public function getData(string $url)
    {
        $st = microtime(true);
        $curl = curl_init($url);
        curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if ($response == false) {
            echo 'Error en la solicitud';
        } else {
            $data = json_decode($response, true);
            if ($data) {
                $response = $this->process($data);
            }
        }
        $this->time =  microtime(true) - $st;
        return $response;
    }

    public function getSpeed(): string
    {
        return "speed of Curl is: " . $this->time;
    }
}
class DragonBall
{
    private string $url;
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

    public function getSpeed()
    {
        return $this->getContent->getSpeed();
    }
}

// ...... logica de negocio en algun servicio
$num = 2;
$fetch = factoryClass($num);
function factoryClass($num)
{
    $fetch = match (true) {
        $num <= 5 => new getDataFromGetContent(),
        $num <= 10 => new getDataFromCurl()
    };

    return $fetch;
}
$class = get_class($fetch);
echo strtoupper($class)  ."<br><br><br>";
$DG = new DragonBall($fetch);
echo $DG->getData();
echo $DG->getSpeed();

