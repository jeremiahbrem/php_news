<!-- Connect to MySQL database and create tables for users and favorites -->
<?php
    session_start();
    $servername = "localhost";
    $username = getenv('MYSQL_LOGIN');
    $password = getenv('MYSQL_PASSWORD');
    $dbname = "news_api";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE,
            username VARCHAR(30) NOT NULL UNIQUE,
            hashed_password VARCHAR(100)
            ) Engine=InnoDB;";
        $conn->exec($sql);

        $sql2 = "CREATE TABLE IF NOT EXISTS favorites (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                url VARCHAR(500),
                author VARCHAR(100),
                publishedAt VARCHAR(30),
                urlToImage VARCHAR(500),
                user_id INT,
                FOREIGN KEY(user_id) REFERENCES users(id)
                ) Engine=InnoDB;";  
        $conn->exec($sql2);

    } catch(PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
  

?>
