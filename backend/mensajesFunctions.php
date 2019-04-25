<?php
function dibujarMensajes($id){
    global $db;
    
    echo "<div id=TablaMensajes>";
    //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
    $sql = "SELECT * FROM mensajes WHERE idP = '$id' ORDER BY fecha DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<table border = '1' style=text-align:center><caption>Bandeja de Entrada</caption>";
    
    echo "<tr>";
        echo "<th> FECHA </th>";
        echo "<th> ASUNTO </th>";
	echo "<th> MENSAJE </th>";
        echo "<th> BORRAR </th>";
    echo "</tr>";
    
    for($i=0; $i< sizeof($result); $i=$i+1){
        if($result[$i] === null){
            echo "<tr></tr>";
        }
        else{

            if($result[$i]['leido']==='0'){
                echo "<tr bgcolor='yellow'>";
            }
            else{
                echo "<tr>";
            }
            echo "<td>" . $result[$i]['fecha'] . "</td>";

            echo "<td>" . $result[$i]['asunto'] . "</td>";

            $idMensaje = $result[$i]['idM'];
            echo "<td>" . "<a href='?page=leer&message=$idMensaje'> Leer </a>" . "</td>";
            
            echo "<td> <span id=$idMensaje class='borrar'>X</span> </td>";
            echo "</tr>";
        }
       
    }
    echo "</table>";
    echo "</div>";
    
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
               
</script>
<?php
}

function lectura($idM){
    include (__ROOT__.'/backend/comprobaciones.php');
    
    global $db;
    $id = $_SESSION['loggedIn'];
    
    echo "Qieres leer el mensaje con idM : " . $idM;
    $puedoLeerlo = comprobarMensaje($idM);
    if ($puedoLeerlo === 1){

        $sql = "SELECT * FROM mensajes WHERE idM = '$idM'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $fechaMensaje = $result[0]['fecha'];
        $asuntoMensaje = $result[0]['asunto'];
        $contenidoMensaje = $result[0]['contenido'];

        echo "<div id='FechaMensaje'> $fechaMensaje </div>";
        echo "<div id='AsuntoMensaje'> $asuntoMensaje </div>";
        echo "<div id='ContenidoMensaje'> $contenidoMensaje </div>";

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
