let map;
let geocoder;
let directionsService;
let directionsRenderer;

const collectionCenters = [
    { lat: 19.468188897999813, lng: -99.19236546741017, name: "Centro de Recolección 1" },
    { lat: 19.501790338417557, lng: -99.211852957532, name: "Centro de Recolección 2" },
    { lat: 19.46137757699044, lng: -99.05718627586737, name: "Centro de Recolección 3" }
];

function loadMap(event) {
    event.preventDefault();
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyC1lVnKTX_5hiUeHYcA9XLUCJ1xMTxEdXM&callback=initMap`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
}

function initMap() {
    const staticMap = document.getElementById('staticMap');
    const mapContainer = document.getElementById('map');
    staticMap.style.display = 'none';
    mapContainer.style.display = 'block';

    const direccion = document.getElementById('direccion').value;
    const colonia = document.getElementById('colonia').value;
    const estado = document.getElementById('estado').value;
    const codigoPostal = document.getElementById('codigoPostal').value;
    const address = `${direccion}, ${colonia}, ${estado}, ${codigoPostal}`;

    map = new google.maps.Map(mapContainer, {
        center: { lat: 19.468188897999813, lng: -99.19236546741017 },
        zoom: 10
    });
    geocoder = new google.maps.Geocoder();
    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    geocodeAddress(address);
}

function geocodeAddress(address) {
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            const marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            findClosestCollectionCenter(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function findClosestCollectionCenter(location) {
    let closestCenter = null;
    let shortestDistance = Infinity;
    
    collectionCenters.forEach(center => {
        const distance = google.maps.geometry.spherical.computeDistanceBetween(
            new google.maps.LatLng(location.lat(), location.lng()),
            new google.maps.LatLng(center.lat, center.lng)
        );
        if (distance < shortestDistance) {
            shortestDistance = distance;
            closestCenter = center;
        }
    });

    if (closestCenter) {
        calculateAndDisplayRoute(location, closestCenter);
    }
}

function calculateAndDisplayRoute(start, end) {
    directionsService.route(
        {
            origin: start,
            destination: { lat: end.lat, lng: end.lng },
            travelMode: 'DRIVING'
        },
        function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        }
    );
}



