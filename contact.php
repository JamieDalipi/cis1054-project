<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/bootstrap.php';
require_once 'vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__);
$twig = new Environment($loader);

$json = file_get_contents(__DIR__.'/database.json');
$data = json_decode($json, true);

session_start();

$nameErr = $emailErr = $messageErr = "";

$name = $email = $message = "";

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valid = true;

    if (empty($_POST["fname"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["fname"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    if (empty($_POST["comment"])) {
        $messageErr = "Message is required";
        $valid = false;
    } else {
        $message = test_input($_POST["comment"]);
    }

    if ($valid) {

        $_SESSION["form_data"] = [
            "name" => $name,
            "email" => $email,
            "message" => $message
        ];

        header("Location: Redirect.php");
        exit();
    }
}

echo $twig->render('Contact-us.twig', [
    'business' => $data['business'][0],
    'nameErr' => $nameErr,
    'emailErr' => $emailErr,
    'messageErr' => $messageErr
]);
