<?php
// Filename: /module/FuelStation/src/FuelStation/Form/StationForm.php
namespace FuelStation\Form;

use FuelStation\Entity\Station;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Stdlib\Hydrator\ClassMethods;

class StationForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Station());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'stationId',
            'options' => array(
                'label' => 'Stationsnummer'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $this->add(array(
            'name' => 'street',
            'options' => array(
                'label' => 'Strasse'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $this->add(array(
            'name' => 'postalCode',
            'options' => array(
                'label' => 'PLZ'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $this->add(array(
            'name' => 'city',
            'options' => array(
                'label' => 'Ort'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $this->add(array(
            'name' => 'geoCoordinateLatitude',
            'options' => array(
                'label' => 'Breitengrad'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));
        $this->add(array(
            'name' => 'geoCoordinateLongitude',
            'options' => array(
                'label' => 'Laengengrad'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));
        $this->add(array(
            'name' => 'poolActive',
            'options' => array(
                'label' => 'Poolfaehig'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $submit = new Element\Button('submit');
        $submit
            ->setLabel('speichern')
            ->setAttributes(array('type' => 'submit',));


        $this->add($submit);

    }
}