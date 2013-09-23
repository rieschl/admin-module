<?php

namespace Midnight\Admin;

use Zend\Session\Container;

class Session extends Container
{
    public function __construct()
    {
        parent::__construct(__NAMESPACE__);
    }

    public function setLastAdminPage($route, array $params = array())
    {
        $this->last_admin_page = array('route' => $route, 'params' => $params);
    }

    public function getLastAdminPage()
    {
        return $this->last_admin_page;
    }
}