<?php
namespace app\Services\File\Providers;

use app\Services\File\Exceptions\FileException;
use Symfony\Component\HttpFoundation\Request;

class File
{
    const MAX_FILE_SIZE = 15000000;

    protected $name;
    protected $originalName; // alias
    protected $size;
    protected $mimeType;
    protected $path;
    protected $errors = [];
    protected $uploadStatus = false;

    protected $request = null;

    public function __construct(Request $request)
    {
        /**
         *  @var \Symfony\Component\HttpFoundation\File\UploadedFile $file
         */
        $file = $request->files->get('file');

        if ($file === null)
            throw new FileException('The file in request was not found.');

        $this->originalName = $file->getClientOriginalName();
        $this->mimeType = $file->getClientMimeType();
        $this->size = $file->getClientSize();

        $this->generateName();

        $this->request = $request;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $reflectionClass = new \ReflectionClass(get_class($this));
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            if ($property->getName() == 'request' ||
                $property->getName() == 'path')
            {
                continue;
            }
            $property->setAccessible(true);
            $array[$property->getName()] = $property->getValue($this);
            $property->setAccessible(false);
        }
        return json_encode($array);
    }

    /**
     * @param string $error
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool (false - no errors)
     */
    public function checkErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return bool (true - validated)
     */
    public function validate()
    {
        if ($this->size > self::MAX_FILE_SIZE) {
            $this->addError('File too big, try to select file less than 15mb.');
            return false;
        }

        if (!in_array(strtolower($this->getExtension()), require(dirname(__FILE__) . "/allowedExtensions.php"))) {
            $this->addError('File format not supported.');
            return false;
        }

        return true;
    }

    /**
     * @return string The extension
     */
    public function getExtension()
    {
        return pathinfo($this->originalName, PATHINFO_EXTENSION);
    }

    protected function generateName()
    {
        $name = preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $this->originalName);
        $name = preg_replace('/([_]+)/', '_', $name);

        $this->name = $name;
    }

}