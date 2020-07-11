<!-- User home page for searching news stories -->
<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>
    
<h1>Hello <?php echo $first_name ?></h1><br>

<a href="logout.php">Logout</a><br><br>

<a href="favorites.php">Favorites</a><br><br>

<a href="news_feed.php">News Feed</a><br><br>

<h3>Select the Stories You Want to Share</h3>

<!-- Form for searching news topics -->
<form action="" method="POST">
    <input id="search-stories" name="search-stories" type="text" placeholder="Search a topic">
    <input type="submit">
</form><br>

<?php include "api.php"; ?>   

<?php include "templates/footer.php"; ?>