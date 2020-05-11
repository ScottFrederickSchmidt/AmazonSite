<!DOCTYPE html>
 <?php  error_reporting(E_ALL);  ?>

    <html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=.8, maximum-scale=.8">
<!--, user-scalable=no-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<!--<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">-->
	<title>DTEC</title>
    <link rel="icon" type="image/png" href="images/D.png" />
   <!--       -->
     <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- datatable lib -->
 <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.css"/>
 <script src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.js"></script>
       <script src="js.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.3/holder.min.js"></script>
<script> 
function checkURL(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

$(document).ready(function() {
   var table=  $('#example').DataTable( {
       responsive: true,
        "processing": true,
        "serverSide": true,
        "searching": true,
        ajax: {
        url: 'server.php',
        type: 'POST',
        },
     columnDefs: [   { 
             targets: -1,
           render: function (data, type, row, meta) {
            return '<button type="submit" class="add_btn btn btn-warning btn-md active" data-id="' + meta.row + '"  id=" ' + meta.row + ' " data-toggle="modal" data-target="#insert_form"> <span class="fa fa-shopping-cart"></span> Add to Cart  </button>' ;
         }
         }
         ],
         
    })
} ); // end ready
</script>    
 
  <!--  CART TABLE -->
<script> 
$(document).ready(function() {
var table=  $('#example2').DataTable( {
       responsive: true,
        "processing": true,
        "serverSide": true,
        "responsive":true,
        ajax: {
        url: 'server2.php',
        type: 'POST',
        },
       drawCallback: function () {
      //  var sum = $('#example2').DataTable().column(4).data().sum();
    //    num=Math.round(sum * 100) / 100;
     //   num=num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      //  $('#cart-total').html("Total cart is: $"+num);
         var info = this.api().page.info();
        $(".shoppingbasket").append("<div class='basketitems'>" + info.recordsTotal + "</div>");
        
       $(".cart-num").html(info.recordsTotal);
        
           $.get( "common.php", function( data ) {
  $( ".common-php").html('Popular Item! '+data );
           });  
           $.get( "lastRow.php", function( data ) {
  $( "#lastRow").html(data);
           });  
                  $.get( "lastRowRec.php", function( data ) {
  $( "#lastRowRec").html(data);
           });  
        
        $.get( "sum.php", function( data ) {
               var total=data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $( ".sum-php").html('Total: $'+total );
});  
      },   
       columnDefs: [ 
         {  targets: -1,
         render: function (data, type, row, meta) {
             return '<button type="submit" class="delete_btn btn btn-danger btn-md active" id="' + meta.row + '" value="delete">  <span class="glyphicon glyphicon-trash"></span>  </button>  <button type="submit" class="edit_btn btn btn-success btn-md active" id="' + meta.row + '" data-id="' + meta.row + '" value="edit" name="edit_btn" data-toggle="modal" data-target="#editForm">  <span class="glyphicon glyphicon-pencil"></span> </button>  </a>';
         }
         }
        ]
   }) //end dt
} ); // end ready
</script>

   <script>
 $(document).on('click','.rec_btn',function (){
   var  rec_id=$(this).attr('id');
  // alert(rec_id);
    $.ajax({
            type:'POST',
            url:'add-rec.php',
            data: {
         rec_id:rec_id,
            }, 
              success: function(data){
         // alert(data); 
              if(data==1) {
                  alert("Successfully added"); 
              $('#example2').DataTable().ajax.reload();
              }if(data=='0'){
                  alert('wrong');
          }    
          } //end success
      }) //ajax
        }); //end doc
   </script>

<script>
 $(document).on('click','.add_btn',function (){
     var id = $(this).attr("id");
    
   var dataRow = $('#example').DataTable().row( id ).data();
   var name = dataRow[1];
   var price = dataRow[3].match(/\d+\.?\d*/);
   //.match(/\d+/);  
   
   $('#name').html(name);
   $('#price').html(price);
   $('#total').html(price);
 $('#qtd').prop('selectedIndex',0);
  // var qtd = $(this).closest('tr').find('select').val();
   var total3 = price*qtd;
      var total2 = total3.toFixed(2);
    total=total2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}); //end doc
        
 $(document).on('change','#qtd',function (){
var e = document.getElementById("qtd");
var qtd = e.options[e.selectedIndex].value;
var e = document.getElementById("qtd");
var qtd = e.options[e.selectedIndex].text;

   var price = $('#price').text();
   var total3 = price*qtd;
   var total2=total3.toFixed(2);
   var total=total2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#total').html(total);
        }); //end doc       
        </script>
        
<script>        
$(document).on('click','.sell-cancel_btn',function (){
    $('#image').val("");
              $('#sell_name').val("");
              $('#info').val("");
                $('#sell_price').val(""); 
                $('#image_mgs').html("");
               $('#sell_name_mgs').html("");
             $('#info_mgs').html("");
             $('#sell_price_mgs').html(""); 
});

$(document).on('click','#sold_btn',function (){
    var image= $.trim($("#image").val());
     var info= $.trim($("#info").val());
     var name= $.trim($("#sell_name").val());
        var sell_price=$('#sell_price').val();
        
    if(checkURL(image)==false ) {
        $('#image_mgs').text("Use .png or .jpg");
    }
    if (info=="") {
        $('#info_mgs').text("Cannot be blank");
    }
    if (name=="") {
        $('#sell_name_mgs').text("Cannot be blank");
    }
    if ( (sell_price<0 ) || (isNaN(sell_price)==false ) ) {
        $('#sell_price_mgs').text("Positive number");
    } 
    if (sell_price>0) {
        $('#sell_price_mgs').text("");
    }
    if (checkURL(image)==true) {
        $('#image_mgs').text("");
    }
    if (name.length>1) {
        $('#sell_name_mgs').text("");
    }
    if (info.length>1) {
        $('#info_mgs').text("");
    }
//var sell= $.trim($("#sell_price").val());

    if (checkURL(image)  && (sell_price>0) && (isNaN(sell_price)==false) && (info.length>0)  ) {
       $.ajax({
            type:'POST',
            url:'sell.php',
            data: {
                image: image,
                sell_name: $('#sell_name').val(),
                info: $('#info').val(),
                sell_price: $('#sell_price').val(),
            }, 
               success: function(data){
               if(data==1) {
                   $('#sell_form').modal('hide');
              $('#example').DataTable().ajax.reload();
              $('#image').html("");
              $('#sell_name').html("");
              $('#info').html("");
                $('#sell_price').html(""); 
                 $('#image_mgs').html("");
               $('#sell_name_mgs').html("");
             $('#info_mgs').html("");
             $('#sell_price_mgs').html(""); 
              alert("Added item for sale"); 
               }if(data=='0'){
                  alert('wrong');
           }    
           } //end success
      }) //ajax
    }
        }); //end doc
        </script>        

<script>
 $(document).on('click','.insert_btn',function (){
name=$('#name').text();
price=$('#price').text();
total=$('#total').text();

// Math.round(num * 100) / 100
total=Math.round(total * 100) / 100;
// total=total.toFixed(2);
// https://stackoverflow.com/questions/14190433/javascript-rounding-to-two-decimal-places

var e = document.getElementById("qtd");
var qtd = e.options[e.selectedIndex].value;
var e = document.getElementById("qtd");
var qtd = e.options[e.selectedIndex].text;

$('#insert_form').modal('hide');
    $.ajax({
            type:'POST',
            url:'add.php',
            data: {
                name: name,
                price: price,
                qtd: qtd,
                total:total,
            }, 
               success: function(data){
           // alert(data); 
               if(data==1) {
                  alert("Successfully added "+name+" to your cart"); 
              $('#example2').DataTable().ajax.reload();
              //$('#total').html("");
              $('#qtd').prop('selectedIndex',0);
               }if(data=='0'){
                  alert('wrong');
           }    
           } //end success
      }) //ajax
        }); //end doc
        </script>
        
         <script> 
    $(document).on('click','.delete_btn',function (){
         var id = $(this).attr("id");
        var dataRow = $('#example2').DataTable().row( id ).data();
        var del_id = dataRow[0];
               //  .match(/\d+\.?\d*/);
        var name = dataRow[1];
        //alert(del_id);

        if (confirm('Are you sure you want to delete item: '+ name+' order number: '+ del_id)) {
        $.ajax({
            type:'POST',
            url:'delete.php',
            //dataType: "json",
            data: {del_id:del_id}, 
            success: function(data){ 
           // alert(data);
                if (data==1) {
                    alert(name+" Successfully removed from cart.");
                     $('#example2').DataTable().ajax.reload();
                } if (data==0) {
                 alert('something wrong');
                }
                  } // end success
                     }) //end ajax
        } // end confirm
        }); //end doc
   </script>
   
<script>
 $(document).on('click','.edit_btn',function (){
     var id = $(this).attr("id");
     var dataRow = $('#example2').DataTable().row( id ).data();
     var edit_id=dataRow[0];
     // https://stackoverflow.com/questions/19966417/prevent-typing-non-numeric-in-input-type-number
  $.ajax({
            type:'POST',
            url:'editRow.php',
            //dataType: "json",
            data: {edit_id:edit_id}, 
            success: function(data){
               $('#edit-qtd').val(data);
            }
  })
 
  var name = dataRow['1'];
  var price = dataRow[2].match(/\d+\.?\d*/);
  var qtd = $('#edit-qtd').text();
var total = dataRow[4].match(/\d+\.?\d*/);
  //.match(/\d+/);  
//   var e = document.getElementById("edit-qtd");
// var qtd = e.options[e.selectedIndex].value;
 $('#edit-id').html(edit_id);
 $('#edit-name').html(name);
$('#edit-price').html(price);
  $('#edit-total').html(total);
// // $('#edit-qtd').prop('selectedIndex',0);
// // //   // var qtd = $(this).closest('tr').find('select').val();
//  var totalOne = price*qtd;
// total=totalOne.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}); //end doc
</script>

<script>
// https://stackoverflow.com/questions/995183/how-to-allow-only-numeric-0-9-in-html-inputbox-using-jquery
$(document).ready(function() {
    (function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      }
    });
  };
}(jQuery));
    
