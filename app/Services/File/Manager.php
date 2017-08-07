<?php
namespace app\Services\File;

use Symfony\Component\HttpFoundation\Request;

class Manager
{
    public $uploadService = null;
    private $dependencies = [];

    public function __construct(Request $request)
    {
        $this->dependencies = [
            'request' => $request
        ];
    }

    public function getUploadService($serviceName)
    {
        $this->uploadService = ServiceFactory::create($serviceName, $this->dependencies);

        return $this->uploadService;
    }

}