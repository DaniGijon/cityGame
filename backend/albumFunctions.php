<?php
function dibujarAlbum(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<button id='seccion1'>Monstruos</button>";
        echo "<button id='seccion2'>Insignias</button>";
        echo "<button id='seccion3'>Coleccionismo</button>";
    echo "</div>"; 
    
    echo "<div id=seccion1>";
        echo "<button id='botonMonstruos'>Comunes</button>";
        echo "<button id='botonBosses'>Bosses de Zona</button>";
    echo "<div id='monstruos'>";
    
    echo 'MONSTRUOS DERROTADOS:<br>';
    
    $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM < '200'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    foreach($result as $cadaMonstruo){
        $idMonstruo = $cadaMonstruo['idM'];
        $sql = "SELECT * FROM monstruos WHERE idM='$idMonstruo'";
        $stmt = $db->query($sql);
        $res = $stmt->fetchAll();
        
        echo "<div id='albumFicha'>";
        echo "     <div id='opcionBox'><img src='/design/img/monstruos/" . $res[0]['imagenMonstruo'] ."'>";
        echo "     </div>";
        echo "<br>" . $res[0]['nombre'];
        echo "<br> Nivel : " . $res[0]['nivel'];
        
        switch ($res[0]['barrio']){
            case '1':
                $barrio = 'Cañamares';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Asdrúbal';
                        break;
                    case '2':
                        $zona = 'Terri';
                        break;
                }
                break;
            case '2':
                $barrio = 'Libertad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Gran Capitán';
                        break;
                    case '2':
                        $zona = 'San José';
                        break;
                    case '3':
                        $zona = 'Pozo Norte';
                        break;
                }
                break;
            case '3':
                $barrio = 'Constitución';
                $zona = 'Abulagar';
                break;
            case '4':
                $barrio = 'El Poblado';
                $zona = 'El Poblado';
                break;
            case '5':
                $barrio = 'Santa Ana';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Salesianos';
                        break;
                    case '2':
                        $zona = 'Tauro';
                        break;
                    case '3':
                        $zona = 'La Copa';
                        break;
                }
                break;
            case '6':
                $barrio = 'Centro Sur';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Viacrucis';
                        break;
                    case '2':
                        $zona = 'Paseo S.Gregorio';
                        break;
                    case '3':
                        $zona = 'Paseo El Bosque';
                        break;
                }
                break;
            case '7':
                $barrio = 'Las Mercedes';
                $zona = 'El Pino';
                break;
            case '8':
                $barrio = 'El Carmen';
                $zona = 'El Carmen';
                break;
            case '9':
                $barrio = 'Fraternidad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Las 600';
                        break;
                    case '2':
                        $zona = 'PAU';
                        break;
                    case '3':
                        $zona = 'Recinto Ferial';
                        break;
                }
                break;
            case '10':
                $barrio = 'Ciudad Jardín';
                $zona = 'Ciudad Jardín';
                break;
        }
        echo "<br> Barrio : " . $barrio;
        echo "<br> Zona : " . $zona;
        echo "<div id='fichaDescripcion'><br>" . $res[0]['descripcion'] . "</div>";
        echo "<div id='fichaPie'> Victorias : " . $cadaMonstruo['cantidad'] . "</div>";
        echo "</div>";
    }
    echo "</div>"; //FIN SECCION MONSTRUOS
    
    echo "<div id='bosses'>";
         
    $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM >= '200'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    foreach($result as $cadaMonstruo){
        $idMonstruo = $cadaMonstruo['idM'];
        $sql = "SELECT * FROM monstruos WHERE idM='$idMonstruo'";
        $stmt = $db->query($sql);
        $res = $stmt->fetchAll();
        
        echo "<div id='albumFicha'>";
        echo "     <div id='opcionBox'><img src='/design/img/monstruos/" . $res[0]['imagenMonstruo'] ."'>";
        echo "     </div>";
        echo "<br>" . $res[0]['nombre'];
        echo "<br> Nivel : " . $res[0]['nivel'];
        
        switch ($res[0]['barrio']){
            case '1':
                $barrio = 'Cañamares';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Asdrúbal';
                        break;
                    case '2':
                        $zona = 'Terri';
                        break;
                }
                break;
            case '2':
                $barrio = 'Libertad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Gran Capitán';
                        break;
                    case '2':
                        $zona = 'San José';
                        break;
                    case '3':
                        $zona = 'Pozo Norte';
                        break;
                }
                break;
            case '3':
                $barrio = 'Constitución';
                $zona = 'Abulagar';
                break;
            case '4':
                $barrio = 'El Poblado';
                $zona = 'El Poblado';
                break;
            case '5':
                $barrio = 'Santa Ana';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Salesianos';
                        break;
                    case '2':
                        $zona = 'Tauro';
                        break;
                    case '3':
                        $zona = 'La Copa';
                        break;
                }
                break;
            case '6':
                $barrio = 'Centro Sur';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Viacrucis';
                        break;
                    case '2':
                        $zona = 'Paseo S.Gregorio';
                        break;
                    case '3':
                        $zona = 'Paseo El Bosque';
                        break;
                }
                break;
            case '7':
                $barrio = 'Las Mercedes';
                $zona = 'El Pino';
                break;
            case '8':
                $barrio = 'El Carmen';
                $zona = 'El Carmen';
                break;
            case '9':
                $barrio = 'Fraternidad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Las 600';
                        break;
                    case '2':
                        $zona = 'PAU';
                        break;
                    case '3':
                        $zona = 'Recinto Ferial';
                        break;
                }
                break;
            case '10':
                $barrio = 'Ciudad Jardín';
                $zona = 'Ciudad Jardín';
                break;
        }
        echo "<br> Barrio : " . $barrio;
        echo "<br> Zona : " . $zona;
        echo "<div id='fichaDescripcion'><br>" . $res[0]['descripcion'] . "</div>";
        echo "<div id='fichaPie'> Victorias : " . $cadaMonstruo['cantidad'] . "</div>";
        echo "</div>";
    }
    echo "</div>"; //FIN SECCION BOSSES
    echo "</div>"; //FIN SECCION 1
    
    echo "<div id='seccion2'>";
    echo "<div id='insignias'>";
        $sql = "SELECT * FROM insignias WHERE idP='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        foreach ($result as $cadaInsignia){
            echo "<div id='albumFicha'>";
            echo "     <div id='opcionBox'><img src='/design/img/insignias/" . $cadaInsignia['imagen'] ."'>";
            echo "     </div>";
            echo "</div>";   
        }
    echo"</div>"; //FIN SECCION INSIGNIAS
    echo "</div>"; //FIN SECCION 2
    
    echo "<div id='seccion3'>";
        echo "<button id='botonReliquias'>Reliquias</button>";
        echo "<button id='botonAeromodelismo'>Aeromodelismo</button>";
        
    echo "<div id='aeromodelismo'>";
        $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO>='1000'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        foreach ($result as $cadaAeromodelismo){
            echo "<div id='albumFicha'>";
            echo "     <div id='opcionBox'><img src='/design/img/objetos/" . $cadaAeromodelismo['imagen'] ."'>";
            echo "     </div>";
            echo "</div>";   
        }
    echo "</div>"; //FIN SECCION AEROMODELISMO
    
    echo "<div id='reliquias'>";
        $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO<'1000'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        foreach ($result as $cadaReliquia){
            echo "<div id='albumFicha'>";
            echo "     <div id='opcionBox'><img src='/design/img/objetos/" . $cadaReliquia['imagen'] ."'>";
            echo "     </div>";
            echo "</div>";   
        }
    echo "</div>"; //FIN SECCION RELIQUIAS
    echo "</div>"; //FIN SECCION 3
