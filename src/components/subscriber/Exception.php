<?php
namespace src\components\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

use src\components\http\JsonResponse;
use src\components\http\Response;

class Exception implements  EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException'
        );
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $msg = $exception->getMessage();

        if (is_array($msg) || is_object($msg) || (is_string($msg) && (json_decode($msg)) !== null)) {
            $response = new JsonResponse($msg);
        } else {
            $response = new Response($msg);
        }

        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            if (!empty($exception->getHeaders())) {
                $response->headers->replace($exception->getHeaders());
            }
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}