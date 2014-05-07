<?php

namespace Midnight\AdminModule\View\Helper\Form;

use Zend\Form\View\Helper\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class FormFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface|HelperPluginManager $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $form Form */
        $form = $serviceLocator->create('form');
        /** @var $view PhpRenderer */
        $view = $form->getView();
        $view->getHelperPluginManager()->setAlias('formRow', 'adminFormRow');
        return $form;
    }
}