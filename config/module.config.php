<?php

namespace Midnight\Admin;

return array(
    'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                'options' => array(
                    'defaults' => array(
                        'controller' => 'Midnight\Admin\Controller\Admin',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Midnight\Admin\Controller\Admin' => 'Midnight\Admin\Controller\AdminController'
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
                __DIR__ . '/../public',
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formRow' => 'Midnight\Admin\View\Helper\FormRow',
        ),
    ),
    'navigation' => array(
        'admin' => array(
        ),
    ),
);
