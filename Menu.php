<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);

echo $twig->render('Menu.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'Menu.php'
]);
