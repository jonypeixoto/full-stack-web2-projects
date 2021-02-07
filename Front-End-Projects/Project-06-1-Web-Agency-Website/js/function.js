window.onload = function(){

	var map;

	function initialize(){
		var mapProp = {
			center: new google.maps.LatLng(-13.6999006,-69.7243715),
			scrollwheel:false,
			zoom:2,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById("map"),mapProp);
	}

	function addMarker(lat,long,icon,content,click){
		var latLng = {'lat':lat,'lng':long};

		var marker = new google.maps.Marker({
			position:latLng,
			map:map,
			icon:icon
		});

		var infoWindow = new google.maps.InfoWindow({
			content:content,
			maxWidth:200,
			pixelOffset: new google.maps.Size(0,20)
		});

		if(click == true){
			google.maps.event.addListener(marker,'click',function(){
				infoWindow.open(map,marker);
			});
		}else{
			infoWindow.open(map,marker);
		}
		
	}

	initialize();

	var content = '<p style="color:black;font-size:13px;padding:10px 0;border-bottom:1px solid black;">The CybertimeUP Address</p>';
	addMarker(-22.8928915,-43.3589825,'',content,true);


	// OR USE TRUE, IF YOU WANT THAT USERS CLICK ON THE MAP FOR SEE YOUR LOCALIZATION:

		// addMarket(-22.8928965,-43.3589771,'',content,true);


	// YOU CAN ADD OTHER ADDMARKER

	//addMarket ...

	setTimeout(function(){
			map.panTo({'lat':-22.8928915,'lng':-43.3589825});
			map.setZoom(12);


	var content = '<p style="color:black;font-size:13px;padding:10px 0;border-bottom:1px solid black;">The CybertimeUP Address, Brazil, Rio de Janeiro</p>';
	addMarker(-22.8928915,-43.3589825,'',content);

	},4000);


}



