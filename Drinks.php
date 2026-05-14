<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);
$jsonFile = __DIR__ . '/Database.json';
$jsonRaw = file_get_contents($jsonFile);
$jsonData = json_decode($jsonRaw, true);
$DrinksItems = [];
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Drinks') {

        $DrinksItems[] = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
            'desc' => $item['desc'],
            'Ingredients' => $item['Ingredients'],
            'Category' => $item['Category'],
            'price' => $item['Price']
        ];
    }
}
echo $twig->render('Drinks.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'Drinks.php',
    'drinks' => $DrinksItems
]);
