<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);
$jsonFile = __DIR__ . '/Database.json';
$jsonRaw = file_get_contents($jsonFile);
$jsonData = json_decode($jsonRaw, true);
$breakfastItems = [];
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Breakfast') {

        $breakfastItems[] = [
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
echo $twig->render('Breakfast.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'Breakfast.php',
    'breakfast' => $breakfastItems
]);
