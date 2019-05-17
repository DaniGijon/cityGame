<?php
//SPOTS
function getFotoSpot($idS){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='$idS'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

//OBJETOS: MASCOTAS:
function getPez(){
    global $db;
    
    $sql = "SELECT * FROM objetos WHERE id='1'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/objetos/" . $result[0]['imagenObjeto'] . "'>";
}

function getHámster(){
    global $db;
    
    $sql = "SELECT * FROM objetos WHERE id='2'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/objetos/" . $result[0]['imagenObjeto'] . "'>";
}

function getGallo(){
    global $db;
    
    $sql = "SELECT * FROM objetos WHERE id='3'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/objetos/" . $result[0]['imagenObjeto'] . "'>";
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
