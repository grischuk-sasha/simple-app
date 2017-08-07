<?php
namespace app\Services\Http;

use app\Exceptions\FatalError;
use app\Services\Http\Clients\Guzzle\GuzzleClient;
use Symfony\Component\HttpFoundation\Request;

class ClientFactory
{

    public static function create(Request $request, $clientName)
    {
        switch ($clientName)
        {
            case EnClients::GUZZLE:
                return new GuzzleClient($request);
                break;

            default:
                throw new FatalError("Client '".$request."' was not found.");
        }
    }

}