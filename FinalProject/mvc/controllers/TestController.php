<?php

namespace APP\controller;

use App\models\interfaces\IController;
use App\models\interfaces\IService;



class TestController extends BaseController implements IController {
    
    protected $service;
    
    public function __construct( IService $TestService ) {                
        $this->service = $TestService;     
        
    }
    
      public function execute(IService $scope) {
          
          if ( $scope->util->isPostRequest() ) {
               $this->data['game'] = filter_input(INPUT_POST, 'game');
               
               $this->data['gamevalid'] = $this->service->validateForm($this->data['game']);
               
          }
          
          $this->data['test1'] = 'hello';
          $this->data['test2'] = 'world';
          
          $scope->view = $this->data;
          $page = 'test';
          return $this->view($page, $scope);          
      }
    
}
