<?php
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
?>

Please register:

<form action="?bPage=accountOptions&action=register&nonUI" method="post">
    Username: <input type="text" name="username" pattern=".{4,20}" title="Min. 4 caracteres, Max. 20 caracteres" required><br>
    Password: <input type="password" name="password" pattern=".{8,32}" title="Min. 8 caracteres, Max. 32 caracteres" required><br>
    Email: <input type="email" name="email" required><br> 
    <input type="submit">
</form>