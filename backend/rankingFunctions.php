<?php
function dibujarRanking(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
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
    
    //Cojo todos los jugadores y los ordeno de más respeto a menos social
    $sql = "SELECT * FROM personajes ORDER BY social DESC";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    echo "<table border = '1'><caption>10 MÁS POPULARES</caption>";
    
    echo "<tr>";
        echo "<th> POS. </th>";
        echo "<th> NOMBRE </th>";
	echo "<th> SOCIAL </th>";
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
	echo "<td>" . $result[$i]['social'] . "</td>";
	echo "</tr>";
       
    }
    echo "</table>";
}