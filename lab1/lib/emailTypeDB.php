<?php

/**
 * Description of emailTypeDBclass
 *
 * @author 001296817
 */
class emailTypeDB
{
    public function sendToDB($emailType)
    {
        $dbConfig = array
        (
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");
        $values = array(":emailtype"=>$emailType);
            
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
            {
            echo 'Email Added';//when email is added display the message that email is added.
            }  
        
    }
    
    public function DisplayEmailType($emailType)
    {
        $dbConfig = array
        (
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("SELECT * FROM emailtype"); //select the data in the database and display when enter the page.
    
        if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($results as $value)
            {
                if($value['active'] == 1)
                {
                echo '<strong><p>', $value['emailtype'], '</p></strong>';//wrap the output in strong to make it bold.
                }
                else
                {
                    echo '<p>', $value['emailtype'],'</p>';
                }
            }
        } 
        else 
        {
        echo '<p>No Data</p>';//if there are no data display no data.
        }
    
    }
}
