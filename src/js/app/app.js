$(document).ready(function() {
	var html = Mustache.render(viewData.template, viewData);
	$('.active').html(html);
});