# tinyPHP
A tiny set of functions to connect to MySQL using PHP

How to use?
Edit the tinyPHP.php file and insert your data in:
```
$db_params = array('localhost', 'user', 'password', 'database');
```
Include the file and connect to the database:
```
include_once 'tinyPHP.php';
    
// Connect to database
$conn = db_connect($db_params);
```
Build the query and submit it:
```
// Build the query
$query = 'SELECT * FROM Users WHERE id_user>%s AND id_user<%s';
$query_params = array(1,7);
$sql = build_query($conn, $query, $query_params);

// Get the results
$results = $conn->query($sql);
```
Define the parameters to return, the function to display results and the default function:
```
$query_params = ['firstname','lastname'];
function f_results($array) { echo vsprintf('<p>%s %s</p>', $array); }
function f_default() { echo 'No results to display'; }
```
Process the results and close the connection:
```
// Process the results
process_results($results,$query_params,'f_results','f_default');
// Close the connection
$conn->close();
```
