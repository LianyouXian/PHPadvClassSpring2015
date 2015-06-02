<?php
namespace App\models\services;


class GameTypeModel extends BaseModel {
    
    private $gametypeid;
    private $gametype;
    private $active;
    
    function getGametypeid() {
        return $this->gametypeid;
    }

    function getGametype() {
        return $this->gametype;
    }

    function getActive() {
        return $this->active;
    }

    function setGametypeid($gametypeid) {
        $this->gametypeid = $gametypeid;
    }

    function setGametype($gametype) {
        $this->gametype = $gametype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
