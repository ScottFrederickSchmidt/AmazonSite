$(document).ready(function() {
function filterGlobal () {
    $('#example').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}
 
function filterColumn ( i ) {
    $('#example').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}
 
$(document).ready(function() {
    $('#example').DataTable();
 
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
 
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );
} ); //end

 $(document).on('click','price', function (){
     $.ajax({
            type:'POST',
            url:'price.php',
            data: {
                num1:num1,
                num2:num2
            }, 
               success: function(data){
           // alert(data); 
               if(data==1) {
                   
               }if(data=='0'){
                  alert('wrong');
           }    
           } //end success
      }) //ajax
        }); //end doc
