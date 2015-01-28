<?php
// Filenama: /module/FuelStation/src/FuelStation/Controller/ListController.php

namespace FuelStation\Controller;

use FuelStation\Service\StationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{
    /**
     *
     * @var FuelStation\Service\StationServiceInterface
     */
    protected $stationService;

    public function __construct(StationServiceInterface $stationService)
    {
        $this->stationService = $stationService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'stations' => $this->stationService->findAllStations()
        ));
    }

    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');

        try {
            $station = $this->stationService->findStation($id);
        } catch (\InvalidArgumentException $ex) {
            return $this->redirect()->toRoute('fuelstation');
        }

        return new ViewModel(array(
            'station' => $station
        ));
    }
}