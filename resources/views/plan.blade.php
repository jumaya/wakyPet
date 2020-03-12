@extends('layouts.app')

@section('content')


<section class="section">
      <div class="container">
      
        <div class="row align-items-stretch">
        @foreach($dataPlan as $item)
            @if($item->plan_id == 1)
            <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="pricing h-100 text-center">
              <span class="popularity">Plan Preferente</span>
              <h4>{{$item->descripcion}}</h4>
              <ul class="list-unstyled">
                <li>Pasear a tu mascota deacuerdo a su edad y ritmo.</li>
                <li>Tu eliges la mejor ruta</li>       
              </ul>
              <div class="price-cta">
                <strong class="price">$ {{$item->valor}} / hora</strong>                
              </div>
            </div>
          </div>         
           @endif
            @if($item->plan_id == 2)
            <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="pricing h-100 text-center popular">
              <span class="popularity">Mas Popular</span>
              <h4>{{$item->descripcion}}</h4>
              <ul class="list-unstyled">
                <li>Pasear a tu mascota con un grupo de otros perros.</li>
                <li> Se brinda el mejor paseo y seguridad. </li>
              </ul>
              <div class="price-cta">
                <strong class="price"> $ {{$item->valor}} / hora </strong>                
              </div>
            </div>
          </div>         
          @endif
          @endforeach
        </div>
      </div>
    </section>

@endsection