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
    
    $sql = "SELECT * FROM spots WHERE idS='20'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getAviones(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='41'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getLuckia(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='100'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";

}

function getJoker(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='80'";
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

function getPescaBass(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='21'";
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

function getSantaEulalia(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='112'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";
}

function getElPaisano(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='120'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/spots/" . $result[0]['imagenSpot'] . "'>";
}

function getMuro(){
    global $db;
    
    $sql = "SELECT * FROM spots WHERE idS='160'";
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
function getFotoInsignia8(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='8'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/insignias/" . $result[0]['imagen'] . "'>";
}

function getFotoInsignia21(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='21'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/insignias/" . $result[0]['imagen'] . "'>";
}

function getFotoInsignia112(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='112'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/insignias/" . $result[0]['imagen'] . "'>";
}

function getFotoInsignia120(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='120'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return "<img src='/design/img/insignias/" . $result[0]['imagen'] . "'>";
}