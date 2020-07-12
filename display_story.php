<!-- function for displaying stories -->
<?php
    function display_story(array $story, $index) { ?>
        <li>
            <input type="checkbox" id="<?php echo $index; ?>" name="<?php echo $index; ?>">
            <a href="<?php echo $story['url']; ?>"><?php echo $story['title']; ?></a></li><br>
            Author: <?php echo $story['author']; ?><br>
            Published: <?php echo substr($story['publishedAt'], 0, 10); ?><br>
            <img style="width:250px;" src="<?php echo $story['urlToImage']; ?>" alt="">
            <br><br><br>
        </li>
    <?php } ?>