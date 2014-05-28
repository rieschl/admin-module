<?php

namespace Midnight\AdminModule;

return array(
    'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                'options' => array(
                    'defaults' => array(
                        'controller' => __NAMESPACE__ . 'Admin',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            __NAMESPACE__ . 'Admin' => __NAMESPACE__ . '\Controller\AdminController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                dirname(__DIR__) . '/public',
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'adminForm' => 'Zend\Form\View\Helper\Form',
            'adminFormRow' => 'Midnight\AdminModule\View\Helper\Form\FormRow',
            'formRow' => 'Midnight\AdminModule\View\Helper\Form\FormRow',
            'adminTabs' => 'Midnight\AdminModule\View\Helper\AdminTabs',
        ),
    ),
    'zfc_rbac' => array(
        'guards' => array(
            'ZfcRbac\Guard\RouteGuard' => array(
                'zfcadmin*' => array('admin'),
            ),
        ),
    ),
);
