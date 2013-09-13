<?php

namespace Admin;

return array(
    'router' => array(
        'routes' => array(
            'zfcadmin' => array(
                'options' => array(
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Admin',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Admin' => 'Admin\Controller\AdminController'
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
            'formRow' => 'Admin\View\Helper\FormRow',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'content' => array('label' => 'Content', 'uri' => 'http://www.rbo.at/admin/cms'),
            'overview' => array('label' => 'Übersicht', 'uri' => 'http://www.rbo.at/admin'),
            'newsletter' => array('label' => 'Newsletter', 'uri' => 'http://www.rbo.at/admin/newsletter'),
            'forum' => array('label' => 'Forum', 'uri' => 'http://www.rbo.at/admin/forum'),
            'users' => array('label' => 'Benutzer', 'uri' => 'http://www.rbo.at/admin/users'),
            'catalog' => array('label' => 'Katalogbestellungen', 'uri' => 'http://www.rbo.at/admin/catalog-orders'),
            'email' => array('label' => 'E-Mail', 'uri' => 'http://www.rbo.at/admin/email'),
            'settings' => array('label' => 'Einstellungen', 'uri' => 'http://www.rbo.at/admin/settings'),
            'redirects' => array('label' => 'Weiterleitungen', 'uri' => 'http://www.rbo.at/admin/redirects'),
            'logout' => array('label' => 'Logout', 'route' => 'user/logout'),
            'homepage' => array('label' => 'Zur Homepage', 'uri' => 'http://www.rbo.at/'),
        ),
    ),
);
