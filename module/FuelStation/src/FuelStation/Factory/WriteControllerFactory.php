<?php
// Filename /module/FuelStation/src/FuelStation/Factory/WriteControllerFactory.php
namespace FuelStation\Factory;

use FuelStation\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class WriteControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $stationService     = $realServiceLocator->get('FuelStation\Service\StationServiceInterface');
        $stationInsertForm  = $realServiceLocator->get('Form\ElementManager')->get('FuelStation\Form\StationForm');

        return new WriteController(
                $stationService,
                $stationInsertForm
        );
    }
}