<?php
// Filename: /module/FuelStation/src/FuelStation/Factory/ZendDbSqlMapperFactory.php

namespace FuelStation\Factory;

use FuelStation\Mapper\ZendDbSqlMapper;
use FuelStation\Entity\Station;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ZendDbSqlMapperFactory implements FactoryInterface
{
    /**
     * create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ZendDbSqlMapper (
                $serviceLocator->get('Zend\Db\Adapter\Adapter'),
                new ClassMethods(false),
                new Station()
        );
    }
}