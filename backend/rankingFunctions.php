<?php
function dibujarRanking(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<button class='seccion1'>Top Respetados</button>";
        echo "<button class='seccion2'>Top Populares</button>";
        echo "<button class='seccion3'>Top Cazarrecompensas</button>";
        echo "<button class='seccion4'>Top Safari</button>";
        echo "<button class='seccion5'>Top Coleccionistas</button>";
        echo "<button class='seccion6'>Top Clientes</button>";
    echo "</div>"; 
    
    echo "<div class='contenedor1'>";
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
    echo "</div>";
    

?>
<script>
    $(".seccion1").click(function(){
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion1Ranking").show(); 
        $(".seccion1").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
        $(".seccion4").css("background-color", "white");
        $(".seccion5").css("background-color", "white");
        $(".seccion6").css("background-color", "white");
    });
    
    $(".seccion2").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion2Ranking").show(); 
        $(".seccion2").css("background-color", "yellow");
        $(".seccion1").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
        $(".seccion4").css("background-color", "white");
        $(".seccion5").css("background-color", "white");
        $(".seccion6").css("background-color", "white");
    });
    
    $(".seccion3").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion3Ranking").show();
        $(".seccion3").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion1").css("background-color", "white");
        $(".seccion4").css("background-color", "white");
        $(".seccion5").css("background-color", "white");
        $(".seccion6").css("background-color", "white");
    });
    $(".seccion4").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion4Ranking").show(); 
        $(".seccion4").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
        $(".seccion1").css("background-color", "white");
        $(".seccion5").css("background-color", "white");
        $(".seccion6").css("background-color", "white");
    });
    $(".seccion5").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion6Ranking").hide();
        $("#seccion5Ranking").show(); 
        $(".seccion5").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
        $(".seccion4").css("background-color", "white");
        $(".seccion1").css("background-color", "white");
        $(".seccion6").css("background-color", "white");
    });
    $(".seccion6").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").hide();
        $("#seccion3Ranking").hide();
        $("#seccion4Ranking").hide();
        $("#seccion5Ranking").hide();
        $("#seccion6Ranking").show(); 
        $(".seccion6").css("background-color", "yellow");
        $(".seccion2").css("background-color", "white");
        $(".seccion3").css("background-color", "white");
        $(".seccion4").css("background-color", "white");
        $(".seccion5").css("background-color", "white");
        $(".seccion1").css("background-color", "white");
    });
</script>
<?php
}

