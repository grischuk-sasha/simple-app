<?php
namespace app\Services\Http;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Manager
{
    private $client = null;
    private $request = null;

    public function __construct(SymfonyRequest $request)
    {
        $this->request = $request;
        $this->setDefaultClient();
    }

    private function setDefaultClient()
    {
        $this->client = ClientFactory::create($this->request, EnClients::GUZZLE);
    }

    public function getClient()
    {
        return $this->client;
    }
}