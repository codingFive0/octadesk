<?php

namespace codingFive0\octadesk;

/**
 * Class Octadesk
 */
abstract class Octadesk
{
    /** @var string <b>E-mail</b> cadastrado na octadesk */
    protected $userName;
    /** @var string <b>Senha</b> de acesso na octadesk */
    protected $userPassword;
    /** @var string <b>Token</b> obtido apartir do painel de controle da octadesk */
    protected $apiToken;
    /** @var string <b><em>xxxxx</em>.octadesk.com<b/> nome do sub-dominio na octadesk. (apenas até o primeiro ponto "." ) */
    protected $subDomain;

    /** @var string <b>Base</b> da API. Todas as requisições serão direceionadas a esta URL. Com a adição do endpoint final */
    private $apiUrl;
    /** @var string <b>Endpoint</b> Independende a cada solicitação e cada objetivo. */
    private $endpoint;
    /** @var string <b>Metodo<b/> da requisição */
    private $method;
    /** @var array <b>Campos</b> para postagem no metodo <em>POST</em> */
    private $fields;

    /** @var array <b>headers</b> para envio junto a requisição CURL */
    private $headers;

    /** @var ?object Retorno de dados por parte da octadesk */
    protected $callback;

    /** @var string <b>Erro</b> por mensagem do <em>Componente</em>. Sem interação com a API */
    protected $error;

    /** @var string <b>Token</b> retornado a partir do login no API */
    protected $accesToken;


    public function __construct($apiToken = null, $userName = null, $userPassword = null, $subDomain = null)
    {
        $this->userName = $userName;
        $this->apiToken = $apiToken;
        $this->userPassword = $userPassword;
        $this->subDomain = $subDomain;

        $this->apiUrl = "https://api.octadesk.services";
    }

    protected function setAccesToken($accToken)
    {
        $this->headers[] = "Authorization: Bearer " . $accToken;
        return $this;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array|null $fields
     * @param array|null $headers
     */
    protected function request($method, $endpoint, $fields = null, $headers = null, $toJson = false)
    {
        $this->method = $method;
        $this->endpoint = $endpoint;
        $this->fields = (empty($toJson) ? $fields : json_encode($fields));
        $this->setHeaders($headers);

        if($toJson){
            $this->headers[] = "Content-Type: application/json";
            $this->headers[] = "accept: application/json";
        }

        $this->dispatch();
    }

    public function getError()
    {
        return $this->error;
    }

    /**
     * @return object|null
     */
    public function callback()
    {
        return $this->callback;
    }

    /**
     * @return object|null
     */
    public function error()
    {
        if (!empty($this->callback->errorId)) {
            return $this->callback->message;
        }

        return null;
    }

    /**
     * @param array|null $headers
     */
    private function setHeaders($headers = null)
    {
        if (!$headers) {
            return;
        }

        foreach ($headers as $key => $header) {
            $this->headers[] = "{$key}: {$header}";
        }
    }

    /**
     *
     */
    private function dispatch()
    {
        $curl = curl_init();

        $get = ($this->method === "GET" ? "?" . http_build_query($this->fields) : null);
        $this->url = "{$this->apiUrl}/{$this->endpoint}{$get}";

        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$this->apiUrl}/{$this->endpoint}{$get}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_POSTFIELDS => $this->fields,
            CURLOPT_HTTPHEADER => $this->headers,
        ));

        $this->callback = json_decode(curl_exec($curl));
        curl_close($curl);
    }

    public function __clone()
    {
    }
}