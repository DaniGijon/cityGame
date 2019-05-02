<?php

function calcularCosteViaje($voyABarrio, $voyAZona, $estoyEnBarrio, $estoyEnZona){
    global $db;
    
    //COMPROBAR COSTES DE CADA VIAJE
    if($estoyEnBarrio === '1' && $estoyEnZona === '1'){ //si estoy en Asdrubal
        if($voyABarrio === '1' && $voyAZona === '2'){ //de Asdrubal a Terri
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Asdrubal a Gran Capitan
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Asdrubal a San Jose
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Asdrubal a Pozo Norte
            $costeViaje = 50;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Asdrubal a Abulagar
            $costeViaje = 70;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Asdrubal a El Poblado
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Asdrubal a Salesianos
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Asdrubal a Tauro
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Asdrubal a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Asdrubal a Viacrucis
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Asdrubal a San Gregorio
            $costeViaje = 70;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Asdrubal a El Bosque
            $costeViaje = 90;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Asdrubal a El Pino
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Asdrubal a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Asdrubal a Las 600
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Asdrubal a PAU
            $costeViaje = 130;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Asdrubal a Recinto Ferial
            $costeViaje = 130;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Asdrubal a Ciudad Jardin
            $costeViaje = 130;
        }      
    }
    elseif($estoyEnBarrio === '1' && $estoyEnZona === '2'){ //si estoy en Terri
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Terri a Asdrubal
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Terri a Gran Capitan
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Terri a San Jose
            $costeViaje = 90;
        }
         elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Terri a Pozo Norte
            $costeViaje = 70;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Terri a Abulagar
            $costeViaje = 90;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Terri a El Poblado
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Terri a Salesianos
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Terri a Tauro
            $costeViaje = 90;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Terri a La Copa
            $costeViaje = 110;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Terri a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Terri a San Gregorio
            $costeViaje = 90;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Terri a El Bosque
            $costeViaje = 110;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Terri a El Pino
            $costeViaje = 50;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Terri a El Carmen
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Terri a Las 600
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Terri a PAU
            $costeViaje = 130;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Terri a Recinto Ferial
            $costeViaje = 130;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Terri a Ciudad Jardin
            $costeViaje = 130;
        }      
    }
    elseif($estoyEnBarrio === '2' && $estoyEnZona === '1'){ //si estoy en Gran Capitan
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Gran Capitan a Asdrubal
            $costeViaje = 50;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Gran Capitan a Terri
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Gran Capitan a San Jose
            $costeViaje = 50;
        }
         elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Gran Capitan a Pozo Norte
            $costeViaje = 50;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Gran Capitan a Abulagar
            $costeViaje = 70;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Gran Capitan a El Poblado
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Gran Capitan a Salesianos
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Gran Capitan a Tauro
            $costeViaje = 50;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Gran Capitan a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Gran Capitan a Viacrucis
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Gran Capitan a San Gregorio
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Gran Capitan a El Bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Gran Capitan a El Pino
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Gran Capitan a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Gran Capitan a Las 600
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Gran Capitan a PAU
            $costeViaje = 130;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Gran Capitan a Recinto Ferial
            $costeViaje = 130;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Gran Capitan a Ciudad Jardin
            $costeViaje = 130;
        }      
    }
    elseif($estoyEnBarrio === '2' && $estoyEnZona === '2'){ //si estoy en San Jose
        if($voyABarrio === '1' && $voyAZona === '1'){ //de San Jose a Asdrubal
            $costeViaje = 70;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de San Jose a Terri
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de San Jose a Gran Capitan
            $costeViaje = 50;
        }
         elseif($voyABarrio === '2' && $voyAZona === '3'){ //de San Jose a Pozo Norte
            $costeViaje = 50;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de San Jose a Abulagar
            $costeViaje = 50;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de San Jose a El Poblado
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de San Jose a Salesianos
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de San Jose a Tauro
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de San Jose a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de San Jose a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de San Jose a San Gregorio
            $costeViaje = 90;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de San Jose a El Bosque
            $costeViaje = 110;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de San Jose a El Pino
            $costeViaje = 90;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de San Jose a El Carmen
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de San Jose a Las 600
            $costeViaje = 130;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de San Jose a PAU
            $costeViaje = 150;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de San Jose a Recinto Ferial
            $costeViaje = 150;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de San Jose a Ciudad Jardin
            $costeViaje = 150;
        }      
    }
    elseif($estoyEnBarrio === '2' && $estoyEnZona === '3'){ //si estoy en Pozo Norte
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Pozo Norte a Asdrubal
            $costeViaje = 50;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Pozo Norte a Terri
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Pozo Norte a Gran Capitan
            $costeViaje = 50;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Pozo Norte a San Jose
            $costeViaje = 50;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Pozo Norte a Abulagar
            $costeViaje = 50;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Pozo Norte a El Poblado
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Pozo Norte a Salesianos
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Pozo Norte a Tauro
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Pozo Norte a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Pozo Norte a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Pozo Norte a San Gregorio
            $costeViaje = 90;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Pozo Norte a El Bosque
            $costeViaje = 110;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Pozo Norte a El Pino
            $costeViaje = 90;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Pozo Norte a El Carmen
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Pozo Norte a Las 600
            $costeViaje = 130;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Pozo Norte a PAU
            $costeViaje = 150;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Pozo Norte a Recinto Ferial
            $costeViaje = 150;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Pozo Norte a Ciudad Jardin
            $costeViaje = 150;
        }      
    }
    elseif($estoyEnBarrio === '3' && $estoyEnZona === '1'){ //si estoy en Abulagar
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Abulagar a Asdrubal
            $costeViaje = 70;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Abulagar a Terri
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Abulagar a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Abulagar a San Jose
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Abulagar a Pozo Norte
            $costeViaje = 50;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Abulagar a El Poblado
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Abulagar a Salesianos
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Abulagar a Tauro
            $costeViaje = 90;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Abulagar a La Copa
            $costeViaje = 110;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Abulagar a Viacrucis
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Abulagar a San Gregorio
            $costeViaje = 110;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Abulagar a El Bosque
            $costeViaje = 130;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Abulagar a El Pino
            $costeViaje = 110;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Abulagar a El Carmen
            $costeViaje = 130;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Abulagar a Las 600
            $costeViaje = 150;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Abulagar a PAU
            $costeViaje = 170;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Abulagar a Recinto Ferial
            $costeViaje = 170;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Abulagar a Ciudad Jardin
            $costeViaje = 170;
        }      
    }
    elseif($estoyEnBarrio === '4' && $estoyEnZona === '1'){ //si estoy en El Poblado
        if($voyABarrio === '1' && $voyAZona === '1'){ //de El Poblado a Asdrubal
            $costeViaje = 90;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de El Poblado a Terri
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de El Poblado a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de El Poblado a San Jose
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de El Poblado a Pozo Norte
            $costeViaje = 70;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de El Poblado a Abulagar
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de El Poblado a Salesianos
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de El Poblado a Tauro
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de El Poblado a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de El Poblado a Viacrucis
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de El Poblado a San Gregorio
            $costeViaje = 90;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de El Poblado a El Bosque
            $costeViaje = 90;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de El Poblado a El Pino
            $costeViaje = 110;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de El Poblado a El Carmen
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de El Poblado a Las 600
            $costeViaje = 130;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de El Poblado a PAU
            $costeViaje = 150;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de El Poblado a Recinto Ferial
            $costeViaje = 150;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de El Poblado a Ciudad Jardin
            $costeViaje = 150;
        }      
    }
    elseif($estoyEnBarrio === '5' && $estoyEnZona === '1'){ //si estoy en Salesianos
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Salesianos a Asdrubal
            $costeViaje = 90;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Salesianos a Terri
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Salesianos a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Salesianos a San Jose
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Salesianos a Pozo Norte
            $costeViaje = 90;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Salesianos a Abulagar
            $costeViaje = 70;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Salesianos a El Poblado
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Salesianos a Tauro
            $costeViaje = 50;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Salesianos a La Copa
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Salesianos a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Salesianos a San Gregorio
            $costeViaje = 70;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Salesianos a El Bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Salesianos a El Pino
            $costeViaje = 90;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Salesianos a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Salesianos a Las 600
            $costeViaje = 110;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Salesianos a PAU
            $costeViaje = 130;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Salesianos a Recinto Ferial
            $costeViaje = 130;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Salesianos a Ciudad Jardin
            $costeViaje = 130;
        }      
    }
    elseif($estoyEnBarrio === '5' && $estoyEnZona === '2'){ //si estoy en Tauro
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Tauro a Asdrubal
            $costeViaje = 70;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Tauro a Terri
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Tauro a Gran Capitan
            $costeViaje = 50;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Tauro a San Jose
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Tauro a Pozo Norte
            $costeViaje = 70;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Tauro a Abulagar
            $costeViaje = 90;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Tauro a El Poblado
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Tauros a Salesianos
            $costeViaje = 50;
        }
         elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Tauro a La Copa
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Tauro a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Tauro a San Gregorio
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Tauro a El Bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Tauro a El Pino
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Tauro a El Carmen
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Tauro a Las 600
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Tauro a PAU
            $costeViaje = 110;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Tauro a Recinto Ferial
            $costeViaje = 110;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Tauro a Ciudad Jardin
            $costeViaje = 110;
        }      
    }
    elseif($estoyEnBarrio === '5' && $estoyEnZona === '3'){ //si estoy en La Copa
        if($voyABarrio === '1' && $voyAZona === '1'){ //de La Copa a Asdrubal
            $costeViaje = 90;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de La Copa a Terri
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de La Copa a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de La Copa a San Jose
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de La Copa a Pozo Norte
            $costeViaje = 90;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de La Copa a Abulagar
            $costeViaje = 110;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de La Copa a El Poblado
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de La Copa a Salesianos
            $costeViaje = 50;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de La Copa a Tauro
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de La Copa a Viacrucis
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de La Copa a San Gregorio
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de La Copa a El Bosque
            $costeViaje = 50;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de La Copa a El Pino
            $costeViaje = 90;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de La Copa a El Carmen
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de La Copa a Las 600
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de La Copa a PAU
            $costeViaje = 90;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de La Copa a Recinto Ferial
            $costeViaje = 90;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de La Copa a Ciudad Jardin
            $costeViaje = 90;
        }      
    }
    elseif($estoyEnBarrio === '6' && $estoyEnZona === '1'){ //si estoy en Viacrucis
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Viacrucis a Asdrubal
            $costeViaje = 50;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Viacrucis a Terri
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Viacrucis a Gran Capitan
            $costeViaje = 50;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Viacrucis a San Jose
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Viacrucis a Pozo Norte
            $costeViaje = 70;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Viacrucis a Abulagar
            $costeViaje = 90;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Viacrucis a El Poblado
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Viacrucis a Salesianos
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Viacrucis a Tauro
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Viacrucis a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Viacrucis a San Gregorio
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Viacrucis a El Bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Viacrucis a El Pino
            $costeViaje = 50;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Viacrucis a El Carmen
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Viacrucis a Las 600
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Viacrucis a PAU
            $costeViaje = 110;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Viacrucis a Recinto Ferial
            $costeViaje = 110;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Viacrucis a Ciudad Jardin
            $costeViaje = 110;
        }      
    }
    elseif($estoyEnBarrio === '6' && $estoyEnZona === '2'){ //si estoy en Paseo San Gregorio
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Paseo San Gregorio a Asdrubal
            $costeViaje = 70;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Paseo San Gregorio a Terri
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Paseo San Gregorio a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Paseo San Gregorio a San Jose
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Paseo San Gregorio a Pozo Norte
            $costeViaje = 90;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Paseo San Gregorio a Abulagar
            $costeViaje = 110;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Paseo San Gregorio a El Poblado
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Paseo San Gregorio a Salesianos
            $costeViaje = 70;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Paseo San Gregorio a Tauro
            $costeViaje = 50;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Paseo San Gregorio a La Copa
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Paseo San Gregorio a Viacrucis
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Paseo San Gregorio a El Bosque
            $costeViaje = 50;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Paseo San Gregorio a El Pino
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Paseo San Gregorio a El Carmen
            $costeViaje = 50;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Paseo San Gregorio a Las 600
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Paseo San Gregorio a PAU
            $costeViaje = 90;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Paseo San Gregorio a Recinto Ferial
            $costeViaje = 90;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Paseo San Gregorio a Ciudad Jardin
            $costeViaje = 90;
        }      
    }
    elseif($estoyEnBarrio === '6' && $estoyEnZona === '3'){ //si estoy en Paseo El Bosque
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Paseo El Bosque a Asdrubal
            $costeViaje = 90;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Paseo El Bosque a Terri
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Paseo El Bosque a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Paseo El Bosque a San Jose
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Paseo El Bosque a Pozo Norte
            $costeViaje = 90;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Paseo El Bosque a Abulagar
            $costeViaje = 110;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Paseo El Bosque a El Poblado
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Paseo El Bosque a Salesianos
            $costeViaje = 90;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Paseo El Bosque a Tauro
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Paseo El Bosque a La Copa
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Paseo El Bosque a Viacrucis
            $costeViaje = 70;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Paseo El Bosque a Paseo San Gregorio
            $costeViaje = 50;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Paseo El Bosque a El Pino
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Paseo El Bosque a El Carmen
            $costeViaje = 50;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Paseo El Bosque a Las 600
            $costeViaje = 50;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Paseo El Bosque a PAU
            $costeViaje = 70;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Paseo El Bosque a Recinto Ferial
            $costeViaje = 70;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Paseo El Bosque a Ciudad Jardin
            $costeViaje = 70;
        }      
    }
    elseif($estoyEnBarrio === '7' && $estoyEnZona === '1'){ //si estoy en El Pino
        if($voyABarrio === '1' && $voyAZona === '1'){ //de El Pino a Asdrubal
            $costeViaje = 70;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de El Pino a Terri
            $costeViaje = 50;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de El Pino a Gran Capitan
            $costeViaje = 70;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de El Pino a San Jose
            $costeViaje = 90;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de El Pino a Pozo Norte
            $costeViaje = 90;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de El Pino a Abulagar
            $costeViaje = 110;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de El Pino a El Poblado
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de El Pino a Salesianos
            $costeViaje = 90;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de El Pino a Tauro
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de El Pino a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de El Pino a Viacrucis
            $costeViaje = 50;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de El Pino a Paseo San Gregorio
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de El Pino a Paseo el bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de El Pino a El Carmen
            $costeViaje = 50;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de El Pino a Las 600
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de El Pino a PAU
            $costeViaje = 110;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de El Pino a Recinto Ferial
            $costeViaje = 110;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de El Pino a Ciudad Jardin
            $costeViaje = 110;
        }      
    }
    elseif($estoyEnBarrio === '8' && $estoyEnZona === '1'){ //si estoy en El Carmen
        if($voyABarrio === '1' && $voyAZona === '1'){ //de El Carmen a Asdrubal
            $costeViaje = 90;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de El Carmen a Terri
            $costeViaje = 70;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de El Carmen a Gran Capitan
            $costeViaje = 90;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de El Carmen a San Jose
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de El Carmen a Pozo Norte
            $costeViaje = 110;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de El Carmen a Abulagar
            $costeViaje = 130;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de El Carmen a El Poblado
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de El Carmen a Salesianos
            $costeViaje = 90;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de El Carmen a Tauro
            $costeViaje = 70;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de El Carmen a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de El Carmen a Viacrucis
            $costeViaje = 70;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de El Carmen a Paseo San Gregorio
            $costeViaje = 50;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de El Carmen a Paseo el bosque
            $costeViaje = 50;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de El Carmen a El Pino
            $costeViaje = 50;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de El Carmen a Las 600
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de El Carmen a PAU
            $costeViaje = 90;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de El Carmen a Recinto Ferial
            $costeViaje = 90;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de El Carmen a Ciudad Jardin
            $costeViaje = 90;
        }      
    }
    elseif($estoyEnBarrio === '9' && $estoyEnZona === '1'){ //si estoy en Las 600
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Las 600 a Asdrubal
            $costeViaje = 110;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Las 600 a Terri
            $costeViaje = 110;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Las 600 a Gran Capitan
            $costeViaje = 110;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Las 600 a San Jose
            $costeViaje = 130;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //deLas 600 a Pozo Norte
            $costeViaje = 130;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Las 600 a Abulagar
            $costeViaje = 150;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Las 600 a El Poblado
            $costeViaje = 130;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Las 600 a Salesianos
            $costeViaje = 110;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Las 600 a Tauro
            $costeViaje = 90;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Las 600 a La Copa
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Las 600 a Viacrucis
            $costeViaje = 90;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Las 600 a Paseo San Gregorio
            $costeViaje = 70;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Las 600 a Paseo el bosque
            $costeViaje = 50;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Las 600 a El Pino
            $costeViaje = 90;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Las 600 a El Carmen
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Las 600 a PAU
            $costeViaje = 50;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Las 600 a Recinto Ferial
            $costeViaje = 50;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Las 600 a Ciudad Jardin
            $costeViaje = 50;
        }      
    }
    elseif($estoyEnBarrio === '9' && $estoyEnZona === '2'){ //si estoy en PAU
        if($voyABarrio === '1' && $voyAZona === '1'){ //de PAU a Asdrubal
            $costeViaje = 130;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de PAU a Terri
            $costeViaje = 130;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de PAU a Gran Capitan
            $costeViaje = 130;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de PAU a San Jose
            $costeViaje = 150;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de PAU a Pozo Norte
            $costeViaje = 150;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de PAU a Abulagar
            $costeViaje = 170;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de PAU a El Poblado
            $costeViaje = 150;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de PAU a Salesianos
            $costeViaje = 130;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de PAU a Tauro
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de PAU a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de PAU a Viacrucis
            $costeViaje = 110;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de PAU a Paseo San Gregorio
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de PAU a Paseo el bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de PAU a El Pino
            $costeViaje = 110;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de PAU a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de PAU a Las 600
            $costeViaje = 50;
        }
         elseif($voyABarrio === '9' && $voyAZona === '3'){ //de PAU a Recinto Ferial
            $costeViaje = 50;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de PAU a Ciudad Jardin
            $costeViaje = 70;
        }      
    }
    elseif($estoyEnBarrio === '9' && $estoyEnZona === '3'){ //si estoy en Recinto Ferial
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Recinto Ferial a Asdrubal
            $costeViaje = 130;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Recinto Ferial a Terri
            $costeViaje = 130;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Recinto Ferial a Gran Capitan
            $costeViaje = 130;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Recinto Ferial a San Jose
            $costeViaje = 150;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Recinto Ferial a Pozo Norte
            $costeViaje = 150;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Recinto Ferial a Abulagar
            $costeViaje = 170;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Recinto Ferial a El Poblado
            $costeViaje = 150;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Recinto Ferial a Salesianos
            $costeViaje = 130;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Recinto Ferial a Tauro
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Recinto Ferial a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Recinto Ferial a Viacrucis
            $costeViaje = 110;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Recinto Ferial a Paseo San Gregorio
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Recinto Ferial a Paseo el bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Recinto Ferial a El Pino
            $costeViaje = 110;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Recinto Ferial a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Recinto Ferial a Las 600
            $costeViaje = 50;
        }
         elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Recinto Ferial a PAU
            $costeViaje = 50;
        }
        elseif($voyABarrio === '10' && $voyAZona === '1'){ //de Recinto Ferial a Ciudad Jardin
            $costeViaje = 70;
        }      
    }
    elseif($estoyEnBarrio === '10' && $estoyEnZona === '1'){ //si estoy en Ciudad Jardin
        if($voyABarrio === '1' && $voyAZona === '1'){ //de Ciudad Jardin a Asdrubal
            $costeViaje = 130;
        }
        elseif($voyABarrio === '1' && $voyAZona === '2'){ //de Ciudad Jardin a Terri
            $costeViaje = 130;
        }
        elseif($voyABarrio === '2' && $voyAZona === '1'){ //de Ciudad Jardin a Gran Capitan
            $costeViaje = 130;
        }
         elseif($voyABarrio === '2' && $voyAZona === '2'){ //de Ciudad Jardin a San Jose
            $costeViaje = 150;
        }
        elseif($voyABarrio === '2' && $voyAZona === '3'){ //de Ciudad Jardin a Pozo Norte
            $costeViaje = 150;
        }
        elseif($voyABarrio === '3' && $voyAZona === '1'){ //de Ciudad Jardin a Abulagar
            $costeViaje = 170;
        }
        elseif($voyABarrio === '4' && $voyAZona === '1'){ //de Ciudad Jardin a El Poblado
            $costeViaje = 150;
        }
        elseif($voyABarrio === '5' && $voyAZona === '1'){ //de Ciudad Jardin a Salesianos
            $costeViaje = 130;
        }
         elseif($voyABarrio === '5' && $voyAZona === '2'){ //de Ciudad Jardin a Tauro
            $costeViaje = 110;
        }
        elseif($voyABarrio === '5' && $voyAZona === '3'){ //de Ciudad Jardin a La Copa
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '1'){ //de Ciudad Jardin a Viacrucis
            $costeViaje = 110;
        }
         elseif($voyABarrio === '6' && $voyAZona === '2'){ //de Ciudad Jardin a Paseo San Gregorio
            $costeViaje = 90;
        }
        elseif($voyABarrio === '6' && $voyAZona === '3'){ //de Ciudad Jardin a Paseo el bosque
            $costeViaje = 70;
        }
        elseif($voyABarrio === '7' && $voyAZona === '1'){ //de Ciudad Jardin a El Pino
            $costeViaje = 110;
        }
        elseif($voyABarrio === '8' && $voyAZona === '1'){ //de Ciudad Jardin a El Carmen
            $costeViaje = 90;
        }
        elseif($voyABarrio === '9' && $voyAZona === '1'){ //de Ciudad Jardin a Las 600
            $costeViaje = 50;
        }
         elseif($voyABarrio === '9' && $voyAZona === '2'){ //de Ciudad Jardin a PAU
            $costeViaje = 70;
        }
        elseif($voyABarrio === '9' && $voyAZona === '3'){ //de Ciudad Jardin a Recinto Ferial
            $costeViaje = 70;
        }      
    }
    return $costeViaje;
}