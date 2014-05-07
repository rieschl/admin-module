<?php

namespace Midnight\Admin\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Zend\Form\Form;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Navigation\Navigation;
use Zend\Navigation\Service\ConstructedNavigationFactory;

abstract class AbstractAdminController extends AbstractActionController
{
    /**
     * @param array $pages
     * @return Navigation
     */
    protected function createNavigation($pages)
    {
        $factory = new ConstructedNavigationFactory($pages);
        return $factory->createService($this->getServiceLocator());
    }

    protected function processForm(Form $form, $options = array(), $extra1 = null, $extra2 = array())
    {
        /**
         * Special case for a simpler API: if the second argument is a string, it is used as the route to redirect
         * to, the third argument as the route parameters and the fourth argument as additional options.
         */
        if (is_string($options)) {
            $options = array(
                'redirect_route' => $options,
                'redirect_params' => $extra1,
            );
            $options = $options + $extra2;
        }
        if ($options && isset($options['object_manager'])) {
            $objectManager = $options['object_manager'];
        } else {
            $objectManager = $this->getEntityManager();
        }
        /** @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $form->bindValues();
                $objectManager->persist($form->getObject());
                $objectManager->flush();
                if (!empty($options['success_message'])) {
                    $this->flashMessenger()->addMessage($options['success_message']);
                }
                if (!empty($options['redirect_route'])) {
                    $params = array();
                    if (!empty($options['redirect_params'])) {
                        $params = $options['redirect_params'];
                        if (is_callable($params)) {
                            $params = call_user_func($params, $form);
                        }
                    }
                    return $this->redirect()->toRoute($options['redirect_route'], $params);
                }
            }
        }
        return null;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    }

    /**
     * @param string $name
     * @return EntityRepository
     */
    protected function getRepository($name)
    {
        return $this->getEntityManager()->getRepository($name);
    }
}
