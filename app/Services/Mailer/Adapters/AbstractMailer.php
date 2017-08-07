<?php
namespace app\Services\Mailer\Adapters;

abstract class AbstractMailer
{
    abstract public function send();
    abstract public function setFrom(array $from);
    abstract public function setTo(array $to);
    abstract public function setBody($body);
    abstract public function setSubject($subject);
}