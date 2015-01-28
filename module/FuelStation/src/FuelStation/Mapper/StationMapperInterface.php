<?php
// Filename: /module/FuelStation/src/FuelStation/Mapper/StationMapperInterface.php

namespace FuelStation\Mapper;

use FuelStation\Entity\StationInterface;

interface StationMapperInterface
{
    /**
     * @param int|string $id
     * @returns FuelStationInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);


    /**
     * @return array|FuelStationInterface[]
     */
    public function findAll();
}