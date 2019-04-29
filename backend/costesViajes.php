<?php

function calcularCosteViaje($voyABarrio, $voyAZona, $estoyEnBarrio, $estoyEnZona){
    global $db;
    
    //COMPROBAR COSTES DE CADA VIAJE
    if($estoyEnBarrio === 1 && $estoyEnZona === 1){ //si estoy en Asdrubal
        if($voyABarrio === 1 && $voyAZona === 2){ //de Asdrubal a Terri
            $costeViaje = 70;
        }
        elseif($voyABarrio === 2 && $voyAZona === 1){ //de Asdrubal a Gran Capitan
            $costeViaje = 70;
        }
        elseif($voyABarrio === 2 && $voyAZona === 1){ //de Asdrubal a Terri
            $costeViaje = 70;
        }
            
    }
    else{
        $costeViaje = 0;
    }
    return $costeViaje;
}