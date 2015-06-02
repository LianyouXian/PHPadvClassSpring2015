<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        // put your code here
        
       
         if ( $scope->util->isPostRequest() ) {
             
             if ( isset($scope->view['errors']) ) {
                print_r($scope->view['errors']);
             }
             
             if ( isset($scope->view['saved']) && $scope->view['saved'] ) {
                  echo 'Game Added';
             }
             
             if ( isset($scope->view['deleted']) && $scope->view['deleted'] ) {
                  echo 'Game deleted';
             }
             
         }
        
         $gameType = $scope->view['model']->getGametype();
         $active = $scope->view['model']->getActive();
        
        ?>
        
        
         <h3>Add game type</h3>
        <form action="#" method="post">
            <label>Game Type:</label> 
            <input type="text" name="gametype" value="<?php echo $gameType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>
         <br />
         <br />
         
       
         <div>
             <a href="game.php"></a>
         </div>
        
         <?php
         
        
          if ( count($scope->view['GameTypes']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Game Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($scope->view['GameTypes'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getGametype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="gametypeid" value="',$value->getGametypeid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="gametypeid" value="',$value->getGametypeid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
         
         
         ?>
         <a href="game"> redirect to add game</a>
    </body>
</html>
