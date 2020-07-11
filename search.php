<?php
    class Search {

        public $sql;
        
        public function __construct(string $sql, PDO $conn) {
            $this->sql = $sql;
            $this->conn = $conn;
        }

        public function get_search_results() {
            $statement = $this->conn->prepare($this->sql);
            $statement->execute();
            return $statement->fetchAll();
        }
    }
?>    