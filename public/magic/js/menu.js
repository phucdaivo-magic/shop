
// Init Menu~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function initList(list, hidenOther = false) {
	var li = list.find('>li');
	li.each(function (index, el) {
		if ($(el).has('ul').html() === undefined) { return }
		intListAction($(el), hidenOther);
		initList($(el).find('>ul'));
	});
}

function intListAction(li, hidenOther) {
	// Call emelent show child
	if (li.hasClass('show')) {
		var ul = li.find('>ul');
		ul.slideDown(150);
	}
	// Call emelent click in
	li.find('>a').addClass('toggle').click(function () {
		var isShow = li.hasClass('show');
		var ul = li.find('>ul');
		if (isShow) {
			li.removeClass('show');
			ul.slideUp(150);
		} else {
			if (hidenOther) {
				// if you want close list other
				var parent = li.parent();
				parent.find('ul').slideUp();
				parent.find('li').removeClass('show')
			}
			li.addClass('show');
			ul.slideDown(150);
		}
	});
}
// End Init Menu~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~