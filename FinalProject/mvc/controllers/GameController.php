<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;

class GameController extends BaseController implements IController {
   
    protected $service;
    
    public function __construct( IService $GameService  ) {                
        $this->service = $GameService;  
    }
    
    public function execute(IService $scope) {
        $viewPage = 'game';
        
        $this->data['model'] = $this->service->getNewGameModel();
        $this->data['model']->reset();
        
        if ( $scope->util->isPostRequest() ) {
            
            
            if ( $scope->util->getAction() == 'create' ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["saved"] = $this->service->create($this->data['model']);
            }
            
            if ( $scope->util->getAction() == 'edit' ) {
                $viewPage .= 'edit';
                $this->data['model'] = $this->service->read($scope->util->getPostParam('gameid'));
                  
            }
            
            if ( $scope->util->getAction() == 'delete' ) {                
                $this->data["deleted"] = $this->service->delete($scope->util->getPostParam('gameid'));
            }
            
             if ( $scope->util->getAction() == 'update'  ) {
                $this->data['model']->map($scope->util->getPostValues());
                $this->data["errors"] = $this->service->validate($this->data['model']);
                $this->data["updated"] = $this->service->update($this->data['model']);
                 $viewPage .= 'edit';  
            }
            
            
        }
        
        
        $this->data['gameTypes'] = $this->service->getAllGameTypes(); 
        $this->data['games'] = $this->service->getAllGames(); 
        
        $scope->view = $this->data;
        return $this->view($viewPage,$scope);
    }
    
}
