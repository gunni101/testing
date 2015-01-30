<?php
// Filenama: /module/FuelStation/src/FuelStation/Controller/ListController.php

namespace FuelStation\Controller;

use FuelStation\Service\StationServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Gmaps;

class ListController extends AbstractActionController
{
    /**
     *
     * @var FuelStation\Service\StationServiceInterface
     */
    protected $stationService;

    public function __construct(StationServiceInterface $stationService, GMaps\Service\GoogleMap $gmapsService)
    {
        $this->stationService = $stationService;
        $this->gmapsService = $gmapsService;
    }

    public function indexAction()
    {
        $marker = null;
        $stations = $this->stationService->findAllStations();

        foreach ($stations as $station){
            if($station->getPoolActive() == NULL) {
                continue;
            }
            $marker[$station->getStationId()] = $station->getGeoCoordinateLatitude() . "," . $station->getGeoCoordinateLongitude();
        }

        $markers = array($marker);

        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 8,                //zoom level
            'width' => "600px",         //width of the div
            'height' => "400px",        //height of the div
            'lat' => $station->getGeoCoordinateLatitude(),         //lattitude
            'lon' => $station->getGeoCoordinateLongitude(),         //longitude
            'animation' => 'none',      //animation of the marker
            'markers' => $marker       //loading the array of markers
        );
        $this->gmapsService->initialize($config);                                         //loading the config
        $html = $this->gmapsService->generate();

        return new ViewModel(array(
            'stations' => $stations,
            'map_html' => $html
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

        $markers = array($station->getStationId() => $station->getGeoCoordinateLatitude() . ',' . $station->getGeoCoordinateLongitude());
        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 17,                //zoom level
            'width' => "300px",         //width of the div
            'height' => "200px",        //height of the div
            'lat' => $station->getGeoCoordinateLatitude(),         //lattitude
            'lon' => $station->getGeoCoordinateLongitude(),         //longitude
            'animation' => 'none',      //animation of the marker
            'markers' => $markers       //loading the array of markers
        );

        $this->gmapsService->initialize($config);                                         //loading the config
        $html = $this->gmapsService->generate();

        return new ViewModel(array(
            'station' => $station,
            'map_html' => $html
        ));
    }
}