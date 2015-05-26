<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
             $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                );
            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            
            if ( NULL !== $emailtypeid ) 
            {
               $emailTypeDAO = new EmailTypeDAO($db);
               
                if ( $emailTypeDAO->delete($emailtypeid) ) 
                {
                   echo 'deleted Email type';                  
                }                
        
            }
            
            
            echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">back</a></p>';
            echo '<p><a href="AddEmail.php">Add Email</a></p>';
            echo '<p><a href="AddEmailType.php">Add Email Type</a></p>';
        
        ?>
    </body>
</html>
