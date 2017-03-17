<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use App\Model\NewsMapper;
use App\Model\NewsEntity;

class Front
{
    public function getIndex(Application $app, Request $request)
    {
        $mapper = new NewsMapper($app['db']);
        $items = $mapper->getNews();

        $logged = $request->getSession()->get('logged');

        return include '../templates/index.tpl.php';
    }
    
    public function getLogin(Request $request)
    {
        return include '../templates/login.tpl.php';
    }

    public function postLogin(Application $app, Request $request)
    {
        $login = $request->request->get('name');
        $pass = $request->request->get('pass');

        $session = $request->getSession();
        if ($login == 'test' && $pass == '123') {
            $session->set('logged', true);
            return $app->redirect('/cabinet');
        }

        return $app->redirect('/login');
    }

    public function getLogout(Application $app, Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        $session->invalidate();

        return $app->redirect('/');
    }
}
