<?php require 'functions.php' ?>

<html>
    <head>
        <title>My News Site</title>
        <link href="news-site-styles.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <a href="index.php">Back to Main Page</a>

        <!-- insert a form here that lets you submit stories too 
        then take what's been posted & send it to the database-->
        <form class="story-submit" action="submitnews.php" method="POST">
            <h1>Submit a Story</h1>
            <label for="title">Title:</label>
            <input id="title" type="text" name="title">
            <label for="story">Story</label>
            <input id="story" type="text" name="story">
            <!-- <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" /> -->
            <button type="submit" name="submit">Submit Story</button>
        </form>

        <?php
            // this allows the user to submit stories to database, which then gets rendered
            if(isset($_POST['title']) && isset($_POST['story'])) {
                $mysqli = connectdb(); 

                $newtitle = $_POST['title'];
                $newstory = $_POST['story'];
                
                $sql = "INSERT INTO stories(newstitle, newstext) VALUES(?, ?)";
                
                $stmt = $mysqli -> prepare($sql);
                
                if(!$stmt){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                } else {
                    echo "Query successful!"; 
                    //$_SESSION['token'] = bin2hex(random_bytes(32));           
                    $stmt->bind_param('ss', $newtitle, $newstory);
                    $stmt->execute();
                    $stmt->close();
                }
            } 
        ?>

    </body>
</html>