<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

$jsonFile = __DIR__ . '/Database.json';
$jsonRaw = file_get_contents($jsonFile);
$jsonData = json_decode($jsonRaw, true);

$items = [];

foreach ($jsonData['Data'] as $item) {
    $items[] = [
        'id' => $item['ID'],
        'name' => $item['Name'],
        'image' => $item['img'],
        'desc' => $item['desc'],
        'Ingredients' => $item['Ingredients'],
        'category' => $item['Category'],
        'price' => $item['Price']
    ];
}

echo $twig->render('Favorites.twig', [
    'item' => $items,
    'currentPage' => 'Favorites'
]);
