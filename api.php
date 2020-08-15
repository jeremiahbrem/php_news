<!-- Sends search request to News API, displays results with checkbox options to add to users favorites -->
<?php
    include "display_story.php";
    include "user.php";
    $search = '';
    // create array for storing stories to reference for adding favorites to database
    $stories = array();
    $result;
    $decode;
    
    session_start();
    
    // sends API request
    function get_stories(string $search) {
        $formatted_string = str_replace(' ', '%20', $search);
        $key = getenv('NEWS_API_KEY');
        $news_url = "http://newsapi.org/v2/everything?q={$formatted_string}&apiKey={$key}";
        print($news_url);
        $curl = curl_init($news_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($curl);
        if (!$result) { 
            return array("Error"=>"There was an error accessing the News API.",
                         "Message"=>curl_error($curl));
        }
        return $result;
    }

    if (isset($_POST['search-stories'])) {
        $result = get_stories($_POST['search-stories']);
    } 

    if ($result) {
        $decode = json_decode($result, true);
    }

    if ($decode && $decode['totalResults'] != 0) { ?>
        <!-- Form for submitting user favorites -->
        <form action="favorites.php" method="POST">
            <button type="submit">Add Favorites</button>
            <ul>
        <?php
            $articles = $decode['articles'];
            for ($i = 0; $i < count($articles); $i++) {
                $story = $articles[$i];
                array_push($stories, $story);
                display_story($story, $i);
            }
            $_SESSION['stories'] = $stories; ?>
            </ul>
        </form>
    <?php } else { ?>
        <h4>No results.</h4>
<?php } ?>