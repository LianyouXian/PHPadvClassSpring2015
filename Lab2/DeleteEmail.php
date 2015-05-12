<?php
include './bootstrap.php'; ?>
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
       
       $emailid = filter_input(INPUT_GET, 'emailid');
               if(NULL !== $emailid)
               {
                   $emailDAO = new EmailDAO($db);
                   
                   if($emailDAO->delete($emailid))
                   {
                       echo "The Email is Deleted";
                   }
               }
               
               echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Back</a></p>';
               echo '<p><a href="AddEmail.php">Add Email</a></p>';
               echo '<p><a href="AddEmailType.php">Add Email Type</a></p>';
       
        ?>
    </body>
</html>

