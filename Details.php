<?php 

// 1. Load the Composer Autoloader (Required for Twig to work) may be changed for folders
require_once __DIR__ . '/vendor/autoload.php';

// 2. Initialize Twig
// This tells Twig to look for your .twig files in a folder named 'templates' (or 'views')
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

// 3. Get the ID from the URL (e.g., details.php?a=3)
$idToFind = $_GET['a'] ?? null;

if ($idToFind) {
    // 4. Load and decode the JSON data
    $jsonFile = __DIR__ . '/database.json';
    
    if (file_exists($jsonFile)) {
        $jsonRaw = file_get_contents($jsonFile);
        $jsonData = json_decode($jsonRaw, true);
        
        $foundItem = null;

        // 5. Search for the matching ID in the "Data" array
        foreach ($jsonData['Data'] as $item) {
            // Check if the ID matches (casting to string for safety)
            // may remove or add somethings where neccessary
            if ((string)$item['ID'] === (string)$idToFind) {
                $foundItem = [
                    'id'       => $item['ID'],
                    'name'     => $item['Name'],
                    'image'    => $item['img'],
                    'desc'     => $item['desc'],
                    'longDesc' => $item['longDesc'],
                    'category' => $item['Catagory'],
                    'price'    => $item['Price']
                ];
                break;
            }
        }

        if ($foundItem) {
            // 6. Render the template
            echo $twig->render('details.twig', ['item' => $foundItem]);
        } else {
            echo $twig->render('404.twig');
        }
    } else {
        die("Error: database.json not found.");
    }
} else {
    echo $twig->render('404.twig');
}
