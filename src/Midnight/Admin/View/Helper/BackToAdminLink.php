<?php

namespace Midnight\Admin\View\Helper;

use Midnight\Admin\Session;
use Midnight\User\Entity\User;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Session\Container;
use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\Identity;
use Zend\View\Helper\Url;

class BackToAdminLink extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __invoke()
    {
        /** @var Identity $identity */
        $identity = $this->getServiceLocator()->get('identity');
        /** @var User $me */
        $me = $identity();
        if (!$me || !$me->getIsAdmin()) {
            return '';
        }
        $session = new Session();
        /** @var Url $url */
        $url = $this->getServiceLocator()->get('url');
        $last_admin_page = $session->getLastAdminPage();
        if (!$last_admin_page) {
            return '';
        }
        $route = $last_admin_page['route'];
        $params = $last_admin_page['params'];
        return '<a href="' . $url($route, $params) . '" class="admin-link">Admin</a>';
    }
}