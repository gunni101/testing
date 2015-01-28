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
                'type' => 'literal',
                'options' => array(
                    'route' => '/tankstelle',
                    'defaults' => array(
                        'controller' => 'FuelStation\Controller\List',
                        'action' => 'index',
                    ),
                    'may_terrminate' => true,
                    'child_routes' => array(
                        'detail' => array(
                            'type' => 'segment',
                            'options' => array(
                                'route' => '/:id',
                                'defaults' => array(
                                    'action' => 'detail',
                                ),
                                'constraints' => array(
                                    'id' => '[1-9]\d*'
                                )
                            )
                        )
                    )
                ),
            ),
        ),
    ),
);