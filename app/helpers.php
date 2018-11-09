<?php

function parse_csv($path = ''){
    return array_map('str_getcsv', file($path));
}

function parse_data($path = ''){
    $data = parse_csv($path);

    $temp = [];
    foreach ($data as $d){
        $temp[] = [
            'id' => $d['0'],
            'name' => $d['1'],
            'tax' => (float)$d['2'],
            'price' => (float)$d['3']
        ];
    }

    return $temp;
}

function print_debug($data){
    echo '<pre>';
    print_r($data);
    die();
}

function id_to_index($data){
    $temp = [];
    foreach ($data as $d){
        $temp[$d['id']] = $d;
    }
    return $temp;
}