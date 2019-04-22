<?php

function objetosDesequipados(){
    global $db;
    $id = $_SESSION['loggedIn']; 
   
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7";
    $stmt = $db->query($sql);
    $objetosDB = $stmt->fetchAll();
    return $objetosDB;
}

function objetosDesequipadosCofres(){
    global $db;
    $id = $_SESSION['loggedIn']; 
   
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND (inventario.idO >= 900 && inventario.idO <1000)";
    $stmt = $db->query($sql);
    $objetosDB = $stmt->fetchAll();
    return $objetosDB;
}

function comprobarSlotLibre(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    //Slots que tiene SIN EQUIPAR el personaje (Inventario)
    $sql = "SELECT inventario.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $slotLibre = -1;
    
    foreach ($result as $res){
        if($res['idO'] === '0'){
            $slotLibre = $res['slot'];
        }
    }
   return $slotLibre;
   
}

function comprobarDinero(){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT cash,enBanco FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   return $result;
}

function comprobarCoste($coste){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT cash FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if($coste <= $result[0]['cash']){
       $puedoPagar = 1;
   }
   else{
       $puedoPagar = 0;
   }
   return $puedoPagar;
}

function comprobarSalud($salud){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT salud FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if($salud <= $result[0]['salud']){
       $tengoVida = 1;
   }
   else{
       $tengoVida = 0;
   }
   return $tengoVida;
}

function comprobarEspera(){
  global $db;
   $id = $_SESSION['loggedIn']; 
   
   date_default_timezone_set('Europe/Madrid');
   
   $sql = "SELECT accion FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $actual = date("Y-m-d H:i:s");
   $accion = $result[0]['accion'];
   
   if($accion < $actual){
       $estoyLibre = 1;
   }
   else{
       $estoyLibre = 0;
   }
   return $estoyLibre;  
}

function comprobarEmboscar(){
  global $db;
   $id = $_SESSION['loggedIn']; 
   
   date_default_timezone_set('Europe/Madrid');
   
   $sql = "SELECT emboscada FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $actual = date("Y-m-d H:i:s");
   $emboscada = $result[0]['emboscada'];
   
   if($emboscada < $actual){
       $puedoEmboscar = 1;
   }
   else{
       $puedoEmboscar = 0;
   }
   return $puedoEmboscar;  
}

function comprobarEnergia($agotamiento){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT energia FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if($agotamiento <= $result[0]['energia']){
       $puedoHacerlo = 1;
   }
   else{
       $puedoHacerlo = 0;
   }
   return $puedoHacerlo;
}

function comprobarEsNuevoPersonaje(){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT * FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if($result[0]['destreza'] === '1' && $result[0]['fuerza'] === '1' && $result[0]['agilidad'] === '1' && $result[0]['resistencia'] === '1'
           && $result[0]['espiritu'] === '1' && $result[0]['estilo'] === '1' && $result[0]['ingenio'] === '1' && $result[0]['percepcion'] === '1'){
       $esValido = 1;
   }
   else{
       $esValido = 0;
   }
   return $esValido;
}

function comprobarZonaBarrioPersonajes($id,$miId){
    global $db;
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $resultRival = $stmt->fetchAll();   
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$miId'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == $resultRival[0]['zona'])&&($result[0]['barrio'] == $resultRival[0]['barrio'])){
         $estamosJuntos = 1;
     }
     else{
         
         $estamosJuntos = 0;
     }  
     return $estamosJuntos;
}
//Comprobar que el personaje está efectivamente en esa zona
function comprobarZona1Barrio1(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '1')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona2Barrio1(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '2')&&($result[0]['barrio'] == '1')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio2(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '2')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona2Barrio2(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '2')&&($result[0]['barrio'] == '2')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona3Barrio2(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '3')&&($result[0]['barrio'] == '2')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio3(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '3')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio4(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '4')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio5(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '5')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona2Barrio5(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '2')&&($result[0]['barrio'] == '5')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona3Barrio5(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '3')&&($result[0]['barrio'] == '5')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio6(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '6')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona2Barrio6(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '2')&&($result[0]['barrio'] == '6')){
       
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona3Barrio6(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '3')&&($result[0]['barrio'] == '6')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio7(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '7')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio8(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '8')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio9(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '9')){
        
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona2Barrio9(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '2')&&($result[0]['barrio'] == '9')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona3Barrio9(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '3')&&($result[0]['barrio'] == '9')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

function comprobarZona1Barrio10(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '10')){
         
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

//COMPROBAR INSIGNIAS
function comprobarInsignia8(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='8'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if($result){
        return $result[0]['fecha'];
     }
     else{
         return 0;
     }
}

function comprobarInsignia21(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='21'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if($result){
        return $result[0]['fecha'];
     }
     else{
         return 0;
     }
}

//ACTIVAR CODIGOS INSIGNIAS
function activarCodigo($codigoInsignia){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    echo "EPPPP";
    
    $sql = "SELECT * FROM codigos WHERE clave='$codigoInsignia'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    var_dump($result);
    
    $activada = $result[0]['insignia'];
    
    $sql = "INSERT INTO insignias (idP, idI, imagen, fecha) VALUES ('$id','$codigoInsignia','$codigoInsignia.png', '5/5/2000')";
    header("location: ?page=accion&message=Activado!");
    
}


if(isset($_POST['codigoInsignia'])){
    activarCodigo($_POST['oodigoInsignia']);
}
?>
