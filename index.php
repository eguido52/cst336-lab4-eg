<?php
     $backgroundImage = "img/sea.jpg";
     
    if(isset($_GET['keyword']))
    {    
        include 'api/pixabayAPI.php';
        $keyword = $_GET['keyword'];
        $imageURLs = getImageURLs($keyword);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
   
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset= "utf-8" />
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url(<?=$backgroundImage?>);
            }
        </style>
    </head>
    
    <body>
        <br/>
        
        <?php
            if(!isset($imageURLs))
            {
                echo "<h2> Type a keyword to display a slideshow <br /> with random imgaes from Pixabay.com </h2>";
            }
            else 
            {
        ?>
        <div id= "carousel-example-generic" class= "carousel slide" data-ride= "carousel">
            
            <ol class="carousel-indicators">
                <?php
                    for($i=0; $i<7; $i++)
                    {
                        echo "<li data-target= '#carousel-example-generic' data-slide-to= '$i'";
                        echo ($i==0)? "class='active'": "";
                        echo "></li>";
                    }
                ?>
            </ol>
            
            <div class= "carousel-inner" role= "listbox">
            <?php
                for($i = 0; $i<7; $i++)
                {
                    do
                    {
                        $randomIndex = rand(0,count($imageURLs));
                    }while(!isset($imageURLs[$randomIndex]));
                    
                    echo '<div class= "item ';
                    echo ($i==0)?"active":"";
                    echo '">';
                    echo '<img src= "'.$imageURLs[$randomIndex].'" >';
                    echo '</div>';
                    unset($imageURLs[$randomIndex]);
                }
            ?>
            </div>
            
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <?php
            }//end else
        ?>
        <br>
        <form>
            <input type="text" name="keyword" placeholder= "keyword" value="<?=$_GET['keyword']?>"/>
            <br/><br/>
            <!--<div id="imageLayout">-->
            <input type="radio" id="lhorizontal" name="layout" value="horizontal"/>
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label><br/>
            <input type="radio" id="lvertical" name="layout" value="vertical"/>
            <label for="Vertical"></label><label for="lvertical">Vertical </label><br/>
            <!--</div>-->
            <br />
            <select name="category">
                 <option value="">- Select One -</option>
                 <option > Dogs </option>
                 <option > Cats </option>
                 <option > Rabbits </option>
                 <option > Otters </option>
                 <option > Pandas </option>
            </select><br/><br/>
            <input type="submit" value="Search"/>
        </form>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </body>
    
    <footer>
        
    </footer>
    
</html>