<?php
// Filename: /module/FuelStation/src/FuelStation/Mapper/ZendDbSqlMapper.php
namespace FuelStation\Mapper;

use FuelStation\Entity\StationInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ZendDbSqlMapper implements StationMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface $dbAdapter
     */
    protected $dbAdapter;

    /**
     * @param \Zend\Stdlib\Hydrator\HydratorInterface
     */
    protected $hydrator;

    /**
     * @param \FuelStation\Entity\StationInterface
     */
    protected $stationPrototype;

    /**
     * @param AdapterInterface $dbAdapter
     */
    public function __construct(
            AdapterInterface $dbAdapter,
            HydratorInterface $hydrator,
            StationInterface $stationPrototype
            )
    {
        $this->dbAdapter = $dbAdapter;
        $this->hydrator = $hydrator;
        $this->stationPrototype = $stationPrototype;
    }

    /**
     * @param int|string $id
     *
     * @return FuelStationInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {
         $sql    = new Sql($this->dbAdapter);
         $select = $sql->select('tk_fuelstation');
         $select->where(array('id = ?' => $id));

         $stmt   = $sql->prepareStatementForSqlObject($select);
         $result = $stmt->execute();

         if ($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()) {
             return $this->hydrator->hydrate($result->current(), $this->stationPrototype);
         }

         throw new \InvalidArgumentException("Blog with given ID:{$id} not found.");
    }

    /**
     * @return array|FuelStationInterface[]
     */
    public function findAll()
    {
          $sql    = new Sql($this->dbAdapter);
          $select = $sql->select('tk_fuelstation');

          $stmt   = $sql->prepareStatementForSqlObject($select);
          $result = $stmt->execute();

          if($result instanceof ResultInterface && $result->isQueryResult()) {
              $resultSet = new HydratingResultSet($this->hydrator, $this->stationPrototype);
              return $resultSet->initialize($result);
          }
          die('no data');
    }

}