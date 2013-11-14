jQuery(window).load(function(){
		var $ = jQuery;
		$('body').prepend('dddg');
		//img center
		$('img.center').each(function(){
			var img_w = $(this).css('width');
			$(this).css({
				'width': img_w,
				'display': 'block',
				'margin': '0 auto'
			})
			console.log(img_w);
		});
});