<?php

namespace App;
function fetchJsonData($pokemonUrl) {

    $curl = curl_init($pokemonUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    if ($response === false) {
        return null;
    }
    $data = json_decode($response, true);
    return $data;
}

class Pokemon {
    public $name;
    public $weight;
    public $abilities = [];
    public $moves = [];
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->weight = $data['weight'];
        foreach($data['abilities'] as $ability) {
            $this->abilities[] = $ability['ability']['name'];
        }
        foreach($data['moves'] as $move) {
            $this->moves[] = $move['move']['name'];
        }
    }
}

$pokemonUrl = 'https://pokeapi.co/api/v2/pokemon/25';
$pokemonData = fetchJsonData($pokemonUrl);

if ($pokemonData === null) {
    echo 'Error fetching data';
    exit;
}
$pokemon = new Pokemon($pokemonData);

echo "\n$pokemon->name";
echo "\n$pokemon->weight";
echo "\n [ Abilities ] ";
foreach ($pokemon->abilities as $i => $ability) {
    echo "\n$i  $ability";
}
echo "\n [ Moves ] ";
foreach ($pokemon->moves as $i => $move) {
    echo "\n$i  $move";
}
echo "\n";