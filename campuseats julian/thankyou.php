<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader);

$data = $_SESSION["form_data"] ?? null;
if (!$data) {
    echo $twig->render('404.twig');
    exit();
}
?>

<h1>Thank You! Message sent successfully.</h1>
<p>Name: <?php echo htmlspecialchars($data["name"]); ?></p>
<p>Email: <?php echo htmlspecialchars($data["email"]); ?></p>

<a href="contact.php">Back</a>