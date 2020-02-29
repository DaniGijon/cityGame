<?php
global $db;
        include (__ROOT__.'/backend/comprobaciones.php');
        include (__ROOT__.'/backend/getFotos.php');
        $id = $_SESSION['loggedIn'];
        comprobarZona1Barrio8();
        
        $estoyLibre = comprobarEspera();
        if($estoyLibre === 1){
            echo "<div id='moduloZona'>";
            echo "<span class = 'tituloSpot'>";
                echo "<h4>" . getNombreSpot(144) . "</h4>";
            echo "</span>";
            
            $result = comprobarDinero();
            $dineroEnBanco = $result[0]['enBanco'];
            
            echo "<div class='contenido'>";
            echo "<span class='contenedor1'>"; 
            echo "<div class='seccionSpotOpciones'>";
            echo "<div id='botonesComprarVender'>";
                echo "<button id='botonComprar' class='tagTiendaComprar'>Cajero</button>";
                echo "<button id='botonVender' class='tagTiendaVender'>Taquillas</button>";
            echo "</div>";
            echo "<div class='semiTransparente'>"; 
            echo "<div id='cajero'>";
            echo "<div class='textoDependiente'>";
                echo "\"Gringotts es el lugar más seguro del mundo para guardar lo que quieras guardar\".";
            echo "</div>"; //FIN textoDependiente
            echo "<div class='imagenDependiente'>";
                echo '<img src="/design/img/dependientes/fogataRitual.png">';
            echo "</div>"; //FIN imagenDependiente
            
            echo '<form id = "selectorOpciones" action="?bPage=actualizaciones&action=actualizarDinero&nonUI" method="post">';
            echo "<div class='opcionesTienda'>";
                echo "<div class='opcionesTiendaCheckbox'>";
                    echo '<input type="checkbox" name="cbox1" value="depositarDinero" checked="true">';
                echo "</div>";
                echo "<div class='opcionesTiendaTitulo'>";
                    echo 'Meter en banco';
                echo "</div>";
                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTiendaInput"><input name="cantidadDeposito" style="width:70%; border-radius:10px;" type=number min="0"></div><br></label>';
            echo "</div>";
            echo "<div class='opcionesTienda'>";
                echo "<div class='opcionesTiendaCheckbox'>";
                    echo '<input type="checkbox" name="cbox1" value="retirarDinero">';
                echo "</div>";
                echo "<div class='opcionesTiendaTitulo'>";
                    echo 'Deseo Retirar';
                echo "</div>";
                echo '<label for="cbox3"><div id="opcionBox">' . '<img src="/design/img/bar/cafeIrlandes">' . '</div><div class="monedaTienda"></div><div class="precioTiendaInput"><input name="cantidadRetirada" style="width:70%; border-radius:10px;" type=number min="0"></div>(5% Comisión)</label>';
            echo "</div>";
            
            echo "<div class='submitTienda'>";
                echo "<input type='submit' class='botonCarrilBici' value=' '><br><br>";
            echo "</div>";
            
            echo "</form>"; 
            echo "</div>"; //FIN cajero
            echo "<div id='empeno'>";
            echo "<div class='textoDependiente'>";
                echo "\"Gringotts es el lugar más seguro del mundo para guardar lo que quieras guardar\".";
            echo "</div>"; //FIN textoDependiente
            echo "<div class='imagenDependiente'>";
                echo '<img src="/design/img/dependientes/fogataRitual.png">';
            echo "</div>"; //FIN imagenDependiente
            
            //Objetos que tiene SIN EQUIPAR el personaje
                    echo"<div id='capaBolsa'>";
                        $sql = "SELECT objetos.* FROM inventario JOIN objetos ON inventario.idO = objetos.id WHERE inventario.idP = '$id' AND inventario.slot > 7";
                        $stmt = $db->query($sql);
                        $objetosDB = $stmt->fetchAll();
                        
                        echo "<div id='capaInventarioSuperior'>";
                            echo "<div id='inventarioTitulo' class='coolWhiteGigante'>";
                                echo "MOCHILA GRANDE";
                            echo "</div>";
                            echo "<div id='inventarioX'>";
                            echo "</div>";
                        echo "</div>";
                        
                        echo "<div id='capaFondo'>";
                        echo "<span id='areaCuerpo' style='display:none'></span>";
                        $inv = 8; //slot inicial de inventario
                        foreach($objetosDB as $obj){
                            if($inv < 10){
                                $inv = "0" . "$inv";
                            }
                            if($obj['id'] === '0'){
                                
                             echo "<div id='0' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                             echo "</div>" ;
                               
                            }
                            elseif($obj['id'] > 0 && $obj['id'] < 20){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                 
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 20 && $obj['id'] < 100){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                               
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 100 && $obj['id'] < 200){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                        
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                       
                                echo "</div>" ;
                            }
                            else if($obj['id'] >= 200 && $obj['id'] < 300){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                  
                                    
                                echo "</div>";
                            }
                            else if($obj['id'] >= 300 && $obj['id'] < 400){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                 
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                    
                                echo "</div>";
                            }
                            else if($obj['id'] >= 400 && $obj['id'] < 500){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                  
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                
                                echo "</div>";
                            }
                            else if($obj['id'] >= 500 && $obj['id'] < 600){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                            
                                echo "</div>";
                            }
                            else if($obj['id'] >= 900 && $obj['id'] < 920){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                   
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                                echo "</div>";
                            }
                            elseif($obj['id'] >= 920){
                                echo "<div id='" . $obj['id'] . "' class='nuevoBoxBolsa inv inv" . $inv . "'>";
                                   
                                    echo "<img src='/design/img/objetos/" . $obj['imagenObjeto'] . "'><br><br>";
                                   
                                echo "</div>";
                            }
                            $inv = $inv + 1; //incremento de la variable $inv
                        }
                        echo "</div>"; //FIN capaFondo
                        
                    echo "</div>"; //FIN capaBolsa
                    
            
            
            //caja de empeños
            //dibujar
            
            echo "<div class='cajaEmpenos'>";
            
                //ver slots y objetos de empeño que tiene el jugador
                $slots = verSlotsEmpeno(); //slots de empeño que tiene comprados
                if($slots){
                   
                    $i=0;
                    foreach($slots as $cadaSlot){
                        echo "<div id='" . $cadaSlot['idO'] . "' class='nuevoBoxBolsa empeno slot slot".$i."'>"; 
                         
                            echo "<img src='/design/img/objetos/" . $cadaSlot['idO'] . "'>";
                        echo "</div>";
                        $i = $i+1;
                    }
                    for ($index = $i; $index < 9; $index++) {
                         echo "<div class='nuevoBoxBolsa empeno slotEnVenta'>"; 
                        
                        echo"</div>";
                    }
                }
                else{
                    for ($index = 0; $index < 9; $index++) {
                         echo "<div class='nuevoBoxBolsa empeno slotEnVenta'>"; 
                        
                        echo"</div>";
                    }
                }
                //Boton de comprar slot
                if(count($slots) < 9){
                    echo "<div class='submitTaquilla'>";
                        echo "<input type='submit' class='botonCarrilBici' value=' '>";
                    echo "</div>";
                }
            echo "</div>"; //FIN cajaempenos
            
            echo "</div>"; //FIN empeno
            echo '<div id="fondoMano" style="display:none;">';
            echo "</div>";//FIN fondoMano
        }
        
                ?>
         
                <script>
                    
                    $(":checkbox").change(function(){
                       var $box = $(this);
                      
                       $box.parents('#selectorOpciones').find(':checkbox').each(function(){
                          $(this).prop('checked', false); 
                       });
                       $box.prop("checked", true);

                    });
                    
                     $("#botonVender").click(function(){
                        $("#cajero").hide();
                        $("#empeno").show();
                        $("#botonVender").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonComprar").css("background-color", "white");
                    });

                      $("#botonComprar").click(function(){
                        $("#cajero").show();
                        $("#empeno").hide();
                        $("#botonComprar").css("background-color", "rgba(255, 249, 192, 0.7)");
                        $("#botonVender").css("background-color", "white");
                    });
                    
                    $(".slot").click(function(){
                       var idObjeto = $(this).attr('id');
                       var tiki = $(this).attr('class');
                       var slot = tiki[30];
                       
                       $("."+slot).css('border-color','yellow');
                       $("."+slot).css('background','yellow');
                       
                       $("#fondoMano").css('left',0);
                       $("#fondoMano").css('top',0);
                       $("#fondoMano").toggle();
                    
                         $("#capaBolsa").css('left',500);
                         $("#capaBolsa").css('top',20);
                         $("#capaBolsa").css('z-index',6);
                         $("#capaBolsa").toggle();

                         $("#capaFondo").toggle();
                         
                         $("#inventarioX").click(function(){
                            $("#zonaArea").load("index.php?page=zona&nonUI")
                         });

                        $(".inv").click(function(){
                            var idInv = $(this).attr('id');
                            var taka = $(this).attr('class');
                            var inv = taka[21]+taka[22];
                            
                            $.post("?bPage=zonaFunctions", {
                                idObjeto : idObjeto,
                                slot : slot,
                                idInv : idInv,
                                inv : inv
                            }).done(function(){
                                $("#zonaArea").load("index.php?bPage=zonaFunctions&taquillear")
                                
                                $("#zonaArea").load("index.php?bPage=zonaFunctions&dibujarZona&nonUI")
                            })
                        });
                    });
                    
                   $(".submitTaquilla").click(function(){
                        var compraTaquilla = 1;
                      $.post("?bPage=zonaFunctions", {
                          compraTaquilla : compraTaquilla
                      }).done(function(){
                          $("#zonaArea").load("index.php?bPage=zonaFunctions&comprarTaquilla&dibujarZona&nonUI")
                      })
                    });
                 
                    
                    
                    
                </script>

                <?php
                echo "</div>"; //fin de semiTransparente     
                echo "</div>"; //FIN DE div seccionSpotOpciones
                
                echo "</span>"; //FIN contenedor1
                
                echo "<span class='contenedor2'>";
                    echo "<div class='opcionSpot0 opcionSpot' style='display: inline'>";
                        echo "<div class='seccionDescripcionZonaImagen'>";
                            echo "<div class='seccionSpotImagen'>" ;
                                $spotImagen = getFotoSpot(144);
                                echo $spotImagen;
                            echo "</div>";
                        echo "</div>";               
                    echo "</div>"; //FIN opcionSpot0
                echo "</span>"; //FIN de contenedor2
                
            echo "</div>"; //FIN DE div contenido

        echo "</div>"; //FIN DE div moduloZona
        
        
