@extends('layout.app')
@section('Contenido')

<div class='row'>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form action="{{ route('predios.update', $predio->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3><b>Editar Predio</b></h3>
            <hr>
            <label><b>Propietario:</b> </label> <br>
            <input type="text" name="propietario" id="propietario" class="form-control" value="{{ $predio->propietario }}" required><br> 
            
            <label><b>Clave Catastral:</b></label>        
            <input type="number" name="clave" id="clave" class="form-control" value="{{ $predio->clave }}"><br>

            @for ($i = 1; $i <= 4; $i++)
            <div class="row">
                <div class="col-md-5">
                    <label><b>COORDENADA N° {{ $i }}</b></label><br>
                    <label><b>Latitud:</b></label>
                    <input type="number" name="latitud{{ $i }}" id="latitud{{ $i }}" class="form-control" readonly value="{{ $predio['latitud'.$i] }}" placeholder="Seleccione ..."><br>
                    <label><b>Longitud:</b></label>
                    <input type="number" name="longitud{{ $i }}" id="longitud{{ $i }}" class="form-control" readonly value="{{ $predio['longitud'.$i] }}" placeholder="Seleccione ...">
                </div>
                <div class="col-md-7">
                    <div id="mapa{{ $i }}" style="height:180px; width:100%; border:2px solid black;"></div>
                </div>
            </div>
            <br>
            @endfor

            <center>
                <button type="submit" class="btn btn-success">Actualizar</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ route('predios.index') }}" class="btn btn-secondary">Cancelar</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-primary" onclick="graficarPredio();">Graficar Predio</button>
            </center>
        </form>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-12">
        <div id="mapa-poligono" style="height:500px; width:100%; border:2px solid blue;"></div>
    </div>
</div>

<script type="text/javascript">
    var mapaPoligono;

    function initMap(){
        var latlng = new google.maps.LatLng({{ $predio->latitud1 ?? -0.9374805 }}, {{ $predio->longitud1 ?? -78.6161327 }});
        
        @for ($i = 1; $i <= 4; $i++)
        var mapa{{ $i }} = new google.maps.Map(document.getElementById('mapa{{ $i }}'), {
            center: latlng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marcador{{ $i }} = new google.maps.Marker({
            position: new google.maps.LatLng({{ $predio['latitud'.$i] ?? -0.9374805 }}, {{ $predio['longitud'.$i] ?? -78.6161327 }}),
            map: mapa{{ $i }},
            title: "Seleccione coordenada {{ $i }}",
            draggable: true
        });
        google.maps.event.addListener(marcador{{ $i }}, 'dragend', function(event) {
            document.getElementById("latitud{{ $i }}").value = this.getPosition().lat();
            document.getElementById("longitud{{ $i }}").value = this.getPosition().lng();
        });
        @endfor

        mapaPoligono = new google.maps.Map(document.getElementById("mapa-poligono"), {
            zoom: 15,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    }

    function graficarPredio(){
        var coordenadas = [];
        for (var i = 1; i <= 4; i++) {
            var lat = parseFloat(document.getElementById('latitud' + i).value);
            var lng = parseFloat(document.getElementById('longitud' + i).value);
            coordenadas.push(new google.maps.LatLng(lat, lng));
        }

        var poligono = new google.maps.Polygon({
            paths: coordenadas,
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#00FF00",
            fillOpacity: 0.35,
        });

        poligono.setMap(mapaPoligono);
    }
</script>

@endsection
