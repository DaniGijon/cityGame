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
            <legend style="text-align: center">Mi inventario</legend>
            
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
         
                echo "<div id='infoObjeto'>";
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
            <span class="quarterWidth">Social: <?php echo $result[0]['social']; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mi dinero</legend>
            <span class="quarterWidth">En el bolsillo: <?php echo $result[0]['cash'] . "€"; ?></span><br>
            <span class="quarterWidth">En el banco: <?php echo $result[0]['enBanco'] . "€"; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mis habilidades</legend>
            <span class="quarterWidth">Destreza: <?php echo round($destreza+$bonusDestreza, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['destreza'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusDestreza . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances1' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Fuerza: <?php echo round($fuerza+$bonusFuerza, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['fuerza'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusFuerza . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances2' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Agilidad: <?php echo round($agilidad+$bonusAgilidad, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['agilidad'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusAgilidad . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances3' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Resistencia: <?php echo round($resistencia+$bonusResistencia, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['resistencia'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusResistencia . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances4' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Espiritu: <?php echo round($espiritu+$bonusEspiritu, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['espiritu'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusEspiritu . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances5' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Estilo: <?php echo round($estilo+$bonusEstilo, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['estilo'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusEstilo . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances6' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Ingenio(<img src='/design/img/iconos/ingenio.png'>): <?php echo round($ingenio+$bonusIngenio, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['ingenio'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusIngenio . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances7' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            <span class="quarterWidth">Percepción (<img src='/design/img/iconos/percepcion.png'>): <?php echo round($percepcion+$bonusPercepcion, 2, PHP_ROUND_HALF_DOWN) . ' (' . round($result[0]['percepcion'], 2, PHP_ROUND_HALF_DOWN) . '+' . $bonusPercepcion . ')' ;
            if ($result[0]['avances'] > 0){
                echo "<span id='botonAvances8' class='botonAvances'>
                <img src='/design/img/botones/avances.png'><br>
            </span>";
            }
            ?></span><br>
            
            <span class="quarterWidth">Avances: <?php echo $result[0]['avances'] . " ";?></span><br>

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
                
                $(".objetoBox").mouseenter(function(e){
                    $("#infoObjeto").css("left", e.pageX + 5);
                    $("#infoObjeto").css("top", e.pageY + 5);
                    $("#infoObjeto").css("display", "block");
                });
                
                $(".objetoBox").mouseleave(function(e){
                    $("#infoObjeto").css("display", "none");
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
        else if ($cosaId >= 500){
            $slot = 7; //bolsa
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
