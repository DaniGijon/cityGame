<?php

function cocodrilos($cantidadApuesta1, $cantidadApuesta2, $cantidadApuesta3, $cantidadApuesta4, $cantidadApuesta5, $cantidadApuesta6, $cantidadApuesta7){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $ganador = rand(1,100);
    $ingresos = 0;
    $gastos = $cantidadApuesta1 + $cantidadApuesta2 + $cantidadApuesta3 + $cantidadApuesta4 + $cantidadApuesta5 + $cantidadApuesta6 + $cantidadApuesta7;
    //Comprobar que tengo suficiente dinero para apostar
    $puedoPagar = comprobarCoste($gastos);
    if($puedoPagar === 1){
        if($ganador <=28){
            $box = '¡El ganador es Crocky Balboa!';
            if($cantidadApuesta1 > 0){
                $ingresos = $cantidadApuesta1 * 3;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        elseif($ganador >=29 && $ganador <=50){
            $box = '¡El ganador es Dientes de leche!';
            if($cantidadApuesta2 > 0){
                $ingresos = $cantidadApuesta2 * 4;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        elseif($ganador >=51 && $ganador <=67){
            $box = '¡El ganador es Cai-Man!';
            if($cantidadApuesta3 > 0){
                $ingresos = $cantidadApuesta3 * 5;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        elseif($ganador >=68 && $ganador <=81){
            $box = '¡El ganador es Totodile!';
            if($cantidadApuesta4 > 0){
                $ingresos = $cantidadApuesta4 * 6;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        elseif($ganador >=82 && $ganador <=91){
            $box = '¡La ganadora es Rumbera!';
            if($cantidadApuesta5 > 0){
                $ingresos = $cantidadApuesta5 * 8;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        elseif($ganador >=92 && $ganador <=98){
             $box = '¡El ganador es Old Jack!';
             if($cantidadApuesta6 > 0){
                $ingresos = $cantidadApuesta6 * 10;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        else{
             $box = '¡El ganador es Guacamole!';
             if($cantidadApuesta7 > 0){
                $ingresos = $cantidadApuesta7 * 41;
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                   $box = $box . ' Pierdes ' . $beneficio . "€."; 
                }
            }
            else{
                $box = $box . ' Pierdes ' . $gastos . "€.";
            }
        }
        $sql = "UPDATE personajes SET cash=cash + $ingresos - $gastos WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=accion&message=$box");
    }
    else{
       header("location: ?page=apuestasCocodrilos&message=No tengo tanto dinero para apostar"); 
    }
}


if($_GET['action'] === "cocodrilos"){
    cocodrilos($_POST['cantidadApuesta1'], $_POST['cantidadApuesta2'], $_POST['cantidadApuesta3'], $_POST['cantidadApuesta4'], $_POST['cantidadApuesta5'], $_POST['cantidadApuesta6'], $_POST['cantidadApuesta7']);
}

?>