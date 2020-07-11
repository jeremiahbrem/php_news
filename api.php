<!-- Sends search request to News API, displays results with checkbox options to add to users favorites -->
<?php
    $search = '';
    // create array for storing stories to reference for adding favorites to database
    $stories = array();
    session_start();
    // sends API request
    if (isset($_POST['search-stories'])) {
        $search = $_POST['search-stories'];
        $key = getenv('NEWS_API_KEY');
        $news_url = "http://newsapi.org/v2/everything?q={$search}&apiKey={$key}";
        $curl = curl_init($news_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        $decode = json_decode($result, true);
        ?>
        <!-- Form for submitting user favorites -->
        <form action="favorites.php" method="POST">
            <button type="submit">Add Favorites</button>
            <ul>
            <?php
                $articles = $decode['articles'];
                for ($i = 0; $i < count($decode); $i++) {
                    $title = $articles[$i]['title'];
                    $author = $articles[$i]['author'];
                    $published = $articles[$i]['publishedAt'];
                    $image = $articles[$i]['urlToImage'];
                    $url = $articles[$i]['url'];
                    // add stories to array for reference if adding to favorites
                    array_push($stories, array("title"=>$title,
                                            "author"=>$author,
                                            "published"=>$published,
                                            "image"=>$image,
                                            "url"=>$url));
                ?>
                <!-- Display story results to page -->
                <li>
                    <input type="checkbox" id="<?php echo $i; ?>" name="<?php echo $i; ?>">
                    <a href="<?php echo $url; ?>"><?php echo $title; ?></a></li><br>
                    Author: <?php echo $author; ?><br>
                    Published: <?php echo substr($published, 0, 10); ?><br>
                    <img style="width:250px;" src="<?php echo $image; ?>" alt="">
                    <br><br><br>
                </li>
            <?php
            }
            curl_close($curl);
            // add stories array to session to access in favorites.php
            $_SESSION['stories'] = $stories;
            ?>
            </ul>
        </form>
        
    <?php } ?>    