$(document).ready(function() {
	initList($('.list-menu ul'));
	$('.scroll-box').each(function () {
		initScroll($(this));
	});
});