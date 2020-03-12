@extends('layouts.app')

@section('content')

<div class="container">
  <div class="response"></div>
  <div id='calendar'></div>
</div>

<div class="col-md-4 col-md-offset-2">
  <div id="programacionModal" class="modal modal-fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">


          <div class="form-group">
            <div class="col-lg-12">
              <label>Mascota:</label>
              <select name="masco" id="masco" >
                <option value="0"> Seleccione su mascota </option>
                @foreach($mascota as $masco)
                <option name="masco2" value="{{$masco->mascota_id.' '.$masco->nombre}}"> {{$masco->nombre}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label>Mascota:</label>
              <select name="plan" id="plan">
                <option value="0"> Seleccione un plan </option>
                @foreach($plan as $pla)
                <option value="{{$pla->plan_id.' '.$pla->descripcion}}"> {{$pla->descripcion}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="saveProg" value="create">
              Confirmar 
            </button>
          </div>






        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/programacionFunction.js')}}"></script>
@stop