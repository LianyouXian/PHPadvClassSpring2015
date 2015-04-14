<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailTypeDBclass
 *
 * @author 001296817
 */
class emailTypeDB
{
    private $emailtype;
    
    function getEmailType() 
    {
        return $this->emailtype;
    }
    
    function setEmailType($emailtype) 
    {
        $this->emailtype = $emailtype;        
    }
}
