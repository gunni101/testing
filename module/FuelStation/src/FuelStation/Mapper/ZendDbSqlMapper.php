<?php
// Filename: /module/FuelStation/src/FuelStation/Mapper/ZendDbSqlMapper.php
namespace FuelStation\Mapper;

use FuelStation\Entity\StationInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;

class ZendDbSqlMapper implements StationMapperInterface
{
    /**
     * @var \Zend\Db\Adapter\AdapterInterface $dbAdapter
     */
    protected $dbAdapter;

    /**
     * @param AdapterInterface $dbAdapter
     */
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @param int|string $id
     *
     * @return FuelStationInterface
     * @throws \InvalidArgumentException
     */
    public function find($id)
    {

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
              $resultSet = new HydratingResultSet(new \Zend\Stdlib\Hydrator\ClassMethods(), new \FuelStation\Entity\Station());
              return $resultSet->initialize($result);
          }
          die('no data');
    }

}