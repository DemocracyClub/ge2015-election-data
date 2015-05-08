<?php
/**
 * Auto-generate constituency CSVs for votes and seats
 */

error_reporting(E_ALL);

if ( ( $handle = fopen( "candidates.csv", "r" ) ) !== FALSE ) {
	while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== FALSE ) {
var_dump($data);
		// Convert constituname into a filename-friendly string for seats
		$votes_filename = 'votes-templates/' . str_ireplace( ' ', '-', strtolower( $data[3] ) ) . '-votes.csv';

		// Don't overwrite existing files
		if ( ! file_exists( $votes_filename ) ) {

			// Generate contents
			$votes_csv = 'Poll Date,Constituency,Constituency Code,Constituency URL,Party,Party ID,Votes,Ballots Rejected' . PHP_EOL;

			// Write the Votes CSV header
			$votes = file_put_contents( $votes_filename, $votes_csv );

		}

		// Okay, now create the next line
		$votes_csv = '2015-05-07,';
		$votes_csv .= '"' . $data[3] . '",'; // Constituency
		$votes_csv .= $data[6] . ','; // Constituency code
		$votes_csv .= 'http://statistics.data.gov.uk/doc/statistical-geography/' . $data[6] . ','; // Constituency URL
		$votes_csv .= $data[2] . ','; // Party
		$votes_csv .= $data[20] . ','; // Party ID
		$votes_csv .= PHP_EOL;

		// Now write the line to the file
		file_put_contents( $votes_filename, $votes_csv, FILE_APPEND );

	}
}