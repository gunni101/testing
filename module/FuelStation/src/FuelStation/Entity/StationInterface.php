<?php
// Filename: /module/FuelStation/src/FuelStation/Entity/StationInterface.php
namespace FuelStation\Entity;

interface StationInterface
{
    /**
     * Return the Id of the Fuel Station
     *
     * @return int
     */
    public function getId();

    /**
     * Return the Station Number
     *
     * @return string
     */
    public function getStationId();

    /**
     * Return the street
     *
     * @return string
     */
    public function getStreet();

    /**
     * Return the city
     *
     * @return string
     */
    public function getCity();

    /**
     * Return the postal code
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Return the status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Return the Latitude (Breitengrad)
     *
     * @return string
     */
    public function getGeoCoordinateLatitude();

    /**
     * Return the Longitude (Längengrad)
     *
     * @return string
     */
    public function getGeoCoordinateLongitude();

    /**
     * Return true if station is ready for TP24
     *
     * @return bool
     */
    public function getPoolActive();
}