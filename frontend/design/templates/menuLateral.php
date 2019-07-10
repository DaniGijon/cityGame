<?php
    if(isset($_SESSION['loggedIn'])){
       /* include (__ROOT__.'/backend/menus.php');*/
        $id = ($_SESSION['loggedIn']);
        
?>
    <div id="menuLateral">
        
        <ul class='ulMenuLateral'>
                <a href="?page=personaje"><div id='botonPersonaje' class="botonPersonaje">
                        <div id='botonPersonajeTexto'>
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
