<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<title>DTEC</title>
    <link rel="icon" type="image/png" href="images/D.png" />
   <!--       -->
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet<" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- datatable lib -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.css"/>
 <script src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.js"></script>
 <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>

<table id="example3" class="display" >
<thead>
<tr>
<th>ID</th>
 <th>Name</th>
  <th>Image</th>
 <th>Info</th>
 <th>Price</th>
</tr>
</thead>

<script>
$(document).ready(function() {
    $('#example3').DataTable().draw;
} );
</script>

<?php
// https://coderexample.com/datatable-custom-column-search/
 $database ="";
$local = "localhost";
$username = "";
$password = "";

// Create connection
$conn = mysqli_connect($local, $username, $password, $database);


$records = "SELECT * from tbl where price>100";
$records=mysqli_query($conn, $records);

$row = mysqli_fetch_array($records);
if (!$row) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while ($row = mysqli_fetch_array($records)) { ?>
<tr>
<td><?php echo $row['id']; ?> </td>
<td><?php echo $row['name']; ?> </td>
<td><img class='zoom' src='<?php echo $row['image'];?>' style='height:90px;width:90px;align:middle;'/> </td>
<td><?php echo $row['info']; ?> </td>
<td>$<?php echo $row['price']; ?> </td>

<!--<td>-->
<!--<a href="edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-success edit_btn glyphicon glyphicon-pencil"></a>-->
<!--<a href="index.php?del=<?php echo $row['id']; ?>" class="btn btn-danger del_btn glyphicon glyphicon-trash" onclick="return confirm('Are you sure you want to delete this item?');"></a> -->
<!--</td>-->

</tr>
<?php
}
?>
    </tbody>
     </table>
