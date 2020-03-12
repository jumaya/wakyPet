@extends('layouts.app')

@section('content')

<div class="container">
  <div class="response"></div>
  <div id='calendar'></div>
</div>


<div class="modal fade" id="programacionModal" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                
              </div>
              <div class="modal-body">
             

                
              <div class="form-group">
            <div class="col-lg-12">
              <label>Mascota:</label>
              <select class="form-control" name="masco" id="masco" >
                <option value="0"> Seleccione su mascota </option>
                @foreach($mascota as $masco)
                <option name="masco2" value="{{$masco->mascota_id.' '.$masco->nombre}}"> {{$masco->nombre}}</option>
                @endforeach
              </select><br>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label>Plan:</label>
              <select class="form-control" name="plan" id="plan">
                <option value="0"> Seleccione un plan </option>
                @foreach($plan as $pla)
                <option value="{{$pla->plan_id.' '.$pla->descripcion}}"> {{$pla->descripcion}}</option>
                @endforeach
              </select>
            </div>
          </div>


              </div>
              <div class="modal-footer">
                
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="saveProg" value="create"> Confirmar</button> 
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>




@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/programacionFunction.js')}}"></script>
@stop