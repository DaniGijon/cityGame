<?php
    if(isset($_SESSION['loggedIn'])){
?>
    <div id="top">
        <h1 class="large noMargin floatLeft">My browser game</h1>
        <div id="accountOptions" class="floatRight" >
            <a href="?bPage=accountOptions&action=logout&nonUI"><button>Logout</button></a><br>
            <a href="?page=personaje"><button>Mi Personaje</button></a><br>
            <a href="?page=atacarJugador"><button>Atacar a otro jugador</button></a><br>
            <a href="?page=ciudad"><button>Ir a Ciudad</button></a><br>
        </div>
        
    </div>
<?php
    }
    else{
        ?>
        <div id="top">
            <h1 class="large noMargin floatLeft">My browser game</h1>
            <div id="accountOptions" class="floatRight" >
                <a href="?page=register"><button>Register</button></a><br>
                <a href="?page=login"><button>Login</button></a>
            </div>
        </div>
    <?php
    }
?>
