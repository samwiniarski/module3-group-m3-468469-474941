<?php require 'database.php' ?>

<html>
    <head>
        <title>My News Site</title>
        <link href="news-site-styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <a href="index.php">Back to Main Page</a>

        <!-- insert a form here that lets you submit stories too 
        then take what's been posted & send it to the database-->
        <form class="mainForm story-submit-form" action="submitnews.php" method="POST">
            <h1>Submit a Story</h1>
            
                <label for="title">Title:</label> <br>
                <input id="title" type="text" name="title">
                <label for="story">Story:</label> <br>
                <input id="story" type="text" name="story">

                <label for="comment">Comments:</label> <br>
                <input id="comment" type="text" name="comment">

                <label for="link">Link to story:</label> <br>
                <input id="link" type="text" name="link">
          

            <button type="submit" name="submit">Submit Story</button>
        </form>

        <?php
            // this allows the user to submit stories to database, which then gets rendered
            if(isset($_POST['title']) && isset($_POST['story'])) {
                $mysqli = connectdb(); 

                $newtitle = $_POST['title'];
                $newstory = $_POST['story'];
                // $newlink = $_POST['link'];
                
                $sql = "INSERT INTO stories(newstitle, newstext) VALUES(?, ?)";
                
                $stmt = $mysqli -> prepare($sql);
                
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                } else {
                    echo "Query successful!";            
                    $stmt->bind_param('ss', $newtitle, $newstory);
                    $stmt->execute();
                    $stmt->close();
                }

                if(isset($_POST['comment'])) {
                    $newcomment = $_POST['comment'];
                    $sql = "INSERT INTO comments(commentstext) VALUES(?)";

                    $stmt = $mysqli -> prepare($sql);
                
                    if(!$stmt){
                        printf("Query Prep 2 Failed: %s\n", $mysqli->error);
                        exit;
                    } else {
                        echo "Query successful!";            
                        $stmt->bind_param('s', $newcomment);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
            } 
 
        ?>

    </body>
</html>