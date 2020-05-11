<?php
$database ="";
$local = "localhost";
$username = "";
$password = "";

// Create connection
$conn = mysqli_connect($local, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>

<?php
$u = '';
$p = '';
$d   = '';
$l = 'localhost';
    
$conn_cart = mysqli_connect($l, $u, $p, $d);
    
// Check connection
if (!$conn_cart) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
