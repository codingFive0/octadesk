<?php require_once __DIR__ . "/../vendor/autoload.php";

$token = "octa.************.************";
$userName = "";
$userPassword = "";
$subDomain = "";

$login = new \codingFive0\octadesk\Login($token, $userName, $userPassword, $subDomain);
$accToken = $login->login()->callback()->token;

$product = new \codingFive0\octadesk\Product($accToken);

$products = $product->findProducts(null, true, 2);
var_dump($products->callback());

