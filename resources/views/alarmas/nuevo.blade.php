@extends('layout.app')

@section('Contenido')
    <div class='row'>
        <div class="col-md-3"></div>
        <div class="col-md-6 mx">
            <h1>
                NUEVA ALARMA    
            </h1>
            <form action="{{ route('alarmas.store') }}" method="POST">
                @csrf
                <label for=""><b>No. de Serie</b></label><br>
                <input type="text" name="serie" id="serie" class="form-control" placeholder="Ingrese la serie"> 
                <br>

                <label for=""><b>Responsable</b></label><br>
                <input type="text" name="responsable" id="responsable" class="form-control" placeholder="Ingrese el nombre del responsable"> 
                <br>

                <label for=""><b>Tipo</b></label><br>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">--Seleccione--</option>
                    <option value="PUBLICA">Alarma Publica</option>
                    <option value="PRIVADA">Alarma Privada</option>
                </select>
                <br>

                <label for=""><b>Radio Sonoro</b></label><br>
                <input type="number" name="radio" id="radio" class="form-control" placeholder="Ingrese el radio de la alarma"> 
                <br>

                <label for=""><b>Ubicacion de la Alarma</b></label><br>
                <div class="row">
                    <div class="col-md-6">
                        <b>Latitud:</b>
                        <input type="number" name="latitud" id="latitud" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <b>Longitud:</b>
                        <input type="number" name="longitud" id="longitud" class="form-control" readonly>
                    </div>
                </div>
                <br>
                <div id="mapa1" style="border:2px solid black; height:300px; width:100%;"></div>                
                <br>

                <center>
                    <button class= "btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalGraficoCirculo" onclick="graficarCirculo()">
                        Graficar </button>
                    <button class="btn btn-danger">Cancelar</button>
                </center>

                
            </form>
            <!-- Modal -->
    <div class="modal fade" id="modalGraficoCirculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Rango Sonoro de la Alarma</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div id="mapa-circulo" style="border:2px solid blue; height:300px; width=:100%;">

                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>    
        </div>
        </div>
    </div>
    </div>
        </div>
    </div>
<script type="text/javascript">
    function initMap() {
        var latitud = -0.9374805;
        var longitud = -78.6161327;

        var latitud_longitud = new google.maps.LatLng(latitud, longitud);
        var mapa = new google.maps.Map(document.getElementById('mapa1'), {
            center: latitud_longitud,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Seleccione la dirección",
            draggable: true
        });

        google.maps.event.addListener(marcador, 'dragend', function(event) {
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
        });
        
    }// Finalin

    function graficarCirculo(){
        var radio=document.getElementById('radio').value;
        var latitud=document.getElementById('latitud').value;
        var longitud=document.getElementById('longitud').value;
        //alert(radio+"\n"+latitud+"\n"+longitud);

        var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);
        var mapaCirculo=new google.maps.Map(
          document.getElementById('mapa-circulo'),
          {
            center:latitud_longitud,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          }
        );

        var centro= new google.maps.LatLng(latitud,longitud);

        
        var marcadorCentroCirculo=new google.maps.Marker({
          position:centro,
          map:mapaCirculo,
          title:"Centro del Circulo",
          draggable:false
        });
        
        var circuloSonoro=new google.maps.Circle({
            strokeColor:"red",
            strokeOpacity:0.8,
            strokeWeight:2,
            fillColor:"blue",
            fillOpacity:0.5,
            map:mapaCirculo,
            center:centro,
            radius:parseFloat(radio)
        });
    }
</script>


@endsection