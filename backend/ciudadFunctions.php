<?php
    function dibujarCiudad($id,$zonaID,$barrioID){
        
        global $db;
        
        echo "<div id='moduloZona'>";
            
            echo "<div class='contenido'>";
                echo "<a href='?page=zona'><button>Volver a Zona</button></a><br><br>";
                
                echo "<div class='seccionMapaCiudad'>" ;
                    
                    $sql = "SELECT * FROM zonas";
                    $stmt = $db->query($sql);
                    $result = $stmt->fetchAll();
                    
                    foreach ($result as $zonas) {
                       echo "<div id = 'barrio" . $zonas['idB'] . "zona" . $zonas['idZ'] .  
                       "' class='cuadritoZona " . "barrio" . $zonas['idB'] . "'>";
                       echo $zonas['nombreZona'];
                       echo "</div>";
                    }
                echo "</div>"; //FIN DE div seccionMapaCiudad
               
                echo "<div class='seccionDescripcionZona'>";
                    echo "<div class='seccionDescripcionZonaImagen'>";
                        //Lo necesitare a continuacion
                        $sql = "SELECT barrio,zona FROM personajes WHERE id='$id'";
                        $stmt = $db->query($sql);
                        $resultado = $stmt->fetchAll();
                            
                        $zonaEstoy = $resultado[0]['zona'];
                        $barrioEstoy = $resultado[0]['barrio'];
                                       
                        $sql = "SELECT * FROM zonas  WHERE idZ = '$zonaEstoy' AND idB = '$barrioEstoy'";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();
                        
                        if($zonaID === 0){
                            //Voy a enseñar la localizacion en la que actualmente estoy
                            
                            
                            $imagenZona = "<img src='/design/img/zonas/" . $result[0]['imagenZona'] . "'>";
                            echo $imagenZona;
                        }
                        else{
                            $sql = "SELECT * FROM zonas  WHERE idZ = '$zonaID' AND idB = '$barrioID'";
                            $stmt = $db->query($sql);
                            $res = $stmt->fetchAll();
                            
                            $imagenSpot = "<img src='/design/img/zonas/" . $res[0]['imagenZona'] . "'>";
                            echo $imagenSpot;
                        }
                    
                    echo "</div>";
                    echo "<div class='seccionDescripcionZonaTexto'>";
                        if($zonaID === 0 || ($zonaID === $zonaEstoy && $barrioID === $barrioEstoy)){
                            //Voy a enseñar el texto de la localizacion en la que actualmente estoy
                            echo "<span class='textoDescripcionSpot'>";
                                $descripcionZona = $result[0]['textoZona'];
                                echo $descripcionZona;
                            echo "</span>";
                            echo "<br><br><br>¡Estas aquí!";
                        }
                        else{
                            echo "<div class='textoDescripcionSpot'>";
                                $nombreZona = $res[0]['nombreZona'];
                                $descripcionZona = $res[0]['textoZona'];
                                echo $nombreZona;
                                echo "<br>";
                                echo $descripcionZona;
                            echo "</div>";
                        }
                        
                    echo "</div>";
                echo "</div>"; // FIN de div seccionDescripcionZona
               
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        ?>
<script>
$(function() {
    $(".cuadritoZona").hover(function(){
        var barriozonaId = $(this).attr('id');
        

        $.post("?bPage=ciudadFunctions", {

            barriozonaId: barriozonaId

        }).done(function(){
               
               $("#ciudadArea").load("index.php?bPage=ciudadFunctions&dibujarCiudad&nonUI")
                
        })
    });
    
    $(".cuadritoZona").click(function(){
       $("#ciudadArea").load("index.php?bPage=zonaFunctions&llegarAZona&nonUI")
    });
});
</script>
<?php
}

function siguienteZona($barriozonaId){
        global $db;
        $id = $_SESSION['loggedIn'];
        
        //HACER EL SWITCH
        switch($barriozonaId){
            case 'barrio1zona1':
                $idB = 1;
                $idZ = 1;
                break;
            case 'barrio1zona2':
                $idB = 1;
                $idZ = 2;
                break;
            case 'barrio2zona1':
                $idB = 2;
                $idZ = 1;
                break;
            case 'barrio2zona2':
                $idB = 2;
                $idZ = 2;
                break;
            case 'barrio2zona3':
                $idB = 2;
                $idZ = 3;
                break;
            case 'barrio3zona1':
                $idB = 3;
                $idZ = 1;
                break;
            case 'barrio4zona1':
                $idB = 4;
                $idZ = 1;
                break;
            case 'barrio5zona1':
                $idB = 5;
                $idZ = 1;
                break;
            case 'barrio5zona2':
                $idB = 5;
                $idZ = 2;
                break;
            case 'barrio5zona3':
                $idB = 5;
                $idZ = 3;
                break;
            case 'barrio6zona1':
                $idB = 6;
                $idZ = 1;
                break;
            case 'barrio6zona2':
                $idB = 6;
                $idZ = 2;
                break;
            case 'barrio6zona3':
                $idB = 6;
                $idZ = 3;
                break;
            case 'barrio7zona1':
                $idB = 7;
                $idZ = 1;
                break;
            case 'barrio8zona1':
                $idB = 8;
                $idZ = 1;
                break;
            case 'barrio9zona1':
                $idB = 9;
                $idZ = 1;
                break;
            case 'barrio9zona2':
                $idB = 9;
                $idZ = 2;
                break;
            case 'barrio9zona3':
                $idB = 9;
                $idZ = 3;
                break;
            case 'barrio10zona1':
                $idB = 10;
                $idZ = 1;
                break;
            default:
                echo "ERROR";
        }
        
        $sql = "UPDATE siguientespot SET idZ=$idZ, idB=$idB WHERE idP='$id'";
        $db->query($sql);
    }
    
    if(isset($_GET['dibujarCiudad'])){
        $id = $_SESSION['loggedIn'];
        include (__ROOT__.'/backend/comprobaciones.php');
        
        $zonaSeleccionada = getSiguienteZona($id);
        $barrioSeleccionado = getSiguienteBarrio($id);
        dibujarCiudad($id, $zonaSeleccionada, $barrioSeleccionado);
    }
    
    if(isset($_POST['barriozonaId'])){
        siguienteZona($_POST['barriozonaId']);
    }
