@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

    <img src="{{ $Pelicula -> poster }}"><br>

    </div>
    <div class="col-sm-8">

      

        <h2>{{ $Pelicula -> title }}</h2><br>
        Año: {{ $Pelicula -> year }}<br>
        Director: {{ $Pelicula -> director }}<br><br>
        
        Resumen: {{ $Pelicula -> synopsis }}<br><br>
        Estado: 
                @if($Pelicula  -> rented )
                     No disponible
                @else
                     Disponible
                @endif
                <br><br>

       
       

        <form method="get" action="/catalog/edit/{{ $Pelicula->id }} ">
        

        
        @if($Pelicula->rented )
        <input type='button' name="No disponible" value='Devolver'>
        @else
        <input type='button' name="Alquilar" value='Alquilar'>
        @endif
            <button type="submit">Editar Pelicula</button>
        </form>
        


    </div>
</div>

@stop