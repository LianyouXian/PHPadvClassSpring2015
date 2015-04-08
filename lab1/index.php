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
        $emailType = filter_input(INPUT_POST, 'emailtype');
        
        //connect to database
        $dbConfig = array
        (
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        if ( $util->isPostRequest() ) //if utillity is a post repuest
        {
            $errors = array();
            if ( !$validator->emailTypeIsValid($emailType) ) //if email not valid
            {
            $errors[] = 'Email is not valid';//tell the user that the email is not valid
            }
    
            if ( count($errors) > 0 ) //if it have more than one error. show all of them
            {
                foreach ($errors as $value) 
                {
                echo '<p>',$value,'</p>';
                }
            }
            else //else if there are no error, then insert into database
            {
                $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  
                $values = array(":emailtype"=>$emailType);
                if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
                {
                echo 'Email Added';
                }       
            }
    
    
        }

       
    ?>
     <!-- set up the form--> 
    <center>
    <h3>Add Email type</h3>
    <form action="#" method="post">
        <label>Email:</label> 
        <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
        <input type="submit" value="Submit" />
    </form>
            
    <?php 
    
    $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
    
    if ($stmt->execute() && $stmt->rowCount() > 0) 
        {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $value)
        {
        echo '<strong><p>', $value['emailtype'], '</p></strong>';
        }
        } 
    else 
    {
    echo '<p>No Data</p>';
    }
    
    ?>
    </center>  
         
         
    </body>
</html>