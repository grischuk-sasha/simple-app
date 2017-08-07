<?php
namespace src\components\http;

use Symfony\Component\HttpFoundation\JsonResponse as SJsonResponse;;

class JsonResponse extends SJsonResponse
{

    public function setData($data = array())
    {
        if (!is_string($data)) {
            try {
                $data = json_encode($data, $this->encodingOptions);
            } catch (\Exception $e) {
                if ('Exception' === get_class($e) && 0 === strpos($e->getMessage(), 'Failed calling ')) {
                    throw $e->getPrevious() ?: $e;
                }
                throw $e;
            }
        }

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        $this->data = $data;

        return $this->update();
    }

}