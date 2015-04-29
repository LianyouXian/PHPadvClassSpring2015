<?php

class EmailModel implements IModel {
    
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $emailtypeactive;
    
    function getEmailid() 
    {
        return $this->emailid;
    }
    
    function getEmail() 
    {
        return $this->email;
    }
    
    function getEmailtypeid()
    {
        return $this->emailtypeid;
    }
    
     function getEmailtype()
    {
        return $this->emailtype;
    }
    
    function getEmailtypeactive() 
    {
        return $this->emailtypeactive;
    }
    
    
    function setEmailid($emailid)
    {
        $this->emailid = $emailid;
    }
    
    function setEmail($email) 
    {
        $this->email = $email;
    }
    
    function setEmailtypeid($emailtypeid) 
    {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setEmailtype($emailtype) 
    {
        $this->emailtype = $emailtype;
    }
    
    function setEmailtypeactive($emailtypeactive) 
    {
        $this->emailtypeactive = $emailtypeactive;
    }


    public function reset() 
            {
        $this->setEmailid('');
        $this->setEmail('');
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setEmailtypeactive('');
        return $this;
    }
    
    
   
    public function map(array $values) 
    {
        if ( array_key_exists('emailid', $values) ) 
        {
            $this->setEmailid($values['emailid']);
        }
        
        if ( array_key_exists('email', $values) ) 
        {
            $this->setEmail($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) ) 
        {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) 
        {
            $this->setEmailtype($values['emailtype']);
        }
        
        if ( array_key_exists('emailtypeactive', $values) ) 
        {
            $this->setEmailtypeactive($values['emailtypeactive']);
        }
        return $this;
    }
}

