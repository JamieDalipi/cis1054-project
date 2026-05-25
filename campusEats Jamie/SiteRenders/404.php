<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';
$page = $_GET['page'] ?? '';

if (!file_exists($page . '.php')) {
    require '404.php';
    exit;
}
$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

http_response_code(404);

echo $twig->render('404.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => '404.php'
]);