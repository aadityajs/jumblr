// JavaScript Document

	var slider_counter = 0;
	
	var hd_map;
	function hd_initialize() {
	var pinkParksStyles = [ { featureType: "water", stylers: [ { hue: "#002426" }, { lightness: -81 }, { visibility: "on" } ] },{ featureType: "landscape", stylers: [ { invert_lightness: false }, { visibility: "simplified" }, { hue: "#FFAF0F" } ] },{ featureType: "road", stylers: [ { visibility: "on" }, { hue: "#FFAF0F"}, { lightness: -41 } ] },{ featureType: "landscape", elementType: "labels", stylers: [ { visibility: "on" }, { invert_lightness: true }, { hue: "#FFAF0F" }, { lightness: -31 } ] } ]
	
	var pinkMapType = new google.maps.StyledMapType(pinkParksStyles,
	{name: "Dark Green"});
	
	
	var mapOptions = {
	zoom: 4,
	center: new google.maps.LatLng(55.6468, 14.581),
	mapTypeControlOptions: {
	mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'pink_parks']
	}
	};
	hd_map = new google.maps.Map(document.getElementById('slider_map'),
	mapOptions);
	
	
	hd_map.mapTypes.set('pink_parks', pinkMapType);
	hd_map.setMapTypeId('pink_parks');
	
	}
	
	google.maps.event.addDomListener(window, 'load', hd_initialize);
	
	
		var geocoder;
		var map;
		var boxtextarray = new Array();
		var newlinearray = new Array();
		var modeswitch;
		var markerarray = new Array();
		
		
		
		
		/* This is the function from where the latitude and longitude is supplied. */
		function init() {
			geocoder = new google.maps.Geocoder();
			if(document.getElementById("lat").value!='')
			{
				var lt = document.getElementById("lat").value;
			}
			else
			{
				var lt = '43';
			}
			if(document.getElementById("lng").value!='')
			{
				var ln = document.getElementById("lng").value;
			}
			else
			{
				var ln = '-3.5';
			}
			//var ln = document.getElementById("lng").value;
			
			var centerLatLng = new google.maps.LatLng(lt,ln);
			map = new google.maps.Map(document.getElementById('mapCanvas'), {
			  'zoom': 2,
			  'center': centerLatLng,
			  'mapTypeId': google.maps.MapTypeId.ROADMAP,
			  'minZoom': 2
			});
			  addmarker('drag this  marker to find matching address');
			}	
		
		
		function addmarker(addressi){
			
			
			var currentcenter = map.getCenter();
			
			var marker = new google.maps.Marker({
			 map: map,
			 draggable: true,
			 position: currentcenter,
			 visible: true,
			  animation: google.maps.Animation.DROP
			});
			marker.address = addressi;
			markerarray.push(marker);
			 
			var boxText = document.createElement("div");
			boxtextarray.push(boxText);
			boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background: black; color:white;padding: 5px;";
			boxText.innerHTML = 'Lat: '+latconverter(currentcenter.lat())+'<br />Lng: ' +lngconverter(currentcenter.lng())+'<br />'+marker.address;
			 
			
			 
			var newline = document.createElement("div");
			newlinearray.push(newline);
			var datadiv = document.getElementById("displaycsv");
			//datadiv.appendChild(newline);
			newline.innerHTML='Lat: '+latconverter(currentcenter.lat())+'Lng: ' +lngconverter(currentcenter.lng());	
			
			// document.getElementById("lat").value=latconverter(currentcenter.lat());
			//document.getElementById("lng").value=lngconverter(currentcenter.lng());
			
			
			var myOptions = {
					 content: boxText
					,disableAutoPan: false
					,maxWidth: 0
					,pixelOffset: new google.maps.Size(-140, 0)
					,zIndex: null
					,boxStyle: { 
					  background: "url('tipbox.gif') no-repeat"
					  ,opacity: 0.75
					  ,width: "200px"
					 }
					,closeBoxMargin: "10px 2px 2px 2px"
					,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
					,infoBoxClearance: new google.maps.Size(1, 1)
					,isHidden: false
					,pane: "floatPane"
					,enableEventPropagation: false
			};
		
			
			var ib = new InfoBox(myOptions);
			
			ib.open(map, marker);
			bindInfoBox(marker, map, ib);
			
			google.maps.event.addListener(marker, 'drag', function() {
			
			latLng = marker.getPosition();
			boxText.innerHTML = 'Lat: '+latconverter(latLng.lat())+'<br />Lng: ' +lngconverter(latLng.lng())+'<br />'+marker.address;
			newline.innerHTML = 'Lat: '+latconverter(latLng.lat())+'Lng: ' +lngconverter(latLng.lng());
			
			});
			
			google.maps.event.addListener(marker,'dragend', function() {
			 pos = marker.getPosition()
			geocodePosition(marker,pos);
			
		});
		}
		
		
		
		function bindInfoBox(marker, map, ib) {
		  google.maps.event.addListener(marker, 'click', function() {
		  ib.open(map, marker);
		});
		}
		
		
		/*
		function convert_coords(){
		if(document.getElementById("convertbutton").value == "Convert To Degrees"){
		modeswitch = 1;
		document.getElementById("convertbutton").value ="Convert To Decimal";
		
		}
		else{
		modeswitch = 0;
		document.getElementById("convertbutton").value = "Convert To Degrees"
		}
		update_data();
		}
		*/
		
		function latconverter(data){
			var data;
			var sphere;
			data < 0?sphere="S":sphere="N";
			
			if(!modeswitch){
			return data;
			}
			else{
			var str="";
			var deg=0, mnt=0, sec=0;
			data=Math.abs(data);
			deg=Math.floor(data);
			data=(data-Math.floor(data))*60;
			mnt=Math.floor(data);
			data=(data-Math.floor(data))*60;
			sec=Math.floor(data*100)/100;
			str+=deg+"&#176; "+mnt+"' "+sec+"\" "+sphere;
			return str;
			}
		
		}
		
		function lngconverter(data){
			var data;
			var sphere;
			data < 0?sphere="W":sphere="E";
			if(!modeswitch){
			return data;
			}
			else{
			var str="";
			var deg=0, mnt=0, sec=0;
			data=Math.abs(data);
			deg=Math.floor(data);
			data=(data-Math.floor(data))*60;
			mnt=Math.floor(data);
			data=(data-Math.floor(data))*60;
			sec=Math.floor(data*100)/100;
			str+=deg+"&#176; "+mnt+"' "+sec+"\" "+sphere;
			return str;
			}
		
		} 
		
		
		/*
		function codeAddress() { 
			var address ='';
			if(document.getElementById("fulladdress").value !='Enter full address'){
			address += document.getElementById("fulladdress").value;
			address +=', ';
			}
			if(document.getElementById("postalcode").value !='Enter Post/Zip code'){
			address += document.getElementById("postalcode").value;
			address +=', ';
			}
			if( document.getElementById("country").value !='Enter Country'){
			address += document.getElementById("country").value;
			}
		
		geocoder.geocode( { 'address': address}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
		   addmarker(address);
		  } else {
			alert("Geocode was not successful for the following reason: " + status);
		  }
		});
		}
		*/
		
		function geocodePosition(marker,pos) {
		
		geocoder.geocode({
		latLng: pos 
		}, function(responses) {
		if (responses && responses.length > 0) {
		 marker.address = responses[0].formatted_address;
		 
		 
		 }
		 else{
		
		 marker.address = "no matching address";
		} 
		 update_data();
		});
		}
		
		function update_data(modeswitch){
			
			
				for (var i=0;i <= boxtextarray.length;i++){
					var latlng = markerarray[i].getPosition();
					
					boxtextarray[i].innerHTML = 'Lat: '+latconverter(latlng.lat())+'<br />Lng: ' +lngconverter(latlng.lng())+'<br />'+markerarray[i].address;
					newlinearray[i].innerHTML = 'Lat: '+latconverter(latlng.lat())+'      Lng: ' +lngconverter(latlng.lng())+'      '+markerarray[i].address;
					
					 document.getElementById("lat").value=latconverter(latlng.lat());
					document.getElementById("lng").value=lngconverter(latlng.lng());
					
				}
			
		}
		
		
		
		google.maps.event.addDomListener(window, 'load', init);
