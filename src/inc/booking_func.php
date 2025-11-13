<?php 
    $json_data  = file_get_contents('php://');

    $data = json_decode($json_data);

    if ($data) {
        $method = $data->method;
        $date = $data->date;

        // open db connections
        // prep sql statements
    }