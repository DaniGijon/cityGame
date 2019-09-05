<?php
function dibujarRanking(){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
    echo "<div class = 'tituloZona1 seccion0'>";
            echo "<div class = 'textoZona1 cool'>";
                echo "Clanes";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona4 seccion1 opacity'>";
            echo "<div class = 'textoZona4 cool'>";
                echo "Respetados";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona1 seccion2 opacity'>";
            echo "<div class = 'textoZona1 cool'>";
                echo "Populares";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona2 seccion3 opacity'>";
            echo "<div class = 'textoZona2 cool'>";
                echo "Cazarrecompensas";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona5 seccion4 opacity'>";
            echo "<div class = 'textoZona5 cool'>";
                echo "Safari";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona2 seccion5 opacity'>";
            echo "<div class = 'textoZona2 cool'>";
                echo "Coleccionistas";
            echo "</div>";
        echo "</div>";
        echo "<div class = 'tituloZona5 seccion6 opacity'>";
            echo "<div class = 'textoZona5 cool'>";
                echo "Clientes";
            echo "</div>";
        echo "</div>";
    echo "</div>"; 
    
    echo "<div class='contenedor1'>";
    echo "<div id=seccion0Ranking>";
    //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
    $sql = "SELECT * FROM personajes WHERE nivel > 1 ORDER BY respeto DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $puntos1=$puntos2=$puntos3=$puntos4=$puntos5=$puntos6=$puntos7=$puntos8=$puntos9=$puntos10=0;
    
    foreach($result as $jugador){
        if($jugador['origen'] === '1'){
            $puntos1 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '2'){
            $puntos2 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '3'){
            $puntos3 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '4'){
            $puntos4 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '5'){
            $puntos5 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '6'){
            $puntos6 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '7'){
            $puntos7 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '8'){
            $puntos8 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '9'){
            $puntos9 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
        elseif($jugador['origen'] === '10'){
            $puntos10 += $jugador['respeto'] + ($jugador['popularidad'] * 100);
        }
    }
    
    $barrios = array(
        array(
            'id' => '1',
            'nombre' => 'Cañamares',
            'puntos' => $puntos1
        ),
        
        array(
          'id' => '2',
          'nombre' => 'Libertad',
          'puntos' => $puntos2  
        ),
        
        array(
            'id' => '3',
            'nombre' => 'Constitución',
            'puntos' => $puntos3
        ),
        
        array(
            'id' => '4',
          'nombre' => 'El Poblado',
          'puntos' => $puntos4  
        ),
        
        array(
            'id' => '5',
            'nombre' => 'Santa Ana',
            'puntos' => $puntos5
        ),
        
        array(
            'id' => '6',
          'nombre' => 'Centro Sur',
          'puntos' => $puntos6  
        ),
        
        array(
            'id' => '7',
            'nombre' => 'Las Mercedes',
            'puntos' => $puntos7
        ),
        
        array(
            'id' => '8',
          'nombre' => 'El Carmen',
          'puntos' => $puntos8  
        ),
        
        array(
            'id' => '9',
            'nombre' => 'Fraternidad',
            'puntos' => $puntos9
        ),
        
        array(
            'id' => '10',
          'nombre' => 'Ciudad Jardín',
          'puntos' => $puntos10  
        )
    );
    //VOY A ORDENAR LOS BARRIOS DE MAS A MENOS PUNTOS
   foreach ($barrios as $key => $row)
    {
        $wek[$key]  = $row['puntos'];
    }    
    array_multisort($wek, SORT_DESC, $barrios);
    //Pues ya estaría
    
    $miClan = getOrigen($id);
    
    echo "<div class='tablaTopClanes'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;'><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> CLAN </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> PUNTOS </th>";
    echo "</tr>";
    
    for($i=0; $i<10; $i=$i+1){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

            if($barrios[$i]['id'] === $miClan){ //Si es mi clan...
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            echo "<td>";
           echo $barrios[$i]['nombre'];
            echo "</td>";

            echo "<td style='text-align:right;'>" . $barrios[$i]['puntos'] . "</td>";
            echo "</tr>";
        
    }
    echo "</table>";
    echo "<br>* Sólo contabilizan los jugadores de Nivel 2 o superior.<br>** 1% de Popularidad = +100 puntos. 1 de Respeto = +1 punto.";
    echo "</div>";
    echo "</div>"; //Fin seccion0Ranking
    echo "<div id=seccion1Ranking>";
    //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
    $sql = "SELECT * FROM personajes ORDER BY respeto DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopRespetados'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;'><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> RESPETO </th>";
    echo "</tr>";
    
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

            if($result[$i]['id'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            echo "<td>" . $result[$i]['nombre'] . "</td>";

            echo "<td style='text-align:right;'>" . $result[$i]['respeto'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion1Ranking
    
    echo "<div id=seccion2Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos popularidad
    $sql = "SELECT * FROM personajes ORDER BY popularidad DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopPopulares'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;'><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> POPULARIDAD </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

            if($result[$i]['id'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            echo "<td>" . $result[$i]['nombre'] . "</td>";

            echo "<td>" . $result[$i]['popularidad'] . "%</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion2
    
    echo "<div id=seccion3Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos monstruos derrotados
    $sql = "SELECT idP, COUNT(*) FROM progresos WHERE completada = '1' GROUP BY idP";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopCazarrecompensas'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black'><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> MISIONES COMPLETADAS </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

            if($result[$i]['idP'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            $nombre = getNombre($result[$i]['idP']);
            echo "<td>" . $nombre . "</td>";

            echo "<td>" . $result[$i]['COUNT(*)'] . " / 20</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion3
    
    echo "<div id=seccion4Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos monstruos derrotados
    $sql = "SELECT idP, COUNT(*) FROM victorias GROUP BY idP";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopSafari'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;'><br><caption></caption>";
    
   echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> ESPECIES DERROTADAS </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

             if($result[$i]['idP'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            $nombre = getNombre($result[$i]['idP']);
            echo "<td>" . $nombre . "</td>";

            echo "<td>" . $result[$i]['COUNT(*)'] . " / 190</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion4
    
    echo "<div id=seccion5Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos monstruos derrotados
    $sql = "SELECT idP, COUNT(*) FROM coleccionismo GROUP BY idP";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopColeccionistas'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; '><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> RELIQUIAS </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

             if($result[$i]['idP'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            $nombre = getNombre($result[$i]['idP']);
            echo "<td>" . $nombre . "</td>";

            echo "<td>" . $result[$i]['COUNT(*)'] . " / 25</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion5
    
     echo "<div id=seccion6Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos insignias activadas
    $sql = "SELECT idP, COUNT(*) FROM insignias GROUP BY idP";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopClientes'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black;'><br><caption></caption>";
    
    echo "<tr style='background:darkturquoise'>";
        echo "<th style='text-align:center;min-width:70px' class='coolWhiteGrande texto-borde'> POS. </th>";
        echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> NOMBRE </th>";
	echo "<th style='text-align:center;min-width:100px' class='coolWhiteGrande texto-borde'> INSIGNIAS </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        if(isset($result[$i])){
            echo "<tr>";
                echo "<td colspan='100%' bgcolor='black' height='2'></td>";
            echo "</tr>";  

            if($result[$i]['idP'] === $id ){ //Si soy yo
                echo "<tr style='color:orange; font-weight:bold'>";
            }
            else{    
                echo "<tr>";    
            }
            $pos = $i + 1;
            echo "<td><b>" . $pos . "</b></td>";

            $nombre = getNombre($result[$i]['idP']);
            echo "<td>" . $nombre . "</td>";

            echo "<td>" . $result[$i]['COUNT(*)'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion6
    echo "</div>"; //FIN contenedor1
    
    echo "<div class='contenedor2'>";
        echo "<div class='podioFondo'>";
        echo "</div>"; //FIN .podioFondo
    echo "</div>"; //FIN contenedor2
    

?>
<script>
    $(".seccion0").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion0Ranking").show(); 
        $(".seccion0").css("opacity", "1");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    $(".seccion1").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion1Ranking").show(); 
        $(".seccion1").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    
    $(".seccion2").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion1Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion2Ranking").show(); 
        $(".seccion2").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    
    $(".seccion3").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion3Ranking").show();
        $(".seccion3").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    $(".seccion4").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion4Ranking").show(); 
        $(".seccion4").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    $(".seccion5").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion5Ranking").show(); 
        $(".seccion5").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion6").css("opacity", "0.6");
    });
    $(".seccion6").click(function(){
        $("#seccion0Ranking").hide();
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").show(); 
        $(".seccion6").css("opacity", "1");
        $(".seccion0").css("opacity", "0.6");
        $(".seccion1").css("opacity", "0.6");
        $(".seccion2").css("opacity", "0.6");
        $(".seccion3").css("opacity", "0.6");
        $(".seccion4").css("opacity", "0.6");
        $(".seccion5").css("opacity", "0.6");
    });
</script>
<?php
}
