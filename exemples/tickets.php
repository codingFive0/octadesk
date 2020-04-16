<?php require __DIR__ . "../vendor/autoload.php";

$token = "octa.aFr19n6IHvE4.aKTbqOYjyk24";
$userName = "diogenes@contaagil.com";
$userPassword = "agil123899";
$subDomain = "contaagil";

$login = new Login($token, $userName, $userPassword, $subDomain);
$accToken = $login->login()->callback()->token;

$ticket = new Ticket($accToken);

$customList = $ticket->customList()->callback();
$default = $ticket->defaultList()->callback();

$idClient = "b59def2b-56bb-4ee1-8a59-f0c0af22b794";
$ticketsByReqId = $ticket->findByRequesterId($idClient)->callback();

$ticketsByNumber = $ticket->findByNumber(29);
var_dump($ticketsByNumber);
