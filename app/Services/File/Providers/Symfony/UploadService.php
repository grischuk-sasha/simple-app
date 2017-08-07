<?php
namespace app\Services\File\Providers\Symfony;

use app\Services\File\Exceptions\FileException;
use app\Services\File\Providers\AbstractUploadService;
use Symfony\Component\HttpFoundation\Request;

class UploadService extends AbstractUploadService
{
    private $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->request = $request;
    }

    /**
     * @return \app\Services\File\Providers\File|null
     * @throws FileException
     */
    public function upload()
    {
        if ($this->file->validate()) {
            /**
             *  @var \Symfony\Component\HttpFoundation\File\UploadedFile $file
             */
            $file = $this->request->files->get('file');
            try{
                $file->move($this->file->path, $this->file->name);

                $this->file->uploadStatus = true;
            } catch (\Exception $e) {
                throw new FileException( (string)$e );
            }
        }

        return $this->file;
    }

}