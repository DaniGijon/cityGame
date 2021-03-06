<?php

function comprobarMision($idM){
   global $db;
   $id = $_SESSION['loggedIn'];  
   
   $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $mostrar = 1; //Esta activa pero no completada
   
   if(isset($result[0])){
       if($result[0]['completada'] === '1'){
        $mostrar = 0; //Ya está completada
       }
   }
   else{
       $mostrar = 2; //Aún no está activada
   }
   return $mostrar;
}

function comprobarProgreso($idM){
  global $db;
   $id = $_SESSION['loggedIn'];  
   
   $sql = "SELECT * FROM progresos WHERE idP='$id' AND idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if(isset($result[0])){
    $progreso = $result[0]['progreso'];
   }
   else{
       $progreso = 1;
   }
   return $progreso;
}

function getDescripcionMision($idM, $progreso){
   global $db; 
   
   $sql = "SELECT * FROM misiones WHERE idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $etapa = 'e' . $progreso;
   $recompensa = $result[0][$etapa];
   
   return $recompensa;
}

function getRecompensaMision($idM, $progreso){
   global $db; 
   
   $sql = "SELECT * FROM misiones WHERE idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $etapa = 'r' . $progreso;
   $recompensa = $result[0][$etapa];
   
   return $recompensa;
}

function comprobarTiempoRestanteMision($idP, $idM){
    global $db; 
    
   date_default_timezone_set('Europe/Madrid');
   
   $actual = date("Y-m-d H:i:s");
   
   $sql = "SELECT * FROM tiempos WHERE idP='$idP' AND idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $deadline = $result[0]['deadline'];
   $tiempoRestante = strtotime($deadline) - strtotime($actual);
   $legible = date('i\M s\S', $tiempoRestante);
   
   if($deadline <= $actual){
       return 0;
   }
   else{
       return $legible;
   }
    
}

function comprobarIluminacion(){
    global $db;
    $id = $_SESSION['loggedIn']; 
    
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $tengoIluminacion = 0;
    
    foreach ($result as $cadaObjeto){
        if($cadaObjeto['id'] === '105' || $cadaObjeto['id'] === '313' || $cadaObjeto['id'] === '314'){ //SI LLEVO EQUIPADO UN OBJETO LUMINOSO
            $tengoIluminacion = 1;
            break;
        }
    }
    return $tengoIluminacion;
}

function comprobarCana(){
    global $db;
    $id = $_SESSION['loggedIn']; 
    
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $tengoCana = 0;
    
    foreach ($result as $cadaObjeto){
        if($cadaObjeto['id'] === '307'){ //SI LLEVO EQUIPADO UNA CAÑA DE PESCAR
            $tengoCana = 1;
            break;
        }
    }
    return $tengoCana;
}

function comprobarRevolver(){
    global $db;
    $id = $_SESSION['loggedIn']; 
    
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $tengoRevolver = 0;
    
    foreach ($result as $cadaObjeto){
        if($cadaObjeto['id'] === '310'){ //SI LLEVO EQUIPADO UN REVOLVER
            $tengoRevolver = 1;
            break;
        }
    }
    return $tengoRevolver;
}

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
   
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND (inventario.idO >= 900 && inventario.idO <920)";
    $stmt = $db->query($sql);
    $objetosDB = $stmt->fetchAll();
    return $objetosDB;
}

