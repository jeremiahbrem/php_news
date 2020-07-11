<?php
   
    if (isset($_POST['username-login'])) {
        try {
            $username = $_POST['username-login'];
            $password = $_POST['password-login'];

            $user_search = new Search("SELECT username FROM users WHERE username = '{$username}'", $conn);
            $if_user = $user_search->get_search_results()[0]['username'];
            if (!$if_user) {
        ?>
                <h4>Username doesn't exist</h4>
    <?php            
            }
            else {
                $pwd_search = new Search("SELECT hashed_password FROM users WHERE username = '{$username}'", $conn);
                $hashed_pwd = $pwd_search->get_search_results()[0]['hashed_password'];
                if (password_verify($password, $hashed_pwd)) {
                    $_SESSION['current_user'] = $username;
                    header("Location: user.php");
                }
                else {
        ?>
                    <h3>Incorrect password</h3>
    <?php    
                }
            }    
        } catch (Exception $ex) {
            $message = $ex->getMessage();
            echo $message;
        }
    }

    ?>        