<?php

namespace Factory;

require __DIR__ . '/../vendor/autoload.php';

$docFactory = new DocumentFactory();
$docFactorySelector = new DocumentFactorySelector($docFactory);

$doc = $docFactorySelector->generate('csv');
echo get_class($doc);
$doc->generate();
