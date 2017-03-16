<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Model\SourceMapper;
use App\Model\SourceEntity;

class Cabinet
{
    public function getIndex(Request $request)
    {
        $logged = $request->getSession()->get('logged');

        if ($logged) return 'CABINET';

        return new Response('Forbidden.', '403');
    }

    // public function postAddItem($request, $response)
    // {
    //     $logged = $request->getSession()->get('logged');
    //     if ($logged) {
    //         $response->setContent('CABINET');
    //     } else {
    //         $response->setStatusCode('403');
    //         $response->setContent('Forbidden.');
    //     }

    //     return $response;
    // }
}
