<?php require_once __DIR__ . "/../vendor/autoload.php";

$token = "octa.aFr19n6IHvE4.aKTbqOYjyk24";
$userName = "diogenes@contaagil.com";
$userPassword = "agil123899";
$subDomain = "contaagil";

$login = new \codingFive0\octadesk\Login($token, $userName, $userPassword, $subDomain);
$accToken = $login->login()->callback()->token;

$product = new \codingFive0\octadesk\Product($accToken);

$products = $product->findProducts(null, true, 2);
var_dump($products->callback());

