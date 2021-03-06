$(function(){

	// Get current path and find target link
	var path = window.location.pathname.split("/");

	// Account for home page with empty path
	// if(path == ''){
	// 	path = 'index.php';
	// }

	// Add active class to target link
	$('.nav-sidebar li a[href="'+path[1]+'"]').parent().addClass('active');

	// Datepicker plugin
	$('#datepicker').datepicker({dateFormat: 'yy-mm-dd'});

	// Confirm to delete any information to the table
	$('.delete_item').click(function(){
		return confirm('¿Está seguro que desea eliminar este registro?');
	});


	// showing & hiding arrows 
	$('.fa-angle-double-left').hide();

	$('.table-responsive').scroll(function(){
		var scroll = $('.table-responsive').scrollLeft();

		if(scroll >= 1){
			$('.fa-angle-double-left').show();
			$('.fa-angle-double-right').hide();
		}else{
			$('.fa-angle-double-left').hide();
			$('.fa-angle-double-right').show();
		}
	});

});