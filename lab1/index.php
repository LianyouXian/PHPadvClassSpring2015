<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <style>
        body 
        {
        background-color:lightcyan;
        }
    </style>
    <body>
           
    <?php
        $util = new Util(); //create new utillity
        $validator = new Validator(); //create new validator
        
        $sendEmailType = new emailTypeDB();//get the class from emailTypeDB
        $emailType = filter_input(INPUT_POST, 'emailtype'); //filtering the input
        
        $errors = array(); //making empty error string to contain future errors
        
        if ( $util->isPostRequest() ) //if utillity is a post repuest
        {
            
            if ( !$validator->emailTypeIsValid($emailType) ) //if email not valid
            {
            $errors[] = 'sorry,invalid Email Type';//tell the user that the email is not valid
            }
    
            if ( count($errors) > 0 ) //if it have more than one error. show all of them
            {
                foreach ($errors as $value) 
                {
                echo '<p>',$value,'</p>';
                }
            }
            else //else if there are no error, then send to emailTypeBD in to sendToEmail function
            {
                  $sendEmailType->sendToDB($emailType);
            }
        }

       
    ?>
     <!-- set up the form--> 
    <center>
    <h3>Add Email type</h3>
    <form action="#" method="post">
        <label>Email Type:</label> 
        <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
        <input type="submit" value="Submit" />
    </form>
            
    <?php //call display email type function from emailTypeDB to display the database
    
    $sendEmailType->DisplayEmailType($emailType);
    
    ?>
    </center>  
         
         
    </body>
</html>