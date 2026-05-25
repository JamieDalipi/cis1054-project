<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);
$jsonFile = __DIR__ . '/Database.json';
$jsonRaw = file_get_contents($jsonFile);
$jsonData = json_decode($jsonRaw, true);
$categoryItems = [];
$category = $_GET['category'] ?? 'Breakfast';

foreach ($jsonData['Data'] as $item) {

    if ($item['Category'] == $category) {

        $categoryItems[] = [
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

echo $twig->render('Category.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => $category,
    'category' => $category,
    'categoryItems' => $categoryItems
]);