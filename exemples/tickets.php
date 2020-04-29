<?php require_once __DIR__ . "/../vendor/autoload.php";

$token = "octa.aFr19n6IHvE4.aKTbqOYjyk24";
$userName = "diogenes@contaagil.com";
$userPassword = "agil123899";
$subDomain = "contaagil";

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
    "comments_content" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when"
];

//$create = $ticket->createTicket($createTicket);

