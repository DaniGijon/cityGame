<?php
    if(isset($_SESSION['loggedIn'])){
        include (__ROOT__.'/backend/menus.php');
        $id = ($_SESSION['loggedIn']);
        

    echo "<div id='top'>";
            
        echo "<div id='logoTitulo'>";
            echo "<h1 class='large noMargin floatLeft cool'>PG</h1>";
        echo "</div>";
        ?>

        <div id='secundarioTop'>
            <div id ='logoutTop' class='iconoTop botonLogout'></div>
            <a href="?page=manual"><div id ='manualTop' class='iconoTop'></div></a>
        </div>
        <div id="contenedorTop">
         <div id="infoArriba" class="floatRight" >
            <span id='burbujaPersonaje' class='burbujaPersonaje'>
                
                <span id='avatar' class='avatar'>
                    <?php
                    $avatar = getAvatar($id);
                    echo "<img src='/design/img/iconos/" . $avatar . "Avatar'>";
                    ?>
                </span>
                
             <!--  <span id='nombrePersonaje' class='nombrePersonaje'>
                    <?php
                   // echo getNombre($id);
                    ?>
                </span> -->
                
             <!--   <span id='dineroTop' class='dineroTop miniTop'>
                    <?php
                    //echo "<img src='/design/img/iconos/dinero'>";
                    ?>
                </span>
                
                <span id='tiempoTop' class='tiempoTop miniTop'>
                    <?php
                    //echo "<img src='/design/img/iconos/relojArena'>";
                    ?>
                </span>-->
            </span>
             
             <span id='dineroSeccionTop' class='dineroSeccionTop cajitaSeccionTop dineroTop'>
                 <span id='iconoDinero' class='iconoDinero'>
                     <span id='textoDinero' class='textoDinero cool'>
                    <?php
                    if(floor(getCash($id))<1000)
                     echo floor(getCash($id));
                    else{
                        $cash = getCash($id);
                        $cash = round($cash/1000, 2,PHP_ROUND_HALF_DOWN);
                        echo $cash . "K";
                    }
                     ?>
                    </span>
                 </span>
                 
             </span>
             
             <span id='nivelSeccionTop' class='nivelSeccionTop cajitaSeccionTop'>
                 <span id='iconoNivel' class='iconoNivel'>
                     <span id='textoNivel' class='textoNivel cool'>
                    <?php
                    echo "Nivel " . floor(getNivel($id));
                    ?>
                    </span>
                 </span>
                 
             </span>
             
             <span id='respetoSeccionTop' class='respetoSeccionTop cajitaSeccionTop'>
                 <span id='iconoRespeto' class='iconoRespeto'>
                     <span id='textoRespeto' class='textoRespeto cool'>
                    <?php
                    if(floor(getRespeto($id))<1000)
                     echo floor(getRespeto($id));
                    else{
                        $respeto = getRespeto($id);
                        $respeto = round($respeto/1000, 2,PHP_ROUND_HALF_DOWN);
                        echo $respeto . "K";
                    }
                     ?>
                    </span>
                 </span>
                
             </span>
             
             <span id='popularidadSeccionTop' class='popularidadSeccionTop cajitaSeccionTop'>
                 <span id='iconoPopularidad' class='iconoPopularidad'>
                     <span id='textoPopularidad' class='textoPopularidad cool'>
                    <?php
                     echo getPopularidad($id) . " %";
                     ?>
                    </span>
                 </span>
                
             </span>
             
             <span id='tiempoSeccionTop' class='tiempoSeccionTop cajitaSeccionTop tiempoTop'>
                 <span id='iconoTiempo' class='iconoTiempo'>
                     <span id='textoTiempo' class='textoTiempo cool'>
                    <?php
                     echo getTiempoAccion($id);
                     ?>
                    </span>
                 </span>
                
             </span>
             
            <span id='experienciaSeccionTop' class='experienciaSeccionTop cajitaSeccionTop'>
                <span id='iconoExp' class='iconoExp'>
                    <?php
                        echo "<span id='expAhora' style='width:" . getBarraExp($id) . "%'></span>"; 
                    ?>
                </span>
                
                <!--<span id='barraExp' class='barraExp'>
                    
                </span>-->
            </span>
            
            <div id='saludSeccionTop' class='saludSeccionTop cajitaSeccionTop'>
                <div id='iconoSalud' class='iconoSalud'>
                    <?php
                    echo "<div id='saludAhora' style='width:" . getBarraSalud($id) . "%'></div>";
                    ?> 
                    <!--<span id='textoSalud' class='textoSalud'>-->
                    
                </div>
                
               
            </div>
            
            <span id='energiaSeccionTop' class='energiaSeccionTop cajitaSeccionTop'>   
                <span id='iconoEnergia' class='iconoEnergia'>
                    <?php
                    echo "<span id='energiaAhora' style='width:" . getBarraEnergia($id) . "%'></span>"; 
                      
                    ?> 
                   
                </span>
              
            </span>
             
            <!-- <span id='botonLogout' class='botonLogout'> 
                
            </span>-->
             
            <div id='capaDinero'>
                <span id='cashTop' class='cashTop'>
                    <span id='iconoCash' class='iconoCash'></span>
                    <span id='textoCash' class='textoCash'>
                    <?php
                        echo getCash($id); 
                    ?> 
                    </span>
                 </span>
                
                <br>
                
                 <span id='bancoTop' class='bancoTop'>
                    <span id='iconoBanco' class='iconoBanco'></span>
                    <span id='textoBanco' class='textoBanco'>
                    <?php
                        echo getBanco($id); 
                    ?> 
                    </span>
                </span>
            </div>
             
             <div id='capaNivel'>
                    <?php
                        echo "Nivel " . getNivel($id); 
                    ?> 
            </div>
             
             <div id='capaRespeto'>
                    <?php
                        echo "Respeto " . getRespeto($id); 
                    ?> 
            </div>
             
             <div id='capaPopularidad'>
                    <?php
                        echo "Popularidad<br>" . getPopularidad($id) . "%"; 
                    ?> 
            </div>
             
            <div id='capaLogout'>
                    <?php
                        echo "Logout"; 
                    ?> 
            </div>
             
            <div id='capaManual'>
                    <?php
                        echo "Manual"; 
                    ?> 
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
                
                <br>
                
                <span id='viajeTop' class='viajeTop'>
                    <span id='iconoViaje' class='iconoCash'></span>
                    <span id='textoViaje' class='textoCash'>
                    <?php
                        echo getProxViaje($id); 
                    ?> 
                    </span>
                </span>
                
                <br>
                
                <span id='emboscadaTop' class='emboscadaTop'>
                    <span id='iconoEmboscada' class='iconoCash'></span>
                    <span id='textoEmboscada' class='textoCash'>
                    <?php
                        echo getProxEmboscada($id); 
                    ?> 
                    </span>
                </span>
            </div> 
             
            <div id='capaExperiencia'>
                    <?php
                        echo "EXP<br>" . getExperiencia($id) . "/" . getTopeExperiencia($id); 
                    ?> 
            </div>
             
             <div id='capaSalud'>
                    <?php
                        echo "Salud<br>" . getSalud($id) . "/100"; 
                    ?> 
            </div>
             
             <div id='capaEnergia'>
                    <?php
                        echo "Energía<br>" . getEnergia($id) . "/100"; 
                    ?> 
            </div>
             
        </div>
       </div>


        
    </div>
<?php
    }
    else{
        ?>
        <div id="top">
            <h1 class="large noMargin floatLeft">PuertoGame</h1>
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
    
    $(".nivelSeccionTop").hover(function(event){                          
        $("#capaNivel").css('left',event.pageX);
        $("#capaNivel").css('top',60);
        $("#capaNivel").toggle();              
    });
    
    $(".respetoSeccionTop").hover(function(event){                          
        $("#capaRespeto").css('left',event.pageX);
        $("#capaRespeto").css('top',60);
        $("#capaRespeto").toggle();              
    });
    
    $(".popularidadSeccionTop").hover(function(event){                          
        $("#capaPopularidad").css('left',event.pageX);
        $("#capaPopularidad").css('top',60);
        $("#capaPopularidad").toggle();              
    });
    
    $(".tiempoTop").hover(function(event){                             
        $("#capaTiempo").css('left',event.pageX);
        $("#capaTiempo").css('top',60);
        $("#capaTiempo").toggle();              
    });
    
    $(".experienciaSeccionTop").hover(function(event){                             
        $("#capaExperiencia").css('left',event.pageX);
        $("#capaExperiencia").css('top',60);
        $("#capaExperiencia").toggle();              
    });
    
    $(".saludSeccionTop").hover(function(event){                             
        $("#capaSalud").css('left',event.pageX);
        $("#capaSalud").css('top',60);
        $("#capaSalud").toggle();              
    });
    
    $(".energiaSeccionTop").hover(function(event){                             
        $("#capaEnergia").css('left',event.pageX);
        $("#capaEnergia").css('top',60);
        $("#capaEnergia").toggle();              
    });
    
    $("#manualTop").hover(function(event){                             
        $("#capaManual").css('left',event.pageX);
        $("#capaManual").css('top',60);
        $("#capaManual").toggle();              
    });
    
    $("#logoutTop").hover(function(event){                             
        $("#capaLogout").css('left',event.pageX);
        $("#capaLogout").css('top',60);
        $("#capaLogout").toggle();              
    });
    
    $(".botonLogout").click(function(event){                   
                   
        window.location = "index.php?bPage=accountOptions&action=logout&nonUI";
                      
    });
    
    $(".avatar").click(function(event){                   
                   
        window.location = 'index.php?page=personaje';
                      
    });
    
  
</script>