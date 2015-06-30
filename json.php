<?php

$file = fopen("teste.csv", "r");

$json = array();
if ($file !== FALSE) {
	$i = 0;
	$city = array();
    while (($data = fgetcsv($file)) !== FALSE) {
    	if (!$i) {
    		$i++;
    		continue;
    	}

    	$coords = str_replace('MULTIPOINT (', '', utf8_encode($data[0]));
    	$coords = str_replace(')', '', $coords);
    	$coords = explode(' ', $coords);

    	$name = utf8_encode($data[1]);

        $json[$name][] = array($coords[0], $coords[1], $data[2]);

    	//if (count($json) > 10) break;
    }
	fclose($file);
}

echo json_encode($json);

?>