$(".numbers-positive").inputFilter(function(value) {
    // #uintTextBox
  return /^\d*$/.test(value); });
  
  $("#currencyTextBox").inputFilter(function(value) {
  return /^-?\d*[.,]?\d{0,2}$/.test(value); });
}); //end ready

     // https://stackoverflow.com/questions/8747439/detecting-value-change-of-inputtype-text-in-jquery
 $(document).on('change paste keyup touchend','#edit-qtd',function (){
var price=$('#edit-price').text();
var qtd=$('#edit-qtd').val();

 var total3 = price*qtd;
 var total2 = total3.toFixed(2);
 var total=total2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
$('#edit-total').html(total);
}); // end keyup
</script>

<script>
 $(document).on('click','.update_btn',function (){
var edit_id=$('#edit-id').text();
var price=$('#edit-price').text();
var qtd=$('#edit-qtd').val();
var total=price*qtd;
    $.ajax({
            type:'POST',
            url:'update.php',
            //dataType: "json",
            data: {
                edit_id:edit_id,
                qtd:qtd,
                total:total,
            }, 
            success: function(data){ 
           // alert(data);
                if (data==1) {
                    alert("Purchase Updated");
                     $('#example2').DataTable().ajax.reload();
                     $('#editForm').modal('hide');
                } if (data==0) {
                 alert('something wrong');
                }
                  } // end success
                     }) //end ajax
 }); // end doc
   </script>     
   
   <script>
 $(document).on('click','.cart_qtd',function (){
   var id = $(this).attr("id");
var rowData = $('#example2').DataTable().row( id ).data();
var id= rowData[0].match(/\d+\.?\d*/);
var price = rowData[2].match(/\d+\.?\d*/);
// var e = document.getElementById("cart_qtd");
// var qtd = e.options[e.selectedIndex].value;
// var e = document.getElementById("cart_qtd");
// var qtd = e.options[e.selectedIndex].text;

// var name = $(this).closest('tr').find('.contact_name').text();
var edit_id = $(this).closest('tr').find('.cart_id').text();

string=$(this).closest('tr').find('.cart_price').text();
cart_price=string.match(/\d+\.?\d*/);
var cart_total=$(this).closest('tr').find('.cart_total');
var cart_qtd = $(this).closest('tr').find('select').val();

total=cart_price*cart_qtd;
//total=Math.max( Math.round(number * 10) / 10).toFixed(2);

cart_total.text('$'+total);
 $.ajax({
            type:'POST',
            url:'edit.php',
            data: {
                edit_id: edit_id,
                total: total,
                qtd: cart_qtd,
            }, 
               success: function(data){
           // alert(data); 
               if(data==1) {
                     $.get( "sum.php", function( data ) {
  $( ".sum-php").html('Total: $'+data );
});  
              // alert("Successfully updated cart! Refresh page to double check =)"); 
               }if(data=='0'){
                  alert('wrong');
           }    
           } //end success
      }) //ajax
        }); //end doc
        </script>
        
        <script>
             $(document).on('click','#range-btn',function (){
                 var max=$('#max-price').val();
                 var min=$('#min-price').val();
                 //alert(max);
$.ajax({
            type:'POST',
            url:'range-search.php',
            data: {
               min:min,
               max:max,
            }, 
               success: function(data){
           alert(data); 
               if(data==1) {
             //alert("SEARCH"); 
               }if(data=='0'){
                  alert('wrong');
           }    
           } //end success
      }) //ajax
             }); //end ready
        </script>

          <script>
         function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
     </script>
       <script src="js.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.3/holder.min.js"></script>
       
       <script>
  $(document).ready(function() {
$.get("https://api.iextrading.com/1.0//stock/qqq/batch?types=quote,=1m&last=1", function(data, status){
      var qqq_price=data.quote.latestPrice;
      var qqq_change=data.quote.change;
      var qqq_percent= qqq_change/qqq_price*100;
      if(qqq_percent>0) {
          $('#qqq-percent').addClass('green-text');
      } else{
          $('#qqq-percent').addClass('red-text');
      }
     $('#qqq-info').html(data);
       $('#qqq-price').html(qqq_price);
      $('#qqq-change').html('$'+qqq_change);
        $('#qqq-percent').html(qqq_percent.toFixed(2)+'%');
  }); 
    
      $.get("https://api.iextrading.com/1.0//stock/dia/batch?types=quote,=1m&last=1", function(data, status){
      var dia_price=data.quote.latestPrice;
      var dia_change=data.quote.change;
      var dia_percent= dia_change/dia_price*100;
         if(dia_percent>0) {
          $('#dia-percent').addClass('green-text');
      } else{
          $('#dia-percent').addClass('red-text');
      }
      
     $('#dia-info').html(data);
      $('#dia-price').html(dia_price);
      $('#dia-change').html('$'+dia_change);
        $('#dia-percent').html(dia_percent.toFixed(2)+'%');
  }); 
     $.get("https://api.iextrading.com/1.0//stock/spy/batch?types=quote,=1m&last=1", function(data, status){
      var spy_price=data.quote.latestPrice;
      var spy_change=data.quote.change;
      var spy_percent= spy_change/spy_price*100
            if(spy_percent>0) {
          $('#spy-percent').addClass('green-text');
      } else{
          $('#spy-percent').addClass('red-text');
      }
     $('#spy-info').html(data);
      $('#spy-price').html(spy_price);
      $('#spy-change').html('$'+spy_change);
        $('#spy-percent').html(spy_percent.toFixed(2)+'%');
  }); 
    
     $.get("https://api.iextrading.com/1.0//stock/dia/batch?types=quote,=1m&last=1", function(data, status){
      var iwm_price=data.quote.latestPrice;
      var iwm_change=data.quote.change;
      var iwm_percent= iwm_change/iwm_price*100;
     $('#iwm-info').html(data);
      $('#iwm-price').html(iwm_price);
      $('#iwm-change').html('$'+iwm_change);
        $('#iwm-percent').html('Small Caps '+iwm_percent.toFixed(2)+'%');
  }); 
    }); 
