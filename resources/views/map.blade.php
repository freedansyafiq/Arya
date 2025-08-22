@extends('layouts.app')

@section('title', 'Peta Data SPPG')

@section('content')
    <div class="container mb-4">
        <div id="map"></div>
    </div>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Marker Cluster -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <style>
        #map { height: 600px; }
        .legend {
            background: white;
            padding: 10px;
            border-radius: 8px;
            line-height: 1.5;
            font-size: 14px;
            box-shadow: 0 0 6px rgba(0,0,0,0.2);
        }
        .legend span {
            display: inline-block;
            width: 15px;
            height: 15px;
            margin-right: 5px;
        }
    </style>

    <script>
        var map = L.map('map').setView([-2.5489, 118.0149], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© Badan Gizi Nasional'
        }).addTo(map);

        var markers = L.markerClusterGroup();

        // Data dari Laravel
        var data = @json($sppgs);

        data.forEach(d => {
            if (d.latitude && d.longitude) {
                let iconUrl =
                    d.status_pengajuan.toLowerCase() === 'beroperasi'
                        ? 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
                        : 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';

                var marker = L.marker([d.latitude, d.longitude], {
                    icon: L.icon({
                        iconUrl: iconUrl,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    })
                }).bindPopup(`
                    <b>ID SPPG:</b> ${d.id_sppg}<br>
                    <b>Status:</b> ${d.status_pengajuan}<br>
                    <b>Alamat:</b> ${d.alamat}
                `);

                markers.addLayer(marker);
            }
        });

        map.addLayer(markers);

        // Tambah legenda
        var legend = L.control({position: 'bottomright'});
        legend.onAdd = function () {
            var div = L.DomUtil.create('div', 'legend');
            div.innerHTML = `
                <h6>Status</h6>
                <span style="background:green"></span> Beroperasi<br>
                <span style="background:red"></span> Belum Beroperasi
            `;
            return div;
        };
        legend.addTo(map);
    </script>
@endsection
