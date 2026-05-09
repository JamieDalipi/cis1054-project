<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);

echo $twig->render('Sushi.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'Sushi.php'
]);
