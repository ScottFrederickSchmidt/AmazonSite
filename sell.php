<?php
error_reporting(E_ALL)
?>
<?php
$database ="";
$local = "localhost";
$username = "";
$password = "";

// Create connection
$conn = mysqli_connect($local, $username, $password, $database);

if(!$conn) {
    var_dump($conn->error());
}
?>

<?php
 $stmt2= $conn->prepare("INSERT INTO tbl(`name`, `info`, `image`, `price`, `date`) VALUES(?, ?, ?, ?, ?)");
if(!$stmt2) { die ("DB Error: ". $conn->error); }
//var_dump($_POST['image'], $_POST['sell_price']);
//var_dump($_POST['sell_name'], $_POST['info']);
$date= date("y-m-d");

$stmt2->bind_param("sssds", $_POST['sell_name'], $_POST['info'],  $_POST['image'], $_POST['sell_price'], $date);
if(!$stmt2) { var_dump($conn->error()); }
$sell=$stmt2-> execute(); 

    if($sell){
        echo 1;
    }
    if(!$sell) {
        echo 0;
    }
?>
