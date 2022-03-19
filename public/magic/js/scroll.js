// PhucVD
// Scroll~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// $('.scroll-box').each(function () {
// 		initScroll($(this));
// 	});
function initScroll(scrollBox) {
	var scrollContent = scrollBox.find('.scroll-content');
	scrollBox.css('height', '100%');
	if (scrollContent.prop('scrollHeight') > scrollBox.height()) {
		scrollBox.append("<div class='scroll-bar'><div class='scroll'></div></div>");
		actionScroll(scrollBox);
	}
}

function actionScroll(scrollBox) {
	scrollBox.css('overflow', 'hidden');
	scrollBox.css('position', 'relative');
	scrollBox.css('height', '100%');

	var content = scrollBox.find('>.scroll-content');
	content.css('width', 'calc(100% + 17px)');
	content.css('padding-right', '20px');
	content.css('height', '100%');
	content.css('overflow', 'auto');
	content.css('position', 'relative');
	content.css('box-sizing', 'unset');
	repositionScrollBar(scrollBox);
	mouseSeek(scrollBox);
	mouseDrag(scrollBox);

	content.scroll(function (e) {
		repositionScrollBar(scrollBox);
	});
}

function sizeScrollBar(scrollBox) {
	var height = scrollBox.find(".scroll-content").height();
	var scrollHeight = scrollBox.find(".scroll-content").prop("scrollHeight");
	return height / scrollHeight * 100;
}

function scrollBarTop(scrollBox) {
	var height = scrollBox.find(".scroll-content").scrollTop();
	var scrollHeight = scrollBox.find(".scroll-content").prop("scrollHeight");
	return height / scrollHeight * 100;
}

function repositionScrollBar(scrollBox) {
	var scrollContent = scrollBox.find('.scroll-content');
	var scroll = scrollBox.find('.scroll');
	scroll.css('height', sizeScrollBar(scrollBox) + "%");
	scroll.css('top', scrollBarTop(scrollBox) + "%");
}

function mouseSeek(scrollBox) {
	var scrollBar = scrollBox.find('.scroll-bar');
	var scroll = scrollBox.find('.scroll');
	var scrollContent = scrollBox.find('.scroll-content');
	var scroll = scrollBox.find('.scroll');
	
	scrollBar.click(function (e) {
		e.preventDefault();
		e.stopPropagation();
		var curTop = (e.pageY - scrollBar.offset().top) / scrollContent.height();
		curTop = curTop * scrollContent.prop('scrollHeight') - (scroll.height() / 2);
		scrollContent.animate({
			scrollTop: curTop
		}, 200);
	});

	scroll.click(function (e) {
		e.preventDefault();
		e.stopPropagation();
	});
}

function mouseDrag(scrollBox) {
	var click = false;
	var lastY = 0;
	var scroll = scrollBox.find('.scroll');
	var scrollContent = scrollBox.find('.scroll-content');
	scrollBox.mousemove(function (e) {
		e.stopPropagation();
		if (click == true) {
			curTop = e.pageY - lastY;
			lastY = e.pageY;
			curTop = scrollBox.find('.scroll-content').scrollTop() + (curTop / scrollBox.find('.scroll-bar').height() * scrollBox.find('.scroll-content').prop("scrollHeight"));
			scrollBox.find('.scroll-content').scrollTop(curTop);

		}
	});

	scroll.mousedown(function (e) {
		e.preventDefault();
		e.stopPropagation();
		click = true;
		lastY = e.pageY;
	});

	$(document).mouseup(function (e) {
		e.preventDefault();
		e.stopPropagation();
		click = false;
		lastY = 0;
	});
}
// End Scrol//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~