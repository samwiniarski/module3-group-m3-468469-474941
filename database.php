<!DOCTYPE html>
<html>
    <head>
        <title>My News Site</title>
    </head>
    
    <body>

        <?php
            function connectdb() {
                $mysqli = new mysqli('localhost', 'root', 'FISslsl4942', 'newssitedata');

                if($mysqli->connect_errno) {
                    printf("Connection Failed: %s\n", $mysqli->connect_error);
                    exit;
                }

                return $mysqli;
            }
            
        ?>
    </body>
</html>