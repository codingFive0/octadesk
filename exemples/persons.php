<?php require __DIR__ . "../vendor/autoload.php";

$token = "octa.************.************";
$userName = "";
$userPassword = "";
$subDomain = "";

$login = new Login($token, $userName, $userPassword, $subDomain);
$token = $login->login()->callback()->token;

$person = new Person($token);

$id = "3f8b20ab-7865-449d-a88d-4d9ff837b640";
$clientById = $person->findById($id)->callback();

$email = "renan.freitas@tecnospeed.com.br";
$clientByEmail = $person->findByEmail($email)->callback();
$requesters = $person->findRequesters()->callback();
$agents = $person->findAgents()->callback();
$newClient = $person->createClient(
    "Gabriel Silva",
    "gabrielcaldeira2009@hotmail.com",
    234234,
    "",
    "Agência Galg Digitais",
    "Agência de inovação e resultados digitais",
    "agenciagalg.com.br"
);
//var_dump($newClient);