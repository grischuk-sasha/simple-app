<?php
namespace src\components\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class Request implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 33]]
        ];
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if (preg_match("~/$~", $request->server->get('REQUEST_URI'))) {
            $request->server->set('REQUEST_URI', rtrim($request->server->get('REQUEST_URI'), '/'));
        }
    }

}