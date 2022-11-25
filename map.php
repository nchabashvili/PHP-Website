<?php

include_once(__DIR__ . '/app/start.php');

?>
<div id="map" style="height: 100%; width: 100%;">Loading... Please make sure your adblocker is off</div>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
	function getIp(callback) {
		fetch('https://ipinfo.io/?token=da8710b69ec52b').then(function(response) {
			response.json().then(function(json) {
				callback(json)
			})
		}).catch(function(e) {
			callback(false)
		})
	}

	function setupMap(ipData) {
		var location = ipData.loc.split(',')
		var map = L.map('map').setView(location, 13);

		var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
				'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1
		}).addTo(map);

		L.marker(location).addTo(map)
	    .bindPopup(ipData.ip)
	    .openPopup();
	}

	getIp(function(ipData) {
		if (!ipData) {
			alert('Something went wrong while retrieving your IP');
			return;
		}

		setupMap(ipData);
	})
</script>
</html>