<?php
    if(isset($_SESSION['loggedIn'])){
        include (__ROOT__.'/backend/menus.php');
        $id = ($_SESSION['loggedIn']);
        

    echo "<div id='top'>";
            
        echo "<div id='logoTitulo'>";
            echo "<h1 class='large noMargin floatLeft'>PuertoGame</h1>";
        echo "</div>";
        ?>
         <div id="infoArriba" class="floatRight" >
            <span id='burbujaPersonaje' class='burbujaPersonaje'>
                <span id='nombrePersonaje' class='nombrePersonaje'>
                    <?php
                    echo getNombre($id);
                    ?>
                </span>

                <span id='avatar' class='avatar'>
                    <?php
                    $avatar = getAvatar($id);
                    echo "<img src='/design/img/iconos/" . $avatar . "Avatar'>";
                    ?>
                </span>
                
                <span id='dineroTop' class='dineroTop miniTop'>
                    <?php
                    echo "<img src='/design/img/iconos/dinero'>";
                    ?>
                </span>
                
                <span id='tiempoTop' class='tiempoTop miniTop'>
                    <?php
                    echo "<img src='/design/img/iconos/relojArena'>";
                    ?>
                </span>
            </span>
             
             <span id='nivelSeccionTop' class='nivelSeccionTop cajitaSeccionTop'>
                 <span id='iconoNivel' class='iconoNivel'></span>
                 <span id='textoNivel' class='textoNivel'>
                 <?php
                 echo floor(getNivel($id));
                 ?>
                 </span>
             </span>
             
             <span id='respetoSeccionTop' class='respetoSeccionTop cajitaSeccionTop'>
                <span id='iconoRespeto' class='iconoRespeto'></span>
                <span id='textoRespeto' class='textoRespeto'>
                <?php
                 echo floor(getRespeto($id));
                 ?>
                </span>
             </span>
             
             <span id='popularidadSeccionTop' class='popularidadSeccionTop cajitaSeccionTop'>
                <span id='iconoPopularidad' class='iconoPopularidad'></span>
                <span id='textoPopularidad' class='textoPopularidad'>
                <?php
                 echo getPopularidad($id) . " %";
                 ?>
                </span>
             </span>
             
            <span id='experienciaSeccionTop' class='experienciaSeccionTop cajitaSeccionTop'>
                <span id='iconoExp' class='iconoExp'></span>
                <span id='textoExp' class='textoExp'>
                   <?php
                        echo getExperiencia($id); 
                    ?> 
                </span>
                <span id='barraExp' class='barraExp'>
                    <?php
                        echo "<span id='expAhora' style='width:" . getBarraExp($id) . "%'></span>"; 
                    ?>
                </span>
            </span>
            
            <span id='saludSeccionTop' class='saludSeccionTop cajitaSeccionTop'>
                <span id='iconoSalud' class='iconoSalud'></span>
                <span id='textoSalud' class='textoSalud'>
                    <?php
                        echo getBarraSalud($id) . "/100"; 
                    ?> 
                </span>
                <span id='barraSalud' class='barraSalud'> 
                    <?php
                        echo "<span id='saludAhora' style='width:" . getBarraSalud($id) . "%'></span>"; 
                    ?>           
                </span>
            </span>
            
            <span id='energiaSeccionTop' class='energiaSeccionTop cajitaSeccionTop'>   
                <span id='iconoEnergia' class='iconoEnergia'></span>
                <span id='textoEnergia' class='textoEnergia'>
                    <?php
                        echo getBarraEnergia($id) . "/100"; 
                    ?> 
                </span>
                <span id='barraEnergia' class='barraEnergia'>
                   <?php 
                        echo "<span id='energiaAhora' style='width:" . getBarraEnergia($id) . "%'></span>"; 
                    ?> 
                </span>
            </span>
             
             <span id='botonLogout' class='botonLogout'>
                
            </span>
             
            <div id='capaDinero'>
                <span id='cashTop' class='cashTop'>
                    <span id='iconoCash' class='iconoCash'></span>
                    <span id='textoCash' class='textoCash'>
                    <?php
                        echo getCash($id); 
                    ?> 
                    </span>
                 </span>
                 <span id='bancoTop' class='bancoTop'>
                    <span id='iconoBanco' class='iconoBanco'></span>
                    <span id='textoBanco' class='textoBanco'>
                    <?php
                        echo getBanco($id); 
                    ?> 
                    </span>
                </span>
            </div>
             
            <div id='capaTiempo'>
                <span id='accionTop' class='accionTop'>
                    <span id='iconoAccion' class='iconoCash'></span>
                    <span id='textoAccion' class='textoCash'>
                    <?php
                        echo getProxAccion($id); 
                    ?> 
                    </span>
                </span>
                
                <span id='viajeTop' class='viajeTop'>
                    <span id='iconoViaje' class='iconoCash'></span>
                    <span id='textoViaje' class='textoCash'>
                    <?php
                        echo getProxViaje($id); 
                    ?> 
                    </span>
                </span>
                
                <span id='emboscadaTop' class='emboscadaTop'>
                    <span id='iconoEmboscada' class='iconoCash'></span>
                    <span id='textoEmboscada' class='textoCash'>
                    <?php
                        echo getProxEmboscada($id); 
                    ?> 
                    </span>
                </span>
            </div> 
             
        </div>

        
    </div>
<?php
    }
    else{
        ?>
        <div id="top">
            <h1 class="large noMargin floatLeft">My browser game</h1>
            <div id="opcionesArriba" class="floatRight" >
                <a href="?page=register"><button>Register</button></a><br>
                <a href="?page=login"><button>Login</button></a>
            </div>
        </div>
    <?php
    }
?>

<script>
    $(".dineroTop").hover(function(event){                   
                   
        $("#capaDinero").css('left',event.pageX);
        $("#capaDinero").css('top',60);
        $("#capaDinero").toggle();

                      
    });
    
    $(".tiempoTop").hover(function(event){                   
                   
        $("#capaTiempo").css('left',event.pageX);
        $("#capaTiempo").css('top',60);
        $("#capaTiempo").toggle();
                      
    });
    
    $(".botonLogout").click(function(event){                   
                   
        window.location = "index.php?bPage=accountOptions&action=logout&nonUI";
                      
    });
    
    $(".avatar").click(function(event){                   
                   
        window.location = 'index.php?page=personaje';
                      
    });
    
  
</script>