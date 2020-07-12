<!-- Class for searching MySQL database -->
<?php
    class Search {

        public $sql;
        
        // create new search instance with SQL statement
        public function __construct(string $sql, PDO $conn) {
            $this->sql = $sql;
            $this->conn = $conn;
        }

        // Submit SQL statement to database and return results
        public function get_search_results() {
            $statement = $this->conn->prepare($this->sql);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>    