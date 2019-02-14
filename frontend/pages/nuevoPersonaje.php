<?php
    if(isset($_GET['message'])){
        echo $_GET['message'] . "<br>";
    }
?>

Ey! Cuéntame de tí:

<form action="?bPage=accountOptions&action=crearPersonaje&nonUI" method="post">
    
    Sexo: 
    <select name="sexo">

    <option>Hombre</option>

    <option>Mujer</option>
    
    </select>
    <br>
    ¿En qué barrio vives? 
    <select name="origen">

    <option>Cañamares</option>
    <option>Libertad</option>
    <option>Constitucion</option>
    <option>El Poblado</option>
    <option>Santa Ana</option>
    <option>Centro Sur</option>
    <option>El Pino</option>
    <option>El Carmen</option>
    <option>Fraternidad</option>
    <option>Ciudad Jardin</option>
    
    </select>
  
    <input type="submit">
</form>