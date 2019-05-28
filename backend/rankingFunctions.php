<?php
function dibujarRanking(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<button id='seccion1'>Top Respetados</button>";
        echo "<button id='seccion2'>Top Populares</button>";
        echo "<button id='seccion3'>Top Safari</button>";
        echo "<button id='seccion4'>Top Coleccionistas</button>";
        echo "<button id='seccion5'>Top Clientes</button>";
    echo "</div>"; 
    
    echo "<div id=seccion1Ranking>";
    //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
    $sql = "SELECT * FROM personajes ORDER BY respeto DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<div class='tablaTopRespetados'>";
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><br><caption>10 Más Respetados</caption>";
    
    echo "<tr>";
        echo "<th style='text-align:center; border-radius: 15px'> POS. </th>";
        echo "<th style='text-align:center; border-radius: 15px'> NOMBRE </th>";
	echo "<th style='text-align:center; border-radius: 15px'> RESPETO </th>";
    echo "</tr>";
    
    for($i=0; $i<10; $i=$i+1){
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";  
        
        if($result[$i]['id'] === $id ){ //Si soy yo
            echo "<tr style='background:pink;'>";
        }
        else{
            if($i===0){
                echo "<tr style='background:gold;'>";
            }
            elseif($i===1){
                echo "<tr style='background:silver;'>";
            }
            elseif($i===2){
                echo "<tr style='background:orange;'>";
            }
            else{
                echo "<tr>";
            }
        }
        $pos = $i + 1;
        echo "<td>" . $pos . "º</td>";
        
        echo "<td>" . $result[$i]['nombre'] . "</td>";
        
	echo "<td>" . $result[$i]['respeto'] . "</td>";
	echo "</tr>";
       
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
    
    echo "<table style='text-align:center; border-top: 2px solid black; border-bottom: 2px solid black; border-left: 2px solid black; border-right: 2px solid black; border-radius: 15px'><br><caption>10 Más Populares</caption>";
    
    echo "<tr>";
        echo "<th style='text-align:center; border-radius: 15px'> POS. </th>";
        echo "<th style='text-align:center; border-radius: 15px'> NOMBRE </th>";
	echo "<th style='text-align:center; border-radius: 15px'> POPULARIDAD </th>";
    echo "</tr>";
    for($i=0; $i<10; $i=$i+1){
        echo "<tr>";
            echo "<td colspan='100%' bgcolor='black' height='2'></td>";
        echo "</tr>";  
        
        if($result[$i]['id'] === $id ){ //Si soy yo
            echo "<tr style='background:pink;'>";
        }
        else{
            if($i===0){
                echo "<tr style='background:gold;'>";
            }
            elseif($i===1){
                echo "<tr style='background:silver;'>";
            }
            elseif($i===2){
                echo "<tr style='background:orange;'>";
            }
            else{
                echo "<tr>";
            }
        }
        $pos = $i + 1;
        echo "<td>" . $pos . "º</td>";
        
        echo "<td>" . $result[$i]['nombre'] . "</td>";
        
	echo "<td>" . $result[$i]['popularidad'] . "%</td>";
	echo "</tr>";
       
    }
    echo "</table>";
    echo "</div>";
    echo "</div>"; //Fin seccion2
    

?>
<script>
    $("#seccion1").click(function(){
        $("#seccion2Ranking").hide();
        $("#seccion1Ranking").show(); 
    });
    
    $("#seccion2").click(function(){
        $("#seccion1Ranking").hide();
        $("#seccion2Ranking").show(); 
    });
</script>
<?php
}
