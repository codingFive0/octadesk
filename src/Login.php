<?php
require_once "../src/Octadesk.php";

class Login extends Octadesk
{
    public function __construct($apiToken, $userName, $userPassword = null, $subDomain = null)
    {
        if ((empty($apiToken) && empty($userName)) || (empty($userName) && empty($userPassword) && empty($subDomain))) {
            $this->error = "Para realizar o login na API é necessário a informação do Token e do E-mail cadastrado na Octadesk. Ou ainda e-mail, senha e sub-dominio.";
        }
        parent::__construct($apiToken, $userName, $userPassword, $subDomain);
    }

    public function login()
    {
        if ($this->error) {
            return null;
        }

        $this->request(
            "POST",
            "login",
            [
                "username" => $this->userName,
                "password" => $this->userPassword
            ],
            [
                "subDomain" => $this->subDomain
            ]
        );

        return $this;
    }

    public function loginWithToken()
    {
        if ($this->error) {
            return null;
        }

        $this->request(
            "POST",
            "login/apiToken",
            null,
            [
                "apiToken" => $this->apiToken,
                "username" => $this->userName
            ]
        );

        return $this;
    }

    public function validateSubDomain()
    {
        if ($this->error) {
            return null;
        }

        $this->request(
            "GET",
            "validate",
            [
                "subdomain" => $this->subDomain
            ]
        );

        return $this;
    }
}