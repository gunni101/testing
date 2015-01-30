<?php
// Filename: /module/FuelStation/src/FuelStation/Controller/WriteController.php
namespace FuelStation\Controller;

use FuelStation\Service\StationServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    protected $stationService;

    protected $stationForm;

    public function __construct(
            StationServiceInterface $stationService,
            FormInterface $stationForm
            ) {
        $this->stationService = $stationService;
        $this->stationForm = $stationForm;
    }

    public function addAction()
    {
        $request = $this->getRequest();

        if($request->isPost()){
            $this->stationForm->setData($request->getPost());
            if($this->stationForm->isValid()) {
                try {
                    $this->stationService->saveStation($this->stationForm->getData());

                    return $this->redirect()->toRoute('fuelstation');
                } catch ( \Exception $e) {
                    die($e->getMessage());
                }
            }
        }
        return new ViewModel(array(
            'form' => $this->stationForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $station = $this->stationService->findStation($this->params('id'));

        $this->stationForm->bind($station);

        if($request->isPost()){
            $this->stationForm->setData($request->getPost());
            if($this->stationForm->isValid()) {
                try {
                    $this->stationService->saveStation($station);

                    return $this->redirect()->toRoute('fuelstation');
                } catch ( \Exception $e) {
                    die($e->getMessage());
                }
            }
        }
        return new ViewModel(array(
            'form' => $this->stationForm
        ));
    }

}