</script>

<script>   
   $(document).ready(function() {
  $.get("https://ipinfo.io/json", function(response) {
 // console.log(response);
    var state=response.region;
    var country=response.country;
    var ip=response.ip;
    var zip=response.postal;
    var loc=response.loc;
    var city=response.city;
    $('#state').html(state);
    $('#country').html(country);
    $('#city').html(city);
    $('#ip').html(ip);
    $('#zip').html(zip);
    $('#loc').html(loc);
    
     var key = '&APPID=767a7cce68ed2b3098d41e24364ec56c';
     var url='http://api.openweathermap.org/data/2.5/weather?q='+city+','+state+country+key;
    var proxy = 'https://cors-anywhere.herokuapp.com/';
       
     $.getJSON(proxy + url, function(data) {
    //   console.log(data);
     var cond= data.weather[0].main;
       var icon= data.weather[0].icon;
      
       var tempC=Math.round(data.main.temp- 273.15);
         var tempF = Math.round(tempC * (9 / 5) + 32);
                var tempMaxC=Math.round(data.main.temp_max- 273.15);
         var tempMaxF = Math.round(tempMaxC * (9 / 5) + 32);
       
            var tempMinC=Math.round(data.main.temp_min- 273.15);
         var tempMinF = Math.round(tempMinC* (9 / 5) + 32);
    
        $('#tempF').html(tempF+'°F');
      $('#tempMaxF').html(tempMaxF+'°F');
      $('#tempMinF').html(tempMinF+'°F / ');
         
      $('#cond').html(cond);
      $('#tempC').html(tempC+'°C');
       $('#tempF').html(tempF+'°F');
       var weatherIcon = 'http://openweathermap.org/img/w/' + icon + '.png';
       $('#weatherIcon').html('<img src=' + weatherIcon + '>');
        });
  }); // end ip api
  
  // START NEWS-SECTION BACKGROUND CHANGE
  var imageHead = document.getElementById("news-section");
var images = [
  "https://images.freecreatives.com/wp-content/uploads/2016/02/Light-Aqua-Blue-Background-Free-Download.jpg",
  "https://www.psdgraphics.com/file/blurry-lights.jpg",
 // "https://weststreetwillyseatery.com/wp-content/uploads/2016/03/Top-10-best-Simple-Awesome-Background-Images-for-Your-Website-or-Blog2.jpg",
 // "http://getwallpapers.com/wallpaper/full/6/7/9/401029.jpg"
]

var i = 0;
setInterval(function() {
      imageHead.style.backgroundImage = "url(" + images[i] + ")";
      i = i + 1;
      if (i == images.length) {
        i =  0;
      }
}, 2000);
});
</script>
</head>
 <!--  BODY   -->
