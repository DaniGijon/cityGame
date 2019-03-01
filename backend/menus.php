<?php

    function getNombre($miId){
        global $db;
        $sql = "SELECT nombre FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['nombre'];
    }
    
    function getNivel($miId){
        global $db;
        $sql = "SELECT nivel FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['nivel'];
    }

    function getBarraExp($miId){
        global $db;
        $sql = "SELECT * FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['nivel'];
    }
    
    function getBarraSalud($miId){
        global $db;
        $sql = "SELECT salud FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['salud'];
    }
    
    function getBarraEnergia($miId){
        global $db;
        $sql = "SELECT energia FROM personajes WHERE id='$miId'";
        $stmt = $db->query($sql);
        $personaje = $stmt->fetchAll();
        return $personaje[0]['energia'];
    }