<?php
namespace app\Services\File\Providers;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractUploadService
{
    const OUTPUT_DIR = 'temp';

    protected $file = null;

    public function __construct(Request $request)
    {
        $this->file = new File($request);
        $this->file->path = BASE_DIR.self::OUTPUT_DIR.'/';

        shell_exec('chmod -R 0777 ' . $this->file->path);
    }

    /**
     * @return File
     */
    abstract public function upload();
}