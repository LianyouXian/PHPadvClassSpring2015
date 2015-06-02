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
        
            $game = $scope->view['model']->getGame();
            $active = $scope->view['model']->getActive();
            $gameTypeid = $scope->view['model']->getGametypeid();
            $gameID = $scope->view['model']->getGameid();
            $gameHighprice = $scope->view['model']->getGamehighprice();
            $gameLowprice = $scope->view['model']->getGamelowprice();
            $gameComment = $scope->view['model']->getGamecomment();
        ?>
        
        <h3>Add game</h3>
        <form action="#" method="post">
            <label>Game:</label>            
            <input type="text" name="game" value="<?php echo $game; ?>" placeholder="" />
            <br /><br />
            <label>Game Type:</label>
            <select name="gametypeid">
            <?php 
                foreach ($scope->view['gameTypes'] as $value) {
                    if ( $value->getGametypeid() == $gameTypeid ) {
                        echo '<option value="',$value->getGametypeid(),'" selected="selected">',$value->getGametype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getGametypeid(),'">',$value->getGametype(),'</option>';
                    }
                }
            ?>
            </select>
            <br /><br />
            <label>High price:</label>
            <input type="number" max="100" min="0" name="highprice" value="<?php echo $gameHighprice; ?>" />
            <label>Low price:</label>
            <input type="number" max="100" min="0" name="lowprice" value="<?php echo $gameLowprice; ?>" />
            <br /><br />
            <label>Comment:</label>            
            <input type="text" name="gamecomment" value="<?php echo $gameComment; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            <br /><br />
            <input type="hidden" name="action" value="create" />
            <input type="submit" value="Submit" />
        </form>
        
        
        
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
        
         <?php 
         
          if ( count($scope->view['games']) <= 0 ) {
                echo '<p>No Data</p>';
            } else {
                echo '<table border="1" cellpadding="5"><tr><th>Game</th><th>Game Type</th><th>High price</th><th>Low price</th><th>Comment</th><th>Last updated</th><th>Logged</th><th>Active</th><th></th><th></th></tr>'; 
                 foreach ($scope->view['games'] as $value) {
                    echo '<tr><td>',$value->getGame(),'</td><td>',$value->getGametype(),'</td><td>',$value->getGameHighprice(),'</td><td>',$value->getGameLowprice(),'</td><td>',$value->getGameComment(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                    echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                     echo '<td><form action="#" method="post"><input type="hidden"  name="gameid" value="',$value->getGameid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                    echo '<td><form action="#" method="post"><input type="hidden"  name="gameid" value="',$value->getGameid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
               
                    echo '</tr>' ;
                }
                echo '</table>';
            }
           
           

         ?>
            
    </body>
</html>