<body>

 <?php include('nav.php'); ?>    
 
   <!--https://stackoverflow.com/questions/2387496/how-to-prevent-robots-from-automatically-filling-up-a-form-->
  <input type="email" class="none" value="Fake inputs to trick bots. see above link" />
    <input type="password" class="none" value="Fake inputs to trick bots. see above link" />
    
      <!-- SELLL FORM MODAL -->
  
<div class="modal fade" id="sell_form" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
    	<div class="modal-header">
			<button type="button" id=“sell-cancel_btn” class="close sell-cancel_btn" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title">Sell Item</h3>
		</div>
		<div class="modal-body">
 <form class="form-inline" action="index.php" method="post">

<div class="form-group">
  <label class="col-md-4 control-label" >Image-URL</label> <br><br>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="text" id="image" class="sells" pattern="[.(jpeg|jpg|gif|png)$]" aria-required="true" />
<span class="red-text sells" id="image_mgs"></span>
</div> </div> </div> <br>

<div class="form-group">
 <label class="col-md-4 control-label" >Name</label> <br>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="text" id="sell_name" class="sells">
<span class="red-text sells" id="sell_name_mgs"></span>
</div> </div></div>  <br>

<div class="form-group">
 <label class="col-md-4 control-label" >Info</label> <br>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
