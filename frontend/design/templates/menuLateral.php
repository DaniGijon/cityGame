<?php
    if(isset($_SESSION['loggedIn'])){
       /* include (__ROOT__.'/backend/menus.php');*/
        $id = ($_SESSION['loggedIn']);
        
?>
    <div id="menuLateral">
        
        <ul class='ulMenuLateral'>
                <a href="?page=personaje"><div id='botonPersonaje' class="botonPersonaje">
                        <div id='botonPersonajeTexto' class='cool'>
                            <?php
                            echo getNombre($id);
                            ?>
                        </div>
                </div></a><br>    
                <a href="?page=zona"><div id='botonDarUnaVuelta' class="botonDarUnaVuelta"></div></a><br>
                <?php
                    if(getMensajesPendientes($id) == 1){
                        echo '<a href="?page=mensajes"><div id="botonMensajesPendientes" class="botonMensajesPendientes"></div></a><br>';
                    }
                    else {
                        echo '<a href="?page=mensajes"><div id="botonMensajes" class="botonMensajes"></div></a><br>';
                    }
                ?>
                
                <a href="?page=misiones"><div id='botonMisiones' class="botonMisiones"></div></a><br>
                <a href="?page=album"><div id='botonAlbum' class="botonAlbum"></div></a><br>
                <a href="?page=ranking"><div id='botonRanking' class="botonRanking"></div></a><br>
                <a href="?page=ranking"><div id='botonRanking' class="botonRanking"></div></a><br>
                
                <form id = 'buscarJugador' action='?page=jugadorRival&action=nombre' method='post'>
                <div class="buscarJugador"><input name="buscarJugador" style="width:50%; border-radius:10px; margin-top: 20px; margin-left: 20px;" type=text min="1" class="cool"></div>
                <div class='submitTienda'>
                    <input type='submit' style="display: none" value=' '><br><br>
                </div>
                </form>
        </ul>    
        
        
    </div>
<?php
    }
    else{
        ?>
        <div id="menuLateral">
            
        </div>
    <?php
    }
?>
