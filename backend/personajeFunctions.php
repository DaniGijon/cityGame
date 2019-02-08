<?php
    function calcularPersonajeTotal($id){
        global $db;
            
        $sql = "SELECT * FROM personajes WHERE id='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $sql = "SELECT * FROM cabezas";
        $stmt = $db->query($sql);
        $cabezasDB = $stmt->fetchAll();

        $sql = "SELECT * FROM torsos";
        $stmt = $db->query($sql);
        $torsosDB = $stmt->fetchAll();

        $sql = "SELECT * FROM pies";
        $stmt = $db->query($sql);
        $piesDB = $stmt->fetchAll();

        $sql = "SELECT * FROM manos";
        $stmt = $db->query($sql);
        $manosDB = $stmt->fetchAll();

        $sql = "SELECT * FROM vehiculos";
        $stmt = $db->query($sql);
        $vehiculosDB = $stmt->fetchAll();

        $sql = "SELECT * FROM mascotas";
        $stmt = $db->query($sql);
        $mascotasDB = $stmt->fetchAll();
            
        $bonusDestreza = 0;
        $bonusFuerza = 0;
        $bonusAgilidad = 0;
        $bonusResistencia = 0;
        $bonusEspiritu = 0;
        $bonusEstilo = 0;
        $bonusIngenio = 0;
        $bonusPercepcion = 0;
        
        foreach ($cabezasDB as $cabezasLista) {
            if($result[0]['cabeza'] == 0){
                
                break;
            }
            else if($result[0]['cabeza'] === $cabezasLista['id']){
                $bonusDestreza +=  $cabezasLista['destreza'];
                $bonusFuerza +=  $cabezasLista['fuerza'];
                $bonusAgilidad +=  $cabezasLista['agilidad'];
                $bonusResistencia +=  $cabezasLista['resistencia'];
                $bonusEspiritu +=  $cabezasLista['espiritu'];
                $bonusEstilo +=  $cabezasLista['estilo'];
                $bonusIngenio +=  $cabezasLista['ingenio'];
                $bonusPercepcion +=  $cabezasLista['percepcion'];
            }
        }
        
        foreach ($torsosDB as $torsosLista) {
            if($result[0]['torso'] == 0){
               
                break;
            }
            else if($result[0]['torso'] === $torsosLista['id']){
                $bonusDestreza +=  $torsosLista['destreza'];
                $bonusFuerza +=  $torsosLista['fuerza'];
                $bonusAgilidad +=  $torsosLista['agilidad'];
                $bonusResistencia +=  $torsosLista['resistencia'];
                $bonusEspiritu +=  $torsosLista['espiritu'];
                $bonusEstilo +=  $torsosLista['estilo'];
                $bonusIngenio +=  $torsosLista['ingenio'];
                $bonusPercepcion +=  $torsosLista['percepcion'];
            }
        }
                
        foreach ($piesDB as $piesLista) {
            if($result[0]['pies'] == 0){
                
                break;
            }
            else if($result[0]['pies'] === $piesLista['id']){
                $bonusDestreza +=  $piesLista['destreza'];
                $bonusFuerza +=  $piesLista['fuerza'];
                $bonusAgilidad +=  $piesLista['agilidad'];
                $bonusResistencia +=  $piesLista['resistencia'];
                $bonusEspiritu +=  $piesLista['espiritu'];
                $bonusEstilo +=  $piesLista['estilo'];
                $bonusIngenio +=  $piesLista['ingenio'];
                $bonusPercepcion +=  $piesLista['percepcion'];
            }
        }
        
        foreach ($manosDB as $manosLista) {
            if($result[0]['derecha'] == 0){
                
                break;
            }
            else if($result[0]['derecha'] === $manosLista['id']){
                $bonusDestreza +=  $manosLista['destreza'];
                $bonusFuerza +=  $manosLista['fuerza'];
                $bonusAgilidad +=  $manosLista['agilidad'];
                $bonusResistencia +=  $manosLista['resistencia'];
                $bonusEspiritu +=  $manosLista['espiritu'];
                $bonusEstilo +=  $manosLista['estilo'];
                $bonusIngenio +=  $manosLista['ingenio'];        
                $bonusPercepcion +=  $manosLista['percepcion'];
            }
        }
        
        foreach ($manosDB as $manosLista) {
            if($result[0]['izquierda'] == 0){
                
                break;
            }
            else if($result[0]['izquierda'] === $manosLista['id']){
                $bonusDestreza +=  $manosLista['destreza'];
                $bonusFuerza +=  $manosLista['fuerza'];
                $bonusAgilidad +=  $manosLista['agilidad'];
                $bonusResistencia +=  $manosLista['resistencia'];
                $bonusEspiritu +=  $manosLista['espiritu'];
                $bonusEstilo +=  $manosLista['estilo'];
                $bonusIngenio +=  $manosLista['ingenio'];
                $bonusPercepcion +=  $manosLista['percepcion'];
            }
        }
        
        foreach ($vehiculosDB as $vehiculosLista) {
            if($result[0]['vehiculo'] == 0){
                
                break;
            }
            else if($result[0]['vehiculo'] === $vehiculosLista['id']){
                $bonusDestreza +=  $vehiculosLista['destreza'];
                $bonusFuerza +=  $vehiculosLista['fuerza'];
                $bonusAgilidad +=  $vehiculosLista['agilidad'];
                $bonusResistencia +=  $vehiculosLista['resistencia'];
                $bonusEspiritu +=  $vehiculosLista['espiritu'];
                $bonusEstilo +=  $vehiculosLista['estilo'];
                $bonusIngenio +=  $vehiculosLista['ingenio'];
                $bonusPercepcion +=  $vehiculosLista['percepcion'];
            }
        }
        
        foreach ($mascotasDB as $mascotasLista) {
            if($result[0]['mascota'] == 0){
                
                break;
            }
            else if($result[0]['mascota'] === $mascotasLista['id']){
                $bonusDestreza +=  $mascotasLista['destreza'];
                $bonusFuerza +=  $mascotasLista['fuerza'];
                $bonusAgilidad +=  $mascotasLista['agilidad'];
                $bonusResistencia +=  $mascotasLista['resistencia'];
                $bonusEspiritu +=  $mascotasLista['espiritu'];
                $bonusEstilo +=  $mascotasLista['estilo'];
                $bonusIngenio +=  $mascotasLista['ingenio'];
                $bonusPercepcion +=  $mascotasLista['percepcion'];
            }
        }
        
        $destreza = $result[0]['destreza'] + $bonusDestreza;
        $fuerza = $result[0]['fuerza'] + $bonusFuerza;
        $agilidad = $result[0]['agilidad'] + $bonusAgilidad;
        $resistencia = $result[0]['resistencia'] + $bonusResistencia;
        $espiritu = $result[0]['espiritu'] + $bonusEspiritu;
        $estilo = $result[0]['estilo'] + $bonusEstilo;
        $ingenio = $result[0]['ingenio'] + $bonusIngenio;
        $percepcion = $result[0]['percepcion'] + $bonusPercepcion;
        
        $sql = "UPDATE personajes SET destrezaTotal = '$destreza',fuerzaTotal = '$fuerza',agilidadTotal = '$agilidad',"
                . "resistenciaTotal = '$resistencia',espirituTotal = '$espiritu',estiloTotal = '$estilo',"
                . "ingenioTotal = '$ingenio',percepcionTotal = '$percepcion' WHERE id='$id'";
        
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetchAll();
        
    }


    function listPersonajeTodo($id){
            
            global $db;
            
            $sql = "SELECT * FROM personajes WHERE id='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            $sql = "SELECT * FROM cabezas";
            $stmt = $db->query($sql);
            $cabezasDB = $stmt->fetchAll();

            $sql = "SELECT * FROM torsos";
            $stmt = $db->query($sql);
            $torsosDB = $stmt->fetchAll();

            $sql = "SELECT * FROM pies";
            $stmt = $db->query($sql);
            $piesDB = $stmt->fetchAll();

            $sql = "SELECT * FROM manos";
            $stmt = $db->query($sql);
            $manosDB = $stmt->fetchAll();

            $sql = "SELECT * FROM vehiculos";
            $stmt = $db->query($sql);
            $vehiculosDB = $stmt->fetchAll();

            $sql = "SELECT * FROM mascotas";
            $stmt = $db->query($sql);
            $mascotasDB = $stmt->fetchAll();
            
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
                        echo "<span id='0' class='cabezaBox'>" . "cabeza" . "</span>";
                    echo "</div>";
                    
                    
                    echo"<div id='nuevoCabeza'>";
                        foreach($cabezasDB as $cabezasObjetos){
                            echo "<div id='nuevoBoxCabeza'>";
                                echo "<div id='" . $cabezasObjetos['id'] . "' class='nuevoBoxCabeza'>" . $cabezasObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $cabezasObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $cabezasObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $cabezasObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $cabezasObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $cabezasObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $cabezasObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $cabezasObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $cabezasObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoMascota'>";
                        foreach($mascotasDB as $mascotasObjetos){
                            echo "<div id='nuevoBoxMascota'>";
                                echo "<div id='" . $mascotasObjetos['id'] . "' class='nuevoBoxMascota'>" . $mascotasObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $mascotasObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $mascotasObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $mascotasObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $mascotasObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $mascotasObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $mascotasObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $mascotasObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $mascotasObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoIzquierda'>";
                        foreach($manosDB as $manosObjetos){
                            echo "<div id='nuevoBoxIzquierda'>";
                                echo "<div id='" . $manosObjetos['id'] . "' class='nuevoBoxIzquierda'>" . $manosObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $manosObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $manosObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $manosObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $manosObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $manosObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $manosObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $manosObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $manosObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoTorso'>";
                        foreach($torsosDB as $torsosObjetos){
                            echo "<div id='nuevoBoxTorso'>";
                                echo "<div id='" . $torsosObjetos['id'] . "' class='nuevoBoxTorso'>" . $torsosObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $torsosObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $torsosObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $torsosObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $torsosObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $torsosObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $torsosObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $torsosObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $torsosObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoDerecha'>";
                        foreach($manosDB as $manosObjetos){
                            echo "<div id='nuevoBoxDerecha'>";
                                echo "<div id='" . $manosObjetos['id'] . "' class='nuevoBoxDerecha'>" . $manosObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $manosObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $manosObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $manosObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $manosObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $manosObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $manosObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $manosObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $manosObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoVehiculo'>";
                        foreach($vehiculosDB as $vehiculosObjetos){
                            echo "<div id='nuevoBoxVehiculo'>";
                                echo "<div id='" . $vehiculosObjetos['id'] . "' class='nuevoBoxVehiculo'>" . $vehiculosObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $vehiculosObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $vehiculosObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $vehiculosObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $vehiculosObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $vehiculosObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $vehiculosObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $vehiculosObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $vehiculosObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    echo"<div id='nuevoPies'>";
                        foreach($piesDB as $piesObjetos){
                            echo "<div id='nuevoBoxPies'>";
                                echo "<div id='" . $piesObjetos['id'] . "' class='nuevoBoxPies'>" . $piesObjetos['nombre'] . "<br><br>" .
                                        "Destreza: " . $piesObjetos['destreza'] . "<br>" .
                                        "Fuerza: " . $piesObjetos['fuerza'] ."<br>" .
                                        "Agilidad: " . $piesObjetos['agilidad'] ."<br>" .
                                        "Resistencia: " . $piesObjetos['resistencia'] ."<br>" .
                                        "Espiritu: " . $piesObjetos['espiritu'] ."<br>" .
                                        "Estilo: " . $piesObjetos['estilo'] ."<br>" .
                                        "Ingenio: " . $piesObjetos['ingenio'] ."<br>" .
                                        "Percepcion: " . $piesObjetos['percepcion'] .
                                        "</div>" ;
                            echo "</div>";
                        }
                    echo "</div>";
                    
                    
                    echo "<div id='tercioMedio'>";
                        echo "<span id='1' class='mascotaBox'>" . "mascota". "</span>";
                        echo "<span id='2' class='izquierdaBox'>" . "izquierda". "</span>";
                        echo "<span id='3' class='torsoBox'>" . "torso" . "</span>";        
                        echo "<span id='4' class='derechaBox'>" . "derecha". "</span>";
                        echo "<span id='5' class='vehiculoBox'>" . "vehiculo". "</span>";
                    echo "</div>";
                    echo "<div id='tercioAbajo'>";
                        echo "<span id='6' class='piesBox'>" . "pies" . "</span>";        
                    echo "</div>";
                echo "</div>";
         /*       var_dump($cabezasDB);
                foreach($cabezasDB as $objetoCabeza){
                    echo "<div class='equiparBox'>" . $objetoCabeza[0]['nombre'] . "</div>";
                }
                
           */ 
            ?>
            
            <script>
                $(".cabezaBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#nuevoCabeza").css('left',event.pageX);
                    $("#nuevoCabeza").css('top',event.pageY);
                    $("#nuevoCabeza").toggle();
                      
                });
               
                $(".nuevoBoxCabeza").click(function(){
                   var objetoCabezaId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoCabezaId: objetoCabezaId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
               
                $(".mascotaBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#nuevoMascota").css('left',event.pageX);
                    $("#nuevoMascota").css('top',event.pageY);
                    $("#nuevoMascota").toggle();
                      
                });
               
                $(".nuevoBoxMascota").click(function(){
                   var objetoMascotaId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoMascotaId: objetoMascotaId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".izquierdaBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#nuevoIzquierda").css('left',event.pageX);
                    $("#nuevoIzquierda").css('top',event.pageY);
                    $("#nuevoIzquierda").toggle();
                      
                });
               
                $(".nuevoBoxIzquierda").click(function(){
                   var objetoIzquierdaId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoIzquierdaId: objetoIzquierdaId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".TorsoBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#nuevoTorso").css('left',event.pageX);
                    $("#nuevoTorso").css('top',event.pageY);
                    $("#nuevoTorso").toggle();
                      
                });
               
                $(".nuevoBoxTorso").click(function(){
                   var objetoTorsoId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoTorsoId: objetoTorsoId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".derechaBox").click(function(event){
                   var id = $(this).attr('id'); 
                     
                    $("#nuevoDerecha").css('left',event.pageX);
                    $("#nuevoDerecha").css('top',event.pageY);
                    $("#nuevoDerecha").toggle();
                      
                });
               
                $(".nuevoBoxDerecha").click(function(){
                   var objetoDerechaId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoDerechaId: objetoDerechaId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".vehiculoBox").click(function(event){
                   var id = $(this).attr('id'); 
                     
                    $("#nuevoVehiculo").css('left',event.pageX);
                    $("#nuevoVehiculo").css('top',event.pageY);
                    $("#nuevoVehiculo").toggle();
                      
                });
               
                $(".nuevoBoxVehiculo").click(function(){
                   var objetoVehiculoId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoVehiculoId: objetoVehiculoId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });
                
                $(".piesBox").click(function(event){
                   var id = $(this).attr('id');
                     
                    $("#nuevoPies").css('left',event.pageX);
                    $("#nuevoPies").css('top',event.pageY);
                    $("#nuevoPies").toggle();
                      
                });
               
                $(".nuevoBoxPies").click(function(){
                   var objetoPiesId = $(this).attr('id');
                   $.post("?bPage=personajeFunctions", {
                       objetoPiesId: objetoPiesId
                   }).done(function(){
                       $("#personajeArea").load("index.php?bPage=personajeFunctions&listPersonajeTodo&nonUI")
                   })
                });

                
           </script>   
           
            
            
            <span class="quarterWidth">Cabeza: 
                <?php  
                    foreach ($cabezasDB as $cabezasLista) {
                        if($result[0]['cabeza'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['cabeza'] === $cabezasLista['id']){
                            echo $cabezasLista['nombre'];
                            $bonusDestreza +=  $cabezasLista['destreza'];
                            $bonusFuerza +=  $cabezasLista['fuerza'];
                            $bonusAgilidad +=  $cabezasLista['agilidad'];
                            $bonusResistencia +=  $cabezasLista['resistencia'];
                            $bonusEspiritu +=  $cabezasLista['espiritu'];
                            $bonusEstilo +=  $cabezasLista['estilo'];
                            $bonusIngenio +=  $cabezasLista['ingenio'];
                            $bonusPercepcion +=  $cabezasLista['percepcion'];
                        }
                    }
                    
                ?>
            </span><br>
            <span class="quarterWidth">Torso: 
                <?php  
                    foreach ($torsosDB as $torsosLista) {
                        if($result[0]['torso'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['torso'] === $torsosLista['id']){
                            echo $torsosLista['nombre'];
                            $bonusDestreza +=  $torsosLista['destreza'];
                            $bonusFuerza +=  $torsosLista['fuerza'];
                            $bonusAgilidad +=  $torsosLista['agilidad'];
                            $bonusResistencia +=  $torsosLista['resistencia'];
                            $bonusEspiritu +=  $torsosLista['espiritu'];
                            $bonusEstilo +=  $torsosLista['estilo'];
                            $bonusIngenio +=  $torsosLista['ingenio'];
                            $bonusPercepcion +=  $torsosLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Pies: 
                <?php  
                    foreach ($piesDB as $piesLista) {
                         if($result[0]['pies'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['pies'] === $piesLista['id']){
                            echo $piesLista['nombre'];
                            $bonusDestreza +=  $piesLista['destreza'];
                            $bonusFuerza +=  $piesLista['fuerza'];
                            $bonusAgilidad +=  $piesLista['agilidad'];
                            $bonusResistencia +=  $piesLista['resistencia'];
                            $bonusEspiritu +=  $piesLista['espiritu'];
                            $bonusEstilo +=  $piesLista['estilo'];
                            $bonusIngenio +=  $piesLista['ingenio'];
                            $bonusPercepcion +=  $piesLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Derecha: 
                <?php  
                    foreach ($manosDB as $manosLista) {
                         if($result[0]['derecha'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['derecha'] === $manosLista['id']){
                            echo $manosLista['nombre'];
                            $bonusDestreza +=  $manosLista['destreza'];
                            $bonusFuerza +=  $manosLista['fuerza'];
                            $bonusAgilidad +=  $manosLista['agilidad'];
                            $bonusResistencia +=  $manosLista['resistencia'];
                            $bonusEspiritu +=  $manosLista['espiritu'];
                            $bonusEstilo +=  $manosLista['estilo'];
                            $bonusIngenio +=  $manosLista['ingenio'];
                            $bonusPercepcion +=  $manosLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Izquierda: 
                <?php  
                    foreach ($manosDB as $manosLista) {
                         if($result[0]['izquierda'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['izquierda'] === $manosLista['id']){
                            echo $manosLista['nombre'];
                            $bonusDestreza +=  $manosLista['destreza'];
                            $bonusFuerza +=  $manosLista['fuerza'];
                            $bonusAgilidad +=  $manosLista['agilidad'];
                            $bonusResistencia +=  $manosLista['resistencia'];
                            $bonusEspiritu +=  $manosLista['espiritu'];
                            $bonusEstilo +=  $manosLista['estilo'];
                            $bonusIngenio +=  $manosLista['ingenio'];
                            $bonusPercepcion +=  $manosLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Vehículo: 
                <?php  
                    foreach ($vehiculosDB as $vehiculosLista) {
                         if($result[0]['vehiculo'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['vehiculo'] === $vehiculosLista['id']){
                            echo $vehiculosLista['nombre'];
                            $bonusDestreza +=  $vehiculosLista['destreza'];
                            $bonusFuerza +=  $vehiculosLista['fuerza'];
                            $bonusAgilidad +=  $vehiculosLista['agilidad'];
                            $bonusResistencia +=  $vehiculosLista['resistencia'];
                            $bonusEspiritu +=  $vehiculosLista['espiritu'];
                            $bonusEstilo +=  $vehiculosLista['estilo'];
                            $bonusIngenio +=  $vehiculosLista['ingenio'];
                            $bonusPercepcion +=  $vehiculosLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Mascota: 
                <?php  
                    foreach ($mascotasDB as $mascotasLista) {
                         if($result[0]['mascota'] == 0){
                            echo 'Nada';
                            break;
                        }
                        else if($result[0]['mascota'] === $mascotasLista['id']){
                            echo $mascotasLista['nombre'];
                            $bonusDestreza +=  $mascotasLista['destreza'];
                            $bonusFuerza +=  $mascotasLista['fuerza'];
                            $bonusAgilidad +=  $mascotasLista['agilidad'];
                            $bonusResistencia +=  $mascotasLista['resistencia'];
                            $bonusEspiritu +=  $mascotasLista['espiritu'];
                            $bonusEstilo +=  $mascotasLista['estilo'];
                            $bonusIngenio +=  $mascotasLista['ingenio'];
                            $bonusPercepcion +=  $mascotasLista['percepcion'];
                        }
                    }
                ?>
            </span><br>
            <span class="quarterWidth">Item1: <?php echo $result[0]['item1']; ?></span><br>
            <span class="quarterWidth">Item2: <?php echo $result[0]['item2']; ?></span><br>
        </fieldset>
        
    </span>

    <span class="contenedor2">
        
        <?php
            $destreza = $result[0]['destrezaTotal'];
            $fuerza = $result[0]['fuerzaTotal'];
            $agilidad = $result[0]['agilidadTotal'];
            $resistencia = $result[0]['resistenciaTotal'];
            $espiritu = $result[0]['espirituTotal'];
            $estilo = $result[0]['estiloTotal'];
            $ingenio = $result[0]['ingenioTotal'];
            $percepcion = $result[0]['percepcionTotal'];
        ?>   
        <fieldset>
            <legend style="text-align: center"> Mis Datos</legend>
            <span class="quarterWidth">Nombre: <?php echo $result[0]['nombre']; ?> </span>
            <span class="quarterWidth">Experiencia: <?php echo $result[0]['experiencia']; ?></span>
            <span class="quarterWidth">Sexo: <?php echo $result[0]['sexo']; ?></span>
            <span class="quarterWidth">Nivel: <?php echo $result[0]['nivel']; ?></span>
            <span class="quarterWidth">Barrio: <?php echo $result[0]['barrio']; ?></span>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Constantes vitales</legend>
            <span class="quarterWidth">Salud: <?php echo $result[0]['salud']; ?></span><br>
            <span class="quarterWidth">Energia: <?php echo $result[0]['energia']; ?></span><br>
            <br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Fama</legend>
            <span class="quarterWidth">Respeto: <?php echo $result[0]['respeto']; ?></span><br>
            <span class="quarterWidth">Social: <?php echo $result[0]['social']; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mis dineros</legend>
            <span class="quarterWidth">En el bolsillo: <?php echo $result[0]['currentMoney']; ?></span><br>
            <span class="quarterWidth">En el banco: <?php echo $result[0]['bankMoney']; ?></span><br>
        </fieldset>
        <fieldset>
            <legend style="text-align: center"> Mis habilidades</legend>
            <span class="quarterWidth">Destreza: <?php echo $destreza . ' (' . $result[0]['destreza'] . '+' . $bonusDestreza . ')' ; ?></span><br>
            <span class="quarterWidth">Fuerza: <?php echo $fuerza . ' (' . $result[0]['fuerza'] . '+' . $bonusFuerza . ')' ; ?></span><br>
            <span class="quarterWidth">Agilidad: <?php echo $agilidad . ' (' . $result[0]['agilidad'] . '+' . $bonusAgilidad . ')' ; ?></span><br>
            <span class="quarterWidth">Resistencia: <?php echo $resistencia . ' (' . $result[0]['resistencia'] . '+' . $bonusResistencia . ')' ; ?></span><br>
            <span class="quarterWidth">Espiritu: <?php echo $espiritu . ' (' . $result[0]['espiritu'] . '+' . $bonusEspiritu . ')' ; ?></span><br>
            <span class="quarterWidth">Estilo: <?php echo $estilo . ' (' . $result[0]['estilo'] . '+' . $bonusEstilo . ')' ; ?></span><br>
            <span class="quarterWidth">Ingenio: <?php echo $ingenio . ' (' . $result[0]['ingenio'] . '+' . $bonusIngenio . ')' ; ?></span><br>
            <span class="quarterWidth">Percepcion: <?php echo $percepcion . ' (' . $result[0]['percepcion'] . '+' . $bonusPercepcion . ')' ; ?></span><br>
        </fieldset>
        
    </span>

<?php
    }
?>

<?php
    function listJugadorRival($id){
        global $db;
        
        $sql = "SELECT nombre,sexo,barrio,nivel,respeto,currentMoney FROM personajes WHERE id='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $nombre = $result[0]['nombre'];
        $sexo = $result[0]['sexo'];
        $barrio = $result[0]['barrio'];
        $nivel = $result[0]['nivel'];
        $respeto = $result[0]['respeto'];
        $currentMoney = $result[0]['currentMoney'];
        
        // Rangos de dinero
        if($currentMoney < 50){
            $currentMoneyText = 'Perro de la calle';
        }
        if($currentMoney >=50 && $currentMoney< 200){
            $currentMoneyText = 'Pobre';
        }
        if($currentMoney >= 200){
            $currentMoneyText = 'Rico nuevo';
        }
        
        // Rangos de Respeto
        if($respeto < 50){
            $respetoText = 'Basura humana';
        }
        if($respeto >=50 && $respeto< 200){
            $respetoText = 'Aquel tipo';
        }
        if($respeto >= 200){
            $respetoText = 'De Usted';
        }
        echo'Nombre: ' . $nombre . '<br>';
        echo'Sexo: ' . $sexo . '<br>';
        echo'Barrio: ' . $barrio . '<br>';
        echo'Nivel: ' . $nivel . '<br>';
        echo'Respeto: ' . $respetoText . '<br>';
        echo'Dineros: ' . $currentMoneyText . '<br>';
    }  
?>

<?php
    function equiparCabeza($objetoCabezaId){
        
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
    
    if(isset($_POST['objetoCabezaId'])){
        equiparCabeza($_POST['objetoCabezaId']);
    }
    
    if(isset($_POST['objetoMascotaId'])){
        equiparMascota($_POST['objetoMascotaId']);
    }
    
    if(isset($_POST['objetoIzquierdaId'])){
        equiparIzquierda($_POST['objetoIzquierdaId']);
    }
    
    if(isset($_POST['objetoTorsoId'])){
        equiparTorso($_POST['objetoTorsoId']);
    }
    
    if(isset($_POST['objetoDerechaId'])){
        equiparDerecha($_POST['objetoDerechaId']);
    }
    
    if(isset($_POST['objetoVehiculoId'])){
        equiparVehiculo($_POST['objetoVehiculoId']);
    }
    if(isset($_POST['objetoPiesId'])){
        equiparPies($_POST['objetoPiesId']);
    }
?>