?>

<script>
    $("#seccion1").click(function(){
        $("#botonInsignias").hide();
        $("#botonAeromodelismo").hide();
        $("#botonReliquias").hide();
        $("#botonMonstruos").show();
        $("#botonBosses").show();
        $("#monstruos").show();
        $("#bosses").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").hide();
        $("#insignias").hide();
    });
    
    $("#seccion2").click(function(){
        $("#botonReliquias").hide();
        $("#botonAeromodelismo").hide();
        $("#botonBosses").hide();
        $("#botonMonstruos").hide();
        $("#monstruos").hide();
        $("#bosses").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").hide();
        $("#insignias").show();
    });
    
    $("#seccion3").click(function(){
        $("#botonInsignias").hide();
        $("#botonAeromodelismo").show();
        $("#botonReliquias").show();
        $("#botonMonstruos").hide();
        $("#botonBosses").hide();
        $("#monstruos").hide();
        $("#bosses").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").show();
        $("#insignias").hide();
    });
    
    $("#botonBosses").click(function(){
        $("#monstruos").hide();
        $("#insignias").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").hide();
        $("#bosses").show();
    });

    $("#botonInsignias").click(function(){
        $("#monstruos").hide();
        $("#bosses").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").hide();
        $("#insignias").show();
    });
    
    $("#botonAeromodelismo").click(function(){
        $("#monstruos").hide();
        $("#insignias").hide();
        $("#bosses").hide();
        $("#reliquias").hide();
        $("#aeromodelismo").show();
    });
    
    $("#botonReliquias").click(function(){
        $("#monstruos").hide();
        $("#insignias").hide();
        $("#aeromodelismo").hide();
        $("#bosses").hide();
        $("#reliquias").show();
    });
    
    $("#botonMonstruos").click(function(){
        $("#bosses").hide();
        $("#insignias").hide();
        $("#aeromodelismo").hide();
        $("#reliquias").hide();
        $("#monstruos").show();
    });
                    
</script>

<?php
}
?>