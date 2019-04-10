<?php
//SPOTS
function getApuestasCocodrilos(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='2'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getCaras(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='30'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getAviones(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='50'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getLuckia(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='140'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getJoker(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='90'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getPajareria(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='8'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";
}

function getCerrajeria(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='7'";
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