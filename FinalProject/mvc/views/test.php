<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <h1>Test</h1>
        <?php
            if ( isset($scope->view['game']) ) {
                echo $scope->view['game'];
            }
            
            if ( isset($scope->view['gamevalid']) ) {
                
                if ( $scope->view['gamevalid'] ) {
                    echo '<p>game is valid</p>';
                } else {
                    echo '<p>game is NOT valid</p>';
                }
                
            }
            
        
        ?>
        <form action="#" method="post">            
            <input type="text" name="game" />            
            <input type="submit" value="submit" />            
        </form>
        
        
        
        <?php
        
        
        //var_dump($scope->view);
        
        echo $scope->view['test1'];
        echo $scope->view['test2'];
        if ( isset($scope->view['test3']) ) {
            echo $scope->view['test3'];
        }
        
        
        ?>
    </body>
</html>
