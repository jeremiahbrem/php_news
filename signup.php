<!-- Signup new user if doesn't already exist, add to database, and redirect to user page -->
<?php
    
    include "search.php";
  
    if (isset($_POST['first-name'])) {
        try{
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // check if username or email already exist in database
            $user_search = new Search("SELECT username FROM users WHERE username = '{$username}'", $conn);
            $if_user = $user_search->get_search_results()[0]['username'];
            $email_search = new Search("SELECT email FROM users WHERE email = '{$email}'", $conn);
            $if_email = $email_search->get_search_results()[0]['email'];

            if ($if_user) {
        ?>
        <h4>Username already exists</h4>
        <?php
            }
            else if ($if_email) {
        ?>
        <h4>Email already exists</h4>
        <?php
            }
            else {
                // adds new user to database and redirects to user page
                $sql_insert = "INSERT INTO users (firstname, lastname, email, username, hashed_password)
                VALUES (?,?,?,?,?)";

                $stmt= $conn->prepare($sql_insert);
                $stmt->execute([$first_name, $last_name, $email, $username, $password]);
                $_SESSION['current_user'] = $username;
                header("Location: user.php");
            }
            
            
            } catch (Exception $ex) {
                $message = $ex->getMessage();
                echo $message;
            }
        }
    ?>