<?php require __DIR__ . "../vendor/autoload.php";

$token = "octa.aFr19n6IHvE4.aKTbqOYjyk24";
$userName = "uribeirosilva@gmail.com";
$userPassword = "agil123899";
$subDomain = "contaagil";

$login = new Login($token, $userName, $userPassword, $subDomain);
var_dump($login->loginWithToken());
/**
 *  <b>Obtendo toquem apartir de um login com e-mail, senha e subdominio da octadesk.</b>
 *  Este token é utilizado apartir em TODOS os endpoints a partir do login.
 */
//$token = $login->login()->callback()->token;
//$tokenWithApiToken = $login->loginWithToken()->callback()->token;

//$login->validateSubDomain();