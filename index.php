<?php
     $backgroundImage = "img/sea.jpg";
     
     include 'api/pixabayAPI.php';
    if(isset($_GET['keyword']))
    {    
        $keyword = $_GET['keyword'];
        $layout = $_GET['layout'];
        $imageURLs = getImageURLs($keyword, $layout);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    if(isset($_GET['category']) && $_GET['category']!="")
    {    
        $keyword = $_GET['category'];
        $layout = $_GET['layout'];
        $imageURLs = getImageURLs($keyword, $layout);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
    }
    if(!isset($_GET['keyword']) && !isset($_GET['category']))
    {
        $backgroundImage = "img/sea.jpg";
    }
   
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset= "utf-8" />
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("css/styles.css");
            body{
                background-image: url(<?=$backgroundImage?>);
            }
        </style>
    </head>
    
    <body>
        <br/>
        <form>
            <input type="text" name="keyword" placeholder= "keyword" value="<?=$_GET['keyword']?>"/>
            <br/><br/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal"/>
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label><br/>
            <input type="radio" id="lvertical" name="layout" value="vertical"/>
            <label for="Vertical"></label><label for="lvertical">Vertical </label>
            <br/><br/>
            <select name="category" >
                 <option value="">- Select One -</option>
                 <option value="dogs"> Dogs </option>
                 <option value="cats"> Cats </option>
                 <option value="rabbits"> Rabbits </option>
                 <option value="otters"> Otters </option>
                 <option value="pandas"> Pandas </option>
            </select><br/><br/>
            <input type="submit" value="Search"/>
        </form>
        <br/><br/>
        
        <?php
            if(!isset($imageURLs))
            {
                echo "<h2> Type a keyword to display a slideshow <br /> with random imgaes from Pixabay.com </h2>";
            }
            else 
            {
        ?>
        <div id= "carousel-example-generic" class= "carousel slide" data-ride= "carousel" style='width:300px'>
            
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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
    </body>
    
    <footer>
        
    </footer>
    
</html>