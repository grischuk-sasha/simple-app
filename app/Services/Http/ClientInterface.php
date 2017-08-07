<?php
namespace app\Services\Http;

interface ClientInterface
{
    public function getData($url, array $options = []);
    public function postData($url, array $options = []);

    /**
     * @param string $baseUri
     * @param array $headers
     * @return $this
     */
    public function setConfigs($baseUri = null, array $headers = []);

    /**
     * @param array $headers
     * @return $this
     */
    public function addHeaders(array $headers);

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers);

    /**
     * @return array
     */
    public function getHeaders();

}