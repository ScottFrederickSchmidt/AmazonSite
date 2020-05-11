<?php
$conn_cart = mysqli_connect($l, $u, $p, $d);
//http://www.mysqltutorial.org/select-nth-highest-record-database-table-using-mysql.aspx
// https://www.anychart.com/blog/2017/12/06/pie-chart-create-javascript/
// https://stackoverflow.com/questions/49564705/create-a-pie-chart-using-an-array-from-a-data-table-in-chart-js
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script src="https://cdnjs.com/libraries/Chart.js"></script>

<?php
$countAll="select count(*) from tbl";
$countAll=mysqli_query($conn_cart, $countAll);
$count = $countAll->fetch_array(MYSQLI_NUM);

$amdchip="select count(*) from tbl where name='AMD Chip' ";
$amdchip=mysqli_query($conn_cart, $amdchip);
$amdchip = $amdchip->fetch_array(MYSQLI_NUM);

// echo round($amdchip[0]/$count[0], 2);
// echo "<br>";

$nvdachip="select count(*) from tbl where name='NVDA Chip' ";
$nvdachip=mysqli_query($conn_cart, $nvdachip);
$nvdachip = $nvdachip->fetch_array(MYSQLI_NUM);

// echo round($nvdachip[0]/$count[0], 2);
// echo "<br>";

$rokuWS="select count(*) from tbl where name='Roku Wireless Speakers' ";
$rokuWS=mysqli_query($conn_cart, $rokuWS);
$rokuWS = $rokuWS->fetch_array(MYSQLI_NUM);

// echo round($rokuWS[0]/$count[0], 2);
//  echo "<br>";
 
$AmazonED="select count(*) from tbl where name='Amazon Echo Dot' ";
$AmazonED=mysqli_query($conn_cart, $AmazonED);
$AmazonED = $AmazonED->fetch_array(MYSQLI_NUM);

// echo round($AmazonED[0]/$count[0], 2);
//  echo "<br>";
 
 $PackersRJ="select count(*) from tbl where name='Packers Rogers Jersey'";
$PackersRJ=mysqli_query($conn_cart, $PackersRJ);
$PackersRJ = $PackersRJ->fetch_array(MYSQLI_NUM);

// echo round($PackersRJ[0]/$count[0], 2);
//  echo "<br>";
 
$TeslaMS="select count(*) from tbl where name='Tesla Model S'";
$TeslaMS=mysqli_query($conn_cart, $TeslaMS);
$TeslaMS = $TeslaMS->fetch_array(MYSQLI_NUM);

// echo round($TeslaMS[0]/$count[0], 2);
//  echo "<br>";
 
 $PackersHat="select count(*) from tbl where name='Packers Hat'";
 $PackersHat=mysqli_query($conn_cart,  $PackersHat);
 $PackersHat =  $PackersHat->fetch_array(MYSQLI_NUM);

// echo round( $PackersHat[0]/$count[0], 2);
//  echo "<br>";
 
  $Tesla3="select count(*) from tbl where name='Tesla 3'";
  $Tesla3=mysqli_query($conn_cart,   $Tesla3);
  $Tesla3 =   $Tesla3->fetch_array(MYSQLI_NUM);

// echo round(  $Tesla3[0]/$count[0], 2);
//  echo "<br>";
 
   $RokuR="select count(*) from tbl where name='Roku Remote'";
 $RokuR=mysqli_query($conn_cart,   $RokuR);
 $RokuR =   $RokuR->fetch_array(MYSQLI_NUM);
 
$AppleR="select count(*) from tbl where name='Apple Remote'";
 $AppleR=mysqli_query($conn_cart,   $AppleR);
 $AppleR =   $AppleR->fetch_array(MYSQLI_NUM);
 
 $AppleMac="select count(*) from tbl where name='Apple Mac'";
 $AppleMac=mysqli_query($conn_cart,   $AppleMac);
 $AppleMac =   $AppleMac->fetch_array(MYSQLI_NUM);

// echo round(  $RokuR[0]/$count[0], 2);
//  echo "<br>";
 
$AmazonE="select count(*) from tbl where name='Amazon Echo'";
 $AmazonE=mysqli_query($conn_cart,   $AmazonE);
$AmazonE =   $AmazonE->fetch_array(MYSQLI_NUM);

// echo round( $AmazonE[0]/$count[0], 2);
//  echo "<br>";
 
 $Intel8G="select count(*) from tbl where name='Intel 8 Gen Process'";
 $Intel8G=mysqli_query($conn_cart,   $Intel8G);
$Intel8G = $Intel8G->fetch_array(MYSQLI_NUM);

// echo round( $Intel8G[0]/$count[0], 2);
//  echo "<br>";
 
  $Intel8GB="select count(*) from tbl where name='Intel 8GB'";
$Intel8GB=mysqli_query($conn_cart, $Intel8GB);
$Intel8GB =$Intel8GB->fetch_array(MYSQLI_NUM);

