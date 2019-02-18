<?php

function buscarMonstruos($probabilidadEncontrar){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT * FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $atributosBase = $stmt->fetchAll();
   
   //Consultar que objetos tiene el personaje en cada slot (se ordenan por slot)
   $sql = "SELECT objetos.*, inventario.slot FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $bonusPercepcion = 0; 
   
   foreach ($result as $objetosPersonaje) {
                        
                        $bonusPercepcion = $bonusPercepcion + $objetosPersonaje['percepcion']; 
                        
                    }
   
   if($probabilidadEncontrar <= $atributosBase[0]['percepcion'] + $bonusPercepcion) {
       $encuentroMonstruos = 1;
   }
   else{
       $encuentroMonstruos = 0;
   }
   return $encuentroMonstruos;
}

function cualMonstruo($zona,$barrio){
   global $db;
   $id = $_SESSION['loggedIn']; 
   
   $sql = "SELECT * FROM personajes WHERE id='$id'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   if($result[0]['nivel']>2){
        $rangoNiveles = rand($result[0]['nivel']-2, $result[0]['nivel']+2);
   }
   else{
       $rangoNiveles = rand(1,$result[0]['nivel']+2);
   }
   $sql = "SELECT * FROM monstruos WHERE nivel='$rangoNiveles' AND zona='$zona' AND barrio='$barrio'";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   return $result;
   
   
    
}


?>