window.onload = function(){

	var map;

	function initialize(){
		var mapProp = {
			center: new google.maps.LatLng(-22.906847,-43.172897),
			scrollWheel:false,
			zoom:12,
			mapTypeId:google.maps.MapTypeId.ROADMAP

			/* 

			OR

			 mapTypeId:'satellite'

			 OR

			 mapTypeId:google.maps.MapTypeId.TERRAIN

			 */
			
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

	var content = '<p style="color:black;font-size:13px;padding:10px 0;border-bottom: 1px solid black;">The CybertimeUP address</p>';
	addMarket(-22.8928965,-43.3589771,'',content);
	
	// OR USE:

		// addMarket(-22.8928965,-43.3589771,'',content,true);


	// YOU CAN ADD OTHER ADDMARKER

	//addMarket ...

}

