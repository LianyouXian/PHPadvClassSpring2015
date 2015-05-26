<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        /*
         * Normally with relational MySQL your dealing with multipule databases that have a connection with another table.
         * 
         * In this example we have a phone table that has a phonetypeid that is linked to the phone type table.
         * We can use the phonetypeid from the phone table to get a match from the phonetype table and get the phonetype.
         * 
         * phone->phonetypeid belongs to phonetype->phonetypeid
         * 
         * 
         * if you need a review about joins this article is good
         * 
         * http://www.sitepoint.com/understanding-sql-joins-mysql-database/
         * 
         */
        
        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("SELECT emailid from email WHERE email = :email");  
        $values = array(":email"=>'Lianyouxian@email.com');
        
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
        {
            echo '<p>Your Email was Already added</p>';
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
             
            //update the email
            $stmt = $db->prepare("UPDATE email SET lastupdated = now() WHERE emailid = :emailid");  
            $values = array(":emailid"=>$result['emailid']);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
            {
                echo '<p>Email Updated</p>';
            }   
        } 
        else
        {
            //add Email
            $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, logged = now(), lastupdated = now()");  
            $values = array(":email"=>'Lianyouxian@email.com',":emailtypeid"=>'1');
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
            {
                echo '<p>Email Added</p>';
            } 
        }

        //display all data
        $stmt = $db->prepare("SELECT email.email, emailtype.emailtype, email.logged, email.lastupdated FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid");  
                
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) 
        {
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            echo '<table>';
            foreach ($results as $value) 
            {
                echo '<tr>';
                echo '<td>', $value['email'], '</td>';
                echo '<td>', $value['emailtype'], '</td>';
                // we use the MySQL timestamp to format it in PHP
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['logged']))  , '</td>';
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['lastupdated'])) , '</td>';
                echo '</td>';
            }
             echo '</table>';
        }
        else 
        {
            echo '<p>No Data</p>';
        }
        
        ?>
    </body>
</html>

