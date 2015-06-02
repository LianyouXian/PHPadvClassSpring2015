<?php

namespace App\models\services;

use App\models\interfaces\IDAO;
use App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;


class GameDAO extends BaseDAO implements IDAO {
        
     public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
    
    
    public function idExisit($id) {
                
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT gameid FROM game WHERE gameid = :gameid");
         
        if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT game.gameid, game.game, game.gametypeid, gametype.gametype,game.gamehighprice, game.gamelowprice,game.comment, gametype.active as gametypeactive, game.logged, game.lastupdated, game.active"
                 . " FROM game LEFT JOIN gametype on game.gametypeid = gametype.gametypeid WHERE gameid = :gameid");
         
        if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
        }       
        return $model;  
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":game" => $model->getGame(),
                         ":active" => $model->getActive(),
                         ":gametypeid" => $model->getGametypeid(),
                         ":gamehighprice" =>$model->getGamehighprice(),
                         ":gamelowprice" =>$model->getGamelowprice(),
                         ":gamecomment" =>$model->getGamecomment()
                    );
                         
         if ( !$this->idExisit($model->getGameid()) ) {
             
             $stmt = $db->prepare("INSERT INTO game SET game = :game, gametypeid = :gametypeid, gamehighprice = :gamehighprice, gamelowprice = :gamelowprice, gamecomment = :gamecomment,  active = :active, logged = now(), lastupdated = now()");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
        $binds = array( ":game" => $model->getGame(),
                        ":active" => $model->getActive(),
                        ":gametypeid" => $model->getGametypeid(),
                        ":gameid" => $model->getGameid(),
                        ":gamehighprice" =>$model->getGamehighprice(),
                        ":gamelowprice" =>$model->getGamelowprice(),
                        ":gamecomment" =>$model->getGamecomment()
                    );
         
                
         if ( $this->idExisit($model->getGameid()) ) {
            
             $stmt = $db->prepare("UPDATE game SET game = :game, gametypeid = :gametypeid, gamehighprice = :gamehighprice, gamelowprice = :gamelowprice, gamecomment = :gamecomment,  active = :active, lastupdated = now() WHERE gameid = :gameid");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }
             
         } 
         
         return false;
    }
    
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM game WHERE gameid = :gameid");

        if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT game.gameid,game.game, game.gametypeid, gametype.gametype, game.gamehighprice, game.gamelowprice, game.gamecomment, gametype.active as gametypeactive, game.logged, game.lastupdated, game.active"
                 . " FROM game LEFT JOIN gametype on game.gametypeid = gametype.gametypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
         return $values;
    }
    
    
}
