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
       
        $util = new Util();
        $validator = new Validator();
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailtypeModel = new EmailTypeModel();
         
        if ( $util->isPostRequest() ) 
        {
            $emailtypeModel->map(filter_input_array(INPUT_POST));             
        } 
        else 
        {
            $emailtypeid = filter_input(INPUT_GET, 'emailtypeid');
            $emailtypeModel = $emailTypeDAO->getById($emailtypeid);
        }
        
        
        $emailtypeid = $emailtypeModel->getEmailtypeid();
        $emailType = $emailtypeModel->getEmailtype();
        $active = $emailtypeModel->getActive();  
              
        
        $emailTypeService = new EmailTypeService($db, $util, $validator, $emailTypeDAO, $emailtypeModel);
        
        if ( $emailTypeDAO->idExisit($emailtypeModel->getEmailtypeid()) ) 
        {
            $emailTypeService->saveForm();
        }
        ?>
        
        
         <h3>UPDATE Email type</h3>
        <form action="#" method="post">
             <input type="hidden" name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         <table border="1" cellpadding="5">
         <?php         
             $emailTypes = $emailTypeDAO->getAllRows();
            

            foreach ($emailTypes as $value) 
            {
                echo"<tr><td>";
                echo '<strong><p>',$value->getEmailtype(),'</p></strong>';
                echo '<td><strong><p>',($value->getActive() == 1 ? 'Yes' : 'No'),'</p></strong></td>';
                echo '<td><a href="DeleteEmailtype.php?emailtypeid=' . $value->getEmailtypeid() . '">Delete</a></td>  ';
                echo '<td><a href="UpdateEmailType.php?emailtypeid=' . $value->getEmailtypeid() . '">Update</a></td>  ';
                echo'</tr>';
            }
                          
         ?>
             
         </table>
         <?php
       echo '<p><a href="AddEmail.php">Add Email</a></p>';
       echo '<p><a href="AddEmailType.php">Add Email Type</a></p>';
        ?>
    </body>
</html>
