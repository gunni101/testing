<?php
// Filename: /module/FuelStation/src/FuelStation/Mapper/ZendDbSqlMapper.php
namespace FuelStation\Mapper;

use FuelStation\Entity\StationInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
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
            return  $this->hydrator->hydrate($result->current(), $this->stationPrototype);
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
          $select->order(array('stationId' => 'ASC'));

          $stmt   = $sql->prepareStatementForSqlObject($select);
          $result = $stmt->execute();

          if($result instanceof ResultInterface && $result->isQueryResult()) {
              $resultSet = new HydratingResultSet($this->hydrator, $this->stationPrototype);
              $resultSet->initialize($result);
              return $resultSet->buffer();
          }
          die('no data');
    }

   /**
    * @param StationInterface $stationObject
    *
    * @return StationInterface
    * @throws \Exception
    */
   public function save(StationInterface $stationObject)
   {
      $stationData = $this->hydrator->extract($stationObject);
      unset($stationData['id']); // Neither Insert nor Update needs the ID in the array

      if ($stationObject->getId()) {
         // ID present, it's an Update
         $action = new Update('tk_fuelstation');
         $action->set($stationData);
         $action->where(array('id = ?' => $stationObject->getId()));
      } else {
         // ID NOT present, it's an Insert
         $action = new Insert('tk_fuelstation');
         $action->values($stationData);
      }

      $sql    = new Sql($this->dbAdapter);
      $stmt   = $sql->prepareStatementForSqlObject($action);
      $result = $stmt->execute();

      if ($result instanceof ResultInterface) {
         if ($newId = $result->getGeneratedValue()) {
            // When a value has been generated, set it on the object
            $stationObject->setId($newId);
         }

         return $stationObject;
      }

      throw new \Exception("Database error");
   }

}