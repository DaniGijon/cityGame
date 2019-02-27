<?php
    if(isset($_SESSION['loggedIn'])){
?>
    <div id="top">
        <div id="logoTitulo">
            <h1 class="large noMargin floatLeft">Test</h1>
        </div>
        <div id="opcionesArriba" class="floatRight" >
            
            <span id='botonPersonaje' class="botonPersonaje">
                <a href="?page=personaje"><button>Mi Personaje</button></a><br>
            </span>
            <span id='botonDarUnaVuelta' class="botonDarUnaVuelta">
                <a href="?page=zona"><button>Dar una Vuelta</button></a><br>
            </span>
            <span id='botonMensajes' class="botonMensajes">
                <a href="?page=mensajes"><button>Mensajes</button></a><br>
            </span>
            <span id='botonRanking' class="botonRanking">
                <a href="?page=ranking"><button>Ranking</button></a><br>
            </span>
            <span id='botonLogout' class='botonLogout'>
                <a href="?bPage=accountOptions&action=logout&nonUI"><button>Logout</button></a><br>
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
