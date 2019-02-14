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
    
     
    $sql = "UPDATE personajes SET sexo='$sexo', origen='$numeroOrigen', barrio='$numeroOrigen' WHERE id='$id'";
    $stmt = $db->query($sql);
    header("location: ?page=loggedIn&message=Exito");
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
                
                $id = $db->lastInsertId();
                $sql = "INSERT INTO personajes (id,nombre,sexo,origen,experiencia,nivel,barrio,zona,destreza,fuerza,agilidad,resistencia,espiritu,estilo,ingenio,percepcion,salud,energia,respeto,social,cash,enBanco) "
                        . "VALUES ('$id','$username','Mujer','1','0','1','1','1','0','0','0','0','0','0','0','0','100','100','0','0','100','0')";
                $db->query($sql);
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