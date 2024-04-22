<?php

// Check if the conexion function is not already defined
    function conexion(){
        $host = "localhost";
        $dbname = "ketal";
        $user = "postgres";
        $password = "1234";

        // Creamos la conexión
        return $connection = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    }

>