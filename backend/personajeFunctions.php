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

        <table style='text-align:center;'><br><caption></caption>
    
    <tr>
        <td rowspan = '3' style='text-align:center;min-width:70px'> <!-- MI PERSONAJE -->
         
            
            <?php
               
                echo "<div id='boxHolder'>";
                //Consultar los objetos que lleva equipados
                $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
                $stmt = $db->query($sql);
                $objetosEquipados = $stmt->fetchAll();
                
                echo "<div id = 'dibujoPersonaje'>";
                    echo "<div id='tercioArriba'>";
                        echo "<span id='0' class='cabezaBox objetoBox'>" . "<img src='/design/img/objetos/" . $objetosEquipados[0]['imagenObjeto'] . "'></span>";
                    echo "</div>";
                    
                    //Objetos que tiene SIN EQUIPAR el personaje
                    echo"<div id='capaBolsa'>";
                        $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7";
                        $stmt = $db->query($sql);
                        $objetosDB = $stmt->fetchAll();
                        echo "<div id='capaFondo'>";
                        echo "<span id='areaCuerpo' style='display:none'></span>";
                        foreach($objetosDB as $obj){
                            if($obj['id'] === '0'){
                                
                             echo "<div id='nuevoBoxBolsa' style='background:white'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                                echo "</div>" ;
                               
                            }
                            elseif($obj['id'] > 0 && $obj['id'] < 20){
                                echo "<div id='nuevoBoxBolsa' style='background:green'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                 
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 20 && $obj['id'] < 100){
                                echo "<div id='nuevoBoxBolsa' style='background:pink'>";
                               
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 100 && $obj['id'] < 200){
                                echo "<div id='nuevoBoxBolsa' style='background:darkturquoise'>";
                        
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                       
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 200 && $obj['id'] < 300){
                                echo "<div id='nuevoBoxBolsa' style='background:red'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                  
                                    
                                echo "</div>";
                            }
                            else if($obj['id'] >= 300 && $obj['id'] < 400){
                                echo "<div id='nuevoBoxBolsa' style='background:gold'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                    
                                echo "</div>";
                            }
                            else if($obj['id'] >= 400 && $obj['id'] < 500){
                                echo "<div id='nuevoBoxBolsa' style='background:darkorchid'>";
                                  
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                
                                echo "</div>";
                            }
                            else if($obj['id'] >= 500 && $obj['id'] < 600){
                                echo "<div id='nuevoBoxBolsa' style='background:yellowgreen'>";
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                            
                                echo "</div>";
                            }
                            else if($obj['id'] >= 900 && $obj['id'] < 920){
                                echo "<div id='nuevoBoxBolsa' style='background:brown'>";
                                   
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                                echo "</div>";
                            }
                            elseif($obj['id'] >= 920){
                                echo "<div id='nuevoBoxBolsa' style='background:grey'>";
                                   
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                                echo "</div>";
                            }
                        }
                        echo "</div>"; //FIN capaFondo
                        
                    echo "</div>"; //FIN capaBolsa
                    
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
         
                echo "<div id='infoObjeto0' class='objetoCabeza'>";
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
                
                echo "<div id='infoObjeto1' class='objetoTorso'>";
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
                
                echo "<div id='infoObjeto2' class='objetoPies'>";
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
                
                echo "<div id='infoObjeto3' class='objetoMano'>";
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
                
                echo "<div id='infoObjeto4' class='objetoMano'>";
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
                
                echo "<div id='infoObjeto5' class='objetoVehiculo'>";
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
                
                echo "<div id='infoObjeto6' class='objetoMascota'>";
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
                
                echo "<div id='infoObjeto7' class='objetoMochila'>";
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
   
        </td> <!-- FIN MI PERSONAJE -->
        <td style='text-align:left;min-width:300px; max-width: 300px' > <!-- MIS DATOS -->
            <?php
            
            echo "<div class = 'tituloZona2 seccion0  textCenter' style = ' left: 15%'>";
                echo "<div class = 'textoZona2 cool'>";
                    echo "Mis Datos";
                echo "</div>";
            echo "</div>";
        
            $sql = "SELECT personajes.*, zonas.*, barrios.* FROM personajes INNER JOIN zonas ON (personajes.zona = zonas.idZ) and (personajes.barrio = zonas.idB) INNER JOIN barrios ON barrios.idB = zonas.idB WHERE id = '$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            
            $sql = "SELECT * FROM personajes WHERE id = '$id'";
            $stmt = $db->query($sql);
            $habilidadesBase = $stmt->fetchAll();

            $destreza = $habilidadesBase[0]['destreza'];
            $fuerza = $habilidadesBase[0]['fuerza'];
            $agilidad = $habilidadesBase[0]['agilidad'];
            $resistencia = $habilidadesBase[0]['resistencia'];
            $espiritu = $habilidadesBase[0]['espiritu'];
            $estilo = $habilidadesBase[0]['estilo'];
            $ingenio = $habilidadesBase[0]['ingenio'];
            $percepcion = $habilidadesBase[0]['percepcion'];
        ?>   
            <div class ="contenidoPersonaje">
                <span class="quarterWidth"><span class="tit">Nombre:</span> <?php echo $result[0]['nombre']; ?> </span>
                <span class="quarterWidth"><span class="tit">Nivel:</span>  <?php echo $result[0]['nivel']; ?></span>
                <span class="quarterWidth"><span class="tit">Sexo:</span> <?php echo $result[0]['sexo']; ?></span>
                <span class="quarterWidth"><span class="tit">Experiencia:</span>  <?php echo $result[0]['experiencia']; ?></span>
                <span class="quarterWidth"><span class="tit">Barrio:</span>  <?php echo $result[0]['nombreBarrio']; ?></span>
                <span class="quarterWidth"><span class="tit">Zona:</span>  <?php echo $result[0]['nombreZona']; ?></span>
            </div>
        </div>    
        </td> <!-- FIN MIS DATOS -->
        <td style='text-align:left;min-width:100px'> <!-- CONSTANTES VITALES -->
            <?php
            echo "<div class = 'tituloZona2 seccion1' style='margin-top:-10px;'>";
                echo "<div class = 'textoZona2 cool'>";
                    echo "Vitalidad";
                echo "</div>";
            echo "</div>";
            ?>
            <div class ="contenidoPersonaje" style="padding-left: 20%">
                <span class="tit">Salud:</span> <?php echo $result[0]['salud'] . "<br>"; ?>
                <span class="tit">Energía:</span> <?php echo $result[0]['energia']; ?><br>
            </div>

        </td> <!-- FIN CONSTANTES VITALES -->
    </tr>
    <tr>
        <td style='padding-right:5%;min-width:70px' class='coolWhiteGrande texto-borde'> <!-- LOGO CLAN -->
            <?php
            echo "<img src='/design/img/export/clan1.png' style='vertical-align: bottom'>";
            ?>
        </td> <!-- FIN LOGO CLAN -->
        <td style='text-align:left;min-width:100px'> <!-- FAMA -->
            <?php
            echo "<div class = 'tituloZona1 seccion1' style='margin-top:-18px; left:23%'>";
                echo "<div class = 'textoZona1 cool'>";
                    echo "Fama";
                echo "</div>";
            echo "</div>";
            ?>
            <div class ="contenidoPersonaje" style='padding-left:20%'>
                <?php
                $sql = "SELECT AVG(puntos) FROM popularidad WHERE idP = '$id'";
                $stmt = $db->query($sql);
                $resultado = $stmt->fetchAll();

                $popularidadAVG = $resultado[0]['AVG(puntos)'];
                ?>
                <span class="tit">Respeto: </span><?php echo $result[0]['respeto']; ?>
                <span class="tit">Popularidad: </span> <?php echo round($popularidadAVG, 2, PHP_ROUND_HALF_DOWN); ?>%<br>
            
            </div>
        </td>   <!-- FIN FAMA -->
    </tr>
    <tr>
        <td style='text-align:left;min-width:300px;'> <!-- TIEMPOS ESPERA -->
        <?php
            echo "<div class = 'tituloZona2 seccion1' style='left:15%'>";
                echo "<div class = 'textoZona2 cool'>";
                    echo "Tiempos Espera";
                echo "</div>";
            echo "</div>";
            ?>
            <?php
                date_default_timezone_set('Europe/Madrid');
            
                $sql = "SELECT accion,viaje,emboscada FROM personajes WHERE id = '$id'";
                $stmt = $db->query($sql);
                $tiempos = $stmt->fetchAll();
                
                $actual = date("Y-m-d H:i:s");
                $accion = $tiempos[0]['accion'];
                $viaje = $tiempos[0]['viaje'];
                $emboscada = $tiempos[0]['emboscada'];
                echo "<div class = 'contenidoPersonaje' style='padding-left:20%' >";
                echo '<span class="tit">';
                echo "Prox. Acción : ";
                echo "</span>";
                if($accion < $actual){
                    echo '¡Ahora!<br>';
                }
                else{
                    $diferenciaAccion = strtotime($accion) - strtotime($actual);
                    $diferenciaLegibleAccion = date('i\M s\S', $diferenciaAccion);
                    echo $diferenciaLegibleAccion . '<br>';
                }
                
                echo '<span class="tit">';
                echo "Prox. Viaje : ";
                echo "</span>";
                if($viaje < $actual && $accion < $actual){
                    echo '¡Ahora!<br>';
                }
                else{
                    if($viaje > $accion){
                        $diferenciaViaje = strtotime($viaje) - strtotime($actual);
                        $diferenciaLegibleViaje = date('i\M s\S', $diferenciaViaje);
                        echo $diferenciaLegibleViaje . '<br>';
                    }
                    else{
                        echo $diferenciaLegibleAccion . '<br>';
                    }
                }
                
                echo '<span class="tit">';
                echo "Prox. Emboscada : ";
                echo "</span>";
                if($emboscada < $actual && $accion < $actual){
                    echo '¡Ahora!<br>';
                }
                else{
                    if($emboscada > $accion){
                        $diferenciaEmboscada = strtotime($emboscada) - strtotime($actual);
                        $diferenciaLegibleEmboscada = date('i\M s\S', $diferenciaEmboscada);
                        echo $diferenciaLegibleEmboscada . '<br>';
                    }
                    else{
                        echo $diferenciaLegibleAccion . '<br>';
                    }
                }
            echo "</div>"; //fin div contenidoPersonaje 
            ?>
        </td> <!-- FIN TIEMPOS ESPERA -->
       
        <td style='text-align:left;min-width:100px'> <!-- DINERO -->
            <?php
            echo "<div class = 'tituloZona1 seccion1' style='left:23%;margin-top:-10px'>";
                echo "<div class = 'textoZona1 cool'>";
                    echo "Dinero";
                echo "</div>";
            echo "</div>";
            ?>
            <div class ="contenidoPersonaje" style="padding-left:20%">
                <span class="tit">En Bolsillo:</span> <?php echo $result[0]['cash'] . "<img src='/design/img/iconos/monedaTop.png' style='vertical-align: bottom'>"; ?><br>
                <span class="tit">En Banco:</span> <?php echo $result[0]['enBanco'] . "<img src='/design/img/iconos/cajaFuerteTop.png' style='vertical-align: bottom'>"; ?><br>
            </div>
        </td><!-- FIN DINERO -->
    </tr>
    <tr>
        <td colspan = "2" style='text-align:center;min-width:70px'> <!-- HABILIDADES -->
            <div id="tablaHabilidades">
            <table border = '0' class='floatLeft'>
    
            <tr>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances1' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/destreza.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/destreza.png'>";
                        echo "</div>";
                    }
                    ?>
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances2' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/fuerza.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/fuerza.png'>";
                        echo "</div>";
                    }
                    ?>
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances3' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/agilidad.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/agilidad.png'>";
                        echo "</div>";
                    }
                    ?> 
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances4' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/resistencia.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/resistencia.png'>";
                        echo "</div>";
                    }
                    ?> 
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances5' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/espiritu.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/espiritu.png'>";
                        echo "</div>";
                    }
                    ?>
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances6' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/style.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/style.png'>";
                        echo "</div>";
                    }
                    ?>
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances7' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/ingenio.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/ingenio.png'>";
                        echo "</div>";
                    }
                    ?>
                    
                </th>
                <th colspan="2"    style='width:200px;'>
                <?php
                    if ($result[0]['avances'] > 0){
                        echo "<div id='botonAvances8' class='botonAvances'>";
                        echo "<img src='/design/img/botones/avancesOro.png'><br></div>";
                        echo "<div id='iconoHabilidad' style='margin-right:16px'>";
                            echo "<img src='/design/img/export/percepcion.png'>";
                        echo "</div>";
                    }
                    else{
                        echo "<div id='iconoHabilidad'>";
                            echo "<img src='/design/img/export/percepcion.png'>";
                        echo "</div>";
                    }
                    ?>
                </th>  
            </tr>    
             <?php   
           
            echo "<tr>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($destreza+$bonusDestreza) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($fuerza+$bonusFuerza) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($agilidad+$bonusAgilidad) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($resistencia+$bonusResistencia) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($espiritu+$bonusEspiritu) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($estilo+$bonusEstilo) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($ingenio+$bonusIngenio) . "</th>";
                echo "<th colspan='2' class='madera1 coolWhiteGrande texto-borde'>" . floor($percepcion+$bonusPercepcion) . "</th>";
            
            echo "</tr>";
            
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['destreza'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusDestreza . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['fuerza'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusFuerza . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['agilidad'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusAgilidad . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['resistencia'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusResistencia . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['espiritu'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusEspiritu . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['estilo'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusEstilo . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['ingenio'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusIngenio . "</th>";
                
                echo "<th class = 'madera3 coolWhiteGrande texto-borde'>" . round($habilidadesBase[0]['percepcion'], 1, PHP_ROUND_HALF_DOWN) . "</th>";
                echo "<th class = 'madera2 coolWhiteGrande texto-borde'>" . $bonusPercepcion . "</th>";
                
                echo '</table>';
                
                echo "</div>";
            ?>
    
        </td> <!-- FIN HABILIDADES -->
        <td style='text-align:center;min-width:100px'> <!-- AVANCES -->
            <?php
            echo "<div class = 'avances'>";
                echo "<div class = 'avancesTexto coolWhiteGigante'>";
                    echo "AVANCES:<br>";
                    echo "<div class = 'avancesCantidad'>";
                        echo $result[0]['avances'];
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            ?>
        </td> <!-- FIN AVANCES -->
    </tr>
    
        </table>
        
    <div id="opcionMano" style="display:none;">
        <div id="manoTexto">
            ¿En qué mano quieres equiparlo?
        </div>
        <div id="manoIzq" class="cualMano">
            Mano Izquierda
        </div>
        <div id="manoDer" class="cualMano">
            Mano Derecha
        </div>
    </div>
    
    <script>
                $(".objetoBox").click(function(event){
                   var id = $(this).attr('id');
                    $("#areaCuerpo").text(id); 
                    $("#capaBolsa").css('left',500);
                    $("#capaBolsa").css('top',20);
                    $("#capaBolsa").toggle();
                    
                    $("#capaFondo").toggle();
                      
                });
               
                $(".nuevoBoxBolsa").click(function(){
                   var objetoBolsaId = $(this).attr('id');
                   var areaCuerpoId = $("#areaCuerpo").text();
                   if(objetoBolsaId >=300 && objetoBolsaId < 400){
                       $("#opcionMano").css('left',event.pageX - 300);
                       $("#opcionMano").css('top',event.pageY - 200);
                       $("#opcionMano").toggle();
                       
                       $(".cualMano").click(function(){
                            var manoId = $(this).attr('id');

                            $.post("?bPage=personajeFunctions", {
                                    objetoBolsaId: objetoBolsaId,
                                    areaCuerpoId: manoId
                                }).done(function(){
                                    $("#personajeArea").load("index.php?bPage=personajeFunctions&equipar&listPersonajeTodo&nonUI")
                                })
                        })
                   }
                   else{
                        $.post("?bPage=personajeFunctions", {
                            objetoBolsaId: objetoBolsaId,
                            areaCuerpoId: areaCuerpoId
                        }).done(function(){
                            $("#personajeArea").load("index.php?bPage=personajeFunctions&equipar&listPersonajeTodo&nonUI")
                        })
                   }
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
                    $("#infoObjeto0").css("left", 175);
                    $("#infoObjeto0").css("top", 140);
                    $("#infoObjeto0").css("display", "block");
                    $("#infoObjeto0").css("opacity", "0.95");
                });
                
                $(".torsoBox").mouseenter(function(e){
                    $("#infoObjeto1").css("left", 175);
                    $("#infoObjeto1").css("top", 140);
                    $("#infoObjeto1").css("display", "block");
                    $("#infoObjeto1").css("opacity", "0.95");
                });
                
                $(".piesBox").mouseenter(function(e){
                    $("#infoObjeto2").css("left", 175);
                    $("#infoObjeto2").css("top", 140);
                    $("#infoObjeto2").css("display", "block");
                    $("#infoObjeto2").css("opacity", "0.95");
                });
                
                $(".derechaBox").mouseenter(function(e){
                    $("#infoObjeto3").css("left", 175);
                    $("#infoObjeto3").css("top", 140);
                    $("#infoObjeto3").css("display", "block");
                    $("#infoObjeto3").css("opacity", "0.95");
                });
                
                $(".izquierdaBox").mouseenter(function(e){
                    $("#infoObjeto4").css("left", 175);
                    $("#infoObjeto4").css("top", 140);
                    $("#infoObjeto4").css("display", "block");
                    $("#infoObjeto4").css("opacity", "0.95");
                });
                
                $(".vehiculoBox").mouseenter(function(e){
                    $("#infoObjeto5").css("left", 175);
                    $("#infoObjeto5").css("top", 140);
                    $("#infoObjeto5").css("display", "block");
                    $("#infoObjeto5").css("opacity", "0.95");
                });
                
                $(".mascotaBox").mouseenter(function(e){
                    $("#infoObjeto6").css("left", 175);
                    $("#infoObjeto6").css("top", 140);
                    $("#infoObjeto6").css("display", "block");
                    $("#infoObjeto6").css("opacity", "0.95");
                });
                
                $(".bolsaBox").mouseenter(function(e){
                    $("#infoObjeto7").css("left", 175);
                    $("#infoObjeto7").css("top", 140);
                    $("#infoObjeto7").css("display", "block");
                    $("#infoObjeto7").css("opacity", "0.95");
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
    
    function equipar($cosaId, $areaCuerpoId){
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
        else if ($cosaId >= 300 && $cosaId < 400){
            if($areaCuerpoId === 'manoDer'){
                $slot = 3; //mano derecha
            }
            elseif($areaCuerpoId === 'manoIzq'){
                $slot = 4; //mano izquierda
            }
        }
        else if ($cosaId >= 400 && $cosaId < 500 ){
            $slot = 2; //pies
        }
        else if ($cosaId >= 500 && $cosaId < 600){
            $slot = 7; //bolsa
        }
        //CONSUMIBLES
        elseif($cosaId === '920'){
            consumir(920);
            exit();
        }
        elseif($cosaId === '923'){
            consumir(923);
            exit();
        }
        elseif($cosaId === '925'){
            consumir(925);
            exit();
        }
        elseif($cosaId === '928'){
            consumir(928);
            exit();
        }
        elseif($cosaId === '929'){
            consumir(929);
            exit();
        }
        elseif($cosaId === '930'){
            consumir(930);
            exit();
        }
        elseif($cosaId === '931'){
            consumir(931);
            exit();
        }
        elseif($cosaId === '932'){
            consumir(932);
            exit();
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
        
        if($slot != 7){
        //EQUIPAR
        $sql = "UPDATE inventario SET idO=$cosaId WHERE (idP='$id' AND slot = '$slot')";
        $stmt = $db->query($sql);

        //DESEQUIPAR EL OBJETO ANTERIOR
        $sql = "UPDATE inventario SET idO='$objetoDesequipado' WHERE (idP='$id' AND slot = '$slotLibre')";
        $stmt = $db->query($sql);
        }
        
        //COMPROBAR SI AUMENTO SLOTS DE INVENTARIO (EN CASO DE EQUIPAR UNA MOCHILA)
        else{
            if($cosaId >=500 && $cosaId <=501){
                $extra = 1;
            }
            elseif($cosaId >=502 && $cosaId <=503){
                $extra = 2;
            }
            elseif($cosaId >=504 && $cosaId <=505){
                $extra = 3;
            }
            elseif($cosaId >=506 && $cosaId <=507){
                $extra = 4;
            }
            elseif($cosaId >=508 && $cosaId <=509){
                $extra = 5;
            }
            elseif($cosaId >=510 && $cosaId <=512){
                $extra = 6;
            }
            elseif($cosaId >=513 && $cosaId <=513){
                $extra = 8;
            }
            elseif($cosaId >=514 && $cosaId <=514){
                $extra = 10;
            }
            
            $sql = "SELECT COUNT(*) FROM inventario WHERE (idP = '$id' && slot > '9')";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            $extraAnterior = $result[0]['COUNT(*)']; //cantidad de slots extra que yo ya tenía
            
            if($extra > $extraAnterior){
                //Meterle Slots Extra
                $nuevos = $extra - $extraAnterior;
                for($i=1; $i<=$nuevos; $i++){
                    $nuevoSlot = 9 + $extraAnterior + $i;
                    $sql = "INSERT INTO inventario (idP, slot, idO) VALUES ('$id', '$nuevoSlot', '0')";
                    $db->query($sql);
                }
                
                //EQUIPAR
                $sql = "UPDATE inventario SET idO=$cosaId WHERE (idP='$id' AND slot = '$slot')";
                $stmt = $db->query($sql);

                //DESEQUIPAR EL OBJETO ANTERIOR
                $sql = "UPDATE inventario SET idO='$objetoDesequipado' WHERE (idP='$id' AND slot = '$slotLibre')";
                $stmt = $db->query($sql);
            }
            elseif($extra < $extraAnterior){ //NO QUITA SLOTS HACIA ATRÁS (PORQUE BORRARÍA OBJETOS). SIMPLEMENTE NO DEJA DESEQUIPAR
               /* //Quitarle slots
                $nuevos = $extraAnterior - $extra;
                for($i=1; $i<=$nuevos; $i++){
                    $slotEliminado = 10 + $extraAnterior - $i;
                    $sql = "DELETE FROM inventario WHERE idP = '$id' AND slot = '$slotEliminado'";
                    $db->query($sql);
                }
                */
                exit();
            }
        }
    }
    
    function consumir($idO){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        //VER QUE SLOT QUEDA LIBRE EN EL INVENTARIO
        $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO = '$idO'";
        $stmt = $db->query($sql);
        $resultado = $stmt->fetchAll();
        $slotLibre = $resultado[0]['slot'];
        
        //DESEQUIPAR EL OBJETO ANTERIOR
        $sql = "UPDATE inventario SET idO='0' WHERE (idP='$id' AND slot = '$slotLibre')";
        $stmt = $db->query($sql);
        
        //Otorgarle los efectos de consumir
        if($idO === 920){ //Chocolatina derretida. +2 Salud
            $mejoraSalud = 2;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 923){ //Agua Agria. +1 Salud
            $mejoraSalud = 1;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 925){ //Sandia Hermosa. +3 Salud
            $mejoraSalud = 3;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 928){ //Pieza de Fruta Fresca. +2 Salud
            $mejoraSalud = 2;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 929){ //Pan del Camino. +4 Salud
            $mejoraSalud = 4;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 930){ //Berenjenas de Almagro. +4 Salud
            $mejoraSalud = 4;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 931){ //Queso especiado. +5 Salud
            $mejoraSalud = 5;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
        
        if($idO === 932){ //Galletas de Maíz. +3 Salud
            $mejoraSalud = 3;
            $sql = "UPDATE personajes SET salud = CASE WHEN salud + '$mejoraSalud' > 100 THEN 100 ELSE salud + '$mejoraSalud' END WHERE id='$id'";
            $db->query($sql);  
        }
    }

    function listJugadorRival($id){
        global $db;
        
        $sql = "SELECT nombre,origen,sexo,nivel,respeto,cash FROM personajes WHERE id='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $sql = "SELECT * FROM insignias WHERE idP='$id'";
        $stmt = $db->query($sql);
        $insignias = $stmt->fetchAll();
        
        $nombre = $result[0]['nombre'];
        $origen = $result[0]['origen'];
        $sexo = $result[0]['sexo'];
        $nivel = $result[0]['nivel'];
        $respeto = $result[0]['respeto'];
        $currentMoney = $result[0]['cash'];
        
        //clanes
        if($origen === '1')
            $origen = 'Cañamares';
        elseif($origen === '2')
            $origen = 'Libertad';
        elseif($origen === '3')
            $origen = 'Constitución';
        elseif($origen === '4')
            $origen = 'El Poblado';
        elseif($origen === '5')
            $origen = 'Santa Ana';
        elseif($origen === '6')
            $origen = 'Centro Sur';
        elseif($origen === '7')
            $origen = 'Las Mercedes';
        elseif($origen === '8')
            $origen = 'El Carmen';
        elseif($origen === '9')
            $origen = 'Fraternidad';
        elseif($origen === '10')
            $origen = 'Ciudad Jardín';
        
        // Rangos de dinero
        if($currentMoney < 500){
            $currentMoneyText = 'Menos que uno que se está bañando';
        }
        if($currentMoney >=500 && $currentMoney< 2500){
            $currentMoneyText = 'Pobre';
        }
        if($currentMoney >= 2500){
            $currentMoneyText = 'Rico nuevo';
        }
        
        // Rangos de Respeto
        if($respeto < 500){
            $respetoText = 'Nuevo en la ciudad';
        }
        if($respeto >=500 && $respeto< 2000){
            $respetoText = 'Don Nadie';
        }
        if($respeto >= 2000){
            $respetoText = 'De Usted';
        }
        
        echo "<table style='text-align:center; margin-left: 3%; margin-right: 3%; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><br></caption>";
    
        echo "<tr>";
                echo "<th style='text-align:center; border-radius: 15px' colspan='100%'>";
                    if($sexo === 'Hombre'){
                        echo "<img src='/design/img/iconos/personajilloHombre.png'>";
                    }else{
                        echo "<img src='/design/img/iconos/personajilloMujer.png'>";
                    }
                echo "</th>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px; width:100px'>" . "Nick:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>" . $nombre . "</td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px'>" . "Clan:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>" . $origen . "</td>";
        echo "</tr>";
             
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px'>" . "Nivel:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>" . $nivel . "</td>";
        echo "</tr>";
             
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px'>" . "Respeto:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>" . $respetoText . "</td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px'>" . "Dinero:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>" . $currentMoneyText . "</td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";
        
        echo "<tr>";
            echo "<th style='text-align:center; border-radius: 15px'>" . "Insignias:" . "</th>";
            echo "<td style='text-align:left; border-radius: 15px'>";
                foreach ($insignias as $cadaInsignia){
                    echo "<div id='albumFicha'>";
                        echo "<div id='insigniaBox'><img src='/design/img/insignias/" . $cadaInsignia['imagen'] ."'>";
                        echo "</div>";
                    echo "</div>";   
                }
            echo "</td>";
        echo "</tr>";
        
           
         
        echo "</table>";
    }
    
    function getDestrezaInicial($idB){
    switch($idB){
        case '3':
            $desInicial = 3;
            break;
        case '9':
            $desInicial = 2;
            break;
        default:
            $desInicial = 1;
    }
    
    return $desInicial;
}

function getFuerzaInicial($idB){
    switch($idB){
        case '7':
            $fueInicial = 2;
            break;
        case '9':
            $fueInicial = 3;
            break;
        default:
            $fueInicial = 1;
    }
    
    return $fueInicial;
}

function getAgilidadInicial($idB){
    switch($idB){
        case '1':
            $agiInicial = 2;
            break;
        case '3':
            $agiInicial = 2;
            break;
        case '7':
            $agiInicial = 3;
            break;
        default:
            $agiInicial = 1;
    }
    
    return $agiInicial;
}

function getResistenciaInicial($idB){
    switch($idB){
        case '5':
            $resInicial = 3;
            break;
        case '8':
            $resInicial = 3;
            break;
        default:
            $resInicial = 1;
    }
    
    return $resInicial;
}

function getEspirituInicial($idB){
    switch($idB){
        case '2':
            $espInicial = 2;
            break;
        case '5':
            $espInicial = 2;
            break;
        default:
            $espInicial = 1;
    }
    
    return $espInicial;
}

function getEstiloInicial($idB){
    switch($idB){
        case '6':
            $estInicial = 2;
            break;
        case '10':
            $estInicial = 3;
            break;
        default:
            $estInicial = 1;
    }
    
    return $estInicial;
}

function getIngenioInicial($idB){
    switch($idB){
        case '2':
            $ingInicial = 3;
            break;
        case '4':
            $ingInicial = 3;
            break;
        default:
            $ingInicial = 1;
    }
    
    return $ingInicial;
}

function getPercepcionInicial($idB){
    switch($idB){
        case '1':
            $perInicial = 3;
            break;
        case '6':
            $perInicial = 3;
            break;
        case '8':
            $perInicial = 2;
            break;
        default:
            $perInicial = 1;
    }
    
    return $perInicial;
}

function getBancoInicial($idB){
    switch($idB){
        case '4':
            $banInicial = 200;
            break;
        case '10':
            $banInicial = 200;
            break;
        
        default:
            $banInicial = 0;
    }
    
    return $banInicial;
}
    
function nuevoPersonaje($idP,$idB){
        
    global $db;
    $id = $_SESSION['loggedIn'];  
        
    $sql = "SELECT * FROM personajes WHERE id = '$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
        
?>
<form action="?bPage=accountOptions&action=crearPersonaje&nonUI" method="post">
    
    <select name="sexo">

    <option>Hombre</option>

    <option>Mujer</option>
    
    </select>
    <br>
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
  
   
    ¡Hmmm! Una nueva sabandija en la ciudad. Cuéntame de tí:<br><br>
    <div id='sexos'>
        <div id='sexoTitulo'>Sexo:</div>
        <div id='Hombre' class='selectorSexo'></div>
        <div id='Mujer' class='selectorSexo'></div>
    </div>

    <div id='barrios'>
        <div id='barriosTitulo'>¿En qué barrio vives?</div>
    </div>
      

    <div id='moduloZona'>
        <div class='contenido'>
            <?php
            
            
            echo "<div class='seccionMapaCiudad'>" ;
                    
                    $sql = "SELECT * FROM barrios";
                    $stmt = $db->query($sql);
                    $resultado = $stmt->fetchAll();
                    
                    foreach ($resultado as $barrios) {
                       echo "<div id = 'barrio" . $barrios['idB'] . "' class='barrio" . $barrios['idB'] . " cuadritoBarrio'>";
                       echo $barrios['nombreBarrio'];
                       echo "</div>";
                    }
                echo "</div>"; //FIN DE div seccionMapaCiudad
            ?>
            <div class='seccionDescripcionZona'>
                <div class='seccionPersonajilloInicial'>
                    
                    <div id='dibujilloPersonaje'>
                        <?php
                        $sql = "SELECT sexo FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $sexo = $stmt->fetchAll();
                        
                        $sexoPersonaje = $sexo[0]['sexo'];
                        if($sexoPersonaje === 'Mujer'){
                           echo "<img src='/design/img/iconos/personajilloMujer.png'>";
                        }
                        else{
                            echo "<img src='/design/img/iconos/personajilloHombre.png'>";
                        }
                        ?>
                    </div>

                    <table border = '0' class='floatLeft'><caption>Habilidades Iniciales</caption>

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
                    
                    $destrezaInicial = getDestrezaInicial($idB);
                    $fuerzaInicial = getFuerzaInicial($idB);
                    $agilidadInicial = getAgilidadInicial($idB);
                    $resistenciaInicial = getResistenciaInicial($idB);
                    $espirituInicial = getEspirituInicial($idB);
                    $estiloInicial = getEstiloInicial($idB);
                    $ingenioInicial = getIngenioInicial($idB);
                    $percepcionInicial = getPercepcionInicial($idB);

                    echo "<tr>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getDestrezaInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getFuerzaInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getAgilidadInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getResistenciaInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getEspirituInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getEstiloInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getIngenioInicial($idB) . "</th>";
                        echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getPercepcionInicial($idB) . "</th>";

                    echo "</tr>";
                echo "</table>";
                
                echo "<table border = '0' class='floatRight' style='margin-left:10px'><caption>Dinero</caption>";
    
                echo "<tr>";
                    echo "<th colspan='2'> <br> </th>";
                    echo "<th colspan='2'> <br> </th>";
                echo "</tr>";  
                
                echo "<tr>";
                    echo "<th colspan='2'> <img src='/design/img/iconos/moneda.png'> </th>";
                    echo "<th colspan='2'> <img src='/design/img/iconos/cajaFuerte.png'> </th>";
                echo "</tr>";  
                
                echo "<tr>";
                    echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . 100 . "</th>";
                    echo "<th colspan='2' style='background-color:yellowgreen'; width:50px>" . getBancoInicial($idB) . "</th>";
                echo "</tr>";
                
                echo "</table>";
            echo "</div>";
            echo "<div class='seccionDescripcionZonaTexto'>";
            
            $sql = "SELECT * FROM barrios WHERE idB = '$idB'";
            $stmt = $db->query($sql);            
            $siguiente = $stmt->fetchAll();
            
            $mostrarDescripcionInicio = $siguiente[0]['descripcionInicio'];
            
            echo $mostrarDescripcionInicio;
            
            echo "<br><br><input type='submit' value='VALE'>";
            echo "</div>"; //FIN NUEVO
            
            echo "</form>"; 
        echo "</div>";
    echo "</div>";
    ?>
<script>
$(function() {
    $(".cuadritoBarrio").hover(function(){
        var barrioId = $(this).attr('id');
        

        $.post("?bPage=personajeFunctions", {

            barrioId: barrioId

        }).done(function(){
               
               $("#nuevoPersonajeArea").load("index.php?bPage=personajeFunctions&nuevoPersonaje&nonUI")
                
        })
    });
    
    $(".cuadritoBarrio").click(function(){
       $("#nuevoPersonajeArea").load("index.php?bPage=personajeFunctions&seleccionInicio&nonUI")
    });
});

$(function() {
    $(".selectorSexo").hover(function(){
        var sexo = $(this).attr('id');
        

        $.post("?bPage=personajeFunctions", {

            sexo: sexo

        }).done(function(){
               
               $("#nuevoPersonajeArea").load("index.php?bPage=personajeFunctions&nuevoPersonaje&nonUI")
                
        })
    });
    
    $(".selectorSexo").click(function(){
        var sexo = $(this).attr('id');
        

        $.post("?bPage=personajeFunctions", {

            sexoClick: sexo

        }).done(function(){
               
               $("#nuevoPersonajeArea").load("index.php?bPage=personajeFunctions&nuevoPersonaje&nonUI")
                
        })
    });
});

                   
</script> 
                        
    <?php
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
    
    function siguienteBarrio($barrioId){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        //HACER EL SWITCH
        switch($barrioId){
            case 'barrio1':
                $idB = 1;
                break;
            case 'barrio2':
                $idB = 2;
                break;
            case 'barrio3':
                $idB = 3;
                break;
            case 'barrio4':
                $idB = 4;
                break;
            case 'barrio5':
                $idB = 5;
                break;
            case 'barrio6':
                $idB = 6;
                break;
            case 'barrio7':
                $idB = 7;
                break;
            case 'barrio8':
                $idB = 8;
                break;
            case 'barrio9':
                $idB = 9;
                break;
            case 'barrio10':
                $idB = 10;
                break;
        
            default:
                echo "ERROR";
        }
        
        $sql = "UPDATE siguientespot SET idB=$idB WHERE idP='$id'";
        $db->query($sql);
    }
    
    function selectorSexo($sexo){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        $sql = "UPDATE personajes SET sexo='$sexo' WHERE id='$id'";
        $db->query($sql);
    }
    
    function seleccionInicio($idP){
        //GUARDAR QUE HA SELECCIONADO ESE INICIO
    }

    
    if(isset($_GET['listPersonajeTodo'])){
        $id = $_SESSION['loggedIn'];
        listPersonajeTodo($id);
    }
    
    if(isset($_POST['objetoBolsaId'])){
        equipar($_POST['objetoBolsaId'], $_POST['areaCuerpoId']);
    }
    
    if(isset($_POST['avanceId'])){
        subirHabilidad($_POST['avanceId']);
    }
    
    if(isset($_GET['nuevoPersonaje'])){
        
        $id = $_SESSION['loggedIn'];
        include (__ROOT__.'/backend/comprobaciones.php');
        
        $barrioSeleccionado = getSiguienteBarrio($id);
        nuevoPersonaje($id,$barrioSeleccionado);
    }
 
    if(isset($_POST['barrioId'])){
        siguienteBarrio($_POST['barrioId']);
    }
    
    if(isset($_POST['sexo'])){
        selectorSexo($_POST['sexo']);
    }
    
    if(isset($_POST['sexoClick'])){
        selectorSexo($_POST['sexoClick']);
    }
?>
