<?php

    function getNombre($miId){
        global $db;
        $sql = "SELECT nombre FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['nombre'];
    }
    
    function getAvatar($miId){
        global $db;
        $sql = "SELECT sexo FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        
        $sexo = $personaje[0]['sexo'];
        if($sexo === 'Hombre'){
            $avatar = 'personajilloHombre';
        }
        elseif($sexo === 'Mujer'){
            $avatar = 'personajilloMujer';
        }
        return $avatar;
    }
    
    function getCash($miId){
        global $db;
        $sql = "SELECT cash FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['cash'];
    }
    
    function getBanco($miId){
        global $db;
        $sql = "SELECT enBanco FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['enBanco'];
    }
    
    function getProxAccion($miId){
        global $db;
        date_default_timezone_set('Europe/Madrid');
            
        $sql = "SELECT accion FROM personajes WHERE id = '$miId'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
                
        $actual = date("Y-m-d H:i:s");
        $accion = $result[0]['accion'];
                
        if($accion < $actual){
            $prox = '¡Ahora!';
        }
        else{
            $diferenciaAccion = strtotime($accion) - strtotime($actual);
            $prox = date('i\M s\S', $diferenciaAccion);
        }
        
        return $prox;
    }
    
    function getProxViaje($miId){
        global $db;
        date_default_timezone_set('Europe/Madrid');
            
        $sql = "SELECT accion,viaje FROM personajes WHERE id = '$miId'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
                
        $actual = date("Y-m-d H:i:s");
        $viaje = $result[0]['viaje'];
        $accion = $result[0]['accion'];
                
        if($viaje < $actual && $accion < $actual){
            $prox = '¡Ahora!';
        }
        else{
            if($viaje > $accion){
                $diferenciaViaje = strtotime($viaje) - strtotime($actual);
                $prox = date('i\M s\S', $diferenciaViaje);
            }
            else{
                $diferenciaAccion = strtotime($accion) - strtotime($actual);
                $prox = date('i\M s\S', $diferenciaAccion);
            }
        }
        
        return $prox;
    }
    
    function getProxEmboscada($miId){
        global $db;
        date_default_timezone_set('Europe/Madrid');
            
        $sql = "SELECT accion,emboscada FROM personajes WHERE id = '$miId'";
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll();
                
        $actual = date("Y-m-d H:i:s");
        $emboscada = $result[0]['emboscada'];
        $accion = $result[0]['accion'];
                
        if($emboscada < $actual && $accion < $actual){
            $prox = '¡Ahora!';
        }
        else{
            if($emboscada > $accion){
                $diferenciaEmboscada = strtotime($emboscada) - strtotime($actual);
                $prox = date('i\M s\S', $diferenciaEmboscada);
            }
            else{
                $diferenciaAccion = strtotime($accion) - strtotime($actual);
                $prox = date('i\M s\S', $diferenciaAccion);
            }
        }
        
        return $prox;
    }
    
    function getNivel($miId){
        global $db;
        $sql = "SELECT nivel FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['nivel'];
    }
    
    function getRespeto($miId){
        global $db;
        $sql = "SELECT respeto FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['respeto'];
    }
    
    function getPopularidad($miId){
        global $db;
        $sql = "SELECT popularidad FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['popularidad'];
    }
    
    function getExperiencia($miId){
        global $db;
        $sql = "SELECT experiencia FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['experiencia'];
    }

    function getBarraExp($miId){
        global $db;
        $sql = "SELECT * FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        
        $miNivelActual = $personaje[0]['nivel'];
        $miExpActual = $personaje[0]['experiencia'];
        
        for ($i=1; $i<=100; $i++){
            if($miNivelActual == $i){
                $inicio = (($i-1)*10) * (($i-1)*10);
                $final = ($i*10)*($i*10);
                break;
            }
            
        }
        $progreso = (($miExpActual - $inicio) * 100) / ($final-$inicio);
        
        return $progreso;
    }
    
    function getBarraSalud($miId){
        global $db;
        $sql = "SELECT salud FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['salud'];
    }
    
    function getBarraEnergia($miId){
        global $db;
        $sql = "SELECT energia FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['energia'];
    }