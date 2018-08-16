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

});