<?php
 
// DB table to use
$table = 'tbl';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$database ="database";
$local = "localhost";
$username = "username";
$password = "";
$conn = mysqli_connect($local, $username, $password, $database);

$columns = array(
  //   array( 'db' => 'id',  'dt' => 0 ),
    array( 'db' => 'image', 'dt' => 0, 'formatter' => function( $d, $row ) {
           return "<img class='zoom' src='$d' style='height:90px;width:90px;align:middle;'/>";
        }    )  ,
    array( 'db' => 'name',  'dt' => 1 ),
    array( 'db' => 'info',  'dt' => 2 ),
    array( 'db' => 'price',  'dt' => 3, 'formatter' => function( $d, $row ) {
          return "$$d";
        }   ),  
);
 
// $database ="id8487820_database";
// $servername = "localhost";
// $username = "id8487820_username";
// $password = "password";
$sql_details = array(
    'user' => 'username',
    'pass' => '',
    'db'   => 'database',
    'host' => 'localhost'
);
 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
