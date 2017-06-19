function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: -34.397, lng: 150.644}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submitGeo').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });
}

function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    position: results[0].geometry.location
                });
                var city = results[0].address_components[0].long_name;
                var country = results[0].address_components[results[0].address_components.length - 1].long_name;
                document.getElementById('country').value = country;
                document.getElementById('city').value = city;
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
}

