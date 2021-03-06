<?php
// Filename: /module/FuelStation/src/FuelStation/Service/StationService.php

namespace FuelStation\Service;

use FuelStation\Mapper\StationMapperInterface;
use FuelStation\Entity\StationInterface;

class StationService implements StationServiceInterface
{

    /**
     * @var StationMapperInterface
     */
    protected $stationMapper;

    /**
     * @param FuelStationMapperInterface $fuelStationMapper
     */
    public function __construct(StationMapperInterface $stationMapper)
    {
        $this->stationMapper = $stationMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllStations()
    {
        return $this->stationMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findStation($id)
    {
        return $this->stationMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function saveStation(StationInterface $station)
    {
        return $this->stationMapper->save($station);
    }
}