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

    public function postAddSource(Application $app, Request $request)
    {
        $logged = $request->getSession()->get('logged');

        if (! $logged) $app->abort(403, 'Forbidden.');

        $data = $request->request->all();
        $source = new SourceEntity($data);

        $mapper = new SourceMapper($app['db']);
        $mapper->save($source);

        return $app->redirect('/cabinet');
    }

    public function postDisableSource(Application $app, Request $request, $id)
    {
        $logged = $request->getSession()->get('logged');

        if (! $logged) $app->abort(403, 'Forbidden.');        

        $mapper = new SourceMapper($app['db']);
        $source = $mapper->getSourceById($id);

        var_dump($source); die();

    }
}
