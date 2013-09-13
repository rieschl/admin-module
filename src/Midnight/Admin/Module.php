<?php

namespace Midnight\Admin;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(
            MvcEvent::EVENT_ROUTE,
            function (MvcEvent $e) {
                /** @var $auth_service AuthenticationService */
                $auth_service = $e->getApplication()->getServiceManager()->get('auth');
                if (!$auth_service->hasIdentity()) {
                    $route_name = $e->getRouteMatch()->getMatchedRouteName();
                    $parts = explode('/', $route_name);
                    if ($parts[0] === 'zfcadmin') {
                        $url = $e->getRouter()->assemble(array(), array('name' => 'user/login'));
                        $response = $e->getResponse();
                        $response->getHeaders()->addHeaderLine('Location', $url);
                        $response->setStatusCode(302);
                        $response->sendHeaders();
                        //  When an MvcEvent Listener returns a Response object,
                        // It automatically short-circuit the Application running
                        return $response;
                    }
                }
            }
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
