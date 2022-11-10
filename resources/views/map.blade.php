@extends('welcome')
@section('content')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link href="{{asset('assets/css/map.css')}}">

    <div id="map" style="width: 100%; height: 700px;"></div>

    <script>
        function getLocation(join_flag) {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            function success(pos) {
                var crd = pos.coords;
            }

            navigator.geolocation.getCurrentPosition(success, error, options);

            function success(position) {
                initMap(position)
            }
        }

        function initMap(position) {
            const center = { lat: 40.1817, lng: 44.5099};
            const markerPosition = { lat: 30.800, lng: 40.9663};

            if (position !== undefined) {
                const markerPosition = { lat: position.coords.latitude, lng: position.coords.longitude};
            }

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: center,
            });

            const marker = new google.maps.Marker({
                position: markerPosition,
                map: map,
                icon: 'assets/image/map.svg'
            });
        }

        window.initMap = initMap;
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1ySADyE_MRjgBs9FDWwVs6OsDeYNeg2A&callback=initMap&v=weekly"
        defer
    ></script>

@endsection
