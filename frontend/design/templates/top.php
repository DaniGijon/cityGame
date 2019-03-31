<?php
    if(isset($_SESSION['loggedIn'])){
        include (__ROOT__.'/backend/menus.php');
        $id = ($_SESSION['loggedIn']);
        
?>
    <div id="top">
        <div id="logoTitulo">
            <h1 class="large noMargin floatLeft">PuertoGame</h1>
        </div>
        
        <div id="infoArriba" class="floatRight" >
            <span id='nombrePersonaje' class='nombrePersonaje'>
                <?php
                echo getNombre($id) . ' Nivel:' . floor(getNivel($id));
                ?>
            </span>
            <span id='botonManual' class='botonManual'>
                <a href="?page=manual"><button>Manual</button></a><br>
            </span>
            <span id='botonLogout' class='botonLogout'>
                <a href="?bPage=accountOptions&action=logout&nonUI"><button>Logout</button></a><br>
            </span>
            <span id='textoExp' class='textoExp'></span>
            <span id='barraExp' class='barraExp'>
                <?php
                    echo "<span id='expAhora' style='width:" . getBarraExp($id) . "%'></span>"; 
                ?>
            </span>
            <span id='textoSalud' class='textoSalud'></span>
            <span id='barraSalud' class='barraSalud'> 
                <?php
                    echo "<span id='saludAhora' style='width:" . getBarraSalud($id) . "%'></span>"; 
                ?>           
            </span>
            <span id='textoEnergia' class='textoEnergia'></span>
            <span id='barraEnergia' class='barraEnergia'>
                <?php
                    echo "<span id='energiaAhora' style='width:" . getBarraEnergia($id) . "%'></span>"; 
                ?>  
            </span>
        </div>
        
        <div id="opcionesArriba" class="floatRight" >
            
            <span id='botonPersonaje' class="botonPersonaje">
                <a href="?page=personaje"><button class="botonPersonajeImagen">Mi Personaje</button></a><br>
            </span>
            <span id='botonDarUnaVuelta' class="botonDarUnaVuelta">
                <a href="?page=zona"><button class="botonDarUnaVueltaImagen">Dar una Vuelta</button></a><br>
            </span>
            
            <span id='botonRanking' class="botonRanking">
                <a href="?page=ranking"><button class="botonRankingImagen">Ranking</button></a><br>
            </span>
            
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
