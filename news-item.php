<?php require 'functions.php' ?>

    <html>
    <head>
    	<title>Welcome to news channel</title>
    	<link rel="stylesheet" type="text/css" href="design/style.css">
    </head>


    <body>
    	<div class="container">
    
    		<div class="welcome">
    			<h1>Latest news</h1>
    			<p>Welcome to the demo news site. <em>We never stop until you are aware.</em></p>
    			<a href="index.php">return to home page</a>
    		</div>
    
    		<div class="news-box">
    
    			<div class="news">
    				<?php
    					// get the database handler
    					$dbh = connect_to_db(); // function created in dbconnect, remember?
    
    					$id_article = (int)$_GET['newsid'];
    
    					if ( !empty($id_article) && $id_article > 0) {
    						// Fecth news
    						$article = getAnArticle( $id_article, $dbh );
    						$article = $article[0];
    					}else{
    						$article = false;
    						echo "<strong>Wrong article!</strong>";
    					}
    
    					
    
    				?>
    
    
    			
    			</div>
    
    			
    		</div>
    
    	</div>
    </body>
</html>