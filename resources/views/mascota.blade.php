@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">

        <div class="col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Formulario de Registro </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger" , style="background-color:#ff4a3d">
                        <strong>Ups!</strong> El formulario presenta inconsistencias. <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(\Session::has('alert'))
                    <div class="alert alert-dismissible alert-success fontbig">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{Session::get('alert')}}</strong>
                    </div>
                    @endif

                    <form class="form-horizontal crolsant" role="form" enctype="multipart/form-data" method="POST" action="{{ route('storePet') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label> Nombre: </label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre de tu mascota" value="{{ old('nombre') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label> Raza: </label>
                                <select name="raza[]" title="Selecciona la raza" class="selectpicker form-control classs" data-live-search="true">
                                    @foreach($valor as $data)
                                    <option value="{{$data->raza_id}}" {{in_array($data->raza_id, old("raza") ?: []) ? "selected": ""}}>{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label>Fecha de Nacimiento:</label>
                                <input type="date" required class="form-control" name="fecha_nacimiento" placeholder="Fecha de Nacimiento " value="{{ old('fecha_nacimiento') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="exampleInputFile">Foto: </label>
                                <input id="foto" data-buttonText="Upload File" accept="image/*" name="foto" type="file" class="form-control-file">
                                <small id="fileHelp" class="form-text text-muted">
                                    La imagen soporta las extensiones jpeg,png,jpg,gif,svg y un maximo de 8mb.
                                </small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="panel panel-primary">
                <div class="panel-heading">Listado de tus mascotas </div>
                <div class="panel-body">
                    <table class="table table-bordered" id="tPet">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Foto</th>
                                <th width="150px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-8 col-md-offset-2">
            <div id="ajaxModel" class="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                            <div class="">
                                <div class="panel-heading"><strong> Editar Registro </strong> </div>
                                <div class="panel-body">

                                    <form id="productForm" name="productForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="mascota_id" id="mascota_id">

                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <label>Nombre:</label>
                                                <input id="nombre" type="text" required class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                     
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <select id="raza" name="raza" class="selectpicker form-control classs" data-live-search="true">
                                                    @foreach($valor as $date)
                                                    @if( $date->raza_id ==  Session::get('test')) )
                                                    <option value="{{$date->raza_id}}"> {{$date->nombre}} </option>
                                                    @endif
                                                    @endforeach
                                                    @foreach($valor as $date)
                                                    <option value="{{$date->raza_id}}"> {{$date->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      

                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <label>Fecha de Nacimiento:</label>
                                                    <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="exampleInputFile">Photo File: </label>
                                                <input id="foto" data-buttonText="Upload File" name="foto" type="file" class="form-control-file">
                                                <small id="fileHelp" class="form-text text-muted">The image file support jpeg,png,jpg,gif,svg formats, and maximun size of 8mb.</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/mascotafunction.js')}}"></script>
@stop