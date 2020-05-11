<?php
// DB table to use
$table = 'tbl';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
     array( 'db' => 'id',  'dt' => 0),  
       array( 'db' => 'name',  'dt' => 1, 'formatter' => function( $d, $row ) {
           //return "<h5 class='cart_name'>$d</h5>";
           return $d;
        }   ),
      array( 'db' => 'price',  'dt' => 2, 'formatter' => function( $d, $row ) {
           return "<span class='cart_price'>$$d</span>";
        }   ),
    array( 'db' => 'qtd',  'dt' => 3 , 'formatter' => function( $d, $row ) {  
    return "<select class='cart_qtd'> <option selected='selected' value='$d'>$d</option></option><option>1</option><option>2</option><option>3</option><option>4</option></select>";
    }   ),
      array( 'db' => 'total',  'dt' => 4, 'formatter' => function( $d, $row ) {
           return "<span class='cart_total'>$$d</span>";
        }   ),  
    //array( 'db' => 'date',  'dt' => 3),  
);
 
$sql_details = array(
    'user' => '',
    'pass' => '',
    'db'   => '',
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
