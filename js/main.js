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
	$('#delete_product').click(function(){
		return confirm('Estas seguro de eliminar este producto?');
	});

	$('#delete_sale').click(function(){
		return confirm('Estas seguro de eliminar esta venta?');
	});

	$('#delete_purchase').click(function(){
		return confirm('Estas seguro de eliminar esta compra?');
	});

});