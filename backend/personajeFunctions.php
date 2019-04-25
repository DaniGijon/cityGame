<?php

    
    function listPersonajeTodo($id){
            
            global $db;
           
            $bonusDestreza = 0;
            $bonusFuerza = 0;
            $bonusAgilidad = 0;
            $bonusResistencia = 0;
            $bonusEspiritu = 0;
            $bonusEstilo = 0;
            $bonusIngenio = 0;
            $bonusPercepcion = 0;            
?>

    <span class="contenedor1">
        
        <fieldset>
            <legend style="text-align: center">Mi personaje</legend>
            
            <?php
               
                echo "<div id='boxHolder'>";
                //Consultar los objetos que lleva equipados
                $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                $stmt = $db->query($sql);
                $objetosEquipados = $stmt->fetchAll();
                
                    echo "<div id='tercioArriba'>";
                        echo "<span id='0' class='cabezaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[0]['imagenObjeto'] . "'></span>";
                    echo "</div>";
                    
                    //Objetos que tiene SIN EQUIPAR el personaje
                    echo"<div id='capaBolsa'>";
                        $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7";
                        $stmt = $db->query($sql);
                        $objetosDB = $stmt->fetchAll();
                        
                        echo "<span id='areaCuerpo' style='display:none'></span>";
                        foreach($objetosDB as $obj){
                            echo "<div id='nuevoBoxBolsa'>";
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa'>" . $obj['nombre'] . "<br><br>";
                                if($obj['destreza'] != 0){
                                    echo "Destreza: " . $obj['destreza'] . "<br>";
                                }
                                if($obj['fuerza'] != 0){
                                    echo "Fuerza: " . $obj['fuerza'] ."<br>";
                                }
                                if($obj['agilidad'] != 0){
                                    echo "Agilidad: " . $obj['agilidad'] ."<br>";
                                }
                                if($obj['resistencia'] != 0){
                                    echo "Resistencia: " . $obj['resistencia'] ."<br>";
                                }
                                if($obj['espiritu'] != 0){
                                    echo "Espiritu: " . $obj['espiritu'] ."<br>";
                                }
                                if($obj['estilo'] != 0){
                                    echo "Estilo: " . $obj['estilo'] ."<br>" ;
                                }
                                if($obj['ingenio'] != 0){
                                    echo "Ingenio: " . $obj['ingenio'] ."<br>";
                                }
                                if($obj['percepcion'] != 0){
                                    echo "Percepcion: " . $obj['percepcion'];
                                }
                                if($obj['especial'] != 'nada'){
                                    echo "Especial: " . $obj['especial'];
                                }
                                   
                                  
                                echo "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo "<div id='tercioMedio'>";
                        
                        echo "<span id='3' class='derechaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[3]['imagenObjeto'] . "'></span>";
                        echo "<span id='1' class='torsoBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[1]['imagenObjeto'] . "'></span>";       
                        echo "<span id='4' class='izquierdaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[4]['imagenObjeto'] . "'></span>";
                        echo "<span id='7' class='bolsaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[7]['imagenObjeto'] . "'></span>";
                        
                    echo "</div>";
                    echo "<div id='tercioAbajo'>";
                        echo "<span id='6' class='mascotaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[6]['imagenObjeto'] . "'></span>";
                        echo "<span id='2' class='piesBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[2]['imagenObjeto'] . "'></span>";  
                        echo "<span id='5' class='vehiculoBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[5]['imagenObjeto'] . "'></span>";
                    echo "</div>";
                echo "</div>";
                
                //Consultar que objetos tiene EQUIPADO el personaje en cada slot (se ordenan por slot)
                    $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7 ";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $objetosPersonaje) {
                        $bonusDestreza = $bonusDestreza + $objetosPersonaje['destreza'];
                        $bonusFuerza = $bonusFuerza + $objetosPersonaje['fuerza'];
                        $bonusAgilidad = $bonusAgilidad + $objetosPersonaje['agilidad'];
                        $bonusResistencia = $bonusResistencia + $objetosPersonaje['resistencia'];
                        $bonusEspiritu = $bonusEspiritu + $objetosPersonaje['espiritu'];
                        $bonusEstilo = $bonusEstilo + $objetosPersonaje['estilo'];
                        $bonusIngenio = $bonusIngenio + $objetosPersonaje['ingenio'];
                        $bonusPercepcion = $bonusPercepcion + $objetosPersonaje['percepcion']; 
                        
                    }
         
                echo "<div id='infoObjeto0'>";
                    if($result[0]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[0]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Cabeza </b><br><br>";
                    }
                    if($result[0]['destreza'] != 0){
                        echo "Destreza: " . $result[0]['destreza'] . "<br>";
                    }
                    if($result[0]['fuerza'] != 0){
                        echo "Fuerza: " . $result[0]['fuerza'] ."<br>";
                    }
                    if($result[0]['agilidad'] != 0){
                        echo "Agilidad: " . $result[0]['agilidad'] ."<br>";
                    }
                    if($result[0]['resistencia'] != 0){
                        echo "Resistencia: " . $result[0]['resistencia'] ."<br>";
                    }
                    if($result[0]['espiritu'] != 0){
                        echo "Espiritu: " . $result[0]['espiritu'] ."<br>";
                    }
                    if($result[0]['estilo'] != 0){
                        echo "Estilo: " . $result[0]['estilo'] ."<br>" ;
                    }
                    if($result[0]['ingenio'] != 0){
                        echo "Ingenio: " . $result[0]['ingenio'] ."<br>";
                    }
                    if($result[0]['percepcion'] != 0){
                        echo "Percepcion: " . $result[0]['percepcion'];
                    }
                    if($result[0]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[0]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto1'>";
                    if($result[1]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[1]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Torso </b><br><br>";
                    }
                    if($result[1]['destreza'] != 0){
                        echo "Destreza: " . $result[1]['destreza'] . "<br>";
                    }
                    if($result[1]['fuerza'] != 0){
                        echo "Fuerza: " . $result[1]['fuerza'] ."<br>";
                    }
                    if($result[1]['agilidad'] != 0){
                        echo "Agilidad: " . $result[1]['agilidad'] ."<br>";
                    }
                    if($result[1]['resistencia'] != 0){
                        echo "Resistencia: " . $result[1]['resistencia'] ."<br>";
                    }
                    if($result[1]['espiritu'] != 0){
                        echo "Espiritu: " . $result[1]['espiritu'] ."<br>";
                    }
                    if($result[1]['estilo'] != 0){
                        echo "Estilo: " . $result[1]['estilo'] ."<br>" ;
                    }
                    if($result[1]['ingenio'] != 0){
                        echo "Ingenio: " . $result[1]['ingenio'] ."<br>";
                    }
                    if($result[1]['percepcion'] != 0){
                        echo "Percepcion: " . $result[1]['percepcion'];
                    }
                    if($result[1]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[1]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto2'>";
                    if($result[2]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[2]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Pies </b><br><br>";
                    }
                    if($result[2]['destreza'] != 0){
                        echo "Destreza: " . $result[2]['destreza'] . "<br>";
                    }
                    if($result[2]['fuerza'] != 0){
                        echo "Fuerza: " . $result[2]['fuerza'] ."<br>";
                    }
                    if($result[2]['agilidad'] != 0){
                        echo "Agilidad: " . $result[2]['agilidad'] ."<br>";
                    }
                    if($result[2]['resistencia'] != 0){
                        echo "Resistencia: " . $result[2]['resistencia'] ."<br>";
                    }
                    if($result[2]['espiritu'] != 0){
                        echo "Espiritu: " . $result[2]['espiritu'] ."<br>";
                    }
                    if($result[2]['estilo'] != 0){
                        echo "Estilo: " . $result[2]['estilo'] ."<br>" ;
                    }
                    if($result[2]['ingenio'] != 0){
                        echo "Ingenio: " . $result[2]['ingenio'] ."<br>";
                    }
                    if($result[2]['percepcion'] != 0){
                        echo "Percepcion: " . $result[2]['percepcion'];
                    }
                    if($result[2]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[2]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto3'>";
                    if($result[3]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[3]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Mano Derecha </b><br><br>";
                    }
                    if($result[3]['destreza'] != 0){
                        echo "Destreza: " . $result[3]['destreza'] . "<br>";
                    }
                    if($result[3]['fuerza'] != 0){
                        echo "Fuerza: " . $result[3]['fuerza'] ."<br>";
                    }
                    if($result[3]['agilidad'] != 0){
                        echo "Agilidad: " . $result[3]['agilidad'] ."<br>";
                    }
                    if($result[3]['resistencia'] != 0){
                        echo "Resistencia: " . $result[3]['resistencia'] ."<br>";
                    }
                    if($result[3]['espiritu'] != 0){
                        echo "Espiritu: " . $result[3]['espiritu'] ."<br>";
                    }
                    if($result[3]['estilo'] != 0){
                        echo "Estilo: " . $result[3]['estilo'] ."<br>" ;
                    }
                    if($result[3]['ingenio'] != 0){
                        echo "Ingenio: " . $result[3]['ingenio'] ."<br>";
                    }
                    if($result[3]['percepcion'] != 0){
                        echo "Percepcion: " . $result[3]['percepcion'];
                    }
                    if($result[3]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[3]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto4'>";
                    if($result[4]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[4]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Mano Izquierda </b><br><br>";
                    }
                    if($result[4]['destreza'] != 0){
                        echo "Destreza: " . $result[4]['destreza'] . "<br>";
                    }
                    if($result[4]['fuerza'] != 0){
                        echo "Fuerza: " . $result[4]['fuerza'] ."<br>";
                    }
                    if($result[4]['agilidad'] != 0){
                        echo "Agilidad: " . $result[4]['agilidad'] ."<br>";
                    }
                    if($result[4]['resistencia'] != 0){
                        echo "Resistencia: " . $result[4]['resistencia'] ."<br>";
                    }
                    if($result[4]['espiritu'] != 0){
                        echo "Espiritu: " . $result[4]['espiritu'] ."<br>";
                    }
                    if($result[4]['estilo'] != 0){
                        echo "Estilo: " . $result[4]['estilo'] ."<br>" ;
                    }
                    if($result[4]['ingenio'] != 0){
                        echo "Ingenio: " . $result[4]['ingenio'] ."<br>";
                    }
                    if($result[4]['percepcion'] != 0){
                        echo "Percepcion: " . $result[4]['percepcion'];
                    }
                    if($result[4]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[4]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto5'>";
                    if($result[5]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[5]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Vehículo </b><br><br>";
                    }
                    if($result[5]['destreza'] != 0){
                        echo "Destreza: " . $result[5]['destreza'] . "<br>";
                    }
                    if($result[5]['fuerza'] != 0){
                        echo "Fuerza: " . $result[5]['fuerza'] ."<br>";
                    }
                    if($result[5]['agilidad'] != 0){
                        echo "Agilidad: " . $result[5]['agilidad'] ."<br>";
                    }
                    if($result[5]['resistencia'] != 0){
                        echo "Resistencia: " . $result[5]['resistencia'] ."<br>";
                    }
                    if($result[5]['espiritu'] != 0){
                        echo "Espiritu: " . $result[5]['espiritu'] ."<br>";
                    }
                    if($result[5]['estilo'] != 0){
                        echo "Estilo: " . $result[5]['estilo'] ."<br>" ;
                    }
                    if($result[5]['ingenio'] != 0){
                        echo "Ingenio: " . $result[5]['ingenio'] ."<br>";
                    }
                    if($result[5]['percepcion'] != 0){
                        echo "Percepcion: " . $result[5]['percepcion'];
                    }
                    if($result[5]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[5]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto6'>";
                    if($result[6]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[6]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Mascota </b><br><br>";
                    }
                    if($result[6]['destreza'] != 0){
                        echo "Destreza: " . $result[6]['destreza'] . "<br>";
                    }
                    if($result[6]['fuerza'] != 0){
                        echo "Fuerza: " . $result[6]['fuerza'] ."<br>";
                    }
                    if($result[6]['agilidad'] != 0){
                        echo "Agilidad: " . $result[6]['agilidad'] ."<br>";
                    }
                    if($result[6]['resistencia'] != 0){
                        echo "Resistencia: " . $result[6]['resistencia'] ."<br>";
                    }
                    if($result[6]['espiritu'] != 0){
                        echo "Espiritu: " . $result[6]['espiritu'] ."<br>";
                    }
                    if($result[6]['estilo'] != 0){
                        echo "Estilo: " . $result[6]['estilo'] ."<br>" ;
                    }
                    if($result[6]['ingenio'] != 0){
                        echo "Ingenio: " . $result[6]['ingenio'] ."<br>";
                    }
                    if($result[6]['percepcion'] != 0){
                        echo "Percepcion: " . $result[6]['percepcion'];
                    }
                    if($result[6]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[6]['especial'] . "</b>";
                    }
                echo "</div>";
                
                echo "<div id='infoObjeto7'>";
                    if($result[7]['nombre'] != 'Vacio'){
                        echo "<b>" . $result[7]['nombre'] . "</b><br><br>";
                    }else{
                        echo "<b> Bolsa </b><br><br>";
                    }
                    if($result[7]['destreza'] != 0){
                        echo "Destreza: " . $result[7]['destreza'] . "<br>";
                    }
                    if($result[7]['fuerza'] != 0){
                        echo "Fuerza: " . $result[7]['fuerza'] ."<br>";
                    }
                    if($result[7]['agilidad'] != 0){
                        echo "Agilidad: " . $result[7]['agilidad'] ."<br>";
                    }
                    if($result[7]['resistencia'] != 0){
                        echo "Resistencia: " . $result[7]['resistencia'] ."<br>";
                    }
                    if($result[7]['espiritu'] != 0){
                        echo "Espiritu: " . $result[7]['espiritu'] ."<br>";
                    }
                    if($result[7]['estilo'] != 0){
                        echo "Estilo: " . $result[7]['estilo'] ."<br>" ;
                    }
                    if($result[7]['ingenio'] != 0){
                        echo "Ingenio: " . $result[7]['ingenio'] ."<br>";
                    }
                    if($result[7]['percepcion'] != 0){
                        echo "Percepcion: " . $result[7]['percepcion'];
                    }
                    if($result[7]['especial'] != 'nada'){
                        echo "<br>Especial: <b>" . $result[7]['especial'] . "</b>";
                    }
                echo "</div>";
            ?>
   
        </fieldset>
        
    </span>

    <span class="contenedor2">
        
        <?php
        
            $sql = "SELECT personajes.*, zonas.*, barrios.* FROM personajes INNER JOIN zonas ON (personajes.zona = zonas.idZ) and (personajes.barrio = zonas.idB) INNER JOIN barrios ON barrios.idB = zonas.idB WHERE id = '$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            $destreza = $result[0]['destreza'];
            $fuerza = $result[0]['fuerza'];
            $agilidad = $result[0]['agilidad'];
            $resistencia = $result[0]['resistencia'];
            $espiritu = $result[0]['espiritu'];
            $estilo = $result[0]['estilo'];
            $ingenio = $result[0]['ingenio'];
            $percepcion = $result[0]['percepcion'];
        ?>   
        <fieldset>
            <legend style="text-align: center"> Mis Datos</legend>
            <span class="quarterWidth">Nombre: <?php echo $result[0]['nombre'] . " (" . $result[0]['origen'] . ")"; ?> </span>
            <span class="quarterWidth">Experiencia: <?php echo $result[0]['experiencia']; ?></span>
            <span class="quarterWidth">Sexo: <?php echo $result[0]['sexo']; ?></span>
            <span class="quarterWidth">Nivel: <?php echo $result[0]['nivel']; ?></span>
            <span class="quarterWidth">Barrio: <?php echo $result[0]['nombreBarrio']; ?></span>
            <span class="quarterWidth">Zona: <?php echo $result[0]['nombreZona']; ?></span>
            
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Constantes vitales</legend>
            <span class="quarterWidth">Salud: <?php echo $result[0]['salud']; ?></span><br>
            <span class="quarterWidth">Energia: <?php echo $result[0]['energia']; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Fama</legend>
            <span class="quarterWidth">Respeto: <?php echo $result[0]['respeto']; ?></span><br>
            <span class="quarterWidth">Popularidad: <?php 
            $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
            $stmt = $db->query($sql);
            $resultado = $stmt->fetchAll();
                
            $popularidadAVG = $resultado[0]['AVG(puntos)'];
            echo round($popularidadAVG, 2, PHP_ROUND_HALF_DOWN); ?>%</span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mi dinero</legend>
            <span class="quarterWidth">En el bolsillo: <?php echo $result[0]['cash'] . "€"; ?></span><br>
            <span class="quarterWidth">En el banco: <?php echo $result[0]['enBanco'] . "€"; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mis habilidades</legend>
            <div id="tablaHabilidades">
            <table border = '0' class='floatLeft'>
    
            <tr>
                <th colspan="2"> <img src='/design/img/iconos/destreza.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/fuerza.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/agilidad.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/resistencia.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/espiritu.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/estilo.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/ingenio.png'> </th>
                <th colspan="2"> <img src='/design/img/iconos/percepcion.png'> </th>   
            </tr>    
                
            <tr>
            <?php
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances1' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " DES </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances2' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " FUE </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances3' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " AGI </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances4' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " RES </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances5' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " ESP </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances6' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " EST </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances7' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " ING </th>";
                
                echo "<th colspan='2'>";
                if ($result[0]['avances'] > 0){
                    echo "<span id='botonAvances8' class='botonAvances'>
                    <img src='/design/img/botones/avances.png'><br></span>";
                }
                echo " PER </th>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($destreza+$bonusDestreza) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($fuerza+$bonusFuerza) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($agilidad+$bonusAgilidad) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($resistencia+$bonusResistencia) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($espiritu+$bonusEspiritu) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($estilo+$bonusEstilo) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($ingenio+$bonusIngenio) . "</th>";
                echo "<th colspan='2' style='background-color:yellowgreen'>" . floor($percepcion+$bonusPercepcion) . "</th>";
            
            echo "</tr>";
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['destreza'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusDestreza . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['fuerza'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusFuerza . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['agilidad'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusAgilidad . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['resistencia'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusResistencia . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['espiritu'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusEspiritu . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['estilo'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusEstilo . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['ingenio'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusIngenio . "</th>";
                
                echo "<th style='width:50px; background-color:yellowgreen'>" . round($result[0]['percepcion'], 2, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th style='width:50px; background-color:pink'>" . $bonusPercepcion . "</th>";
                
                echo '</table>';
                echo "</div>";
            ?>
        <div id="Avances" class="floatLeft"><br>Avances: <?php echo $result[0]['avances'] . " ";?></div><br>
    
        </fieldset>
        
         <fieldset>
            <legend style="text-align: center"> Tiempos de Espera </legend>
            <?php
                date_default_timezone_set('Europe/Madrid');
            
                $sql = "SELECT accion,viaje,emboscada FROM personajes WHERE id = '$id'";
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll();
                
                $actual = date("Y-m-d H:i:s");
                $accion = $result[0]['accion'];
                $viaje = $result[0]['viaje'];
                $emboscada = $result[0]['emboscada'];
                /*
                echo "Actual : " . $actual . "<br>";
                echo "Accion : " . $accion . "<br>";
                echo "Viaje : " . $viaje . "<br>";
                echo "Emboscada : " . $emboscada . "<br>";
                */
                echo "Prox. Acción : ";
                if($accion < $actual){
                    echo '¡Ahora!';
                }
                else{
                    $diferenciaAccion = strtotime($accion) - strtotime($actual);
                    $diferenciaLegibleAccion = date('i\M s\S', $diferenciaAccion);
                    echo $diferenciaLegibleAccion;
                }
                
                echo "<br>Prox. Viaje : ";
                if($viaje < $actual && $accion < $actual){
                    echo '¡Ahora!';
                }
                else{
                    if($viaje > $accion){
                        $diferenciaViaje = strtotime($viaje) - strtotime($actual);
                        $diferenciaLegibleViaje = date('i\M s\S', $diferenciaViaje);
                        echo $diferenciaLegibleViaje;
                    }
                    else{
                        echo $diferenciaLegibleAccion;
                    }
                }
                
                echo "<br>Prox. Emboscada : ";
                if($emboscada < $actual && $accion < $actual){
                    echo '¡Ahora!';
                }
                else{
                    if($emboscada > $accion){
                        $diferenciaEmboscada = strtotime($emboscada) - strtotime($actual);
                        $diferenciaLegibleEmboscada = date('i\M s\S', $diferenciaEmboscada);
                        echo $diferenciaLegibleEmboscada;
                    }
                    else{
                        echo $diferenciaLegibleAccion;
                    }
                }
                
            ?>
         </fieldset>
        
    </span>
    
    <script>
                $(".objetoBox").click(function(event){
                   var id = $(this).attr('id');
                    $("#areaCuerpo").text(id); 
                    $("#capaBolsa").css('left',event.pageX);
                    $("#capaBolsa").css('top',event.pageY);
                    $("#capaBolsa").toggle();
                      
                });
               
                $(".nuevoBoxBolsa").click(function(){
                   var objetoBolsaId = $(this).attr('id');
                   var areaCuerpoId = $("#areaCuerpo").text();
                   $.post("?bPage=personajeFunctions", {
                       objetoBolsaId: objetoBolsaId,
                       areaCuerpoId: areaCuerpoId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&equipar&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".botonAvances").click(function(){
                   var avanceId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       avanceId : avanceId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&subirHabilidad&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".cabezaBox").mouseenter(function(e){
                    $("#infoObjeto0").css("left", e.pageX + 5);
                    $("#infoObjeto0").css("top", e.pageY + 5);
                    $("#infoObjeto0").css("display", "block");
                });
                
                $(".torsoBox").mouseenter(function(e){
                    $("#infoObjeto1").css("left", e.pageX + 5);
                    $("#infoObjeto1").css("top", e.pageY + 5);
                    $("#infoObjeto1").css("display", "block");
                });
                
                $(".piesBox").mouseenter(function(e){
                    $("#infoObjeto2").css("left", e.pageX + 5);
                    $("#infoObjeto2").css("top", e.pageY + 5);
                    $("#infoObjeto2").css("display", "block");
                });
                
                $(".derechaBox").mouseenter(function(e){
                    $("#infoObjeto3").css("left", e.pageX + 5);
                    $("#infoObjeto3").css("top", e.pageY + 5);
                    $("#infoObjeto3").css("display", "block");
                });
                
                $(".izquierdaBox").mouseenter(function(e){
                    $("#infoObjeto4").css("left", e.pageX + 5);
                    $("#infoObjeto4").css("top", e.pageY + 5);
                    $("#infoObjeto4").css("display", "block");
                });
                
                $(".vehiculoBox").mouseenter(function(e){
                    $("#infoObjeto5").css("left", e.pageX + 5);
                    $("#infoObjeto5").css("top", e.pageY + 5);
                    $("#infoObjeto5").css("display", "block");
                });
                
                $(".mascotaBox").mouseenter(function(e){
                    $("#infoObjeto6").css("left", e.pageX + 5);
                    $("#infoObjeto6").css("top", e.pageY + 5);
                    $("#infoObjeto6").css("display", "block");
                });
                
                $(".bolsaBox").mouseenter(function(e){
                    $("#infoObjeto7").css("left", e.pageX + 5);
                    $("#infoObjeto7").css("top", e.pageY + 5);
                    $("#infoObjeto7").css("display", "block");
                });
                
                $(".cabezaBox").mouseleave(function(e){
                    $("#infoObjeto0").css("display", "none");
                });
                
                $(".torsoBox").mouseleave(function(e){
                    $("#infoObjeto1").css("display", "none");
                });
                
                $(".piesBox").mouseleave(function(e){
                    $("#infoObjeto2").css("display", "none");
                });
                
                $(".derechaBox").mouseleave(function(e){
                    $("#infoObjeto3").css("display", "none");
                });
                
                $(".izquierdaBox").mouseleave(function(e){
                    $("#infoObjeto4").css("display", "none");
                });
                
                $(".vehiculoBox").mouseleave(function(e){
                    $("#infoObjeto5").css("display", "none");
                });
                
                $(".mascotaBox").mouseleave(function(e){
                    $("#infoObjeto6").css("display", "none");
                });
                
                $(".bolsaBox").mouseleave(function(e){
                    $("#infoObjeto7").css("display", "none");
                });
                
                
           </script>   
<?php
    }
    
    function equipar($cosaId){
        global $db;
        $id = $_SESSION['loggedIn'];  
        
        //Consultar los objetos que lleva equipados
        $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
        $stmt = $db->query($sql);
        $objetosEquipados = $stmt->fetchAll();
        
        if($cosaId > 0 && $cosaId < 20 ){
            $slot = 6; //mascota
        }
        else if ($cosaId >= 20 && $cosaId < 100 ){
            $slot = 5; //vehiculo
        }
        else if ($cosaId >= 100 && $cosaId < 200 ){
            $slot = 0; //cabeza
        }
        else if ($cosaId >= 200 && $cosaId < 300 ){
            $slot = 1; //torso
        }
        else if ($cosaId >= 300 && $cosaId < 400 ){
            $slot = 3; //HABRA QUE ELEGIR MANO PERO DE MOMENTO SE EQUIPA EN DERECHA
        }
        else if ($cosaId >= 400 && $cosaId < 500 ){
            $slot = 2; //pies
        }
        else if ($cosaId >= 500 && $cosaId < 600){
            $slot = 7; //bolsa
        }
        else{
            //OBJETOS QUE NO SE PUEDEN EQUIPAR
            exit();
        }
        
        //RECOGER EL OBJETO QUE SE VA A DESEQUIPAR
        $objetoDesequipado = $objetosEquipados[$slot]['id'];
        
        //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
        $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '$cosaId'";
        $stmt = $db->query($sql);
        $resultado = $stmt->fetchAll();
        $slotLibre = $resultado[0]['slot'];
        
        //EQUIPAR
        $sql = "UPDATE inventario SET idO=$cosaId WHERE (idP='$id' AND slot = '$slot')";
        $stmt = $db->query($sql);
        
        //DESEQUIPAR EL OBJETO ANTERIOR
        $sql = "UPDATE inventario SET idO='$objetoDesequipado' WHERE (idP='$id' AND slot = '$slotLibre')";
        $stmt = $db->query($sql);
    }

    function listJugadorRival($id){
        global $db;
        
        $sql = "SELECT nombre,origen,sexo,nivel,respeto,cash FROM personajes WHERE id='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $nombre = $result[0]['nombre'] . " (" . $result[0]['origen'] . ")";
        $sexo = $result[0]['sexo'];
        $nivel = $result[0]['nivel'];
        $respeto = $result[0]['respeto'];
        $currentMoney = $result[0]['cash'];
        
        // Rangos de dinero
        if($currentMoney < 100){
            $currentMoneyText = 'Menos que uno que se está bañando';
        }
        if($currentMoney >=100 && $currentMoney< 500){
            $currentMoneyText = 'Pobre';
        }
        if($currentMoney >= 500){
            $currentMoneyText = 'Rico nuevo';
        }
        
        // Rangos de Respeto
        if($respeto < 50){
            $respetoText = 'Nuevo en la ciudad';
        }
        if($respeto >=50 && $respeto< 200){
            $respetoText = 'Don Nadie';
        }
        if($respeto >= 200){
            $respetoText = 'De Usted';
        }
        echo'Nombre: ' . $nombre . '<br>';
        echo'Sexo: ' . $sexo . '<br>';
        echo'Nivel: ' . $nivel . '<br>';
        echo'Respeto: ' . $respetoText . '<br>';
        echo'Dinero: ' . $currentMoneyText . '<br>';
    }  
    
    function nuevoPersonaje(){
        global $db;
        $id = $_SESSION['loggedIn'];  
        
        $sql = "SELECT * FROM personajes WHERE id = '$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
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

    <div id='moduloZona'>
        <div class='contenido'>
            <div class='seccionMapaZona'>
                
            </div>
            <div class='seccionDescripcionZona'>
                <div class='seccionDescripcionZonaImagen'>

                    <table border = '0'><caption>Habilidades Iniciales</caption>

                    <tr>
                        <th colspan="2"> <img src='/design/img/iconos/destreza.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/fuerza.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/agilidad.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/resistencia.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/espiritu.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/estilo.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/ingenio.png'> </th>
                        <th colspan="2"> <img src='/design/img/iconos/percepcion.png'> </th>   
                    </tr>    

                    <tr>
                    <?php
                        echo "<th colspan='2'>";

                        echo " DES </th>";

                        echo "<th colspan='2'>";

                        echo " FUE </th>";

                        echo "<th colspan='2'>";

                        echo " AGI </th>";

                        echo "<th colspan='2'>";

                        echo " RES </th>";

                        echo "<th colspan='2'>";

                        echo " ESP </th>";

                        echo "<th colspan='2'>";

                        echo " EST </th>";

                        echo "<th colspan='2'>";

                        echo " ING </th>";

                        echo "<th colspan='2'>";

                        echo " PER </th>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['destreza']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['fuerza']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['agilidad']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['resistencia']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['espiritu']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['estilo']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['ingenio']) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . floor($result[0]['percepcion']) . "</th>";

                    echo "</tr>";
                echo "</table>";
            echo "</div>";
            echo "<div class='seccionDescripcionZonaTexto'>";
            echo "Los vecinos de Cañamares han desarrollado su Ingenio... (escribir)";
            echo "</div>"; //FIN NUEVO
        echo "</div>";
    echo "</div>";
    }
    
    function subirHabilidad($avanceId){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        $sql = "SELECT * FROM personajes WHERE id='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        if($avanceId === 'botonAvances1'){
           $nuevaHabilidad = $result[0]['destreza'] + 1;
           $sql = "UPDATE personajes SET destreza='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances2'){
           $nuevaHabilidad = $result[0]['fuerza'] + 1;
           $sql = "UPDATE personajes SET fuerza='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances3'){
           $nuevaHabilidad = $result[0]['agilidad'] + 1;
           $sql = "UPDATE personajes SET agilidad='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances4'){
           $nuevaHabilidad = $result[0]['resistencia'] + 1;
           $sql = "UPDATE personajes SET resistencia='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances5'){
           $nuevaHabilidad = $result[0]['espiritu'] + 1;
           $sql = "UPDATE personajes SET espiritu='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances6'){
           $nuevaHabilidad = $result[0]['estilo'] + 1;
           $sql = "UPDATE personajes SET estilo='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances7'){
           $nuevaHabilidad = $result[0]['ingenio'] + 1;
           $sql = "UPDATE personajes SET ingenio='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        if($avanceId === 'botonAvances8'){
           $nuevaHabilidad = $result[0]['percepcion'] + 1;
           $sql = "UPDATE personajes SET percepcion='$nuevaHabilidad' WHERE id = '$id'";
           $db->query($sql);
        }
        
        $nuevosAvances = $result[0]['avances'] - 1;
        $sql = "UPDATE personajes SET avances='$nuevosAvances' WHERE id = '$id'";
        $db->query($sql);
    }

    
    if(isset($_GET['listPersonajeTodo'])){
        $id = $_SESSION['loggedIn'];
        listPersonajeTodo($id);
    }
    
    if(isset($_POST['objetoBolsaId'])){
        equipar($_POST['objetoBolsaId']);
    }
    
    if(isset($_POST['avanceId'])){
        subirHabilidad($_POST['avanceId']);
    }
 
?>
