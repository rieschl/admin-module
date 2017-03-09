<?php

namespace Midnight\Admin;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

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
                if (!$e->getApplication()->getServiceManager()->has('auth')) {
                    return;
                }
                /** @var $auth_service AuthenticationService */
                $auth_service = $e->getApplication()->getServiceManager()->get('auth');
                if (!$auth_service->hasIdentity()) {
                    $route_name = $e->getRouteMatch()->getMatchedRouteName();
                    $parts = explode('/', $route_name);
                    if ($parts[0] === 'zfcadmin') {
                        $routeMatch = $e->getRouteMatch();
                        $urlParams = $this->extractParams($routeMatch->getParams());
                        $router = $e->getRouter();
                        $next = $router->assemble($urlParams, ['name' => $route_name]);
                        $url = $router->assemble([], ['name' => 'user/login', 'query' => ['next' => $next]]);
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

        $eventManager->attach(
            MvcEvent::EVENT_DISPATCH,
            function (MvcEvent $e) {
                $route_match = $e->getRouteMatch();
                $route_name = $route_match->getMatchedRouteName();
                $parts = explode('/', $route_name);
                if ($parts[0] === 'zfcadmin') {
                    $session = new Session();
                    $session->setLastAdminPage($route_name, $route_match->getParams());
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

    private function extractParams($params)
    {
        return array_filter($params,
            function ($key) {
                if (in_array($key, ['action', 'controller'])) {
                    return false;
                }

                return true;
            },
            ARRAY_FILTER_USE_KEY);
    }

}
