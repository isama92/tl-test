<?php

/**
 * Please write robust and secure code, as if this was a website on the internet.
 * We will use different test CSV files in evaluating the code. Treat the supplied CSV file and
 * parameters as user input. We have set up a MySQL server to use for this project, the database
 * layout can be found in the SQL file and the relevant data to access said server is set in
 * the DATABASECONFIG constant. You are free to move code around as long as the functionality
 * correctly works in the end. The target php version is php8.x.
 */
class CSVHandler {

    private $fileName;

    private const DATABASECONFIG = [
        // censored
    ];

    /**
     * Load the file
     */
    public function __construct( $file ) {
        $this->fileName = '';
    }

    /**
     * Output the file into a textarea
     * Use the data to produce a html table
     */
    public function show() {

    }

    /**
     * Clear all lines in the table and import data into a SQL database
     */
    public function import() {

    }

    /**
     * Read data from SQL database and output as html table again
     */
    public function makeTableFromDB() {

    }

}
?><!DOCTYPE html>
<html>
<head><title>CSV Handler</title></head>
<body>
<?php
if ( isset( $_GET[ 'file' ] ) ) {
    $csvHandler = new CSVHandler( $_GET[ 'file' ] );
    $csvHandler->show();
    $csvHandler->import();
    $csvHandler->makeTableFromDB();
} else {
    echo '<ul>';
    echo '<li><a href="?file=test.csv">test.csv</a></li>';
    echo '<li><a href="?file=test2.csv">test2.csv</a></li>';
    echo '</ul>';
}
?>
</body>
</html>
