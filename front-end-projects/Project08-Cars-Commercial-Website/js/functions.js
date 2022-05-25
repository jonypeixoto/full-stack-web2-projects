$(function(){

	/*
	Search system.
	*/

	var currentValue = 0;
	var isDrag = false;
	var maximum_price = 70000;
	var price_search = 0;

	$('.pointer-bar').mousedown(function(){
		isDrag = true;
	})

	$(document).mouseup(function(){
		isDrag = false;
		enableTextSelection();
	})

	$('.bar-price').mousemove(function(e){
		if(isDrag){
			disableTextSelection();
			var elBase = $(this);
			var mouseX = e.pageX - elBase.offset().left;
			if(mouseX < 0)
				mouseX = 0;
			if(mouseX > elBase.width())
				mouseX = elBase.width();

			$('.pointer-bar').css('left',(mouseX-13)+'px');
			currentValue = (mouseX / elBase.width()) * 100;
			$('.bar-price-fill').css('width',currentValue+'%');
	

	//SEE THE PRICE FORMAT - SECTION SALE


			price_search = (currentValue/100) * maximum_price;
			price_search = formatPrice(price_search);
			$('.price_search').html('US$ '+price_search);
		}
	})

	function formatPrice(price_search){
		price_search = price_search.toFixed(2);
		price_arr = price_search.split('.');

		var new_price = formatTotal(price_arr);

		return new_price;
	}

	function formatTotal(price_arr){
		
		if(price_arr[0] < 1000){
			return price_arr[0]+'.'+price_arr[1];
		}else if(price_arr[0] < 10000){
			return price_arr[0][0]+'.'+price_arr[0].substr(1,price_arr[0].length)+
			'.'+price_arr[1];
		}else{
			return price_arr[0][0]+price_arr[0][1]+'.'+price_arr[0].substr(2,price_arr[0].length)+
			'.'+price_arr[1];
		}
		
	}

	function disableTextSelection(){
		 $("body").css("-webkit-user-select","none");
		 $("body").css("-moz-user-select","none");
		 $("body").css("-ms-user-select","none");
		 $("body").css("-o-user-select","none");
		 $("body").css("user-select","none");
	}

	function enableTextSelection(){
		 $("body").css("-webkit-user-select","none");
		 $("body").css("-moz-user-select","none");
		 $("body").css("-ms-user-select","none");
		 $("body").css("-o-user-select","none");
		 $("body").css("user-select","none");
	}

	/***--------------------------***/

	/*

		Slide system of the individual page of each car.

	*/



	/*--- CREATING THE PERSONALIZED SLIDER ---*/


	var imgShow = 3;

	//MAXINDEX = FOR KNOW THE MAXIMUM POSITION OF THE PHOTO ON SLIDER
	var maxIndex = Math.ceil($('.mini-img-wraper').length/3) - 1;

	//CURINDEX = FOR KNOW THE ACTUAL POSITION OF THE PHOTO ON SLIDER
	var curIndex = 0;

	initSlider();
	navigateSlider();
	clickSlider();
	function initSlider(){
		var amt = $('.mini-img-wraper').length * 33.3;
		var elScroll = $('.nav-gallery-wraper');
		var elSingle = $('.mini-img-wraper');
		elScroll.css('width',amt+'%');
		elSingle.css('width',33.3*(100/amt)+'%');
	}

	function navigateSlider(){
		$('.arrow-right-nav').click(function(){
			if(curIndex < maxIndex){
				curIndex++;
				var elOff = $('.mini-img-wraper').eq(curIndex*3).offset().left - $('.nav-gallery-wraper').offset().left;
				$('.nav-gallery').animate({'scrollLeft':elOff+'px'});
			}else{
				//console.log("We got to the end!");
			}
		});

		$('.arrow-left-nav').click(function(){
			if(curIndex > 0){
				curIndex--;
				var elOff = $('.mini-img-wraper').eq(curIndex*3).offset().left - $('.nav-gallery-wraper').offset().left;
				$('.nav-gallery').animate({'scrollLeft':elOff+'px'});
			}else{
				//console.log("We got to the end!");
			}
		})
	}

	function clickSlider(){
		$('.mini-img-wraper').click(function(){
			$('.mini-img-wraper').css('background-color','transparent');
			$(this).css('background-color','rgb(210,210,210)');
			var img = $(this).children().css('background-image');
			$('.featured-photo').css('background-image',img);
		})

		//AUTOMATICALLY SLIDER WITHOUT CLICK ON THE PHOTO

		$('.mini-img-wraper').eq(0).click();
	}

	/***--------------------------***/

	/*
	  Click and go to contact div based on goto attribute
	*/
	var directory = '/Full-Stack-Projects/Front-End-Projects/Project08-Cars-Commercial-Website/'

	$('[goto=contact]').click(function(){
		location.href=directory+'?contact';
		return false;
	})

	checkUrl();

	function checkUrl(){
		var url = location.href.split('/');
		var curPage = url[url.length-1].split('?');

		if(curPage[1] != undefined && curPage[1] == 'contact'){
			//$('header nav a').css('color','black');
			//$('footer nav a').css('color','white');
			$('[goto=contact]').css('color','#EB2D2D');
			$('html,body').animate({'scrollTop':$('#contact').offset().top});
		}else{
			$('a[href='+curPage[0]+']').css('color','#EB2D2D');
		}

	}


	/*
	  Responsive menu
	*/


	$('.mobile').click(function(){
		$(this).find('ul').slideToggle();
	})


	/*
	  Navigation system in the testimonials of index.html
	*/

	var amtClient = $('.client-single p').length;
	var curIndex = 0;

	initiateTestimonials();
	navigateTestimonials();

	function initiateTestimonials(){
		$('.client-single p').hide();
		$('.client-single p').eq(0).show();
	}

	function navigateTestimonials(){
		$('[next]').click(function(){
			curIndex++;
			if(curIndex >= amtClient)
					curIndex = 0;
			$('.client-single p').hide();
			$('.client-single p').eq(curIndex).show();
		})

		$('[prev]').click(function(){
			curIndex--;
			if(curIndex < 0)
					curIndex = amtClient-1;
			$('.client-single p').hide();
			$('.client-single p').eq(curIndex).show();		
		})

	}


})