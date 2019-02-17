<?php

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
//Comprobar que el personaje está efectivamente en esa zona
function comprobarZona1Barrio1(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
     $sql = "SELECT personajes.zona, personajes.barrio FROM personajes WHERE id='$id'";
     $stmt = $db->query($sql);
     $result = $stmt->fetchAll();
     
     if(($result[0]['zona'] == '1')&&($result[0]['barrio'] == '1')){
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
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
         echo 'OK';
     }
     else{
         var_dump($result[0]['barrio']);
         echo 'Estoy muy lejos de ese lugar';
         header("location: ?page=zona&message=Estoy muy lejos de ese sitio");
     }  
}

?>
