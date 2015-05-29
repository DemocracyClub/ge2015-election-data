<?php
/**
 * Auto-generate seats CSVs
 */

error_reporting(E_ALL);

// Loop through all the votes CSVs
foreach ( glob( '../votes\/*-votes\.csv' ) as $filename ) {

	// Try to open this vote CSV
	if ( ( $handle = fopen( $filename, 'r' ) ) !== false ) {

		// Create the seats CSV
		$seats = new VotesSeatsConverter();

		// Count the rows
		$row = 0;

		// Grab the CSV data
		while ( ( $data = fgetcsv( $handle ) ) !== false ) {

			// Create CSV with headers
			if ( 0 === $row ) {
				$seats->setHeaders();
				$row++;
				continue;
			}

			// Remove votes
			unset( $data[6] );

			// TODO: Retrieve name, address, postcode of candidate from YNMP

			// Add the data row
			$seats->addData( $data );

			$row++;

		}

	}

}

Class VotesSeatsConverter {

	// array to keep track of standard headers taken from CSV
	private $headers = array();

	private $data = array();

	private $output_location = '';

	public function __construct( $output_dir = null ) {
		$this->setOutputLocation( $output_dir );
	}

	/**
	 * Take in simple array of header strings
	 */
	public function setHeaders() {

		// Store headers
		$this->headers = array(
			'Poll Date',
			'Constituency',
			'Constituency Code',
			'Constituency URL',
			'Party',
			'Party ID',
		);

		// Create the CSV with headers if needed
		if ( ! file_exists( $this->output_location ) )
			$this->createCSV();
	}

	/**
	 * Take in an array of arrays for data from CSV
	 *
	 * @param array $data_array Array from fgetcsv
	 * @return int Success or failure of file write
	 */
	public function addData( array $data_array ) {

		// Do some cleanup and store the data
		$this->data = array_map( 'addslashes', $data_array );

		return file_put_contents(
			$this->output_location,
			'"' . implode( '","', $this->data ) . '"' . "\n",
			FILE_APPEND
		);
	}

	/**
	 * Set the directory into which we should drop the seats CSV
	 *
	 * @param string $dir Directory path
	 */
	public function setOutputLocation( $dir = null ) {

		if ( is_null( $dir ) )
			$dir = __DIR__;

		$this->output_location = $dir . DIRECTORY_SEPARATOR . 'seats.csv';

	}

	/**
	 * Create the CSV with the headers, overwriting any existing file
	 *
	 * @return int Success or failure of file write
	 */
	private function createCSV() {
		return file_put_contents( $this->output_location, implode( ',', $this->headers ) . "\n" );
	}

}