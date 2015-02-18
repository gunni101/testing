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
        $viewmodel = new ViewModel();
        $request = $this->getRequest();
        $station = $this->stationService->findStation($this->params('id'));
        $this->stationForm->bind($station);
        $viewmodel->setTerminal($request->isXmlHttpRequest());

        $is_xmlhttprequest = 1;
        if( ! $request->isXmlHttpRequest()){
            $is_xmlhttprequest = 0;
            if($request->isPost()){
                $this->stationForm->setData($request->getPost());
                if($this->stationForm->isValid()) {
                    try {
                        $this->stationService->saveStation($station);

                        return $this->redirect()->toRoute('fuelstation/detail', array('id' =>$this->params('id')));
                    } catch ( \Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
        }
        $viewmodel->setVariables(array(
            'form' => $this->stationForm,
            'is_xmlhttprequest' => $is_xmlhttprequest
        ));
        return $viewmodel;
    }

}