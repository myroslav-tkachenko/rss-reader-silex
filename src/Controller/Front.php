<?php

namespace App\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Front
{
    public function getIndex(Application $app, Request $request)
    {
        $db = $app['db'];
        $stmt = $db->query("SELECT * FROM news ORDER BY id DESC LIMIT 50");
        $items = $stmt->fetchAll();

        return include '../templates/index.tpl.php';
    }
    
    public function getLogin(Request $request)
    {
        return new Response('<form action="/login" method="POST">
            <input name="name">
            <input name="pass">
            <input type="submit">
        </form>');
    }

    public function postLogin(Application $app, Request $request)
    {
        $login = $request->request->get('name');
        $pass = $request->request->get('pass');

        $session = $request->getSession();
        if ($login == 'test' && $pass == '123') {
            $session->set('logged', true);

            return 'LOGGED';
            // return new RedirectResponse('/cabinet');
        }

        return $app->redirect('/login');
    }

    public function getLogout($request, $response)
    {
        $session = $request->getSession();
        $session->invalidate();

        return new RedirectResponse('/');
    }
}
