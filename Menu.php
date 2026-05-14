<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);
$jsonFile = __DIR__ . '/Database.json';
$jsonRaw = file_get_contents($jsonFile);
$jsonData = json_decode($jsonRaw, true);
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Breakfast') {

        $foundItem = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
        ];

        break;
    }
}
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Sushi') {

        $foundItem1 = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
        ];

        break;
    }
}
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Main') {

        $foundItem2 = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
        ];

        break;
    }
}
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Desserts') {

        $foundItem3 = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
        ];

        break;
    }
}
foreach ($jsonData['Data'] as $item) {
    if ($item['Category'] == 'Drinks') {

        $foundItem4 = [
            'id' => $item['ID'],
            'name' => $item['Name'],
            'image' => $item['img'],
        ];

        break;
    }
}
echo $twig->render('Menu.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'Menu.php',
    'breakfastItem' => $foundItem,
    'sushiItem' => $foundItem1,
    'mainItem' => $foundItem2,
    'dessertItem' => $foundItem3,
    'DrinksItem' => $foundItem4
]);