// echo round( $Intel8GB[0]/$count[0], 2);
//  echo "<br>";
 
   $RokuSTV="select count(*) from tbl where name='Roku Smart TV'";
$RokuSTV=mysqli_query($conn_cart, $RokuSTV);
$RokuSTV=$RokuSTV->fetch_array(MYSQLI_NUM);

// echo round($RokuSTV[0]/$count[0], 2);
//  echo "<br>";
 
$amdr="select count(*) from tbl where name='AMD Ryzen'";
$amdr=mysqli_query($conn_cart, $amdr);
$amdr=$amdr->fetch_array(MYSQLI_NUM);

$Intel7="select count(*) from tbl where name='Intel i7 Chip'";
$Intel7=mysqli_query($conn_cart, $Intel7);
$Intel7 =$Intel7->fetch_array(MYSQLI_NUM);

$IntelTab="select count(*) from tbl where name='Intel Tablet'";
$IntelTab=mysqli_query($conn_cart, $IntelTab);
$IntelTab =$IntelTab->fetch_array(MYSQLI_NUM);

$IntelPro="select count(*) from tbl where name='Intel Projector'";
$IntelPro=mysqli_query($conn_cart, $IntelPro);
$IntelPro =$IntelPro->fetch_array(MYSQLI_NUM);

$IntelNote="select count(*) from tbl where name='Intel Notebook'";
$IntelNote=mysqli_query($conn_cart, $IntelNote);
$IntelNote =$IntelNote->fetch_array(MYSQLI_NUM);
// echo round($amdr[0]/$count[0], 2);
//  echo "<br>";
 ?>
 
 <table id="myTable" class="none">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
    <tr>
      <th>Amd Chip</th>
      <td> <?php echo $amdchip[0]?> </td>
    </tr>
    <tr>
      <th>NVDA Chip</th>
      <td><?php echo $nvdachip[0]?></td>
    </tr>
    <tr>
      <th>Roku Wireless Speakers</th>
      <td><?php echo $rokuWS[0]?></td>
    </tr>
     <tr>
      <th>Amazon ED</th>
      <td><?php echo $AmazonED[0]?></td>
    </tr>
     <tr>
      <th>Aaron Rogers Jersey</th>
      <td><?php echo  $PackersRJ[0]?></td>
    </tr>
     <tr>
      <th>Tesla </th>
      <td><?php echo $TeslaMS[0]?></td>
    </tr>
     <tr>
      <th>Amazon Echo</th>
      <td><?php echo $AmazonE[0]?></td>
    </tr>
     <tr>
      <th>Intel 8G</th>
      <td><?php echo $Intel8G[0]?></td>
    </tr>
        <tr>
      <th>Roku Smart TV</th>
      <td><?php echo $RokuSTV[0]?></td>
    </tr>
        <tr>
      <td>AMD Ryzen</td>
      <td><?php echo $amdr[0]?></td>
    </tr>
     <tr>
      <td>Roku Remote</td>
      <td><?php echo $RokuR[0]?></td>
    </tr>
    <tr>
      <td>Apple Remote</td>
      <td><?php echo $AppleR[0]?></td>
    </tr>
    <tr>
      <td>Apple Mac</td>
      <td><?php echo $AppleMac[0]?></td>
    </tr>
    <tr>
        <td>Intel i7 Chip</td>
      <td><?php echo $Intel7[0]?></td>
    </tr>
    <tr>
     <td>Intel Tablet</td>
      <td><?php echo $IntelTab[0]?></td>
    </tr>
    <tr>
      <td>Intel Projector</td>
      <td><?php echo $IntelPro[0]?></td>
    </tr>
    <tr>
     <td>Intel Notebook</td>
      <td><?php echo $IntelNote[0]?></td>
    </tr>
</table>

 <br><br>

<canvas class="col-xs-12 col-sm-12" id="pieChart" ></canvas>

<script>
var table = document.getElementById("myTable");
var tableLen = table.rows.length;
var data = {labels: [], count: [] }

for (var i = 1; i < tableLen; i++) {
  data.labels.push(table.rows[i].cells[0].innerText)
  data.count.push(table.rows[i].cells[1].innerText.replace(',',''))
}
var canvasP = document.getElementById("pieChart");
var ctxP = canvasP.getContext('2d');
var myPieChart = new Chart(ctxP, {
  type: 'pie',
  data: {
    labels: data.labels,
    datasets: [{
      data: data.count,
      backgroundColor: ["#fff7fb", "#d0d1e6",  "#74a9cf", "#0570b0", "#525252", "#3f007d", 
      "#807dba", "#fb6a4a", "#ef3b2c", "#49006a", "#dd3497", "#fff7fb", "#d0d1e6",  "#74a9cf", "#0570b0", "#023858"],
      // http://colorbrewer2.org/#type=sequential&scheme=BuGn&n=9 
      hoverBackgroundColor:["black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black", "black"]
    }]
  },
  options: {
    legend: {
      display: true,
      position: "bottom"
    }
  }
})
</script>
