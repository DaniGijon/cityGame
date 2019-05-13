<?php
    if(isset($_SESSION['loggedIn'])){
       /* include (__ROOT__.'/backend/menus.php');*/
        $id = ($_SESSION['loggedIn']);
        
?>
    <div id="menuLateral">
        
        <ul class='ulMenuLateral'>
        

                <span id='botonPersonaje' class="botonPersonaje">
                    <a href="?page=personaje"><button class="botonPersonajeImagen">Mi Personaje</button></a><br>
                </span>
                <span id='botonDarUnaVuelta' class="botonDarUnaVuelta">
                    <a href="?page=zona"><button class="botonDarUnaVueltaImagen">Dar una Vuelta</button></a><br>
                </span>
                <span id='botonMensajes' class="botonMensajes">
                    <a href="?page=mensajes"><button class="botonMensajesImagen">Mensajes</button></a><br>
                </span>
                <span id='botonAlbum' class="botonAlbum">
                    <a href="?page=album"><button class="botonAlbumImagen">Album</button></a><br>
                </span>
                <span id='botonRanking' class="botonRanking">
                    <a href="?page=ranking"><button class="botonRankingImagen">Ranking</button></a><br>
                </span>

        </ul>    
        
        
    </div>
<?php
    }
    else{
        ?>
        <div id="menuLateal">
            
        </div>
    <?php
    }
?>
