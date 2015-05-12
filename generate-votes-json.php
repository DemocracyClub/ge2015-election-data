<?php
/**
 * Generates JSON representations of vote data from the CSVs we have
 */

// Loop through the votes CSVs
foreach ( glob( "votes/*-votes.csv" ) as $filename ) {

	// Get and parse the CSV
	if ( ( $handle = fopen( $filename, 'r' ) ) !== false ) {

		$row = 1; // track the row we're on

		// Get the existing JSON, if it exists
		$json_filename = preg_match( '/votes\/(*)-votes.csv/', $filename );
var_dump($json_filename);
		#if ( file_exists( $filename ) )

		while ( ( $data = fgetcsv( $handle ) ) !== false ) {

			// Skip the header row
			if ( $row === 1 )
				continue;

		}
	}

}