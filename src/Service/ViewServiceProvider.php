<?php

namespace App\Service;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ViewServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['view.name'] = '';
        $app['view.template'] = 'template';

        $app['view'] = function ($app) {
            return new View($app['view.name'], $app['view.template']);
        };
    }
}
