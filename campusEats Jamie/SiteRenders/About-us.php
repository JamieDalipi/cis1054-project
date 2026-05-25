<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

echo $twig->render('About-us.twig', [
    'siteName' => 'CampusEats',
    'currentPage' => 'About-us.php'
]);