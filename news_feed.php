<!-- Displays all favorites stories from all users -->
<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>
<?php include "display_story.php"; ?>

<h1>News Feed</h1>

<a href="logout.php">Logout</a><br><br>

<a href="user.php">Search</a><br><br>

<a href="favorites.php">Favorites</a><br>

<hr>

<?php
    // array for saving to session where favorited stories can be retrieved later
    $stories = array();
    // array for checking duplicate titles
    $titles =array();
    // Retrieve all favorites form database, shuffle, and display to page
    $favorites_search = new Search("SELECT * FROM favorites;", $conn);
    $results = $favorites_search->get_search_results();
    shuffle($results); ?>
        <form action="favorites.php" method="POST">
            <button type="submit">Add Favorites</button>
            <ul>
    <?php
        for ($i = 0; $i < count($results); $i++) { 
            $story = $results[$i];
            if (!in_array($story['title'], $titles)) {
                display_story($story, $i);
                array_push($stories, $story);
                array_push($titles, $story['title']);
            }
        } 
        $_SESSION['stories'] = $stories; ?>
            </ul>
        </form>            