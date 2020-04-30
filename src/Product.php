<?php

namespace codingFive0\octadesk;

class Product extends Octadesk
{

    public function __construct($accToken)
    {
        $this->setAccesToken($accToken);
        parent::__construct();
    }

    public function findProducts(string $keywords = null, bool $onlyEnabledItems = true, int $page = 1)
    {
        $this->request(
            "GET",
            "products/search",
            [
                "keywords" => $keywords,
                "onlyEnabledItems" => $onlyEnabledItems,
                "page" => $page,
                "asSuggestion" => true
            ]
        );

        return $this;
    }

    public function createProduct()
    {
        $body = [
            "id" => "string",
            "isEnabled" => true,
            "sku" => "string",
            "productGroup" => [
                "id" => "string",
                "name" => "string",
                "dateCreation" => "2020-04-30T17:40:26.236Z",
                "description" => "string",
                "isEnabled" => true,
                "fields" => [
                    "string"
                ],
                "products" => [
                    null
                ]
            ],
            "members" => [
                [
                    "code" => "string",
                    "name" => "string",
                    "value" => []
                ]
            ],
            "publicMembers" => [
                [
                    "code" => "string",
                    "name" => "string",
                    "value" => []
                ]
            ],
            "thumbUrl" => "string"
        ];
    }
}