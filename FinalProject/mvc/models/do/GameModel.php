<?php

namespace App\models\services;


class GameModel extends BaseModel {
    
    private $gameid;
    private $game;
    private $gametypeid;
    private $gametype;
    private $gamehighprice;
    private $gamelowprice;
    private $gamecomment;
    private $gametypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getGameid() {
        return $this->gameid;
    }

    function getGame() {
        return $this->game;
    }

    function getGametypeid() {
        return $this->gametypeid;
    }
    
     function getGametype() {
        return $this->gametype;
    }

    function getGamehighprice(){
        return $this->gamehighprice;
    }
            
    function getGamelowprice(){
        return $this->gamelowprice;
    }
            
    function getGamecomment(){
        return $this->gamecomment;
    }
            
    function getGametypeactive() {
        return $this->gametypeactive;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    function setGameid($gameid) {
        $this->gameid = $gameid;
    }

    function setGame($game) {
        $this->game = $game;
    }

    function setGametypeid($gametypeid) {
        $this->gametypeid = $gametypeid;
    }

    function setGametype($gametype) {
        $this->gametype = $gametype;
    }
    
    function setGamehighprice($gamehighprice){
        $this->gamehighprice =$gamehighprice;
    }
    
    function setGamelowprice($gamelowprice){
        $this->gamelowprice =$gamelowprice;
    }
    
    function setGamecomment($gamecomment){
        $this->gamecomment = $gamecomment;
    }
            
    function setGametypeactive($gametypeactive) {
        $this->gametypeactive = $gametypeactive;
    }
    
    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }
    
}
