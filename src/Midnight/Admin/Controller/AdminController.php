<?php

namespace Midnight\Admin\Controller;

use Zend\View\Model\ViewModel;

class AdminController extends AbstractAdminController
{
    public function indexAction()
    {
        $vm = new ViewModel();
        $vm->setTemplate('admin/admin/index.phtml');
        return $vm;
    }
}