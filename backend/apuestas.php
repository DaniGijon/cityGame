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
             $box = '¡El ganador es Plátano!';
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

function caras($cantidadApuesta1, $cantidadApuesta2){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $ganador = rand(1,3);
    $ingresos = 0;
    $gastos = $cantidadApuesta1 + $cantidadApuesta2;
    //Comprobar que tengo suficiente dinero para apostar
    $puedoPagar = comprobarCoste($gastos);
    if($puedoPagar === 1){
        if($ganador === 1){
            $box = '¡Caras!';
            if($cantidadApuesta1 > 0){
                $ingresos = $cantidadApuesta1 * 2;
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
        elseif($ganador === 2){
            $box = '¡Cruces!';
            if($cantidadApuesta2 > 0){
                $ingresos = $cantidadApuesta2 * 2;
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
            $box = '¡Cara y Cruz! Empate <br>';
            $ingresos = $cantidadApuesta1 + $cantidadApuesta2;
            $beneficio = $ingresos - $gastos;
            
        }
    
        $sql = "UPDATE personajes SET cash=cash + $ingresos - $gastos WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=accion&message=$box");
    }
    else{
       header("location: ?page=apuestasCaras&message=No tengo tanto dinero para apostar"); 
    }
}

function ruleta($cantidadApuesta0, $cantidadApuesta1, $cantidadApuesta2, $cantidadApuesta3, $cantidadApuesta4, $cantidadApuesta5, $cantidadApuesta6, $cantidadApuesta7, $cantidadApuesta8, $cantidadApuesta9, $cantidadApuesta10, $cantidadApuesta11, $cantidadApuesta12, $cantidadApuesta13, $cantidadApuesta14, $cantidadApuesta15, $cantidadApuesta16, $cantidadApuesta17, $cantidadApuesta18,
        $cantidadApuesta19, $cantidadApuesta20, $cantidadApuesta21, $cantidadApuesta22, $cantidadApuesta23, $cantidadApuesta24, $cantidadApuesta25, $cantidadApuesta26, $cantidadApuesta27, $cantidadApuesta28, $cantidadApuesta29, $cantidadApuesta30, $cantidadApuesta31, $cantidadApuesta32, $cantidadApuesta33, $cantidadApuesta34, $cantidadApuesta35, $cantidadApuesta36,
        $cantidadApuestaRojo, $cantidadApuestaNegro, $cantidadApuestaPar, $cantidadApuestaImpar, $cantidadApuestaFalta, $cantidadApuestaPasa, $cantidadApuesta1c, $cantidadApuesta2c, $cantidadApuesta3c, $cantidadApuesta1d, $cantidadApuesta2d, $cantidadApuesta3d, 
        $cantidadApuestaJuego, $cantidadApuestaVecinos, $cantidadApuestaHuerfanos, $cantidadApuestaTercio){
    
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $ganador = rand(0,36);
    $bolaJackpot = rand(0,36);
    $ingresos = 0;
    $gastos = $cantidadApuesta0 + $cantidadApuesta1 + $cantidadApuesta2 + $cantidadApuesta3 + $cantidadApuesta4 + $cantidadApuesta5 + $cantidadApuesta6 + $cantidadApuesta7 + $cantidadApuesta8 + $cantidadApuesta9 + $cantidadApuesta10 + $cantidadApuesta11 + $cantidadApuesta12 + $cantidadApuesta13 + $cantidadApuesta14 + $cantidadApuesta15 + $cantidadApuesta16 + $cantidadApuesta17 + $cantidadApuesta18 +
        $cantidadApuesta19 + $cantidadApuesta20 + $cantidadApuesta21 + $cantidadApuesta22 + $cantidadApuesta23 + $cantidadApuesta24 + $cantidadApuesta25 + $cantidadApuesta26 + $cantidadApuesta27 + $cantidadApuesta28 + $cantidadApuesta29 + $cantidadApuesta30 + $cantidadApuesta31 + $cantidadApuesta32 + $cantidadApuesta33 + $cantidadApuesta34 + $cantidadApuesta35 + $cantidadApuesta36 +
        $cantidadApuestaRojo + $cantidadApuestaNegro + $cantidadApuestaPar + $cantidadApuestaImpar + $cantidadApuestaFalta + $cantidadApuestaPasa + $cantidadApuesta1c + $cantidadApuesta2c + $cantidadApuesta3c + $cantidadApuesta1d + $cantidadApuesta2d + $cantidadApuesta3d + 
        $cantidadApuestaJuego + $cantidadApuestaVecinos + $cantidadApuestaHuerfanos + $cantidadApuestaTercio;
    
    //Comprobar que tengo suficiente dinero para apostar
    $puedoPagar = comprobarCoste($gastos);
    if($puedoPagar === 1){
        switch ($ganador) {
            case 0:
                $box = "<img src='/design/img/apuestas/0ruleta.png'><br> ¡Ha salido el 0!";
                if($cantidadApuesta0 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta0 * 36);
                    if($bolaJackpot === 0){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            
            case 1:
                $box = "<img src='/design/img/apuestas/1ruleta.png'><br> ¡Ha salido el 1!";
                if($cantidadApuesta1 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta1 * 36);
                    if($bolaJackpot === 1){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 2:
                $box = "<img src='/design/img/apuestas/2ruleta.png'><br> ¡Ha salido el 2!"; 
                if($cantidadApuesta2 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta2 * 36);
                    if($bolaJackpot === 2){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 3:
                $box = "<img src='/design/img/apuestas/3ruleta.png'><br> ¡Ha salido el 3!";
                if($cantidadApuesta3 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta3 * 36);
                    if($bolaJackpot === 3){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break; 
            case 4:
                $box = "<img src='/design/img/apuestas/4ruleta.png'><br> ¡Ha salido el 4!";
                if($cantidadApuesta4 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta4 * 36);
                    if($bolaJackpot === 4){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 5:
                $box = "<img src='/design/img/apuestas/5ruleta.png'><br> ¡Ha salido el 5!";
                if($cantidadApuesta5 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta5 * 36);
                    if($bolaJackpot === 5){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 6:
                $box = "<img src='/design/img/apuestas/6ruleta.png'><br> ¡Ha salido el 6!";
                if($cantidadApuesta6 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta6 * 36);
                    if($bolaJackpot === 6){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 7:
                $box = "<img src='/design/img/apuestas/7ruleta.png'><br> ¡Ha salido el 7!";
                if($cantidadApuesta7 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta7 * 36);
                    if($bolaJackpot === 7){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 8:
                $box = "<img src='/design/img/apuestas/8ruleta.png'><br> ¡Ha salido el 8!";
                if($cantidadApuesta8 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta8 * 36);
                    if($bolaJackpot === 8){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;   
            case 9:
                $box = "<img src='/design/img/apuestas/9ruleta.png'><br> ¡Ha salido el 9!";
                if($cantidadApuesta9 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta9 * 36);
                    if($bolaJackpot === 9){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 10:
                $box = "<img src='/design/img/apuestas/10ruleta.png'><br> ¡Ha salido el 10!";
                if($cantidadApuesta10 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta10 * 36);
                    if($bolaJackpot === 10){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;  
            case 11:
                $box = "<img src='/design/img/apuestas/11ruleta.png'><br> ¡Ha salido el 11!";
                if($cantidadApuesta11 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta11 * 36);
                    if($bolaJackpot === 11){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;  
            case 12:
                $box = "<img src='/design/img/apuestas/12ruleta.png'><br> ¡Ha salido el 12!";
                if($cantidadApuesta12 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta12 * 36);
                    if($bolaJackpot === 12){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta1d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 13:
                $box = "<img src='/design/img/apuestas/13ruleta.png'><br> ¡Ha salido el 13!";
                if($cantidadApuesta13 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta13 * 36);
                    if($bolaJackpot === 13){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 14:
                $box = "<img src='/design/img/apuestas/14ruleta.png'><br> ¡Ha salido el 14!";
                if($cantidadApuesta14 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta14 * 36);
                    if($bolaJackpot === 14){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 15:
                $box = "<img src='/design/img/apuestas/15ruleta.png'><br> ¡Ha salido el 15!";
                if($cantidadApuesta15 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta15 * 36);
                    if($bolaJackpot === 15){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 16:
                $box = "<img src='/design/img/apuestas/16ruleta.png'><br> ¡Ha salido el 16!";
                if($cantidadApuesta16 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta16 * 36);
                    if($bolaJackpot === 16){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 17:
                $box = "<img src='/design/img/apuestas/17ruleta.png'><br> ¡Ha salido el 17!";
                if($cantidadApuesta17 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta17 * 36);
                    if($bolaJackpot === 17){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 18:
                $box = "<img src='/design/img/apuestas/18ruleta.png'><br> ¡Ha salido el 18!";
                if($cantidadApuesta18 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta18 * 36);
                    if($bolaJackpot === 18){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaFalta > 0){
                    $ingresos = $ingresos + ($cantidadApuestaFalta * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 19:
                $box = "<img src='/design/img/apuestas/19ruleta.png'><br> ¡Ha salido el 19!";
                if($cantidadApuesta19 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta19 * 36);
                    if($bolaJackpot === 19){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 20:
                $box = "<img src='/design/img/apuestas/20ruleta.png'><br> ¡Ha salido el 20!";
                if($cantidadApuesta20 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta20 * 36);
                    if($bolaJackpot === 20){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 21:
                $box = "<img src='/design/img/apuestas/21ruleta.png'><br> ¡Ha salido el 21!";
                if($cantidadApuesta21 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta21 * 36);
                    if($bolaJackpot === 21){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 22:
                $box = "<img src='/design/img/apuestas/22ruleta.png'><br> ¡Ha salido el 22!";
                if($cantidadApuesta22 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta22 * 36);
                    if($bolaJackpot === 22){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 23:
                $box = "<img src='/design/img/apuestas/23ruleta.png'><br> ¡Ha salido el 23!";
                if($cantidadApuesta23 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta23 * 36);
                    if($bolaJackpot === 23){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 24:
                $box = "<img src='/design/img/apuestas/24ruleta.png'><br> ¡Ha salido el 24!";
                if($cantidadApuesta24 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta24 * 36);
                    if($bolaJackpot === 24){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta2d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 25:
                $box = "<img src='/design/img/apuestas/25ruleta.png'><br> ¡Ha salido el 25!";
                if($cantidadApuesta25 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta25 * 36);
                    if($bolaJackpot === 25){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 26:
                $box = "<img src='/design/img/apuestas/26ruleta.png'><br> ¡Ha salido el 26!";
                if($cantidadApuesta26 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta26 * 36);
                    if($bolaJackpot === 26){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 27:
                $box = "<img src='/design/img/apuestas/27ruleta.png'><br> ¡Ha salido el 27!";
                if($cantidadApuesta27 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta27 * 36);
                    if($bolaJackpot === 27){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 28:
                $box = "<img src='/design/img/apuestas/28ruleta.png'><br> ¡Ha salido el 28!";
                if($cantidadApuesta28 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta28 * 36);
                    if($bolaJackpot === 28){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 29:
                $box = "<img src='/design/img/apuestas/29ruleta.png'><br> ¡Ha salido el 29!";
                if($cantidadApuesta29 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta29 * 36);
                    if($bolaJackpot === 29){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€.";
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 30:
                $box = "<img src='/design/img/apuestas/30ruleta.png'><br> ¡Ha salido el 30!";
                if($cantidadApuesta30 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta30 * 36);
                    if($bolaJackpot === 30){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 31:
                $box = "<img src='/design/img/apuestas/31ruleta.png'><br> ¡Ha salido el 31!";
                if($cantidadApuesta31 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta31 * 36);
                    if($bolaJackpot === 31){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 32:
                $box = "<img src='/design/img/apuestas/32ruleta.png'><br> ¡Ha salido el 32!";
                if($cantidadApuesta32 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta32 * 36);
                    if($bolaJackpot === 32){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 33:
                $box = "<img src='/design/img/apuestas/33ruleta.png'><br> ¡Ha salido el 33!";
                if($cantidadApuesta33 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta33 * 36);
                    if($bolaJackpot === 33){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 34:
                $box = "<img src='/design/img/apuestas/34ruleta.png'><br> ¡Ha salido el 34!";
                if($cantidadApuesta34 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta34 * 36);
                    if($bolaJackpot === 34){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaHuerfanos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaHuerfanos * 4.62);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta1c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta1c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 35:
                $box = "<img src='/design/img/apuestas/35ruleta.png'><br> ¡Ha salido el 35!";
                if($cantidadApuesta35 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta35 * 36);
                    if($bolaJackpot === 35){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaJuego > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaJuego * 5.28);
                }
                if($cantidadApuestaVecinos > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaVecinos * 2.17);
                }
                if($cantidadApuestaNegro > 0){
                    $ingresos = $ingresos + ($cantidadApuestaNegro * 2);
                }
                if($cantidadApuestaImpar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaImpar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta2c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta2c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            case 36:
                $box = "<img src='/design/img/apuestas/36ruleta.png'><br> ¡Ha salido el 36!";
                if($cantidadApuesta36 > 0){
                    $box = $box . ' La bola Jackpot es : ' . $bolaJackpot . '<br>';
                    $ingresos = $ingresos + ($cantidadApuesta36 * 36);
                    if($bolaJackpot === 36){
                        $box = $box . '¡¡¡PREMIO JACKPOT!!!';
                        $sql = "SELECT * FROM jackpots WHERE id=2";
                        $stmt = $db->query($sql);
                        $result = $stmt->fetchAll();

                        $jackpot = $result[0]['cantidad'];
                        $ingresos = $ingresos + $jackpot;
                        
                        $sql = "UPDATE jackpots SET cantidad=500 WHERE id='2'"; //Reinicio el Jackpot
                        $db->query($sql);
                    }
                }
                if($cantidadApuestaTercio > 0){
                    $ingresos = $ingresos + floor($cantidadApuestaTercio * 3.08);
                }
                if($cantidadApuestaRojo > 0){
                    $ingresos = $ingresos + ($cantidadApuestaRojo * 2);
                }
                if($cantidadApuestaPar > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPar * 2);
                }
                if($cantidadApuestaPasa > 0){
                    $ingresos = $ingresos + ($cantidadApuestaPasa * 2);
                }
                if($cantidadApuesta3c > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3c * 3);
                }
                if($cantidadApuesta3d > 0){
                    $ingresos = $ingresos + ($cantidadApuesta3d * 3);
                }
                $beneficio = $ingresos - $gastos;
                if($beneficio >= 0){
                    $box = $box . ' Ganas ' . $beneficio . "€.";
                }
                else{
                    $box = $box . ' Pierdes ' . $beneficio . "€."; 
                    $sql = "UPDATE jackpots SET cantidad=cantidad + floor(-$beneficio * 0.05) WHERE id='2'"; //Incremento Bote en 1€ por cada 20€ perdidos
                    $db->query($sql);
                }
                break;
            default:
                $box = '¡Ha salido otro!';
                break;
        }
        $sql = "UPDATE personajes SET cash=cash + $ingresos - $gastos WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=accion&message=$box");
    }
    else{
       header("location: ?page=accion&message=No tengo tanto dinero para apostar"); 
    }
}

function tragaperras($cantidadApuesta1){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $ganador = rand(1,2000);
    $ingresos = 0;
    $gastos = $cantidadApuesta1;
    //Comprobar que tengo suficiente dinero para apostar
    $puedoPagar = comprobarCoste($gastos);
    $apuestaMin = 10;
    $apuestaMax = 100;
    if($puedoPagar === 1){
        if($cantidadApuesta1 >= $apuestaMin && $cantidadApuesta1 <= $apuestaMax){
            if($ganador <=1400){ //70% NO PREMIADOS
                $box = 'Mala suerte. Sigue probando.';

                $ingresos = $cantidadApuesta1 * 0;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Pierdes ' . $beneficio . "€."; 
                
                $sql = "UPDATE jackpots SET cantidad=cantidad + floor($gastos * 0.05) WHERE id='1'"; //Incremento Bote en 1€ por cada 20€ perdidos
                $db->query($sql);
             }
            elseif($ganador >=1401 && $ganador <=1700){ //15% PREMIO x2
                $box = '¡Premio! x2';

                $ingresos = $cantidadApuesta1 * 2;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador >=1701 && $ganador <=1850){ //7.5% PREMIO x3
                $box = '¡Premio! x3';

                $ingresos = $cantidadApuesta1 * 3;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador >=1851 && $ganador <=1930){ //4% PREMIO x5
                $box = '¡Premio! x5';

                $ingresos = $cantidadApuesta1 * 5;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador >=1931 && $ganador <=1970){ //2% PREMIO x10
                $box = '¡Premio! x10';

                $ingresos = $cantidadApuesta1 * 10;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador >=1971 && $ganador <=1990){ //1% PREMIO x20
                $box = '¡Premio! x20';

                $ingresos = $cantidadApuesta1 * 20;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador >=1991 && $ganador <=1999){ //0.5% PREMIO x50
                $box = '¡Premio! x50';

                $ingresos = $cantidadApuesta1 * 50;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            elseif($ganador === 2000){ //0.05% PREMIO JACKPOT
                $box = '¡Premio JACKPOT! ';
   
                $sql = "SELECT * FROM jackpots WHERE id=1";
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll();

                $jackpot = $result[0]['cantidad'];

                $ingresos = $jackpot;
                $beneficio = $ingresos - $gastos;

                $box = $box . ' Ganas ' . $beneficio . "€.";
            }
            $sql = "UPDATE personajes SET cash=cash + $ingresos - $gastos WHERE id='$id'";
            $db->query($sql);
            header("location: ?page=accion&message=$box");
        }
        else{
            header("location: ?page=apuestasTragaperrasLuckia&message=La cantidad apostada debe ser mínimo $apuestaMin y máximo $apuestaMax"); 
        }
    }
    else{
       header("location: ?page=apuestasTragaperrasLuckia&message=No tengo tanto dinero para apostar"); 
    }
}

function getJackpotLuckia(){
   global $db;
   
   $sql = "SELECT * FROM jackpots WHERE id=1";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $jackpot = $result[0]['cantidad'];
   return $jackpot;
}

function getJackpotJoker(){
   global $db;
   
   $sql = "SELECT * FROM jackpots WHERE id=2";
   $stmt = $db->query($sql);
   $result = $stmt->fetchAll();
   
   $jackpot = $result[0]['cantidad'];
   return $jackpot;
}

function avionesVerFecha(){
    global $db;
    
    $sql = "SELECT * FROM survivals WHERE id='1'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return $result[0]['fecha'];
}

function avionesVerPremio(){
    global $db;
    
    $sql = "SELECT * FROM survivals WHERE id='1'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    return $result[0]['premio'];
}

function avionesFormulario(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7 AND inventario.idO >=1000";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll(); 
    
    echo "<form id = 'selectorOpciones' action='?bPage=apuestas&action=avionesInscripcion&nonUI' method='post'>";
    foreach ($result as $avion){
            echo "<input type='checkbox' name='cbox1' value='" . $avion['nombre'] . "'> <label for='cbox3'>" . $avion['nombre'] . "<img src='/design/img/objetos/" . $avion['imagenObjeto'] . "'></label><br>";

    }
                echo "<input type='checkbox' name='cbox1' value='Avioneta de Alquiler' checked='true'> <label for='cbox3'>Avioneta de Alquiler<img src='/design/img/objetos/1001.png'></label><br>";

 
    echo "<br><br>El coste de participación es : 50€ <input type='submit' value='Inscribirse'>";  
}

function avionesHistorial(){
    global $db;
    
    $sql = "SELECT * FROM survivals WHERE id > '1'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $sql = "SELECT COUNT(*) FROM survivals WHERE id > '1'";
    $stmt = $db->query($sql);
    $cuenta = $stmt->fetchAll();
    $tope = $cuenta[0]['COUNT(*)']; //cantidad de partidas ya pasadas
    
    $sql = "SELECT * FROM personajes";
    $stmt = $db->query($sql);
    $nombres = $stmt->fetchAll();
    
    echo "<table border = '1'><caption>Anteriores Ganadores</caption>";
                echo "<tr>";
                    echo "<th> FECHA </th>";
                    echo "<th> GANADOR </th>";
                    echo "<th> PREMIO </th>";
                echo "</tr>";

                for($i=0; $i<$tope; $i=$i+1){
                    echo "<tr>";
                    $fecha = $result[$i]['fecha']; //cada fecha de cada partida pasada
                    
                    $cadaGanador = $result[$i]['ganador']; //cada ganador de cada partida pasada
                    
                    $sql = "SELECT * FROM personajes WHERE id = '$cadaGanador'";
                    $stmt = $db->query($sql);
                    $res = $stmt->fetchAll();
                    
                    $ganador = $res[0]['nombre']; //ganador de esa partida en concreto que se está evaluando
                    
                    $premio = $result[$i]['premio'];  //premio de esa partida en concreto
                    
                    echo "<td>" . date( "d/m/Y", strtotime($fecha)) . "</td>";
                    
                    echo "<td>" . $ganador . "</td>";
                    
                    echo "<td>" . $premio . "€</td>";
                    echo "</tr>";
                }
                echo "</table>";
}

function avionesEstoyInscrito(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $sql = "SELECT survival FROM personajes WHERE id = '$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    $estoyInscrito = $result[0]['survival'];
    return $estoyInscrito;
    
}

function avionesInscripcion(){
    include (__ROOT__.'/backend/comprobaciones.php');
    global $db;
    $id = $_SESSION['loggedIn'];
    
    $puedoPagar = comprobarCoste(50); //Para un coste de INSCRIPCION = 50€.
    if($puedoPagar === 1){
        //PAGO LA INSCRIPCION y MI ESTADO AHORA ES INSCRITO
        $coste = 50;
        
        $sql = "UPDATE personajes SET cash = cash - $coste, survival = 1 WHERE id='$id'";
        $db->query($sql);
        
        //ACTUALIZO EL PREMIO JACKPOT
        $sql = "UPDATE survivals SET premio = premio + 35 WHERE id=1";
        $db->query($sql);
        header("location: ?page=apuestasAviones&message=¡Inscrito!");
    }
    else{
        //NO PUEDO PAGAR
        header("location: ?page=apuestasAviones&message=¡No tengo dinero para pagar la inscripción!");
    }
}


if(isset($_GET['action']) && ($_GET['action'] === "cocodrilos")){
    cocodrilos($_POST['cantidadApuesta1'], $_POST['cantidadApuesta2'], $_POST['cantidadApuesta3'], $_POST['cantidadApuesta4'], $_POST['cantidadApuesta5'], $_POST['cantidadApuesta6'], $_POST['cantidadApuesta7']);
}
if(isset($_GET['action']) && ($_GET['action'] === "caras")){
    caras($_POST['cantidadApuesta1'], $_POST['cantidadApuesta2']);
}
if(isset($_GET['action']) && ($_GET['action'] === "ruleta")){
    ruleta($_POST['cantidadApuesta0'], $_POST['cantidadApuesta1'], $_POST['cantidadApuesta2'], $_POST['cantidadApuesta3'], $_POST['cantidadApuesta4'], $_POST['cantidadApuesta5'], $_POST['cantidadApuesta6'], $_POST['cantidadApuesta7'], $_POST['cantidadApuesta8'], $_POST['cantidadApuesta9'], $_POST['cantidadApuesta10'],
    $_POST['cantidadApuesta11'], $_POST['cantidadApuesta12'], $_POST['cantidadApuesta13'], $_POST['cantidadApuesta14'], $_POST['cantidadApuesta15'], $_POST['cantidadApuesta16'], $_POST['cantidadApuesta17'], $_POST['cantidadApuesta18'], $_POST['cantidadApuesta19'], $_POST['cantidadApuesta20'],
    $_POST['cantidadApuesta21'], $_POST['cantidadApuesta22'], $_POST['cantidadApuesta23'], $_POST['cantidadApuesta24'], $_POST['cantidadApuesta25'], $_POST['cantidadApuesta26'], $_POST['cantidadApuesta27'], $_POST['cantidadApuesta28'], $_POST['cantidadApuesta29'], $_POST['cantidadApuesta30'],
    $_POST['cantidadApuesta31'], $_POST['cantidadApuesta32'], $_POST['cantidadApuesta33'], $_POST['cantidadApuesta34'], $_POST['cantidadApuesta35'], $_POST['cantidadApuesta36'], $_POST['cantidadApuestaRojo'], $_POST['cantidadApuestaNegro'], $_POST['cantidadApuestaPar'], $_POST['cantidadApuestaImpar'],
    $_POST['cantidadApuestaFalta'], $_POST['cantidadApuestaPasa'], $_POST['cantidadApuesta1c'], $_POST['cantidadApuesta2c'], $_POST['cantidadApuesta3c'], $_POST['cantidadApuesta1d'], $_POST['cantidadApuesta2d'], $_POST['cantidadApuesta3d'], $_POST['cantidadApuestaJuego'], $_POST['cantidadApuestaVecinos'],
    $_POST['cantidadApuestaHuerfanos'], $_POST['cantidadApuestaTercio']);
}
if(isset($_GET['action']) && ($_GET['action'] === "tragaperras")){
    tragaperras($_POST['cantidadApuesta1']);
}

if(isset($_GET['action']) && ($_GET['action'] === "avionesInscripcion")){
    avionesInscripcion();
}
?>