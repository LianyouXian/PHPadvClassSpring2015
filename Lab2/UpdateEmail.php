<?php
include './bootstrap.php';?>
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
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
        $validator = new Validator();
        $errors = array();
        $emailTypeDAO = new EmailTypeDAO($db);
        
        $emailTypes = $emailTypeDAO->getAllRows();
        
        if($util->isPostRequest())
        {
            $emailModel->map(filter_input_array(INPUT_POST));
        }
        else
        {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getById($emailid);
        }
       
        $emailid = $emailModel->getEmailid();
        $email = $emailModel->getEmail();
        $active = $emailModel->getActive();
        $emailTypeid = $emailModel->getEmailtypeid();
        $emailType = $emailModel->getEmailtype();
        
        if ($util->isPostRequest())
        {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getById($emailid);
            
            $email = filter_input(INPUT_POST, 'email');
            $emailtypeid = filter_input(INPUT_POST, 'emailtypeid');
            $active = filter_input(INPUT_POST, 'active');
            
            if(!$validator->emailIsValid($email))
            {
                $errors[] = 'Email is Invalid.';
            }
            
            if(!$validator->activeIsValid($active))
            {
                $errors[] = 'Active is invalid';
            }
            
            if(count($errors) > 0 )
            {
                foreach ($errors as $value)
                {
                  
                    echo'<p>',$value,'</p>';
                }
            }
            else 
            {   
                if($emailDAO->idExisit($emailModel->getEmailid()))
                {
                    $emailModel->map(filter_input_array(INPUT_POST));        
                           
                    if($emailDAO->save($emailModel));
                    {
                        echo "Email Updated.";
                    }
                }
            }
        }
        
        ?>
        
        <h3>Email Update</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            
            <br /><br />
            
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) 
                    {
                    if ( $value->getEmailtypeid() == $emailTypeid) 
                    {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
        
        <table border="1" cellpadding="5">
                <tr>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Active</th>
                    <th>Logged</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) 
            {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>' ;
                echo '<td><a href="UpdateEmail.php?emailid=' . $value->getEmailid() . '">Update</a></td>  ';
                echo '<td><a href="DeleteEmail.php?emailid=' . $value->getEmailid() . '">Delete</a></td>  ';
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


