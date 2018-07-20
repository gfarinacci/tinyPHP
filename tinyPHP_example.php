<?php
    include_once 'tinyPHP.php';
    
    // Connect to database
    $conn = db_connect($db_params);
    
    // Build the query
    $query = 'SELECT * FROM Users WHERE id_user>%s AND id_user<%s';
    $query_params = array(1,7);
    $sql = build_query($conn, $query, $query_params);

    // Get the results
	$results = $conn->query($sql);

    // Define parameters, the function to display the results and the default function
    $query_params = ['firstname','lastname'];
    function f_results($array) { echo vsprintf('<p>%s %s</p>', $array); }
    function f_default() { echo 'No results to display'; }
    // Process the results
    process_results($results,$query_params,'f_results','f_default');

    // Close the connection
    $conn->close();
?>