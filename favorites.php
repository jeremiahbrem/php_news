<!-- Retrieves favorites from session, adds to database if not duplicate, and displays users favorites to page -->
<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>
<?php include "display_story.php"; ?>

<h1><?php echo $first_name ?>'s Favorites</h1>

<a href="logout.php">Logout</a><br><br>

<a href="user.php">Search</a><br><br>

<a href="news_feed.php">News Feed</a><br>

<hr>

<?php
    // retrieves favorites added to session from user.php
    $stories = $_SESSION['stories'];
    $favorites_search = new Search("SELECT * FROM favorites WHERE user_id= '{$id}'", $conn);
    $results = $favorites_search->get_search_results();
    
    // get story titles to check duplicates later
    function get_title($story) {
        return $story['title'];
    }
    $titles = array_map('get_title', $results);

    if (isset($_POST)) { 
        foreach(array_keys($_POST) as $index) { 
            $story = $stories[$index];
            $title = $story['title'];
            $author = $story['author'];
            $published = $story['publishedAt'];
            $image = $story['urlToImage'];
            $url = $story['url'];

            // adds new favorite if it doesn't already exist in database
            if (!in_array($title, $titles)) {
                $sql_insert = "INSERT INTO favorites (title, author, url, publishedAt, urlToImage, user_id)
                VALUES (?,?,?,?,?,?)";

                $stmt= $conn->prepare($sql_insert);
                $stmt->execute([$title, $author, $url, $published, $image, $id]);
            }
        }
    } 
    
    // retrieve updated user favorites from database
    $get_favorites = new Search("SELECT * FROM favorites WHERE user_id= '{$id}'", $conn);
    $user_favorites = $favorites_search->get_search_results();
    ?>

    <!-- Form for deleting favorites -->
    <form action="delete.php" method="POST">
        <button type="submit">Delete Favorites</button><br><br>
        <ul>
        <?php
        foreach($user_favorites as $story) { 
            $index = $story['id'];
            display_story($story, $index);
         } ?>
         </ul>
    </form>   

<?php include "templates/footer.php"; ?>    