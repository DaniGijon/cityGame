<?php
function dibujarAlbum(){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<button class='seccion1'>Monstruos</button>";
        echo "<button class='seccion2'>Reliquias</button>";
        echo "<button class='seccion3'>Insignias</button>";
    echo "</div>"; 
    
    echo "<div id=seccion1>";
       
    echo "<div id='monstruos'>";
    
    echo '<br>MONSTRUOS DERROTADOS: ' . getMonstruosDerrotados($id) . '<br><br>';
    
    echo "<div class='tablaMonstruosDerrotados'>";
    
        echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";
            echo "<tr>";
                echo "<th></th>";
                for($i=1;$i<=11;$i++){
                    if($i != 11){
                        echo "<th style='text-align:center; border-radius: 15px'> $i </th>";
                    }
                    else{
                        echo "<th style='text-align:center; border-radius: 15px'> BOSS </th>";
                    }
                }
            echo "</tr>";
            
            for($i=1;$i<20;$i++){ //Para cada zona
              echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";  
              
              echo "<tr>";
                echo "<td>" . getNombreZona($i) . "</td>";
                $uno = $i*10-9;
                $dos = $i*10-8;
                $tres = $i*10-7;
                $cuatro = $i*10-6;
                $cinco = $i*10-5;
                $seis = $i*10-4;
                $siete = $i*10-3;
                $ocho = $i*10-2;
                $nueve = $i*10-1;
                $diez = $i*10;
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$uno'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $uno . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $uno . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$dos'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $dos . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $dos . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$tres'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $tres . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $tres . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$cuatro'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $cuatro . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $cuatro . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$cinco'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $cinco . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $cinco . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$seis'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $seis . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $seis . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$siete'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $siete . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $siete . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$ocho'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $ocho . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $ocho . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$nueve'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $nueve . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $nueve . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM = '$diez'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0]) && $ver[0]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $diez . "ok.png'>" . "</div></td>";
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $diez . ".png'>" . "</div></td>";
                }
                
                $sql = "SELECT * FROM victorias WHERE idP='$id' AND idM >= 200";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[$i-1]) && $ver[$i-1]['cantidad'] > 0){
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $ver[0]['idM'] . "ok.png'>" . "</div></td>";
                }
                else{
                    $idSombra = $i+199;
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/" . $idSombra . ".png'>" . "</div></td>";
                }
               
            echo "</tr>";
            }
            

        echo "</table>";
    echo "</div>";
    
    
    echo "</div>"; //FIN SECCION MONSTRUOS
    
    
    echo "</div>"; //FIN SECCION 1
    
    echo "<div id='seccion2'>";
        
        $sql = "SELECT * FROM coleccionismo WHERE idP='$id'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        echo '<br>RELIQUIAS ENCONTRADAS: ' . getReliquiasEncontradas($id) . ' / 25<br><br>';
        
        echo "<div class='tablaReliquias'>";
    
        echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";
            echo "<tr>";
                echo "<th></th>";
                for($i=1;$i<=5;$i++){
                    echo "<th style='text-align:center; border-radius: 15px'> $i </th>";
                }
            echo "</tr>";
            
              echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";  
              
              echo "<tr>"; //Fila CABEZA
                    echo "<td>Cabeza</td>";
                
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '107'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum miniDescubierta107'>" . "<img src='/design/img/album/r107ok.png'>" . "</div></td>";
                        echo "<div id='infoReliquia107'>";
                            echo "Visor de Energía";
                        echo "</div>"; 
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r107.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '108'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum miniDescubierta108'>" . "<img src='/design/img/album/r108ok.png'>" . "</div></td>";
                        echo "<div id='infoReliquia108'>";
                            echo "Corona del Rey del Patio";
                        echo "</div>"; 
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r108.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '104'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum miniDescubierta104'>" . "<img src='/design/img/album/r104ok.png'>" . "</div></td>";
                        echo "<div id='infoReliquia104'>";
                            echo "Máscara de Mejora";
                        echo "</div>"; 
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r104.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '105'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r105ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r105.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '106'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r106ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r106.png'>" . "</div></td>";
                    }
                    
              echo "</tr>"; //FIN fila CABEZA
              
              echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";  
            
              echo "<tr>"; //Fila TORSO
                    echo "<td>Torso</td>";
                
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '202'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r202ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r202.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '203'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r203ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r203.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '204'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r204ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r204.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '205'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r205ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r205.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '206'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r206ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r206.png'>" . "</div></td>";
                    }
                    
              echo "</tr>"; //FIN fila TORSO
              
               echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";
              
              echo "<tr>"; //Fila MANOS
                    echo "<td>Manos</td>";
                
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '302'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r302ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r302.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '303'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r303ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r303.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '304'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r304ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r304.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '305'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r305ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r305.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '306'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r306ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r306.png'>" . "</div></td>";
                    }
                    
              echo "</tr>"; //FIN fila MANOS
              
              
              echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";
              
              echo "<tr>"; //Fila PIES
                    echo "<td>Pies</td>";
                
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '402'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r402ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r402.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '403'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r403ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r403.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '404'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r404ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r404.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '405'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r405ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r405.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '406'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r406ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r406.png'>" . "</div></td>";
                    }
                    
              echo "</tr>"; //FIN fila PIES
              
              
              echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
              echo "</tr>";
              
              echo "<tr>"; //Fila AEROMODELISMO
                    echo "<td>Aeromodelismo</td>";
                
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '1000'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1000ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1000.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '1001'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1001ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1001.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '1002'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1002ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1002.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '1003'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1003ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1003.png'>" . "</div></td>";
                    }
                    
                    $sql = "SELECT * FROM coleccionismo WHERE idP='$id' AND idO = '1004'";
                    $stmt = $db->query($sql);
                    $ver = $stmt->fetchAll();
                
                    if(isset($ver[0])){
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1004ok.png'>" . "</div></td>";
                    }
                    else{
                        echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r1004.png'>" . "</div></td>";
                    }
                    
              echo "</tr>"; //FIN fila AEROMODELISMO
        echo "</table>";
        echo "</div>";
    
    echo "</div>"; //FIN SECCION 2
    
    echo "<div id='seccion3'>";
        
        echo '<br>INSIGNIAS CONSEGUIDAS: ' . getInsigniasConseguidas($id) . '<br><br>';

            $sql = "SELECT * FROM insignias WHERE idP='$id'";
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll();

            foreach ($result as $cadaInsignia){
                echo "<div id='albumFicha'>";
                    echo "<div id='insigniaBox'><img src='/design/img/insignias/" . $cadaInsignia['imagen'] ."'>";
                    echo "</div>";
                echo "</div>";   
            }
   
    echo "</div>"; //FIN SECCION 3
    
    
