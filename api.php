<?php
    $search = '';
    $stories = array();
    session_start();
    if (isset($_POST['search-stories'])) {
        $search = $_POST['search-stories'];
        $key = getenv('NEWS_API_KEY');
        $news_url = "http://newsapi.org/v2/everything?q={$search}&apiKey={$key}";
        $curl = curl_init($news_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        $decode = json_decode($result, true);
        ?>
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
                    array_push($stories, array("title"=>$title,
                                            "author"=>$author,
                                            "published"=>$published,
                                            "image"=>$image,
                                            "url"=>$url));
                ?>
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
            $_SESSION['stories'] = $stories;
            ?>
            </ul>
        </form>
        
    <?php } ?>    