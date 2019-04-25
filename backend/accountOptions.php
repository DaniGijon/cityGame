<?php
function crearPersonaje($sexo,$origen){
    global $db;
    
    $id = $_SESSION['loggedIn'];
    
    switch($origen){
        case 'Cañamares':
            $numeroOrigen = 1;
            break;
        case 'Libertad':
            $numeroOrigen = 2;
            break;
        case 'Constitucion':
            $numeroOrigen = 3;
            break;
        case 'El Poblado':
            $numeroOrigen = 4;
            break;
        case 'Santa Ana':
            $numeroOrigen = 5;
            break;
        case 'Centro Sur':
            $numeroOrigen = 6;
            break;
        case 'El Pino':
            $numeroOrigen = 7;
            break;
        case 'El Carmen':
            $numeroOrigen = 8;
            break;
        case 'Fraternidad':
            $numeroOrigen = 9;
            break;
        case 'Ciudad Jardin':
            $numeroOrigen = 10;
            break;
    }
    
    if($numeroOrigen === 1){ //CAÑAMARES: AGI + PER
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', agilidad='3', percepcion='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 2){ //LIBERTAD: PER y RES
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', percepcion='3', resistencia='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 3){ //CONSTITUCION: AGI + DES
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', agilidad='3', destreza='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 4){ //EL POBLADO: Dinero EnBanco + ING
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', enBanco='100', ingenio='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    }
    elseif($numeroOrigen === 5){ //SANTA ANA: ESP + RES
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', espiritu='3', resistencia='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 6){ //CENTRO SUR: ING + ESP
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', ingenio='3', espiritu='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 7){ //LAS MERCEDES: AGI + FUE
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', agilidad='3', fuerza='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 8){ //EL CARMEN: RES + PER
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', resistencia='3', percepcion='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    }
    elseif($numeroOrigen === 9){ //FRATERNIDAD: DES + ING
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', destreza='3', ingenio='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    } 
    elseif($numeroOrigen === 10){ //CIUDAD JARDIN: EST + DES
       $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen', estilo='3', destreza='2' WHERE id='$id'";
        $stmt = $db->query($sql);
        header("location: ?page=loggedIn&message=Exito"); 
    }
    
}

function registerAccount($username,$password,$email){
    global $db;
    if(preg_match("/^[a-zA-Z0-9]+$/", $username) !== 0){
        
        if(strlen($username) < 20 || strlen($username) > 4){
             $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            $sql = "INSERT INTO users (username,password,email) VALUES(?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute(array($username,$hash,$email));
            if ($stmt->rowCount() > 0){
                //Creacion del personaje en la base de datos
                $id = $db->lastInsertId();
                $sql = "INSERT INTO personajes (id,nombre,sexo,origen,experiencia,nivel,barrio,zona,destreza,fuerza,agilidad,resistencia,espiritu,estilo,ingenio,percepcion,salud,energia,respeto,popularidad,cash,enBanco,avances,survival) "
                        . "VALUES ('$id','$username','Mujer','1','0','1','1','1','1','1','1','1','1','1','1','1','100','100','0','0','100','0','0','0')";
                $db->query($sql);
                
                //Creacion del inventario en la base de datos
                for($i = 0; $i<10; $i++){
                    $sql = "INSERT INTO inventario (idP,slot,idO)"
                            . "VALUES ('$id','$i','0')";
                    $db->query($sql);
                }
                
                //Creacion de los spots de popularidad en la base de datos
                $arraySpots = array(22,45,65,85,95,105,125,135,155,165); //array con los idS de cada Spot social
                for($i = 0; $i<10; $i++){
                    $sql = "INSERT INTO popularidad (idP,idS,popularidad)"
                            . "VALUES ('$id','$arraySpots[$i]','0')";
                    $db->query($sql);
                }
                
                //Creacion de un siguientespot en la base de datos
                $sql = "INSERT INTO siguientespot (idP,idS) VALUES ('$id', '1')";
                $db->$query($sql);
                
                $_SESSION['loggedIn'] = $id; 
                header("location: ?page=nuevoPersonaje&message=Registered");
            }
       
        }
        else{
            header("location: ?page=register&message=failedTooLongOrShort");
        }
    }
    else{
       header("location: ?page=register&message=failedWeirdCharacters");  
    }
    
}
function login($username,$password){
    global $db;
    
    
    
    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':username' => $username));
   
    if ($stmt->rowCount() > 0){
        $result = $stmt->fetchAll();
        $hash = $result[0]['password'];
        if(password_verify($password, $hash)){
            $_SESSION['loggedIn'] = $result[0]['id'];
            header("location: ?page=loggedIn&message=You%20logged%20in");
        }
        else{
            header("location: ?page=register&message=loginFailed");
        }
    }
    else{
        header("location: ?page=register&message=loginFailed");
    }
}
function logout(){
    session_destroy();
    header("location: ?");
}
if($_GET['action'] === "register"){
    registerAccount($_POST['username'],$_POST['password'],$_POST['email']);
}
elseif($_GET['action'] === "login"){
    login($_POST['username'],$_POST['password']);
}
elseif($_GET['action'] === "logout"){
    logout();
}
elseif($_GET['action'] === "crearPersonaje"){
    crearPersonaje($_POST['sexo'],$_POST['origen']);
}
?>