<?php
namespace src\components\subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use src\components\http\JsonResponse;
use src\components\http\Response;

class StringResponse implements EventSubscriberInterface
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'onKernelView'
        ];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $response = $event->getControllerResult();

        if (is_array($response) || is_object($response) || (is_string($response) && (json_decode($response)) !== null)) {
            $result = new JsonResponse($response);
        } else {
            $result = new Response($response);
        }

        $event->setResponse($result);
    }
}