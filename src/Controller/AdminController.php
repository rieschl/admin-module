<?php

namespace Midnight\AdminModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    public function indexAction()
    {
        $vm = new ViewModel();
        $vm->setTemplate('midnight/admin-module/admin/index.phtml');
        return $vm;
    }
}