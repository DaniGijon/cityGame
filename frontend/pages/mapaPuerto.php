<?php
    global $db;
    $id = $_SESSION['loggedIn'];
    $sql = "SELECT * FROM personaje WHERE id='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();

?>
