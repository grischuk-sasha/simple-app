<?php
namespace app\Services\Http\Clients\Guzzle;

use app\Services\Http\ClientInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class GuzzleClient extends Client implements ClientInterface
{
    private $baseUri;
    private $headers = [];
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setConfigs(null, [

        ]);
    }

    private function init()
    {
        parent::__construct([
            'base_uri' => $this->baseUri,
            'headers' => $this->getHeaders()
        ]);
    }

    public function setConfigs($baseUri = null, array $headers = [])
    {
        $this->setHeaders($headers);

        return $this;
    }

    public function getData($url, array $options = [])
    {
        try {
            $request = $this->get($url, $options);

            return (string) $request->getBody();
        } catch (\Exception $e) {
            return 'Whoops, looks like something went wrong.';
        }
    }

    public function postData($url, array $options = [])
    {
        try {
            $request = $this->post($url, $options);

            return (string) $request->getBody();
        } catch (\Exception $e) {
            return 'Whoops, looks like something went wrong.';
        }
    }

    public function addHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        $this->init();

        return $this;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        $this->init();

        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

}