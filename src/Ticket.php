<?php

namespace codingFive0\octadesk;

class Ticket extends Octadesk
{

    public function __construct($accToken)
    {
        $this->setAccesToken($accToken);
        parent::__construct();
    }

    public function customList()
    {
        $this->request(
            "GET",
            "tickets/custom-lists"
        );

        return $this;
    }

    public function defaultList()
    {
        $this->request(
            "GET",
            "tickets/default-lists"
        );

        return $this;
    }

    public function findByRequesterId($idRequester, $lastNumber = null)
    {
        $params["idRequester"] = $idRequester;

        if ($lastNumber) {
            $params["lastNumber"] = $lastNumber;
        }

        $this->request(
            "GET",
            "tickets",
            $params
        );

        return $this;
    }

    public function findByNumber($number)
    {
        $this->request(
            "GET",
            "tickets/{$number}"
        );

        return $this;
    }

    public function createTicket(array $ticket, array $customField = [])
    {
        ;
        $this->request(
            "POST",
            "tickets",
            [
                "requester" => [
                    "email" => ($ticket["requester_email"]),
                    "name" => ($ticket["requester_name"])
                ],
                "summary" => ($ticket["summary"] ?? null),
                "comments" => [
                    "description" => [
                        "content" => ($ticket["comments_content"] ?? null)
                    ]
                ],
                "customField" => $customField
            ],
            null,
            true
        );

        return $this;
    }
}