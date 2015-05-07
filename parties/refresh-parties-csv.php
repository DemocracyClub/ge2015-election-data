<?php
/**
 * Create parties CSV from Electoral Commission JSON
 */

$file = file_get_contents('parties.json');

$json = json_decode( $file, true );

$csv = 'EC Reference Number,Entity name' . PHP_EOL;

foreach ( $json as $party ) {

	// Add reference number
	$csv .= $party['party_id'] . ',';

	// Party name
	$csv .= '"' . $party['party_name'] . '"' . PHP_EOL;

}

echo $csv;