<input type="text" id="info" class="sells" name="info" maxlength="50">
<span class="red-text sells" id="info_mgs"></span>
</div></div>  </div>  <br>

<div class="form-group">
 <label class="col-md-4 control-label" >Price</label> <br>
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>    
<input type="text" pattern="/\d+\.?\d*/" id="sell_price" class="sells">
<span class="red-text sells" id="sell_price_mgs"></span>
</div> </div> </div>  <br>

<button type="button" class="btn btn-success btn-md active" id="sold_btn"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
<button class="btn btn-danger btn-md active sell-cancel_btn" type="submit" id="sell-cancel_btn" value="Cancel" data-dismiss="modal">Cancel</button>
</form>  

</div></div></div></div>
 
   <!--INSERT FORM MODAL -->
<div class="modal fade" id="insert_form" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		
<img src="images/dtec-logo.png" class="dtec" alt="DTEC">
   
			<!--<h3 class="modal-title">Add to Cart</h3>-->
		</div>
		<div class="modal-body">
 
 <form id="form1" class="form-inline" method="post">
<div class="form-group">
<label>Name</label>
<span id="name"></span>
</div> <br>
<div class="form-group">
    <label>Price</label>
<span id="price" ></span>
</div> <br>
<label>Quanity</label>
<select id="qtd">
  <option selected="selected" value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
