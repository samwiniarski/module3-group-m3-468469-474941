<?php require 'database.php'; 
session_start();?>

<html>
    <head>
        <title>My News Site</title>
        <link href="news-site-styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
    
    	<div class="container">
    		<div class="news-box">
                <h1>Your News</h1>
    			<div class="news">
                    <?php
                        // get the database handler
                        $mysqli = connectdb(); 
                        // Fetch news
                        $stmt = $mysqli->prepare("SELECT newstitle, newstext from stories");

                        if(!$stmt){
                            printf("Query Prep Failed: %s\n", $mysqli->error);
                            exit;
                        }

                        $stmt->execute();

                        $stmt->bind_result($title, $text);

                        echo "<ul>\n";

                        //this prints out all the stories!
                        while($stmt->fetch()){
                            printf("\t<li>%s %s</li>\n",
                                htmlspecialchars($title),
                                htmlspecialchars($text)
                            );
                        }
                        echo "</ul>\n";

                        $stmt->close();
                    ?>

                    
    			</div>

                <div class="newstorysubmit">
                    <a href="submitnews.php">Submit a New Story</a>
                </div>

    		</div>

    	</div>

    </body>
</html>