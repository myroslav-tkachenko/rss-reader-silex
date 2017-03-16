<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Model\SourceMapper;
use App\Model\SourceEntity;

class Cabinet
{
    public function getIndex(Application $app, Request $request)
    {
        $logged = $request->getSession()->get('logged');

        if (! $logged) $app->abort(403, 'Forbidden.');

        $mapper = new SourceMapper($app['db']);
        $sources = $mapper->getSources();

        return include '../templates/cabinet.tpl.php';
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
