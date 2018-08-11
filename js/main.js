$(function(){

	// Get current path and find target link
	var path = window.location.pathname.split("/");
	console.log(path);

	// Account for home page with empty path
	// if(path == ''){
	// 	path = 'index.php';
	// }

	// Add active class to target link
	$('.nav-sidebar li a[href="'+path+'"]').addClass('active');


	// Datepicker plugin
	$('#datepicker').datepicker();

});