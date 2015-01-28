<?php
// /module/FuelStation/config/module.config.php
return array(
    'service_manager' => array(
        'factories' => array(
            'FuelStation\Mapper\StationMapperInterface'   => 'FuelStation\Factory\ZendDbSqlMapperFactory',
            'FuelStation\Service\StationServiceInterface' => 'FuelStation\Factory\StationServiceFactory',
            'Zend\Db\Adapter\Adapter'                     => 'Zend\Db\AdapterServiceFactory',
        )
    ),

    'controllers' => array(
        'factories' => array(
            'FuelStation\Controller\List' => 'FuelStation\Factory\ListControllerFactory',
        ),
        'invokables' => array(
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

   'router' => array(
         'routes' => array(
             'fuelstation' => array(
                 'type' => 'segment',
                 'options' => array(
                     'route'    => '/tankstelle[/:action][/:id]',
                     'defaults' => array(
                         'controller' => 'FuelStation\Controller\List',
                         'action'     => 'index',

                     ),
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id' => '[1-9]\d*'
                     ),
                 ),
            ),
        ),
    ),


);