<?php
/**
 * Generates JSON representations of vote data from the CSVs we have
 * 
 * Note: You need to create the output directory manually currently. This defaults to "votes_json". 
 */

// Loop through the votes CSVs
foreach ( glob( "votes/*-votes.csv" ) as $filename ) {

	// Get and parse the CSV
	if ( ( $handle = fopen( $filename, 'r' ) ) !== false ) {

		$row = 1; // track the row we're on

		// Get the existing JSON, if it exists
		if (preg_match( '/votes\/(.*)-votes.csv/', $filename, $matches )) {
			$json_filename = $matches[1];
		}
var_dump($json_filename);
		#if ( file_exists( $filename ) )

		$headers = array();
		$data_rows = array();
		
		while ( ( $data = fgetcsv( $handle ) ) !== false ) {

			// Skip the header row
			if ( $row === 1 ) {
				$headers = $data;
			} else {
				$data_rows[] = $data;
			}
			
			$row++;

		}
		
		$json_converter = new VotesJsonConverter($headers, $data_rows);
		$success = $json_converter->outputJson($json_filename . '.json');
		// exit;
	}

}

class VotesJsonConverter {
	
	// array to keep track of standard headers taken from CSV
	private $headers = array();
	
	private $csv_data = array();
	
	private $output_dir = 'votes_json';
	
	public function __construct($headers_array, $data_array, $output_dir = null) {
		$this->setHeaders($headers_array);
		$this->setCsavData($data_array);
		if (! is_null($output_dir)) {
			$this->setOutputDirectory($output_dir);
		}
	}
	
	/**
	 * Take in simple array of header strings
	 */
	public function setHeaders(array $headers_array) {
		$this->headers = $headers_array;
	}
	
	/**
	 * Take in an array of arrays for data from CSV
	 */
	public function setCsavData(array $data_array) {
		$this->csv_data = $data_array;
	}
	
	public function setOutputDirectory($dir) {
		$this->output_dir = $dir;
	}
	
	public function convertToJson() {
		$array_to_encode = array();
		$line_n = 1;
		foreach ($this->csv_data as $csv_row) {
			
			if (count($csv_row) > count($this->headers)) {
				error_log('Warning: Data at line ' . $line_n . ' has more columns than headers. Skipping.');
				continue;
			}
			
			// start building up this row
			$this_array_row = array();
			
			$header_n = 0;
			foreach ($csv_row as $csv_cell) {
				$this_array_row[$this->headers[$header_n++]] = $csv_cell;
			}
			
			$array_to_encode[] = $this_array_row;
			
			$line_n++;
		}
		
		return json_encode($array_to_encode);
	}
	
	public function outputJson($filename) {
		$output_location = $this->output_dir . DIRECTORY_SEPARATOR . $filename;
		return file_put_contents($output_location, $this->convertToJson());
	}
	
}
