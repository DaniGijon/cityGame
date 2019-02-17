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
                
                    echo "<div id='tercioArriba'>";
                        echo "<span id='0' class='cabezaBox objetoBox'>" . "cabeza" . "</span>";
                    echo "</div>";
                    
                    
                    echo"<div id='capaBolsa'>";
                        $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id'";
                        $stmt = $db->query($sql);
                        $objetosDB = $stmt->fetchAll();
                        
                        foreach($objetosDB as $obj){
                            echo "<div id='nuevoBoxBolsa'>";
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa'>" . $obj['nombre'] . "<br><br>" .
                                        "Destreza: " . $obj['destreza'] . "<br>" .
                                        "Fuerza: " . $obj['fuerza'] ."<br>" .
                                        "Agilidad: " . $obj['agilidad'] ."<br>" .
                                        "Resistencia: " . $obj['resistencia'] ."<br>" .
                                        "Espiritu: " . $obj['espiritu'] ."<br>" .
                                        "Estilo: " . $obj['estilo'] ."<br>" .
                                        "Ingenio: " . $obj['ingenio'] ."<br>" .
                                        "Percepcion: " . $obj['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo "<div id='tercioMedio'>";
                        
                        echo "<span id='3' class='derechaBox objetoBox'>" . "derecha". "</span>";
                        echo "<span id='1' class='torsoBox objetoBox'>" . "torso" . "</span>";        
                        echo "<span id='4' class='izquierdaBox objetoBox'>" . "izquierda". "</span>";
                        echo "<span id='7' class='bolsaBox objetoBox'>" . "bolsa". "</span>";
                        
                    echo "</div>";
                    echo "<div id='tercioAbajo'>";
                        echo "<span id='6' class='mascotaBox objetoBox'>" . "mascota". "</span>";
                        echo "<span id='2' class='piesBox objetoBox'>" . "pies" . "</span>";  
                        echo "<span id='5' class='vehiculoBox objetoBox'>" . "vehiculo". "</span>";
                    echo "</div>";
                echo "</div>";
         
                echo "<div id='infoObjeto'>";
                //Consultar que objetos tiene el personaje en cada slot (se ordenan por slot)
                    $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id'";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    var_dump($objetosDB);
                    
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
            <span class="quarterWidth">Destreza: <?php echo $destreza+$bonusDestreza . ' (' . $result[0]['destreza'] . '+' . $bonusDestreza . ')' ; ?></span><br>
            <span class="quarterWidth">Fuerza: <?php echo $fuerza+$bonusFuerza . ' (' . $result[0]['fuerza'] . '+' . $bonusFuerza . ')' ; ?></span><br>
            <span class="quarterWidth">Agilidad: <?php echo $agilidad+$bonusAgilidad . ' (' . $result[0]['agilidad'] . '+' . $bonusAgilidad . ')' ; ?></span><br>
            <span class="quarterWidth">Resistencia: <?php echo $resistencia+$bonusResistencia . ' (' . $result[0]['resistencia'] . '+' . $bonusResistencia . ')' ; ?></span><br>
            <span class="quarterWidth">Espiritu: <?php echo $espiritu+$bonusEspiritu . ' (' . $result[0]['espiritu'] . '+' . $bonusEspiritu . ')' ; ?></span><br>
            <span class="quarterWidth">Estilo: <?php echo $estilo+$bonusEstilo . ' (' . $result[0]['estilo'] . '+' . $bonusEstilo . ')' ; ?></span><br>
            <span class="quarterWidth">Ingenio: <?php echo $ingenio+$bonusIngenio . ' (' . $result[0]['ingenio'] . '+' . $bonusIngenio . ')' ; ?></span><br>
            <span class="quarterWidth">Percepcion: <?php echo $percepcion+$bonusPercepcion . ' (' . $result[0]['percepcion'] . '+' . $bonusPercepcion . ')' ; ?></span><br>
        </fieldset>
        
    </span>
    
    <script>
                $(".bolsaBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#capaBolsa").css('left',event.pageX);
                    $("#capaBolsa").css('top',event.pageY);
                    $("#capaBolsa").toggle();
                      
                });
               
                $(".nuevoBoxBolsa").click(function(){
                   var objetoBolsaId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoBolsaId: objetoBolsaId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
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
        if($currentMoney < 50){
            $currentMoneyText = 'Menos que uno que se está bañando';
        }
        if($currentMoney >=50 && $currentMoney< 200){
            $currentMoneyText = 'Pobre';
        }
        if($currentMoney >= 200){
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

    function equiparCabeza($objetoBolsaId){
        
        global $db;
        
        $sql = "SELECT * FROM cabezas WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoCabezaId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['cabeza']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET cabeza='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparMascota($objetoMascotaId){
        
        global $db;
        
        $sql = "SELECT * FROM mascotas WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoMascotaId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['mascota']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET mascota='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparIzquierda($objetoIzquierdaId){
        
        global $db;
        
        $sql = "SELECT * FROM manos WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoIzquierdaId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['izquierda']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET izquierda='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparTorso($objetoTorsoId){
        
        global $db;
        
        $sql = "SELECT * FROM torsos WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoTorsoId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['torso']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET torso='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparDerecha($objetoDerechaId){
        
        global $db;
        
        $sql = "SELECT * FROM manos WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoDerechaId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['derecha']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET derecha='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparVehiculo($objetoVehiculoId){
        
        global $db;
        
        $sql = "SELECT * FROM vehiculos WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoVehiculoId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['vehiculo']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET vehiculo='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    function equiparPies($objetoPiesId){
        
        global $db;
        
        $sql = "SELECT * FROM pies WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($objetoPiesId));
        
        //SI EL OBJETO EXISTE
        if($stmt->rowCount() > 0){
            //LA FILA CON INFORMACION DEL OBJETO
            $objetoResult = $stmt->fetchAll();
            
            $id = $_SESSION['loggedIn'];
            $sql = "SELECT * FROM personajes  WHERE personajes.id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();
            
            $desequipar = $result[0]['pies']; //objeto a desequipar
            var_dump($desequipar);
            $equipar = $objetoResult[0]['id']; //objeto a equipar
            var_dump($equipar);
            
            $sql = "UPDATE personajes SET pies='$equipar' WHERE id = '$id'";
            $stmt = $db->query($sql);
            
            
            // HAY QUE HACER A DONDE VA EL OBJETO QUE DESEQUIPAMOS
            
        }
        else{
            echo "El objeto que estas intentando equipar no existe.";
        }
    }
    
    if(isset($_GET['listPersonajeTodo'])){
        $id = $_SESSION['loggedIn'];
        listPersonajeTodo($id);
    }
    
    if(isset($_POST['objetoBolsaId'])){
        equiparCabeza($_POST['objetoBolsaId']);
    }
?>