</select> <br>

<div class="form-group">
 <label>Total</label>
<span id="total"></span>
</div> <br>

<button type="button" class="btn btn-success btn-md active insert_btn" name="save" id="insert_btn"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
<button class="btn btn-danger btn-md active" type="submit" name="close" value="Cancel" data-dismiss="modal">Cancel</button>
</form>  

</div></div></div></div>

<!-- EDIT FORM MODAL -->
<div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
    	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
		
<img src="images/dtec-logo.png" class="dtec" alt="DTEC">
   
			<h3 class="modal-title">Edit Cart</h3>
		</div>
		<div class="modal-body">
 
 <form class="form-inline" method="post">
<div class="form-group">
<label>Name</label>
<span id="edit-name"></span>
</div> <br>
<div class="form-group">
    <label>Price</label>
<span id="edit-price" ></span>
</div> <br>
<label>Quanity</label>
<input id="edit-qtd" class="numbers-positive" maxlength="2" size="5" pattern="^[0-9]*$" />
<br>
<div class="form-group">
 <label>Total</label>
<span id="edit-total"></span>
</div> <br>

<span class="hidden" id="edit-id"></span>
<input type="hidden" id="new-date" value='' >

<button type="button" class="btn btn-success btn-md active update_btn" name="save" id="update_btn"><span class="glyphicon glyphicon-plus-sign"></span>Update</button>
<button class="btn btn-danger btn-md active" type="submit" name="close" value="Cancel" data-dismiss="modal">Cancel</button>
</form>  

</div></div></div></div>

   <!-- 
   <p class="center"><a href="https://datatables-ajax.000webhostapp.com/" target="_blank">CRUD </a> Datatable Example</p> </div>
   -->

 <!--    <div class="shoppingbasket floated right-float"> 
  <div class="top" id="cartCount"></div>
  <div class="bottom"></div>
  <div class="left"></div>
  <div class="right"></div>
</div>

   <button id="cart-num" class="test btn-md right-float circle bold red white-text"></button>
-->  

<section id="news-section">
    <h5 class="none">fake header to pass HMLT5 validation test</h5>
<div class="container-fluid">
    <div class="row">
        
<div class="col-md-2 col-xs-3 hideClass2 hideClass">           
 <p class="common-php hideClass" id="common-php">
        </div>
        
