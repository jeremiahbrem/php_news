<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>

<h1><?php echo $first_name ?>'s Favorites</h1><br>

<a href="logout.php">Logout</a><br><br>

<a href="user.php">Search</a><br><br>

<a href="news_feed.php">News Feed</a><br>

<?php
    $stories = $_SESSION['stories'];
    $favorites_search = new Search("SELECT * FROM favorites WHERE user_id= '{$id}'", $conn);
    $results = $favorites_search->get_search_results();
    function getTitle($story) {
        return $story['title'];
    }
    $titles = array_map('getTitle', $results);

    if (isset($_POST)) { 
        foreach(array_keys($_POST) as $index) { 
            $story = $stories[$index];
            $title = $story['title'];
            $author = $story['author'];
            $published = $story['published'];
            $image = $story['image'];
            $url = $story['url'];

            if (!in_array($title, $titles)) {
                $sql_insert = "INSERT INTO favorites (title, author, website, published, image_url, user_id)
                VALUES (?,?,?,?,?,?)";

                $stmt= $conn->prepare($sql_insert);
                $stmt->execute([$title, $author, $url, $published, $image, $id]);
            }
        }
    }        

    for ($i = 0; $i < count($results); $i++) { 
        $story = $results[$i]; ?>
        <li>
            <input type="checkbox" id="<?php echo $i; ?>" name="<?php echo $i; ?>">
            <a href="<?php echo $story['website']; ?>"><?php echo $story['title']; ?></a></li><br>
            Author: <?php echo $story['author']; ?><br>
            Published: <?php echo substr($story['published'], 0, 10); ?><br>
            <img style="width:250px;" src="<?php echo $story['image_url']; ?>" alt="">
            <br><br><br>
        </li> 
    <?php } ?>


<?php include "templates/footer.php"; ?>    