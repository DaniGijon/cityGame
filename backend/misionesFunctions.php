<?php
function dibujarMisiones($id){
    global $db;
    echo "<span class = 'tituloSpot'>";
        echo "<h4>" . "Registro de Misiones" . "</h4>";
    echo "</span>";
    
    echo "<div class='contenido'>";
        echo "<span class='contenedor1'>"; 
        
            //Cabecera selector opciones
        echo "<div id='botonesComprarVender'>";
            echo "<div class = 'tituloZona1 seccion1'>";
                echo "<div class = 'textoZona1 cool'>";
                    echo "Activas";
                echo "</div>";
            echo "</div>";
            echo "<div class = 'tituloZona5 seccion2 opacity'>";
                echo "<div class = 'textoZona5 cool'>";
                    echo "Completadas";
                echo "</div>";
            echo "</div>";
            echo "<div id='Mi'>";
        echo "<br><br>";
        echo "</div>";
        echo "</div>"; 
        echo "<div id = 'tablaMisiones'>";
         echo "<div id=seccion1Misiones>";
    
            echo "<div id=TablaMisionesActivas>";
            //Cojo todas mis misiones y las ordeno de más completadas a menos completadas
            $sql = "SELECT * FROM progresos WHERE idP = '$id' AND completada = '0' ORDER BY progreso DESC";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";

            echo "<tr>";
                echo "<th style='Stext-align:center; border-radius: 15px'> MISION </th>";
                echo "<th style='Stext-align:center; border-radius: 15px'> PROGRESO </th>";
                echo "<th style='Stext-align:center; border-radius: 15px'> DETALLES </th>";
                echo "<th style='Stext-align:center; border-radius: 15px; width: 80px;'> ZONA </th>";
            echo "</tr>";

            for($i=0; $i < sizeof($result); $i=$i+1){ //Para cada Mision Activa
                if(isset($result[$i])){
                    echo "<tr>";
                        echo "<td colspan='100%' bgcolor='black' height='2'></td>";
                    echo "</tr>";
                    $idMision = $result[$i]['idM'];
                    $sql = "SELECT * FROM misiones WHERE idM = '$idMision'"; //Detalles de la Mision
                    $stmt = $db->query($sql);
                    $mision = $stmt->fetchAll();
                    
                    echo "<tr id ='" . $mision[0]['idM'] . "' class = 'cajitaMision'>";
                    
                    echo "<td>" . $mision[0]['titulo'] . "</td>";

                    echo "<td>" . $result[$i]['progreso'] . " / " . $mision[0]['etapas'] . "</td>";
                    
                    $idMision = $result[$i]['idM'];
                    echo "<td>" . "<a href='?page=detalles&message=$idMision'> Leer </a>" . "</td>";

                    echo "<td>" . $mision[0]['zona'] . "</td>";

                    echo "</tr>";
                }

            }
            echo "</table>";
            
            echo "</div>"; //FIN DIV tablaMisiones
        echo "</div>"; //FIN de seccion1Misiones
        
        echo "<div id=seccion2Misiones>";
            echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";

            echo "<tr>";
                echo "<th style='Stext-align:center; border-radius: 15px'> MISION </th>";
                echo "<th style='Stext-align:center; border-radius: 15px'> PROGRESO </th>";
                echo "<th style='Stext-align:center; border-radius: 15px; width: 80px;'> ZONA </th>";
            echo "</tr>";
            
            $sql = "SELECT * FROM progresos WHERE idP = '$id' AND completada = '1' ORDER BY idM DESC";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            for($i=0; $i < sizeof($result); $i=$i+1){ //Para cada Mision Activa
                if(isset($result[$i])){
                    echo "<tr>";
                        echo "<td colspan='100%' bgcolor='black' height='2'></td>";
                    echo "</tr>";
                    $idMision = $result[$i]['idM'];
                    $sql = "SELECT * FROM misiones WHERE idM = '$idMision'"; //Detalles de la Mision
                    $stmt = $db->query($sql);
                    $mision = $stmt->fetchAll();
                    
                    echo "<tr id ='" . $mision[0]['idM'] . "' class = 'cajitaMision'>";
                    
                    echo "<td>" . $mision[0]['titulo'] . "</td>";

                    echo "<td>" . $result[$i]['progreso'] . " / " . $mision[0]['etapas'] . "</td>";

                    echo "<td>" . $mision[0]['zona'] . "</td>";

                    echo "</tr>";
                }

            }
            echo "</table>";
        echo "</div>"; //FIN de seccion2Misiones
        echo "</div>"; //Fin tabla misiones
               ?>
<script>
                $(".seccion1").click(function(){
                    $("#seccion2Misiones").hide();
                    $("#seccion1Misiones").show(); 
                    $(".seccion1").css("opacity", "1");
                    $(".seccion2").css("opacity", "0.6");
                });
                $(".seccion2").click(function(){
                    $("#seccion1Misiones").hide();
                    $("#seccion2Misiones").show(); 
                    $(".seccion2").css("opacity", "1");
                    $(".seccion1").css("opacity", "0.6");
                });
    
                $(".cajitaMision").hover(function(){
                    var id = $(this).attr('id');
                            
                    if (id === '1') {
                        $(".opcionSpot1").show();
                        $(".opcionSpot2").hide();
                        $(".opcionSpot3").hide();
                        $(".opcionSpot4").hide();
                        $(".opcionSpot5").hide();
                        $(".opcionSpot6").hide();
                        $(".opcionSpot7").hide();
                        $(".opcionSpot8").hide();
                        $(".opcionSpot9").hide();
                        $(".opcionSpot10").hide();
                        $(".opcionSpot11").hide();
                        $(".opcionSpot12").hide();
                        $(".opcionSpot13").hide();
                        $(".opcionSpot14").hide();
                        $(".opcionSpot15").hide();
                        $(".opcionSpot16").hide();
                        $(".opcionSpot17").hide();
                        $(".opcionSpot18").hide();
                        $(".opcionSpot19").hide();
                        $(".opcionSpot20").hide();
                    }
                    
                    if (id === '2') {
                        $(".opcionSpot2").show();
                        $(".opcionSpot1").hide();
                        $(".opcionSpot3").hide();
                        $(".opcionSpot4").hide();
                        $(".opcionSpot5").hide();
                        $(".opcionSpot6").hide();
                        $(".opcionSpot7").hide();
                        $(".opcionSpot8").hide();
                        $(".opcionSpot9").hide();
                        $(".opcionSpot10").hide();
                        $(".opcionSpot11").hide();
                        $(".opcionSpot12").hide();
                        $(".opcionSpot13").hide();
                        $(".opcionSpot14").hide();
                        $(".opcionSpot15").hide();
                        $(".opcionSpot16").hide();
                        $(".opcionSpot17").hide();
                        $(".opcionSpot18").hide();
                        $(".opcionSpot19").hide();
                        $(".opcionSpot20").hide();
                    }
                   
                });
               
</script>
<?php
    
        echo "</span>"; //Fin de Contenedor1
                    
        echo "<span class='contenedor2'>";
            echo "<div class='opcionSpot1 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    echo "<div class='secundarioPeque'>";
                        $imagenSpot = "<img src='/design/img/mensajes/asuntoSubisteDeNivel.png'>";
                        echo $imagenSpot;
                    echo "</div>";
                echo "</div>";
            echo "</div>"; //FIN opcionSpot1
            
            echo "<div class='opcionSpot2 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    echo "<div class='secundarioPeque'>";
                        $imagenSpot = "<img src='/design/img/mensajes/asuntoCobro.png'>";
                        echo $imagenSpot;
                    echo "</div>";
                echo "</div>";
            echo "</div>"; //FIN opcionSpot2
            
            echo "<div class='opcionSpot3 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot3
            
            echo "<div class='opcionSpot4 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot4
            
            echo "<div class='opcionSpot5 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot5
            
            echo "<div class='opcionSpot6 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot6
            
            echo "<div class='opcionSpot7 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot7
            
            echo "<div class='opcionSpot8 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot8
            
            echo "<div class='opcionSpot9 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot9
            
            echo "<div class='opcionSpot10 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot10
            
            echo "<div class='opcionSpot11 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot11
            
            echo "<div class='opcionSpot12 opcionSpot'>";
                echo "<div class='seccionDescripcionZonaImagen'>";
                    $imagenSpot = "<img src='/design/img/especial/subirNivel.png'>";
                    echo $imagenSpot;
                echo "</div>";
            echo "</div>"; //FIN opcionSpot12
            
            
        echo "</span>"; //FIN de contenedor2


    echo "</div>"; //FIN DE div contenido
    
 
}

function lectura($idM){
    include (__ROOT__.'/backend/comprobaciones.php');
    
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $mostrar = comprobarMision($idM);
    if ($mostrar === 1){
        
        $progreso = comprobarProgreso($idM); //Ver en que etapa de la mision estoy

        $sql = "SELECT * FROM misiones WHERE idM = '$idM'"; //Detalles de la mision
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $descripcion = getDescripcionMision($idM, $progreso);
        $recompensa = getRecompensaMision($idM, $progreso);
        
         echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";

            echo "<tr>";
                echo "<td>";
                    echo "<div id='TituloMision'>";
                        echo $result[0]['titulo'];
                    echo "</div>";
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                    echo "<div id='ProgresoMision'>" . $progreso . " / " . $result[0]['etapas'] . "</div>";
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                    echo "<div id='DescripcionMision'> $descripcion </div>";
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                     echo "<div id='RecompensaMision'> Recompensa: $recompensa </div>";
                echo "</td>";
            echo "</tr>";
        echo "</table>";

    }
    else{
        header("location: ?page=mensajes&message=No puedo hacer esa misión");
    }
}