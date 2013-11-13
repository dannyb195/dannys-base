// JavaScript Document
(function($){
		  var sliderUL = $('div.slider-container').css('overflow', 'hidden').find('ul'),
		  	imgs = sliderUL.find('li'),
			imgWidth = parseInt(imgs.css('width')),
			imgLen = imgs.length, //counts the number of images we have in the slider
			current = 1,
			totalImgsWidth = imgWidth * imgLen;
			$('.current-container').hide();
			$('div.button-container')
				.show()
				.find('button')
				.on('click', function(){
									  var direction = $(this).data('dir'),
									  loc = imgWidth;
									  console.log(direction);
									  //update current image value
									  (direction === 'next') ? current +=1 : current -=1;
									  //if first image
									  if (current === 0){
										  current = imgLen;
										  loc = totalImgsWidth - imgWidth;
										  direction = 'next';
									  } else if (current - 1 === imgLen) {
										  current = 1;
										  loc = 0;
									  }
									  $('.current').text(current);
									  $('.total').text(imgLen);
									  console.log(imgLen);
									  $('.current-container').show();
									  transition(sliderUL, loc, direction);
									  });
				function transition(container, loc, direction) {
					var unit;
					if (direction && loc !==0){
										  unit = (direction ==='next') ? '-=' : '+=';
									  
									  }
					container.animate({
									  'margin-left': unit ? (unit + loc) : loc
									  });
				}
				$('.home-article').first().addClass('home-article-first');
		  })(jQuery);