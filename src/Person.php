<?php

namespace codingFive0\octadesk;

class Person extends Octadesk
{

    public function __construct($accToken)
    {
        $this->setAccesToken($accToken);
        parent::__construct();
    }

    public function findById($id)
    {
        $this->request(
            "GET",
            "persons/{$id}"
        );

        return $this;
    }

    public function findByEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Informe um e-mail em formato válido para prosseguir.";
            return null;
        }

        $this->request(
            "GET",
            "persons",
            [
                "email" => $email
            ]
        );

        return $this;
    }

    public function findRequesters($keywords = null, $page = null, $detailed = false)
    {
        if ($keywords) {
            $params["keyword"] = $keywords;
        }

        if ($page) {
            $params["page"] = $page;
        }

        if ($detailed) {
            $params["detailed"] = $detailed;
        }

        $this->request(
            "GET",
            "persons/requesters",
            $params
        );

        return $this;
    }

    public function findAgents($keywords = null, $page = null, $detailed = false)
    {
        if ($keywords) {
            $params["keyword"] = $keywords;
        }

        if ($page) {
            $params["page"] = $page;
        }

        if ($detailed) {
            $params["detailed"] = $detailed;
        }

        $this->request(
            "GET",
            "persons/agents",
            $params
        );

        return $this;
    }

    public function createClient($name, $email, $clientId, $thumbUrl = null, $organizationName = null, $organizationDesc = null, $organizationDomain = null)
    {
        $fields = [
            "email" => $email,
            "name" => $name,
            "thumbUrl" => $thumbUrl,
            "customerCode" => $clientId,
            "isLocked" => true,
            "type" => 2,
            "participantPermission" => 0,
            "roleType" => 5,
            "permissionType" => 0
        ];

        if (!empty($organizationName) || !empty($organizationDesc) || !empty($organizationDomain)) {
            $fields = array_merge($fields, [
                "default" => true,
                "name" => $organizationName,
                "description" => $organizationDesc,
                "domain" => $organizationDomain
            ]);
        }

        $this->request(
            "POST",
            "persons",
            $fields
        );

        return $this;
    }
}