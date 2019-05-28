<?php
//FOTOS SPOTS
function getFotoSpot($idS){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='$idS'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

//FOTOS INSIGNIAS

function getFotoInsignia($idI){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='$idI'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/insignias/" . $result[0]['imagen'] . "'>";
}


//FOTOS OBJETOS
function getFotoObjeto($idO){
    global $db;
    
    $sql = "SELECT * FROM objetos WHERE id='$idO'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/objetos/" . $result[0]['imagenObjeto'] . "'>";
}
