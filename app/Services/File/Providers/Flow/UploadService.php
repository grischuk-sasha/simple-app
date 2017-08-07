<?php
namespace app\Services\File\Providers\Flow;

use app\Services\File\Providers\File;
use app\Services\File\Providers\AbstractUploadService;

use Flow\Config as FlowConfig;
use Flow\Request as FlowRequest;
use Flow\Basic as FlowBasic;
use Symfony\Component\HttpFoundation\Request;

class UploadService extends AbstractUploadService
{
    const CHUNKS_DIR = 'chunks_temp_dir';

    private $config = null;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->config = new FlowConfig([
            'tempDir' => $this->file->path.self::CHUNKS_DIR
        ]);
    }

    /**
     * @return File
     */
    public function upload()
    {
        if ($this->file->validate()
            && FlowBasic::save($this->file->path.$this->file->name, $this->config, new FlowRequest())
            && $this->uploadToServer())
        {
            $this->file->uploadStatus = true;
        }

        return $this->file;
    }
}