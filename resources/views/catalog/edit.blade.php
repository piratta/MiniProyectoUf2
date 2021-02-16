@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
   <div class="offset-md-3 col-md-6">
      <div class="card">
         <div class="card-header text-center">
            Editar película
         </div>
         <div class="card-body" style="padding:30px">

         <form method="post">

            {{ method_field('PUT') }}
            @csrf

            


            <div class="form-group">
               <label for="title">Título</label>
               <input type="text" name="title" id="title" class="form-control" value="{{ $Pelicula -> title }}">
            </div>

            <div class="form-group">
            <label for="title">Fecha</label>

            <input type="text" name="fecha" id="fecha" class="form-control" value="{{ $Pelicula -> year }}">
            </div>

            <div class="form-group">
            <label for="title">Director</label>
            <input type="text" name="director" id="director" class="form-control" value="{{ $Pelicula -> director }}">
            </div>

            <div class="form-group">
            <label for="Poster">Poster</label>
            <input type="text" name="Poster" id="Poster" class="form-control" value="{{ $Pelicula -> poster}}">          
                  </div>

            <div class="form-group">
               <label for="synopsis">Resumen</label>
               <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{$Pelicula -> synopsis}}</textarea>
            </div>

            <div class="form-group text-center">

               <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                   Modificar película
               </button>

            </div>

            </form>
         </div>
      </div>
   </div>
</div>


@stop