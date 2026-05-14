<?php

// 1. Load the Composer Autoloader (Required for Twig to work) may be changed for folders
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);

// 3. Get the ID from the URL (e.g., details.php?a=3)
$idToFind = $_GET['id'];
$categoryToFind = $_GET['category'];

if ($idToFind) {
    // 4. Load and decode the JSON data
    $jsonFile = __DIR__ . '/Database.json';

    if (file_exists($jsonFile)) {
        $jsonRaw = file_get_contents($jsonFile);
        $jsonData = json_decode($jsonRaw, true);

        $foundItem = null;

        // 5. Search for the matching ID in the "Data" array

        foreach ($jsonData['Data'] as $item) {
            if (
                (string)$item['ID'] === (string)$idToFind &&
                (string)$item['Category'] === (string)$categoryToFind
            ) {
                $foundItem = $item;
                break;
            }
        }
        if ($foundItem) {
            $viewItem = [
                'id' => $foundItem['ID'],
                'name' => $foundItem['Name'],
                'image' => $foundItem['img'],
                'desc' => $foundItem['desc'],
                'longDesc' => $foundItem['longDesc'] ?? '',
                'ingredients' => $foundItem['Ingredients'],
                'category' => $foundItem['Category'], // normalized lowercase key
                'price' => $foundItem['Price']
            ];

            echo $twig->render('Details.twig', [
                'item' => $viewItem
            ]);
        } else {
            echo $twig->render('404.twig');
        }
    } else {
        die("Error: database.json not found.");
    }
} else {
    echo $twig->render('404.twig');
}
