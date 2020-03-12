@extends('layouts.app')

@section('content')


<div class="register-box">
  
  <div class="register-box-body">
    <p class="login-box-msg">Formulario de registro</p>
   

    <form method="POST" action="{{ route('register') }}">
                        @csrf
      <div class="form-group has-feedback">        
        <input id="name" type="text"  placeholder="Nombres" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </div>
      <div class="form-group has-feedback">        
        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      </div>
      <div class="form-group has-feedback">
        
        <input id="password" type="password"  placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">        
        <input id="password-confirm" placeholder="Repetir contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Registrarse
                                </button>
                            </div>
                        </div>        
      </div>
    </form>     
  </div>
  <!-- /.form-box -->
</div>


@endsection
