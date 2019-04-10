<?php
function dibujarAlbum(){
    global $db;
    $id = $_SESSION['loggedIn'];
    
    echo 'MONSTRUOS DERROTADOS:<br>';
    
    $sql = "SELECT * FROM victorias WHERE idP='$id'";
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll();
    
    foreach($result as $cadaMonstruo){
        $idMonstruo = $cadaMonstruo['idM'];
        $sql = "SELECT * FROM monstruos WHERE idM='$idMonstruo'";
        $stmt = $db->query($sql);
        $res = $stmt->fetchAll();
        
        echo "<div id='albumFicha'>";
        echo "     <div id='opcionBox'><img src='/design/img/monstruos/" . $res[0]['imagenMonstruo'] ."'>";
        echo "     </div>";
        echo "<br>" . $res[0]['nombre'];
        echo "<br> Nivel : " . $res[0]['nivel'];
        
        switch ($res[0]['barrio']){
            case '1':
                $barrio = 'Cañamares';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Asdrúbal';
                        break;
                    case '2':
                        $zona = 'Terri';
                        break;
                }
                break;
            case '2':
                $barrio = 'Libertad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Gran Capitán';
                        break;
                    case '2':
                        $zona = 'San José';
                        break;
                    case '3':
                        $zona = 'Pozo Norte';
                        break;
                }
                break;
            case '3':
                $barrio = 'Constitución';
                $zona = 'Abulagar';
                break;
            case '4':
                $barrio = 'El Poblado';
                $zona = 'El Poblado';
                break;
            case '5':
                $barrio = 'Santa Ana';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Salesianos';
                        break;
                    case '2':
                        $zona = 'Tauro';
                        break;
                    case '3':
                        $zona = 'La Copa';
                        break;
                }
                break;
            case '6':
                $barrio = 'Centro Sur';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Viacrucis';
                        break;
                    case '2':
                        $zona = 'Paseo S.Gregorio';
                        break;
                    case '3':
                        $zona = 'Paseo El Bosque';
                        break;
                }
                break;
            case '7':
                $barrio = 'Las Mercedes';
                $zona = 'El Pino';
                break;
            case '8':
                $barrio = 'El Carmen';
                $zona = 'El Carmen';
                break;
            case '9':
                $barrio = 'Fraternidad';
                switch($res[0]['zona']){
                    case '1':
                        $zona = 'Las 600';
                        break;
                    case '2':
                        $zona = 'PAU';
                        break;
                    case '3':
                        $zona = 'Recinto Ferial';
                        break;
                }
                break;
            case '10':
                $barrio = 'Ciudad Jardín';
                $zona = 'Ciudad Jardín';
                break;
        }
        echo "<br> Barrio : " . $barrio;
        echo "<br> Zona : " . $zona;
        echo "<div id='fichaDescripcion'><br>" . $res[0]['descripcion'] . "</div>";
        echo "<div id='fichaPie'> Victorias : " . $cadaMonstruo['cantidad'] . "</div>";
        echo "</div>";
    }
}