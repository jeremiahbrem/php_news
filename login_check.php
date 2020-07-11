<!-- If user not logged in, redirects signup/login page -->
<?php
    include 'connect.php';
    include 'search.php';

    if (!isset($_SESSION['current_user'])) {
        header("Location: /index.php");
    } else {  
        // retrieves firstname and id from database for later use
        $username = $_SESSION['current_user'];
        $name_id_search = new Search("SELECT firstname, id FROM users WHERE username = '{$username}'", $conn);
        $first_name = $name_id_search->get_search_results()[0]['firstname'];
        $id = $name_id_search->get_search_results()[0]['id'];
    }    
    ?>    