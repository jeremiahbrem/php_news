<?php include "templates/header.php"; ?>
<?php include "login_check.php"; ?>
    
<h1>Hello <?php echo $first_name ?></h1><br>

<a href="logout.php">Logout</a><br>

<a href="favorites.php">Favorites</a><br>

<a href="news_feed.php">News Feed</a><br>

<h3>Select the Stories You Want to Share</h3>

<form action="" method="POST">
    <input id="search-stories" name="search-stories" type="text" placeholder="Search stories">
    <input type="submit">
</form><br>

<?php include "api.php"; ?>   

<?php include "templates/footer.php"; ?>