function getObjeto($idO){
    global $db;
    $id = $_SESSION['loggedIn']; 
   
    $sql = "SELECT * FROM objetos WHERE id = '$idO'";
    $stmt = $db->query($sql);
    $objeto = $stmt->fetchAll();
    return $objeto;
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

function comprobarMensaje($idM){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT COUNT(*) FROM mensajes WHERE idM='$idM'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   //if para que no hagan trampas
   if($result[0]['COUNT(*)'] != 1){
       header("location: ?page=mensajes&message=No puedo leer ese mensaje");
   }
   else{
        $sql = "SELECT * FROM mensajes WHERE idM='$idM'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        if($result[0]['idP'] === $id){
            $puedoLeer = 1;
        }
        else{
            $puedoLeer = 0;
        }
        return $puedoLeer;
   }
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

function comprobarRespeto(){
    global $db;
    $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT respeto FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   return $result[0]['respeto'];
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

function puedoViajar(){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   date_default_timezone_set('Europe/Madrid');
   
   $sql = "SELECT viaje FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $actual = date("Y-m-d H:i:s");
   $accion = $result[0]['viaje'];
   
   if($accion < $actual){
       $estoyLibre = 1;
   }
   else{
       $estoyLibre = 0;
   }
   return $estoyLibre;  
}

function TiempoViaje($idP){
   global $db;
   $id = $_SESSION['loggedIn'];
   
   //Mirar que Transporte tiene equipado   
   $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$idP' AND inventario.slot = '5'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $vehiculoEquipado = $result[0]['id'];
   
   if($vehiculoEquipado === '20'){
       $tiempoViaje = 55;
   }
   elseif($vehiculoEquipado === '21'){
       $tiempoViaje = 50;
   }
   elseif($vehiculoEquipado === '22'){
       $tiempoViaje = 35;
   }
   else{
       $tiempoViaje = 59;
   }
   
   //Mirar si lleva algun objeto con la especialidad VELOZ
   $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot <= 7";
   $stmt = $db->query($sql);
   $objetosEquipados = $stmt->fetchAll();
   
   foreach ($objetosEquipados as $cadaObjeto) {
       if($cadaObjeto['especial']==='veloz'){
           $tiempoViaje = $tiempoViaje-10;
       }
   }
   
   return $tiempoViaje;
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

function comprobarMaxPopularidad($idS){
   global $db;
   $id = $_SESSION['loggedIn']; 
         
   $sql = "SELECT puntos FROM popularidad WHERE idP='$id' AND idS='$idS'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $puntos = $result[0]['puntos'];
   
   if($puntos < 100){
       $puedo = 1;
   }
   else{
       $puedo = 0;
   }
   return $puedo;  
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

function getOrigen($id){
  global $db;
   $id = $_SESSION['loggedIn'];  
   
   $sql = "SELECT origen FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   return $result[0]['origen'];
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
//GET Siguiente Spot para las Zonas
function getSiguienteSpot($id){
    global $db;
    
    $sql = "SELECT * FROM siguientespot WHERE idP='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $spotSeleccionado = $result[0]['idS'];
    return $spotSeleccionado;
}
//GET siguiente Zona y siguiente Barrio para la ciudad
function getSiguienteZona($id){
    global $db;
    
    $sql = "SELECT * FROM siguientespot WHERE idP='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $zonaSeleccionada = $result[0]['idZ'];
    return $zonaSeleccionada;
}

function getSiguienteBarrio($id){
    global $db;
    
    $sql = "SELECT * FROM siguientespot WHERE idP='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $barrioSeleccionado = $result[0]['idB'];
    return $barrioSeleccionado;
}

function esDistintoSitio($idP){
        global $db;
        
        $sql = "SELECT idZ,idB FROM siguienteSpot WHERE idP='$idP'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $voyAZona = $result[0]['idZ'];
        $voyABarrio = $result[0]['idB'];
        
        $sql = "SELECT zona,barrio FROM personajes WHERE id='$idP'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
        
        $estoyEnZona = $result[0]['zona'];
        $estoyEnBarrio = $result[0]['barrio'];
        
        if(($voyABarrio === $estoyEnBarrio) && ($voyAZona === $estoyEnZona)){
            return 0;
        }
        return 1;
}

//GET Popularidad de cada spot
function getPopularidadSpot($idS){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT * FROM popularidad WHERE idP='$id' AND idS='$idS'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $popularidadAqui = $result[0]['puntos'];
    return $popularidadAqui;
}

//Get nombre del Spot
function getNombreSpot($idS){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT nombre FROM spots WHERE idS='$idS'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $nombreSpot = $result[0]['nombre'];
    return $nombreSpot;
}

function getMonstruosDerrotados($idP){
    global $db;
    
    $sql = "SELECT cantidad FROM victorias WHERE idP='$idP'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $victorias = 0;
    
    foreach($result as $cadaMonstruo){
        $victorias += $cadaMonstruo['cantidad'];
    }
    
    return $victorias;
}

function getJabaliesDerrotados($idP){
    global $db;
    
    $sql = "SELECT cantidad FROM cacerias WHERE idP='$idP' AND (idM='91' OR idM='94' OR idM='96' OR idM='99')";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $victorias = 0;
    
    foreach($result as $cadaMonstruo){
        $victorias += $cadaMonstruo['cantidad'];
    }
    
    return $victorias;
}

function getTauroDerrotados($idP){
    global $db;
    
    $sql = "SELECT cantidad FROM cacerias WHERE idP='$idP' AND (idM='81' OR idM='82' OR idM='83' OR idM='84' OR idM='85' OR idM='86' OR idM='87' OR idM='88' OR idM='89' OR idM='90' OR idM='208')";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $victorias = 0;
    
    foreach($result as $cadaMonstruo){
        $victorias += $cadaMonstruo['cantidad'];
    }
    
    return $victorias;
}

function get666Derrotados($idP, $etapa){
    global $db;
    
    if($etapa === 1){

        $sql = "SELECT cantidad FROM cacerias WHERE idP='$idP' AND (idM='31' OR idM='32' OR idM='33')";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $victorias = 0;

        foreach($result as $cadaMonstruo){
            $victorias += $cadaMonstruo['cantidad'];
        }
    }
    elseif($etapa === 2){

        $sql = "SELECT cantidad FROM cacerias WHERE idP='$idP' AND (idM='34' OR idM='35' OR idM='36')";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $victorias = 0;

        foreach($result as $cadaMonstruo){
            $victorias += $cadaMonstruo['cantidad'];
        }
    }
    elseif($etapa === 3){

        $sql = "SELECT cantidad FROM cacerias WHERE idP='$idP' AND (idM='37' OR idM='38' OR idM='39')";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();

        $victorias = 0;

        foreach($result as $cadaMonstruo){
            $victorias += $cadaMonstruo['cantidad'];
        }
    }
    return $victorias;
}

function getEspeciesDerrotadas($idP){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM victorias WHERE idP='$idP'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return $result[0]['COUNT(*)'];
}

function getReliquiasEncontradas($idP){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM coleccionismo WHERE idP = '$idP'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $reliquias = $result[0]['COUNT(*)'];
    
    return $reliquias;
}

function getInsigniasConseguidas($idP){
    global $db;
    
    $sql = "SELECT COUNT(*) FROM insignias WHERE idP = '$idP'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $insignias = $result[0]['COUNT(*)'];
    
    return $insignias;
}

//COMPROBAR INSIGNIAS
function comprobarInsignia($idI){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT * FROM insignias WHERE idP='$id' AND idI='$idI'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if($result){
        return $result[0]['fecha'];
     }
     else{
         return 0;
     }
}

//Ver SLOTS DE EMPEÑO QUE TIENE EL JUGADOR
function verSlotsEmpeno(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT * FROM empenos WHERE idP='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if($result){
        return $result;
     }
     else{
         return 0;
     }
}


/*
//ACTIVAR CODIGOS INSIGNIAS
function activarCodigo($codigoInsignia){
    global $db;
    $id = $_SESSION['loggedIn'];
    
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
}*/
?>
