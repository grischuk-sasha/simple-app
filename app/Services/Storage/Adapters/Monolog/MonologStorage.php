<?php
namespace app\Services\Storage\Adapters\Monolog;

use app\Services\Storage\Adapters\Storage;
use app\Services\Storage\EnStorageName;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use app\Helpers\Directory;
use app\Services\Storage\Adapters\Model as BaseModel;
use app\Services\Storage\Adapters\Query as BaseQuery;
use app\Services\Storage\Adapters\StorageInterface;

class MonologStorage extends Storage implements StorageInterface
{
    private $storage;

    public function __construct()
    {
        $this->storage = new Logger('LOG');
        $this->storage->pushHandler(new StreamHandler(
            Directory::checkPath(BASE_DIR.'var/logs').'/monolog.log', Logger::WARNING
        ));
    }

    public function getName()
    {
        return EnStorageName::MONOLOG;
    }

    public function get(BaseQuery $query)
    {
        // TODO: Implement get() method.
    }

    public function flushAll()
    {
        // TODO: Implement flush() method.
    }


    public function set(BaseModel $model)
    {
        return $this->doSet($model);
    }

    private function doSet(Model $model)
    {
        return $this->storage->addRecord(
            $model->getLevel(),
            $model->getName(),
            $model->getBody()
        );
    }

}