<?php
function dibujarRanking(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Cabecera selector opciones
    echo "<div id='botonesComprarVender'>";
        echo "<button id='seccion1'>Más Respetados</button>";
        echo "<button id='seccion2'>Más Populares</button>";
    echo "</div>"; 
    
    echo "<div id=seccion1Ranking>";
    //Cojo todos los jugadores y los ordeno de más respeto a menos respeto
    $sql = "SELECT * FROM personajes ORDER BY respeto DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<table border = '1'><caption>10 MÁS RESPETADOS</caption>";
    
    echo "<tr>";
        echo "<th> POS. </th>";
        echo "<th> NOMBRE </th>";
	echo "<th> RESPETO </th>";
    echo "</tr>";
    
    for($i=0; $i<10; $i=$i+1){
        echo "<tr>";
        $pos = $i + 1;
        echo "<td>" . $pos . "º</td>";
        if($result[$i]['id'] === $id){
            echo "<td bgcolor='yellow'>" . $result[$i]['nombre'] . "</td>";
        }
        else{
        echo "<td>" . $result[$i]['nombre'] . "</td>";
        }
	echo "<td>" . $result[$i]['respeto'] . "</td>";
	echo "</tr>";
       
    }
    echo "</table>";
    echo "</div>";
    
    echo "<div id=seccion2Ranking>";
    //Cojo todos los jugadores y los ordeno de más a menos popularidad
    $sql = "SELECT * FROM personajes ORDER BY popularidad DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<table border = '1'><caption>10 MÁS POPULARES</caption>";
    
    echo "<tr>";
        echo "<th> POS. </th>";
        echo "<th> NOMBRE </th>";
	echo "<th> POPULARIDAD </th>";
    echo "</tr>";
    
    for($i=0; $i<10; $i=$i+1){
        echo "<tr>";
        $pos = $i + 1;
        echo "<td>" . $pos . "º</td>";
        if($result[$i]['id'] === $id){
            echo "<td bgcolor='yellow'>" . $result[$i]['nombre'] . "</td>";
        }
        else{
        echo "<td>" . $result[$i]['nombre'] . "</td>";
        }
	echo "<td>" . $result[$i]['popularidad'] . "</td>";
	echo "</tr>";
       
    }
    echo "</table>";
    echo "</div>";
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