<div class="col-md-2 col-xs-3">   
 <p class="bold">SP500: <span id="spy-percent"></span>
 <p class="bold">Dow: <span id="dia-percent"></span>
    <p class="bold hideClass">Nasdaq: <span id="qqq-percent"></span>
  </div>
<div class="col-md-2 col-xs-3">    
         <span class="no-padding" id="tempF"></span>
         <span class="no-padding" id="cond"></span>
         <br>
          <span class="no-padding" id="weatherIcon"></span>
          <br>
          <span class="hideClass2" id="tempMinF"></span>
         <span class="hideClass2" id="tempMaxF"></span>
         </div>
         
<div class="col-md-2 hideClass3">   
    <span>Deliver To</span>
    <br>
<span id="city"></span>
<br>
<span id="state"></span>
<br>
<span id="zip"></span>
</div>

<div class="col-md-2 col-xs-3">   
<i class="cart-num right-float no-padding glyphicon glyphicon-circle bold red white-text"></i> 
<br>
<i class="cart-icon right-float no-padding glyphicon glyphicon-shopping-cart"></i> 
        <p class="sum-php right-float" ></p>
        </div>
        
</div></div>  <!--  row and container-->
 </section>
 
 <?php include('horo.php'); ?>

 <!--  =========MAIN TABLE=======    -->
<!--<div class="container-fluid">-->
</div>
<section id="table-section">
        <h5 class="none">fake header to pass HMLT5 validation test</h5>
      <div class="center">
<button class="btn btn-primary" id="sell_btn" data-toggle="modal" data-target="#sell_form"> <span class="fa fa-exchange" aria-hidden="true"></span> Sell Item </button>
</div>
    
<div class="container-fluid" style="text-align:center;">
   <table class="display table center width300 width-half smart_table">
       <tr>
       <th style="background-color:darkorange" class="bold">Smart Search</th> 
        <tbody>
            <tr id="filter_col2" class="" data-column="1">
                 <td class=""><input size="15" type="text" class="column_filter center" id="col1_filter" placeholder="Item"></td>
            </tr>
              <tr id="filter_col3"  class="" data-column="2">
                 <td class=""><input size="15" type="text" class="column_filter center" id="col2_filter" placeholder="Info"></td>
            </tr>
           </tbody>
    </table>   <br>
        </div>  
      
    <div class="row">
<div id="left-table" class="hideClass2 col-lg-1">
<!--<table class="display table table-responsive smart_table"> -->
<!--<thead>-->
<!--    <tr>-->
<!--       <th class="left bold">Search</th> -->
<!--       </tr>-->
<!--       </thead>-->
<!--        <tbody>-->
<!--            <tr id="filter_col2"  class="" data-column="1">-->
<!--                 <td class="left"><input size="3" type="text" class="column_filter left" id="col1_filter" placeholder="Item"></td>-->
<!--            </tr>-->
<!--              <tr id="filter_col3"  class="" data-column="2">-->
<!--                 <td class="left"><input size="3"  type="text" class="column_filter left" id="col2_filter" placeholder="Info"></td>-->
<!--            </tr>-->
<!--           </tbody>-->
<!--    </table>   -->
    
    <span class="left bold hideClass4">Price </span>
    <a href="https://datatables-ecom.000webhostapp.com/filter.php" class="price" id="100">Under 100</a>
  <a href="https://datatables-ecom.000webhostapp.com/filter500.php" class="price" id="500">Over 500</a>
  <input  id="min-price" size="3" class="number-positive" maxlength="4" placeholder="Min Price">
  <input id="max-price" size="3" class="number-positive" maxlength="4" placeholder="Max Price">
  <br>
  <button id="range-btn" class="btn btn-xs">Search</button>
  <br>
    </div>    
    
<div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
     
<table id="example" class="display table-responsive no-padding" style="width:100%">
    <thead>
        <tr>
              <th class="no-sort">Image</th>
                <th>Name</th>
                <th>Info</th>
               <th>Price</th>
               <th class="no-sort">Action</th>
        </tr>
