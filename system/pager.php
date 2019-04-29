<?php
function getPage(){
    if (isset($_GET['page'])){ 
        
        $page = str_replace("..\\", "", $_GET['page']);
        
        include("pages/" . $page . ".php");
        /*
        if ($_GET['page'] === "register"){
            include("pages/register.php");
        }
        elseif($_GET['page'] === "login"){
            include("pages/login.php");
        }
        else{
            echo "You requested an invalid link";
        }
         */
    }
    elseif(isset($_GET['bPage'])){
        if ($_GET['bPage'] === "accountOptions"){
            include("..\backend\accountOptions.php");
        }
        elseif($_GET['bPage'] === "personajeFunctions"){
            include("..\backend\personajeFunctions.php");  
        }
        elseif($_GET['bPage'] === "fightFunctions"){
            include("..\backend\fightFunctions.php");  
        }
        elseif($_GET['bPage'] === "zonaFunctions"){
            include("..\backend\zonaFunctions.php");  
        }
        elseif($_GET['bPage'] === "ciudadFunctions"){
            include("..\backend\ciudadFunctions.php");  
        }
        elseif($_GET['bPage'] === "actualizaciones"){
            include("..\backend\actualizaciones.php");  
        }
        elseif($_GET['bPage'] === "aventuras"){
            include("..\backend\aventuras.php");  
        }
        elseif($_GET['bPage'] === "apuestas"){
            include("..\backend\apuestas.php");  
        }
        elseif($_GET['bPage'] === "tiradas"){
            include("..\backend\tiradas.php");  
        }
        elseif($_GET['bPage'] === "menus"){
            include("..\backend\menus.php");  
        }
        elseif($_GET['bPage'] === "mensajesFunctions"){
            include("..\backend\mensajesFunctions.php");  
        }
        elseif($_GET['bPage'] === "costesViajes"){
            include("..\backend\costesViajes.php");  
        }
        
    }
    else{
        if(isset($_SESSION['loggedIn'])){
            include("pages/loggedIn.php");
        }
        else{
            include("pages/welcome.php");
        }
    }
}
?>