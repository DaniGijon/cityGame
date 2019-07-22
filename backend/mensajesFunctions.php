<?php
function dibujarMensajes($id){
    global $db;
    
    echo "<span class = 'tituloSpot'>";
        echo "<h4>" . "Buzón de Mensajes" . "</h4>";
    echo "</span>";
    
    echo "<div class='contenido'>";
        echo "<span class='contenedor1'>"; 
    
            echo "<div id=TablaMensajes>";
            //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
            $sql = "SELECT * FROM mensajes WHERE idP = '$id' ORDER BY fecha DESC";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black'><caption></caption>";

            echo "<tr style='background:darkturquoise'>";
                 echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> FECHA </th>";
                 echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> ASUNTO </th>";
                 echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> LEER </th>";
                 echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> BORRAR </th>";
            echo "</tr>";

            for($i=0; $i<10 /* sizeof($result)*/; $i=$i+1){
                if(isset($result[$i])){
                    echo "<tr>";
                        echo "<td colspan='100%' bgcolor='black' height='2'></td>";
                    echo "</tr>";

                    if($result[$i]['leido']==='0'){
                        echo "<tr id ='" . $result[$i]['asunto'] . "' class = 'cajitaMensaje' bgcolor='yellow'>";
                    }
                    else{
                        echo "<tr id ='" . $result[$i]['asunto'] . "' class = 'cajitaMensaje'>";
                    }
                    echo "<td>" . date("d-m-y | H:i:s", strtotime($result[$i]['fecha'])) . "</td>";

                    echo "<td>" . $result[$i]['asunto'] . "</td>";

                    $idMensaje = $result[$i]['idM'];
                    echo "<td>" . "<a href='?page=leer&message=$idMensaje'> Leer </a>" . "</td>";

                    echo "<td> <span id=$idMensaje class='borrar'>X</span> </td>";
                    echo "</tr>";
                }

            }
            echo "</table>";
            echo "</div>"; //FIN DIV tablaMensajes
            
               ?>
<script>
                $(".borrar").click(function(event){
                    var mensajeId = $(this).attr('id');

                    $.post("?bPage=mensajesFunctions", {

                    mensajeId: mensajeId

                    }).done(function(){

                        $("#mensajesArea").load("index.php?bPage=mensajesFunctions&borrarMensaje&dibujarMensajes&nonUI")
                    })
                });    
                
                $(".cajitaMensaje").hover(function(){
                    var tipo = $(this).attr('id');
                            
                    if (tipo === 'Subiste de Nivel') {
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
                    }
                    
                    else if (tipo === 'Cobro') {
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
    
    $puedoLeerlo = comprobarMensaje($idM);
    if ($puedoLeerlo === 1){

        $sql = "SELECT * FROM mensajes WHERE idM = '$idM'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $fechaMensaje = $result[0]['fecha'];
        $asuntoMensaje = $result[0]['asunto'];
        $imagenMensaje = $result[0]['imagen'];
        $contenidoMensaje = $result[0]['contenido'];
        
         echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";

            echo "<tr>";
                echo "<td>";
                    echo "<div id='FechaMensaje'>";
                        echo date('d-m-y | H:i:s', strtotime($fechaMensaje));
                    echo "</div>";
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                    echo "<div id='AsuntoMensaje'> $asuntoMensaje </div>";
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                    if($asuntoMensaje === 'Aventura'){
                        if(!$imagenMensaje){
                            $imagenMensaje = 'noMonstruo.png';
                        }
                        echo "<div id='ImagenMensaje'> <img src='/design/img/monstruos/" . $imagenMensaje . "'></div>";
                    }
                    elseif($asuntoMensaje === 'Subiste de Nivel'){
                        echo "<div id='ImagenMensaje'> <img src='/design/img/iconos/subirNivel.png'></div>";
                    }
                    elseif($asuntoMensaje === 'Reliquia Encontrada'){
                        echo "<div id='ImagenMensaje'> <img src='/design/img/iconos/reliquiaEncontrada.png'></div>";
                    }
                    elseif($asuntoMensaje === 'Popularidad'){
                        echo "<div id='ImagenMensaje'> <img src='/design/img/iconos/popularidad.png'></div>";
                    }
                echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
                echo "<td>";
                     echo "<div id='ContenidoMensaje'> $contenidoMensaje </div>";
                echo "</td>";
            echo "</tr>";
        echo "</table>";

        //Marcar como Leido
        $sql = "UPDATE mensajes SET leido = 1 WHERE idM='$idM'";
        $db->query($sql);
    }
    else{
        header("location: ?page=mensajes&message=No puedo leer ese mensaje");
    }
}

function borrarMensaje($idM){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "DELETE FROM mensajes WHERE idM='$idM'";
    $db->query($sql);
    
    
}
if(isset($_GET['dibujarMensajes'])){
    $id = $_SESSION['loggedIn'];
    dibujarMensajes($id);
}
    
if(isset($_POST['mensajeId'])){
    borrarMensaje($_POST['mensajeId']);
}
