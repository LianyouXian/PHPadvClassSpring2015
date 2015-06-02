<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class GametypeController extends BaseController implements IController {
       
    public function __construct( IService $GameTypeService ) {                
        $this->service = $GameTypeService;     
        
    }


    public function execute(IService $scope) {
                
        $this->data['model'] = $this->service->getNewGameTypeModel();
        $this->data['model']->reset();
        $viewPage = 'gametype';
        
        
        if ( $scope->util->isPostRequest() ) {
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('gametypeid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('gametypeid'));
            }
                       
        }
        
        
       
        $this->data['GameTypes'] = $this->service->getAllRows();        
        
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
    
}
