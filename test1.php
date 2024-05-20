<?php

class Challenge
{
    public function invertirCadena($string): string
    {
        echo "<p/>[1] Invertir string <br/>";
        $array = str_split($string);
        $aux = count($array)-1;
        $res = '';
        for($i=$aux; $i >=0; $i--) {
           $res .= $array[$i] . " ";
        }
        return $res;
    }

    public function getFibonacciSeries($number): array
    {
        echo "<p/>[2] Serie de Fibonacci <br/>";
        if ($number < 0) {
            return ["Error on number, must be > 0"];
        }
        if ($number == 0) return ["0"];
        if ($number == 1) return ["1"];
        if ($number == 2) return ["3"];
        $fib = [0,1];
        for($i=2; $i<$number; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib;
    }

    public function getPrimo($n)
    {
        echo "<p/>[3] Es Primo o no <br/>";

        $res = $n . " NO es primo";
        if ($n > 10) {
            if ($n % 2 != 0 && $n % 3 != 0 && $n % 5 != 0 && $n % 7 != 0 && $n % 9 != 0) {
                $res = $n . " SI Es primo";
            }
        }
        return $res;
    }

    public function cuentaPalabras(string $text)
    {
        echo "<p/>[4] Cuenta palabras <br/>";

        $words = $wordsDone = array();
        $array = explode(" ", $text);
        foreach ($array as $key => $word) {
            $c = 0;
            if (!in_array($word, $wordsDone)) {
                foreach ($array as $item) {
                    if ($word == $item) {
                        $c++;
                    }
                }
                $wordsDone[] = $word;
                $words[$word] = $c;
            }
        }

        return $words;
    }

    public function expresionesEquilibradas(string $str1, string $str2)
    {
        echo "<p>[5] Expresiones aquilibradas <br>";
        echo $str1 . " <br> ";
        echo $str2 . " <br> ";

        // out1 debe tener todo lo que está en str1 pero no en la str2
        // out2 debe tener todo lo que está en str2 pero no en la str1

        $arr1 = str_split($str1);
        $arr2 = str_split($str2);
        $lettersProcessed1 = $lettersProcessed2 = array();
        $out1 = $out2 = '';

        foreach ($arr1 as $item) {
            if (!in_array($item, $lettersProcessed1) && !in_array($item, $arr2)) {
                $out1 .= $item;
                $lettersProcessed1[] = $item;
            }
        }
        foreach ($arr2 as $item) {
            if (!in_array($item, $lettersProcessed2) && !in_array($item, $arr1)) {
                $out2 .= $item;
                $lettersProcessed2[] = $item;
            }
        }



        echo " -- Estan en 1 pero no en 2: " . $out1 . "<br>";
        echo " -- Estan en 2 pero no en 1: " . $out2 . "<br>";
        return [$out1, $out2];
    }

    public function isPalindromo(string $string)
    {
        echo "<p>[6] Es Palindromo <br>";
        $newStr = strtolower(str_replace(' ' , '', $string));
        $str = str_split($newStr);
        $length = count($str);
        $evaluate = '';
        for($i = 0 ; $i<$length; $i++) {
            $evaluate .= $str[$length - ($i+1)];
        }
        if($newStr == $evaluate) {
            echo "<p >Es palindromo: <p>";
        }

        echo "[a]: " . $newStr;
        echo "<br> [b]: " . $evaluate;

    }

    private function processData($rowData) {
        $result = [];
        foreach ($rowData['items'] as $data) {
            $name = $data['name'];
            $ki = $data['ki'];
            $result[] = ' Name: ' . $name . ' Ki: ' . $ki ;
        }
        return $result;
    }
    public function getDataFromAPIByFileGetContents()
    {
        echo "<p>+++++++++++++++++++++++++++++++++++++++++<br>";
        $url = 'https://dragonball-api.com/api/characters';
        $response = file_get_contents($url);
        $rowData = json_decode($response, true);
        if ($rowData) {
            echo "Get Dragon Ball chars from fileGetContent: <p>";
            $response = $this->processData($rowData);
            echo implode(' ||', $response);
        } else {
            $jsonError = json_last_error_msg();
            echo "Error al decodificar JSON: $jsonError";
        }
    }

    public function getDataFromAPIByCurl()
    {
        echo "<p>+++++++++++++++++++++++++++++++++++++++++<br>";
        $url = 'https://dragonball-api.com/api/characters';
        $curl = curl_init($url);
        curl_setopt($curl,  CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if ($response == false) {
            echo 'Error en la solicitud';
        } else {
            $data = json_decode($response, true);
            if ($data) {
                echo "Get Dragon Ball chars from Curl: <p>";
                $response = $this->processData($data);
                echo implode(' ||', $response);
            }
        }
    }

    private function processAnything($cont)
    {
        $cont++;
        if ($cont < 10) {
            $cont = $this->processAnything($cont);
        }
        return $cont;
    }
    public function useFunctionRecursive()
    {
        echo "<p>+++++++++++++++++++++++++++++++++++++++++<br>";
        $aux= 0;
        $cont = $this->processAnything($aux);
        echo " == Contador es: " . $cont;
    }

    public function quickSort($arr)
    {
        $count = count($arr);

        if ($count <= 1) return $arr;

       $left = $right = [];
       $pivot = $arr[0];
       for ($i=1; $i<$count; $i++) {
           if ($arr[$i] < $pivot ) {
               $left[] = $arr[$i];
           } else {
               $right[] = $arr[$i];
           }
       }
       return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    public function iterateOverMap(array $array)
    {
        $t1 = hrtime(true);
        $r = array_map(function($item){
            return $item*$item;
        }, $array);
        $t2 = hrtime(true);
        echo "total: " . (($t2 - $t1)/1e9) * 1000 . " segs. ";
        var_dump($r);
    }
}

$w = new Challenge();

echo $w->invertirCadena("Hola mundo");

$string = 'Fibonacci serie';
echo $string . ': ' . array_pop($w->getFibonacciSeries(4));

$number = 1987;
echo $string . ': ' . $w->getPrimo($number);

$string = "hola mundo hello world mundo hola hola";
echo $string . ': ' . print_r($w->cuentaPalabras($string));

$w->expresionesEquilibradas('saludosdesdevenezuela', 'quieroiralaplaya' );

$w->isPalindromo('Ana lleva al oso la avellana');
$w->getDataFromAPIByFileGetContents();
$w->getDataFromAPIByCurl();
$w->useFunctionRecursive();
echo "<p>+++++++++++++++++++++++++++++++++++++++++<br> Array Ordenado: ";
$sortedArr = $w->quickSort([3,5,12,3,10,1,2,100]);
print_r($sortedArr);
echo "<p>+++++++++++++++++++++++++++++++++++++++++<br> ArrayMap: ";
$w->iterateOverMap([3,5,12,3,10,1,2,100]);