@extends('layout.app')

@section('Contenido')
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 mx-auto bg-light p-4 rounded shadow">

      <h1>Registrar Nuevo Cliente</h1>

      <form action="{{ route('clientes.store') }}" method="post">
        @csrf

        <label for=""><b>Cédula:</b></label><br>
        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ej: 12345678Z"><br>

        <label for=""><b>Apellido:</b></label><br>
        <input type="text" class= "form-control" name="apellido" id="apellido" placeholder="Ej: Perez"><br>

        <label for=""><b>Nombre:</b></label><br>
        <input type="text" class= "form-control" name="nombre" id="nombre"  placeholder="Ej: Juan"><br>

        <label for=""><b>Latitud:</b></label><br>
        <input readonly type="text" class= "form-control" name="latitud" id="latitud"><br>

        <label for=""><b>Longitud:</b></label><br>
        <input readonly type="text" class= "form-control" name="longitud" id="longitud"><br>

        <div id="mapa_cliente" class="my-3" style="border:1px solid black; height:250px; width:100%"></div>

        <button type="submit">Guardar</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{ route('clientes.index') }}">Cancelar</a>
      </form>
    </div>

    <div class="col-md-3"></div>
  </div>

  <script type="text/javascript">
    function initMap() {
      //alert("mapa ok");

      var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);
      var mapa = new google.maps.Map(document.getElementById('mapa_cliente'), {
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
        var latitud = this.getPosition().lat();
        var longitud = this.getPosition().lng();
        document.getElementById("latitud").value = latitud;
        document.getElementById("longitud").value = longitud;
      });
    }
  </script>
@endsection
