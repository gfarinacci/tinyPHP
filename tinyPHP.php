<?php
    $db_params = array('localhost', 'user', 'password', 'database');

    function db_connect($db_params) {
        $conn = new mysqli($db_params[0], $db_params[1], $db_params[2], $db_params[3]);
        
        // Check connection
	if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return -1;
        } else {
            return $conn;
        }
    }
    
    function build_query($conn, $query, $query_params) {
        $sql = $query;
        for($i=0; $i<count($query_params); $i++) {
            $query_params[$i] = $conn->real_escape_string($query_params[$i]);
        }
        $sql = vsprintf($sql, $query_params);
        return $sql;
    }

    function process_results($results,$query_params,$anonFunc,$defaultFunc) {
        if ($results->num_rows > 0) {
            // Process data of each row
            while($row = $results->fetch_assoc()) {
                $array = array_fill(0,count($query_params)-1,'');
                for($i=0; $i<count($query_params); $i++) {
                    $array[$i] = $row[$query_params[$i]];
                }
                $anonFunc($array);
            }
        } else {
            $defaultFunc();    
        }
    }
?>
