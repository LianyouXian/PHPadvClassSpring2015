<?php

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
use App\models\interfaces\IModel;

class GameService implements IService {
    
    protected $gameDAO;
    protected $gameTypeService;
    protected $validator;
    protected $model;
                function getValidator() {
        return $this->validator;
    }

    function setValidator($validator) {
        $this->validator = $validator;
    }                
     
    function getGameDAO() {
        return $this->gameDAO;
    }

    function setGameDAO(IDAO $DAO) {
        $this->gameDAO = $DAO;
    }
    
    function getGameTypeService() {
        return $this->gameTypeService;
    }

    function setGameTypeService(IService $service) {
        $this->gameTypeService = $service;
    }
    
    
    function getModel() {
        return $this->model;
    }

    function setModel(IModel $model) {
        $this->model = $model;
    }

        public function __construct( IDAO $gameDAO, IService $gameTypeService, IService $validator, IModel $model  ) {
        $this->setGameDAO($gameDAO);
        $this->setGameTypeService($gameTypeService);
        $this->setValidator($validator);
        $this->setModel($model);
    }
    
    
    public function getAllGameTypes() {       
        return $this->getGameTypeService()->getAllRows();   
        
    }
    
     public function getAllGames() {       
        return $this->getGameDAO()->getAllRows();   
        
    }
    
    public function create(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getGameDAO()->create($model);
        }
        return false;
    }
    
    
    public function validate( IModel $model ) {
        $errors = array();
        
        if ( !$this->getGameTypeService()->idExist($model->getGametypeid()) ) {
            $errors[] = 'Game Type is invalid';
        }
       
        if ( !$this->getValidator()->gameIsValid($model->getGame()) ) {
            $errors[] = 'Game is invalid';
        }
               
        if ( !$this->getValidator()->activeIsValid($model->getActive()) ) {
            $errors[] = 'Game active is invalid';
        }
        
        /*if ( !$this->getValidator()->gamehighpriceIsValid($model->getGamehighprice()) ) {
            $errors[] = 'high price is invalid';
        }
        
        if ( !$this->getValidator()->gamelowpriceIsValid($model->getGamelowprice()) ) {
            $errors[] = 'low price is invalid';
        }*/
            
        return $errors;
    }
    
    
    public function read($id) {
        return $this->getGameDAO()->read($id);
    }
    
    public function delete($id) {
        return $this->getGameDAO()->delete($id);
    }
    
    
     public function update(IModel $model) {
        
        if ( count($this->validate($model)) === 0 ) {
            return $this->getGameDAO()->update($model);
        }
        return false;
    }
    
    
     public function getNewGameModel() {
        return clone $this->getModel();
    }
    
    
}
