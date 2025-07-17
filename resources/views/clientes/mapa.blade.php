@extends('layout.app')

@section('Contenido')
    <br>
    <h1>Mapa de Clientes</h1>
    <br>

    <div id="mapa-clientes" style="border: 2px solid black; height: 500px; width: 100%;"></div>

    <script type="text/javascript">
        function initMap() {
            //alert("mapa ok");

            var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);

            var mapa = new google.maps.Map(document.getElementById('mapa-clientes'), 
                {
                    center: latitud_longitud,
                    zoom: 7,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );
            @foreach ($clientes as $clienteTemporal)
                var coordenadaCliente = new google.maps.LatLng({{$clienteTemporal->latitud}}, {{$clienteTemporal->longitud}});
                var marcador = new google.maps.Marker(
                    {
                        position: coordenadaCliente,
                        map: mapa,
                        icon: "https://cdn-icons-png.flaticon.com/32/3135/3135715.png",
                        title: "{{$clienteTemporal->apellido}} {{$clienteTemporal->nombre}}",
                        draggable: false
                    }
                );
            @endforeach

        }
    </script>
@endsection
