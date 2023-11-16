<?php

$file = 'Baza.txt';

$import = [];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
        $num = count($data);
        if ($num === 8) {
            $import[] = $data;
        }
    }
    fclose($handle);
}

file_put_contents('manel_import.json', json_encode($import));



