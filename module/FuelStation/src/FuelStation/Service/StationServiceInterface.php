<?php
// Filename: /module/FuelStation/src/FuelStation/Service/StationServiceInterface.php

namespace FuelStation\Service;

use FuelStation\Entity\StationInterface;

interface StationServiceInterface
{
    /**
     * Should return a set of all Fuelstations that we can iterarte over.
     * Single entries of the array are supposed to be implementing \FuelStation\Entity\FuelStationInterface
     *
     * @return array|FuelStationInterface[]
     */
    public function findAllStations();

    /**
     * Should return a single FuelStation
     * @param int $id Identifier of the Fuelstation that should be returned.
     * @return FuelStationInterface
     */
    public function findStation($id);

    /**
     * Should save a single FuelStation
     * @param StationInterface $station
     * @return tationInterface
     */
    public function saveStation(StationInterface $station);
}
