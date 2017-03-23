<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use App\Model\SourceMapper;
use App\Model\SourceEntity;

class Cabinet
{
    public static function _before(Request $request, Application $app)
    {
        $logged = $request->getSession()->get('logged');
        if (! $logged) $app->abort(403, 'Forbidden.');
    }

    public function getIndex(Request $request, Application $app)
    {
        $mapper = new SourceMapper($app['db']);
        $sources = $mapper->getSources();

        $app['view.name'] = 'cabinet';
        return $app['view']->data(['sources' => $sources])->render();
    }

    public function postAddSource(Request $request, Application $app)
    {
        $data = $request->request->all();
        $source = new SourceEntity($data);

        $mapper = new SourceMapper($app['db']);
        $mapper->save($source);

        return $app->redirect('/cabinet');
    }

    public function postDisableSource(Request $request, Application $app, $id)
    {
        $mapper = new SourceMapper($app['db']);
        $data = $mapper->getSourceById($id);
        $data['is_active'] = ! $data['is_active'];

        $source = new SourceEntity($data);
        $mapper->save($source);

        return $app->redirect('/cabinet');
    }
}
