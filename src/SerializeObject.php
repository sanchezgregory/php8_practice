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

interface PokemonContract {
    public function getName();

    public function getWeight();

    public function getAbilities();

    public function getMoves();
}

class Pokemon implements PokemonContract{
    private $name;
    private $weight;
    private $abilities = [];
    private $moves = [];
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

    public function getName()
    {
        return $this->name;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getAbilities()
    {
        return $this->abilities;
    }

    public function getMoves()
    {
        return $this->moves;
    }
}
$pokemonUrl = 'https://pokeapi.co/api/v2/pokemon/25';
$pokemonData = fetchJsonData($pokemonUrl);

if ($pokemonData === null) {
    echo 'Error fetching data';
    exit;
}
$pokemon = new Pokemon($pokemonData);
echo $pokemon->getName();
echo $pokemon->getWeight();
echo "\n [ Abilities ] ";
foreach ($pokemon->getAbilities() as $i => $ability) {
    echo "\n$i  $ability";
}
echo "\n [ Moves ] ";
foreach ($pokemon->getMoves() as $i => $move) {
    echo "\n$i  $move";
}
echo "\n";