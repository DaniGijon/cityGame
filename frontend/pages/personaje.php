<?php
  
        include(__ROOT__."/backend/personajeFunctions.php");
        $id = $_SESSION['loggedIn'];
        
        echo"<div id='personajeArea'>";
            listPersonajeTodo($id);
        echo "</div>";
?>
