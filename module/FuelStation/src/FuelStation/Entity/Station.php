<?php
// Filename: /module/FuelStation/src/Entity/Station.php
namespace FuelStation\Entity;

class Station implements StationInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $stationId;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $postalCode;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $geoCordinateLatitude;

    /**
     * @var string
     */
    protected $geoCordinateLongitude;

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function getStationId()
    {
        return $this->stationId;
    }

    /**
     * @param string $statinId
     */
    public function setStationId($stationId)
    {
        $this->stationId = $stationId;
    }

    /**
     * {@inheritDoc}
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * {@inheritDoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * {@inheritDoc}
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritDoc}
     */
    public function getGeoCoordinateLatitude()
    {
        return $this->geoCoordinateLatitude;
    }

    /**
     * @param string $geoCoordinateLatitude
     */
    public function setGeoCoordinateLatitude($geoCoordinateLatitude)
    {
        $this->geoCoordinateLatitude = $geoCoordinateLatitude;
    }

    /**
     * {@inheritDoc}
     */
    public function getGeoCoordinateLongitude()
    {
        return $this->geoCoordinateLongitude;
    }

    /**
     * @param string $geoCoordinateLongitude
     */
    public function setGeoCoordinateLongitude($geoCoordinateLongitude)
    {
        $this->geoCoordinateLongitude = $geoCoordinateLongitude;
    }
}
