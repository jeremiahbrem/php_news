<!-- Retrieves story ids from delete POST, removes from database, and refreshes page -->
<?php
    include 'connect.php';
    if (isset($_POST)) {
        foreach(array_keys($_POST) as $id) {
        $sql = "DELETE FROM favorites WHERE id = '{$id}'";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        }
    }    
    header("Location: favorites.php");
?>    