<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';
require_once __DIR__.'/menu.php';

$json = file_get_contents(__DIR__.'/database.json');
$data = json_decode($json, true);

$phone = $data["business"][0]["phone"];
$email = $data["business"][0]["email"];

session_start();

$nameErr = $emailErr = "";
$name = $email = $message = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valid = true;

    // NAME
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
    }

    // EMAIL
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

    // MESSAGE
    if(empty($_POST["message"])) {
        $messageErr = "Message is required";
        $valid = false;
    } else {
        $message = test_input($_POST["message"]);
    

    // If everything is valid → redirect
    if ($valid) {

        $_SESSION["form_data"] = [
            "name" => $name,
            "email" => $email,
            "message" => $message
        ];

        header("Location: thankyou.php");
        exit();
    }
}
?>