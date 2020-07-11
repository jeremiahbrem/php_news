<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>

<h1>News Feed</h1>

<a href="logout.php">Logout</a><br><br>

<a href="user.php">Search</a><br><br>

<a href="favorites.php">Favorites</a><br>

<hr>

<?php
    $favorites_search = new Search("SELECT * FROM favorites;", $conn);
    $results = $favorites_search->get_search_results();
    shuffle($results);

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