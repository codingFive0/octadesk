<?php require_once __DIR__ . "/../vendor/autoload.php";

$token = "octa.************.************";
$userName = "";
$userPassword = "";
$subDomain = "";

$login = new \codingFive0\octadesk\Login($token, $userName, $userPassword, $subDomain);
$accToken = $login->login()->callback()->token;
$ticket = new \codingFive0\octadesk\Ticket($accToken);

//$customList = $ticket->customList()->callback();
//$default = $ticket->defaultList()->callback();

$idClient = "b59def2b-56bb-4ee1-8a59-f0c0af22b794";
//$ticketsByReqId = $ticket->findByRequesterId($idClient)->callback();

//$ticketsByNumber = $ticket->findByNumber(245);

$createTicket = [
    "requester_email" => "ramos@gane.com.br",
    "requester_name" => "Rafael Ramos",
    "summary" => "Mais um teste de API",
    "product" => "50b73676-e9c6-4d93-9284-18bc79399d1c"
];

$create = $ticket->createTicket($createTicket);

