<?php
    if(isset($_SESSION['loggedIn'])){
       /* include (__ROOT__.'/backend/menus.php');*/
        $id = ($_SESSION['loggedIn']);
        
?>
    <div id="menuLateral">
        
        <ul class='ulMenuLateral'>
                <a href="?page=personaje"><div id='botonPersonaje' class="botonPersonaje">
                        <div id='botonPersonajeTexto' class='coolWhiteGrande'>
                            <?php
                            echo getNombre($id);
                            ?>
                        </div>
                </div></a><br>    
                <a href="?page=zona"><div id='botonDarUnaVuelta' class="botonDarUnaVuelta">
                        <div id='botonDarUnaVueltaTexto' class='coolWhiteGrande'>
                            <?php
                            echo "Dar una Vuelta";
                            ?>
                        </div>
                </div></a><br>
                <?php
                    if(getMensajesPendientes($id) == 1){
                        echo '<a href="?page=mensajes"><div id="botonMensajesPendientes" class="botonMensajesPendientes">';
                            echo "<div id='botonMensajesTexto' class='coolWhiteGrande'>Mensajes</div>";
                        echo '</div></a><br>';
                    }
                    else {
                        echo '<a href="?page=mensajes"><div id="botonMensajes" class="botonMensajes">';
                            echo "<div id='botonMensajesTexto' class='coolWhiteGrande'>Mensajes</div>";
                        echo '</div></a><br>';
                    }
                ?>
                
                    <a href="?page=misiones"><div id='botonMisiones' class="botonMisiones">
                        <div id='botonMisionesTexto' class='coolWhiteGrande'>
                        <?php
                        echo "Misiones";
                        ?>
                        </div>
                    </div></a><br>
                    <a href="?page=album"><div id='botonAlbum' class="botonAlbum">
                        <div id='botonAlbumTexto' class='coolWhiteGrande'>
                        <?php
                        echo "Álbum";
                        ?>
                        </div>
                    </div></a><br>
                    <a href="?page=ranking"><div id='botonRanking' class="botonRanking">
                        <div id='botonRankingTexto' class='coolWhiteGrande'>
                        <?php
                        echo "Ranking";
                        ?>
                        </div>
                    </div></a><br>
                    <a href="?page=ranking"><div id='botonForo' class="botonForo">
                        <div id='botonForoTexto' class='coolWhiteGrande'>
                        <?php
                        echo "Foro";
                        ?>
                        </div>
                    </div></a><br>
                
                <form id = 'buscarJugador' action='?page=jugadorRival&action=nombre' method='post'>
                <div class="buscarJugador"><input name="buscarJugador" style="width:50%; border-radius:10px; margin-top: 20px; margin-left: 40px; float:left" type=text min="1" class="cool">
                      <div id='lupa'></div>
                </div>
              
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
