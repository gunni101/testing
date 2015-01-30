<?php
// Filename: /module/FuelStation/src/FuelStation/Form/StationFieldset.php
namespace FuelStation\Form;

use Zend\Form\Fieldset;
use Zend\Form\Element;

class StationFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

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
            'name' => 'geoCoordinatesLatitude',
            'options' => array(
                'label' => 'Breitengrad'
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));
        $this->add(array(
            'name' => 'geoCoordinatesLongitude',
            'options' => array(
                'label' => 'Laengengrad'
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