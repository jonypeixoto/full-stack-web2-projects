$(function(){
	var map;
	
	function initialize() {

	  var mapProp = {
	    center:new google.maps.LatLng(-27.609959,-48.576585),
	    zoom:14,
	   	scrollwheel: false,
	     styles: [{
	    stylers: [{
	      saturation: -100
	    }]
	     }],
	    mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  
	  map=new google.maps.Map(document.getElementById("map"),mapProp);
	}

	function addMarker(lat,long,icon,content,showInfoWindow,openInfoWindow){
		  var myLatLng = {lat:lat,lng:long};

		  if(icon === ''){
			   var marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map,
			    icon:icon
			  });
		  }else{
			  var marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map,
			    icon:icon
			  });
		}

		  var infoWindow = new google.maps.InfoWindow({
	                content: content,
	                maxWidth:200
	        });

		  google.maps.event.addListener(infoWindow, 'domready', function() {

		   // Reference to the DIV which receives the contents of the infowindow using jQuery
		   var iwOuter = $('.gm-style-iw');

		   /* The DIV we want to change is above the .gm-style-iw DIV.
		    * So, we use jQuery and create a iwBackground variable,
		    * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
		    */
		   var iwBackground = iwOuter.prev();

		   // Remove the background shadow DIV
		   iwBackground.children(':nth-child(2)').css({'background' : 'rgb(255,255,255)'}).css({'border-radius':'0px'});

		   // Remove the white background DIV
		   iwBackground.children(':nth-child(4)').css({'background' : 'rgb(255,255,255)'}).css({'border-radius':'0px'});

		   // Moves the shadow of the arrow 76px to the left margin 
			iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'display:none;'});

			// Moves the arrow 76px to the left margin 
			iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'display:none;'});

		});
		  	if(showInfoWindow == undefined){
		        google.maps.event.addListener(marker, 'click', function () {
		              infoWindow.open(map, marker);
		         });
	    	}else if(openInfoWindow == true){
	    		infoWindow.open(map, marker);
	    	}
	}

	//Here goes all our javascript code.
	$('nav.mobile').click(function(){
		//What will happen when we click on nav.mobile!
		var listMenu = $('nav.mobile ul');
		//Open menu via fadein
		/*
		if(listMenu.is(':hidden') == true){
			listMenu.fadeIn();
		}
		else{
			listMenu.fadeOut();
		}
		*/

		//Open or close without effects
		/*
		
		if(listMenu.is(':hidden') == true){
			//listMenu.show();
			listMenu.css('display','block');
		}
		else{
			//listMenu.hide();
			listMenu.css('display','none');
		}
		*/

		if(listMenu.is(':hidden') == true){
			//fa fa-times
			//fa fa-bars
			//var icon =  $('.button-menu-mobile i');
			var icon = $('.button-menu-mobile').find('i');
			icon.removeClass('fa-bars');
			icon.addClass('fa-times');
			listMenu.slideToggle();
		}
		else{
			var icon = $('.button-menu-mobile').find('i');
			icon.removeClass('fa-times');
			icon.addClass('fa-bars');
			listMenu.slideToggle();
		}

	});

	if($('target').length > 0){
		//The element exists, so we need to scroll some element.
		var element = '#'+$('target').attr('target');

		var divScroll = $(element).offset().top;

		$('html,body').animate({scrollTop:divScroll},2000);
	}



	dynamicLoad();
	function dynamicLoad(){
		$('[realtime]').click(function(){
			var page = $(this).attr('realtime');
			$('.container-principal').hide();
			$('.container-principal').load(include_path+'pages/'+page+'.php');
			
			setTimeout(function(){
				initialize();
				addMarker(-27.609959,-48.576585,'',"My house",undefined,false);
			},1000);

			$('.container-principal').fadeIn(1000);
			window.history.pushState('', '',page);

			return false;
		})
	}

})