?>

<script>
    $(".seccion1").click(function(){
        $("#seccion1").show();
        $("#seccion2").hide();
        $("#seccion3").hide();
        $(".seccion1").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
    });
    
    $(".seccion2").click(function(){
        $("#seccion2").show();
        $("#seccion1").hide();
        $("#seccion3").hide();
        $(".seccion2").css("background-color", "yellow");
        $(".seccion1").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
    });
    
    $(".seccion3").click(function(){
        $("#seccion3").show();
        $("#seccion2").hide();
        $("#seccion1").hide();
        $(".seccion3").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion1").css("background-color", "white");
    });
    $(".miniDescubierta104").mouseenter(function(e){
        $("#infoReliquia104").css("left", e.pageX - 150);
        $("#infoReliquia104").css("top", e.pageY - 100);
        $("#infoReliquia104").css("display", "block");
    });
    
    $(".miniDescubierta104").mouseleave(function(e){
        $("#infoReliquia104").css("display", "none");
    });
    
    $(".miniDescubierta107").mouseenter(function(e){
        $("#infoReliquia107").css("left", e.pageX - 150);
        $("#infoReliquia107").css("top", e.pageY - 100);
        $("#infoReliquia107").css("display", "block");
    });
    
    $(".miniDescubierta107").mouseleave(function(e){
        $("#infoReliquia107").css("display", "none");
    });
    
    $(".miniDescubierta108").mouseenter(function(e){
        $("#infoReliquia108").css("left", e.pageX - 150);
        $("#infoReliquia108").css("top", e.pageY - 100);
        $("#infoReliquia108").css("display", "block");
    });
    
    $(".miniDescubierta108").mouseleave(function(e){
        $("#infoReliquia108").css("display", "none");
    });
    
                    
</script>

<?php
}

function getNombreZona($zona){
     global $db;
     
     switch($zona){
         case 1:
             $nombreZona = "Asdrúbal";
             break;
         case 2:
             $nombreZona = "Terri";
             break;
         case 3:
             $nombreZona = "Gran Capitán";
             break;
         case 4:
             $nombreZona = "San José";
             break;
         case 5:
             $nombreZona = "Pozo Norte";
             break;
         case 6:
             $nombreZona = "Abulagar";
             break;
         case 7:
             $nombreZona = "El Poblado";
             break;
         case 8:
             $nombreZona = "Salesianos";
             break;
         case 9:
             $nombreZona = "Tauro";
             break;
         case 10:
             $nombreZona = "La Copa";
             break;
         case 11:
             $nombreZona = "Ayuntamiento";
             break;
         case 12:
             $nombreZona = "Paseo San Gregorio";
             break;
         case 13:
             $nombreZona = "Paseo El Bosque";
             break;
         case 14:
             $nombreZona = "El Pino";
             break;
         case 15:
             $nombreZona = "El Carmen";
             break;
         case 16:
             $nombreZona = "Las 600";
             break;
         case 17:
             $nombreZona = "PAU";
             break;
         case 18:
             $nombreZona = "Recinto Ferial";
             break;
         case 19:
             $nombreZona = "Ciudad Jardín";
             break;
     }
     return $nombreZona;
}
?>