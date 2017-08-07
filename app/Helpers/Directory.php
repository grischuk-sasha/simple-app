<?php
namespace app\Helpers;

class Directory
{
    public static function checkPath($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
            shell_exec('chmod -R 0777 ' . $path);
        }

        return $path;
    }
}