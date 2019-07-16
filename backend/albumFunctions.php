<?php
function dibujarAlbum(){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<div class = 'tituloZona5 seccion1'>";
            echo "<div class = 'textoZona5 cool'>";
                echo "Monstruos";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona1 seccion2 opacity'>";
            echo "<div class = 'textoZona1 cool'>";
                echo "Reliquias";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona5 seccion3 opacity'>";
            echo "<div class = 'textoZona5 cool'>";
                echo "Insignias";
            echo "</div>";
        echo "</div>";
        echo "<div id='Mi'>";
        echo "<br><br>";
        echo "</div>";
    echo "</div>"; 
    
    echo "<div id=seccion1>";
       echo "<button id='botonMonstruosAsdrubal' class='botonMonstruosZona'>Asdrúbal</button>";
       echo "<button id='botonMonstruosTerri' class='botonMonstruosZona'>Terri</button>";
       echo "<button id='botonMonstruosGranCapitan' class='botonMonstruosZona'>Gran Capitán</button>";
       echo "<button id='botonMonstruosSanJose' class='botonMonstruosZona'>San José</button>";
       echo "<button id='botonMonstruosPozoNorte' class='botonMonstruosZona'>Pozo Norte</button>";
       echo "<button id='botonMonstruosAbulagar' class='botonMonstruosZona'>Abulagar</button>";
       echo "<button id='botonMonstruosElPoblado' class='botonMonstruosZona'>El Poblado</button>";
       echo "<button id='botonMonstruosSalesianos' class='botonMonstruosZona'>Salesianos</button>";
       echo "<button id='botonMonstruosTauro' class='botonMonstruosZona'>Tauro</button>";
       echo "<button id='botonMonstruosLaCopa' class='botonMonstruosZona'>La Copa</button>";
       echo "<button id='botonMonstruosAyuntamiento' class='botonMonstruosZona'>Ayuntamiento</button>";
       echo "<button id='botonMonstruosPaseoSanGregorio' class='botonMonstruosZona'>Paseo S.Gregorio</button>";
       echo "<button id='botonMonstruosPaseoElBosque' class='botonMonstruosZona'>Paseo El Bosque</button>";
       echo "<button id='botonMonstruosElPino' class='botonMonstruosZona'>El Pino</button>";
       echo "<button id='botonMonstruosElCarmen' class='botonMonstruosZona'>El Carmen</button>";
       echo "<button id='botonMonstruosLas600' class='botonMonstruosZona'>Las 600</button>";
       echo "<button id='botonMonstruosPAU' class='botonMonstruosZona'>PAU</button>";
       echo "<button id='botonMonstruosRecintoFerial' class='botonMonstruosZona'>Recinto Ferial</button>";
       echo "<button id='botonMonstruosCiudadJardin' class='botonMonstruosZona'>Ciudad Jardín</button>";
    echo "<div id='monstruos'>";
    
    echo '<br>MONSTRUOS DERROTADOS: ' . getMonstruosDerrotados($id);
    echo '<br>ESPECIES DERROTADAS: ' . getEspeciesDerrotadas($id) . ' / 190';
    
    echo "<div id='asdrubalAlbum'>";
    
    echo "<div class='tablaMonstruosDerrotados'>";
    
        echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><caption></caption>";
            echo "<tr>";
                for($i=1; $i<=3; $i++){
                    echo "<td>";
                        $sql = "SELECT * FROM victorias WHERE victorias.idP='$id' AND victorias.idM ='$i'";
                        $stmt = $db->query($sql);
                        $ver = $stmt->fetchAll();

                        if(isset($ver[0])){
                            echo "<div class='albumTarjeta'>";
                                    echo "<div class='albumTarjetaTitulo coolWhite texto-borde'>";
                                    $monstruo = getMonstruoRow($ver[0]['idM']);
                                    echo $monstruo[0]['nombre'];
                                    //Catalogar las habilidades del monstruo
                                    $monstruoAtaque = ($monstruo[0]['destreza'] + $monstruo[0]['fuerza'])/2;
                                    $monstruoDefensa = ($monstruo[0]['agilidad'] + $monstruo[0]['resistencia'])/2;
                                    $monstruoSalud = ($monstruo[0]['salud']);
                                    $monstruoDescripcion = ($monstruo[0]['descripcion']);
                                echo "</div>";
                                    echo '<div id="opcionBox" class="albumTarjetaImagen">';
                                        echo '<div class="cartaSalud texto-borde coolWhiteGrande">';
                                            echo $monstruoSalud;
                                        echo '</div>';
                                        echo '<div class="cartaFoto texto-borde coolWhiteGrande">';
                                            echo '<img src="/design/img/monstruos/' . $ver[0]['idM'] . '">';
                                        echo '</div>';
                                    echo '</div>';
                                    if($monstruoAtaque < 10){
                                        echo '<div class="cartaAtaqueB texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaAtaque texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    if($monstruoDefensa < 10){
                                        echo '<div class="cartaDefensaB texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaDefensa texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                echo "<div class='cartaDescripcion'>";
                                    echo $monstruoDescripcion;
                                    if($ver[0]['cantidad'] < 10){
                                        echo "<div id='vecesDerrotadoB' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                    else{
                                        echo "<div id='vecesDerrotado' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                echo "</div>";
                                
                            echo "</div>";                          
                        }
                        else{
                            echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r107.png'>" . "</div></td>";
                        }
                    echo "</td>";
                }
                
                echo "<td rowspan='3'>";
                $sql = "SELECT * FROM victorias WHERE victorias.idP='$id' AND victorias.idM ='200'";
                $stmt = $db->query($sql);
                $ver = $stmt->fetchAll();
                
                if(isset($ver[0])){
                    echo "<div class='opcionesTienda bossTarjeta'>";
                    echo "<div class='opcionesTiendaTitulo'>";
                        $monstruo = getMonstruoRow($ver[0]['idM']);
                        echo $monstruo[0]['nombre'];
                    echo "</div>";
                    if($ver[0]['cantidad'] >1)
                        echo '<div id="opcionBox">' . '<img src="/design/img/monstruos/' . $ver[0]['idM'] . '"></div>' . '<div class="monedaTienda"></div><div class="precioTienda">' . $ver[0]['cantidad'] . ' veces</div>';
                    else 
                        echo '<div id="opcionBox">' . '<img src="/design/img/monstruos/' . $ver[0]['idM'] . '"></div>' . '<div class="monedaTienda"></div><div class="precioTienda">' . $ver[0]['cantidad'] . ' vez</div>';
                    echo "</div>";                          
                }
                else{
                    echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r107.png'>" . "</div></td>";
                }
                
                echo "</td>";
            echo "</tr>";
                for($i=4; $i<=6; $i++){
                    echo "<td>";
                        $sql = "SELECT * FROM victorias WHERE victorias.idP='$id' AND victorias.idM ='$i'";
                        $stmt = $db->query($sql);
                        $ver = $stmt->fetchAll();

                        if(isset($ver[0])){
                            echo "<div class='albumTarjeta'>";
                                    echo "<div class='albumTarjetaTitulo coolWhite texto-borde'>";
                                    $monstruo = getMonstruoRow($ver[0]['idM']);
                                    echo $monstruo[0]['nombre'];
                                    //Catalogar las habilidades del monstruo
                                    $monstruoAtaque = ($monstruo[0]['destreza'] + $monstruo[0]['fuerza'])/2;
                                    $monstruoDefensa = ($monstruo[0]['agilidad'] + $monstruo[0]['resistencia'])/2;
                                    $monstruoSalud = ($monstruo[0]['salud']);
                                    $monstruoDescripcion = ($monstruo[0]['descripcion']);
                                echo "</div>";
                                    echo '<div id="opcionBox" class="albumTarjetaImagen">';
                                        echo '<div class="cartaSalud texto-borde coolWhiteGrande">';
                                            echo $monstruoSalud;
                                        echo '</div>';
                                        echo '<div class="cartaFoto texto-borde coolWhiteGrande">';
                                            echo '<img src="/design/img/monstruos/' . $ver[0]['idM'] . '">';
                                        echo '</div>';
                                    echo '</div>';
                                    if($monstruoAtaque < 10){
                                        echo '<div class="cartaAtaqueB texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaAtaque texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    if($monstruoDefensa < 10){
                                        echo '<div class="cartaDefensaB texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaDefensa texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                echo "<div class='cartaDescripcion'>";
                                    echo $monstruoDescripcion;
                                    if($ver[0]['cantidad'] < 10){
                                        echo "<div id='vecesDerrotadoB' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                    else{
                                        echo "<div id='vecesDerrotado' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                echo "</div>";
                                
                            echo "</div>";                          
                        }
                        else{
                            echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r107.png'>" . "</div></td>";
                        }
                    echo "</td>";
                }
            
            echo "<tr>";
                
            echo "</tr>";
            
            echo "<tr>";
                for($i=7; $i<=9; $i++){
                    echo "<td>";
                        $sql = "SELECT * FROM victorias WHERE victorias.idP='$id' AND victorias.idM ='$i'";
                        $stmt = $db->query($sql);
                        $ver = $stmt->fetchAll();

                        if(isset($ver[0])){
                            echo "<div class='albumTarjeta'>";
                                    echo "<div class='albumTarjetaTitulo coolWhite texto-borde'>";
                                    $monstruo = getMonstruoRow($ver[0]['idM']);
                                    echo $monstruo[0]['nombre'];
                                    //Catalogar las habilidades del monstruo
                                    $monstruoAtaque = ($monstruo[0]['destreza'] + $monstruo[0]['fuerza'])/2;
                                    $monstruoDefensa = ($monstruo[0]['agilidad'] + $monstruo[0]['resistencia'])/2;
                                    $monstruoSalud = ($monstruo[0]['salud']);
                                    $monstruoDescripcion = ($monstruo[0]['descripcion']);
                                echo "</div>";
                                    echo '<div id="opcionBox" class="albumTarjetaImagen">';
                                        echo '<div class="cartaSalud texto-borde coolWhiteGrande">';
                                            echo $monstruoSalud;
                                        echo '</div>';
                                        echo '<div class="cartaFoto texto-borde coolWhiteGrande">';
                                            echo '<img src="/design/img/monstruos/' . $ver[0]['idM'] . '">';
                                        echo '</div>';
                                    echo '</div>';
                                    if($monstruoAtaque < 10){
                                        echo '<div class="cartaAtaqueB texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaAtaque texto-borde coolWhiteGrande">' . $monstruoAtaque . '</div>';
                                    }
                                    if($monstruoDefensa < 10){
                                        echo '<div class="cartaDefensaB texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                    else{
                                        echo '<div class="cartaDefensa texto-borde coolWhiteGrande">' . $monstruoDefensa . '</div>';
                                    }
                                echo "<div class='cartaDescripcion'>";
                                    echo $monstruoDescripcion;
                                    if($ver[0]['cantidad'] < 10){
                                        echo "<div id='vecesDerrotadoB' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                    else{
                                        echo "<div id='vecesDerrotado' class='texto-borde coolWhiteGrande'>";
                                            echo $ver[0]['cantidad'];
                                        echo "</div>";
                                    }
                                echo "</div>";
                                
                            echo "</div>";                          
                        }
                        else{
                            echo "<td>" . "<div class='miniAlbum'>" . "<img src='/design/img/album/r107.png'>" . "</div></td>";
                        }
                    echo "</td>";
                }
            echo "</tr>";
            

        echo "</table>";
    echo "</div>";
    
    echo "</div>"; //Fin asdrubal
   
    
    
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
        $(".seccion1").css("opacity", "1");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
    });
    
    $(".seccion2").click(function(){
        $("#seccion2").show();
        $("#seccion1").hide();
        $("#seccion3").hide();
        $(".seccion2").css("opacity", "1");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
    });
    
    $(".seccion3").click(function(){
        $("#seccion3").show();
        $("#seccion2").hide();
        $("#seccion1").hide();
        $(".seccion3").css("opacity", "1");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
    });
    
    $("#botonMonstruosAsdrubal").click(function(){
        $("#asdrubalAlbum").show();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "yellow");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
        
    });
    
    $("#botonMonstruosTerri").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").show();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "yellow");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosGranCapitan").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").show();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "yellow");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosSanJose").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").show();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "yellow");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosPozoNorte").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").show();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "yellow");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosAbulagar").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").show();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "yellow");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosElPoblado").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").show();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "yellow");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosSalesianos").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").show();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "yellow");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosTauro").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").show();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "yellow");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosLaCopa").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").show();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "yellow");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosAyuntamiento").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").show();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "yellow");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosPaseoSanGregorio").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").show();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "yellow");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosPaseoElBosque").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").show();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "yellow");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosElPino").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").show();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "yellow");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosElCarmen").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").show();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "yellow");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosLas600").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").show();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "yellow");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosPAU").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").show();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "yellow");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosRecintoFerial").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").show();
        $("#ciudadJardinAlbum").hide();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "yellow");
        $("#botonMonstruosCiudadJardin").css("background-color", "lightblue");
    });
    
    $("#botonMonstruosCiudadJardin").click(function(){
        $("#asdrubalAlbum").hide();
        $("#terriAlbum").hide();
        $("#granCapitanAlbum").hide();
        $("#sanJoseAlbum").hide();
        $("#pozoNorteAlbum").hide();
        $("#abulagarAlbum").hide();
        $("#elPobladoAlbum").hide();
        $("#salesianosAlbum").hide();
        $("#tauroAlbum").hide();
        $("#laCopaAlbum").hide();
        $("#ayuntamientoAlbum").hide();
        $("#paseoSanGregorioAlbum").hide();
        $("#paseoElBosqueAlbum").hide();
        $("#elPinoAlbum").hide();
        $("#elCarmenAlbum").hide();
        $("#las600Album").hide();
        $("#PAUAlbum").hide();
        $("#recintoFerialAlbum").hide();
        $("#ciudadJardinAlbum").show();
        $("#botonMonstruosAsdrubal").css("background-color", "lightblue");
        $("#botonMonstruosTerri").css("background-color", "lightblue");
        $("#botonMonstruosGranCapitan").css("background-color", "lightblue");
        $("#botonMonstruosSanJose").css("background-color", "lightblue");
        $("#botonMonstruosPozoNorte").css("background-color", "lightblue");
        $("#botonMonstruosAbulagar").css("background-color", "lightblue");
        $("#botonMonstruosElPoblado").css("background-color", "lightblue");
        $("#botonMonstruosSalesianos").css("background-color", "lightblue");
        $("#botonMonstruosTauro").css("background-color", "lightblue");
        $("#botonMonstruosLaCopa").css("background-color", "lightblue");
        $("#botonMonstruosAyuntamiento").css("background-color", "lightblue");
        $("#botonMonstruosPaseoSanGregorio").css("background-color", "lightblue");
        $("#botonMonstruosPaseoElBosque").css("background-color", "lightblue");
        $("#botonMonstruosElPino").css("background-color", "lightblue");
        $("#botonMonstruosElCarmen").css("background-color", "lightblue");
        $("#botonMonstruosLas600").css("background-color", "lightblue");
        $("#botonMonstruosPAU").css("background-color", "lightblue");
        $("#botonMonstruosRecintoFerial").css("background-color", "lightblue");
        $("#botonMonstruosCiudadJardin").css("background-color", "yellow");
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

function getMonstruoRow($idMonstruo){
    global $db;
    $sql = "SELECT * FROM monstruos WHERE idM=?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($idMonstruo));
    return $stmt->fetchAll();       
}
?>