</thead>
    </table> 
    </div></div> 
 <!--  ====CART====    -->
 <br>
 </section>
 
 <section id="cart-section">
     <div class="center">
         <br>
     <h2 class="no-padding">Your Shopping Cart</h2>
     </div>

<i class="cart-num right-float no-padding glyphicon glyphicon-circle bold red white-text"></i> 
<br>
<i  class="cart-icon right-float no-padding glyphicon glyphicon-shopping-cart"></i> 

<div class="sum-php right-float" ></div>

    <table id="example2" class="display table-responsive" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                     <th>QTD</th>
                      <th>Total</th>
                <th class="no-sort">Action</th>
        </tr>
</thead>
    </table>
    <br>
</section>

<section id="recommendation-section">
    <h3 class="orange-text">Recommendations</h3>
    <h4>Because you bought <span id="lastRow"></span>
we recommend: <span id="lastRowRec"></span></h4>
</section>
<br>

<section id="piechart-section">
    <div class="container center">
    <h2 class="no-padding">All Sales Pie Chart</h2>
<br>
</div>

 <?php include('piechart.php'); ?>
 <br>
</section>
      <button id="footer_btn" onclick="topFunction()" class="" type="button">Back to top</button>

    <section class="footer center">
   <footer class="center">
        <div class="container">
        <div class="row">
  <div class="col-md-4">
      <h4 class="orange-hover">Get to Know Us</h4>
  <p class="orange-hover">Careers</p>
   <p class="orange-hover">About Us</p>
    <p class="orange-hover">Investor Relations</p>
  </div>
  <div class="col-md-4">  
  <h4 class="orange-hover">Make Money</h4>
  <p class="orange-hover">Sell Items</p>
   <p class="orange-hover">Sell Ads</p>
    <p class="orange-hover">Advertise Your Products</p>
  </div>
  
  <div class="col-md-4">
 <h4 class="orange-hover">Social Media</h4>
<p class="orange-hover">Email: <a href="mailto:scott.schmidt1989@yahoo.com">
          <span class="glyphicon glyphicon-envelope"> </span></a>
        <p class="orange-hover">Subscribe: <a href="https://datatables-ecommerence.000webhostapp.com/PricingSubscriptions.php/sign-up.php" target="_blank"><span class="glyphicon glyphicon-ok"> </span></a>
         <p class="orange-hover">Phone: <a href="https://amazon.com"><span class="glyphicon glyphicon-phone"> </span></a>
        </div>
    <!--row-->    </div>
      <!--container-->    </div> 
  <br>
</footer>
</section>
<!--        <p id="header" class="center"> DataTables E-Commerence </p>-->
<section id="logo-footer">
<div class="container text-center">
<img src="images/dtec-logo.png" class="dtec" height="50" width="150" alt="DTEC">   

<div class="dropdown word-wrap">
  <div class="dropbtn"><h5 class="dropdown white-text"><i style="font-size: 14px;"  class="glyphicon glyphicon-globe"></i>English</h5></div>
  <div class="dropdown-content">
    <a href="#">English</a>
    <a href="#">Spanish</a>
  </div> </div> 

<div class="dropdown word-wrap">
 <div class="dropbtn"><h5 class="dropdown white-text"><i  style="font-size: 14px;"  class="glyphicon glyphicon-flag"></i>United States</h5></div>
  <div class="dropdown-content">
    <a href="#">Mexico</a>
    <a href="#">United States</a>
    <a href="#">Canada</a>
  </div>
</div> 
</div>   <!-- container -->
  <!--<h5 class="dropdown word-wrap white-text"><i id="cart-icon" style="font-size:.9em;"  class="glyphicon glyphicon-globe">English</h5></i> -->
</section>
<section id="bottom">
    <h5 class="none">test</h5>
    <br>
    <div class="text-center">Conditions of Use 2019, DTEC.com, Inc. or its affiliates</div>
</section>
      </body>
       </html>
        
        
