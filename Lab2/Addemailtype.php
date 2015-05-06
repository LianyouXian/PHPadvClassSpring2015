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
        $emailType = filter_input(INPUT_POST, 'emailtype');
        $active = filter_input(INPUT_POST, 'active');
        
        $util = new Util();
        $emailTypeDAO = new EmailTypeDAO($db);
       
            
            if ( $util->isPostRequest() ) 
            {
                $validator = new Validator(); 
                $errors = array();
                
                if( !$validator->emailTypeIsValid($emailType) ) 
                {
                    $errors[] = 'Your Email Type is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) 
                {
                     $errors[] = 'In-active';
                }
                
                if ( count($errors) > 0 ) 
                {
                    foreach ($errors as $value) 
                    {
                        echo '<p>',$value,'</p>';
                    }
                } 
                else 
                {                  
                    $emailtypeModel = new EmailTypeModel();
                    $emailtypeModel->setActive($active);
                    $emailtypeModel->setEmailtype($emailType);
                    
                   // var_dump($emailtypeModel);
                    if ( $emailTypeDAO->save($emailtypeModel) ) 
                    {
                        echo 'New Email added';
                    }   
                }   
            }
        
        ?>
        
        
         <h3>Add Email Type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         <table border="1" cellpadding="5">
            <tr>
                <th>Type</th>
                <th>Active</th>
                <th>Delete</th>
                <th>Update</th>
             </tr>
         <?php         
             
            $emailTypes = $emailTypeDAO->getAllRows();
            

            foreach ($emailTypes as $value) 
            {
                echo"<tr><td>";
                echo '<strong><p>',$value->getEmailtype(),'</p></strong>';
                echo '<td><strong><p>',$value->getActive(),'</p></strong></td>';
                echo '<td><a href="DeleteEmailtype.php?emailtypeid=' . $value->getEmailtypeid() . '">Delete</a></td>  ';
                echo '<td><a href="UpdateEmailType.php?emailtypeid=' . $value->getEmailtypeid() . '">Update</a></td>  ';
                echo'</tr>';
            }
            

         ?>
         
         </table>
         <?php
       echo '<p><a href="AddEmail.php">Add Email</a></p>';
        ?>
    </body>
</html>