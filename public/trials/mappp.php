<?php require ("../includes/header.php"); ?>
<style>
    #map {
        width: 500px;
        height: 400px;
    }
</style>
<div id="map"></div>
<script>
    function initMap() {
        var mapDiv = document.getElementById('map');
        var map = new google.maps.Map(mapDiv, {
            center: {lat: -1.3790, lng: 36.9281},
            zoom: 13
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
async defer></script>
