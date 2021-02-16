<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Movie;

class CatalogController extends Controller{

 


    public function getIndex(){
        
		return view('catalog.index',['consultaIndex' => DB::table('movies')->get()]);
		
    }

      public function getShow($id) {

        return view('catalog.show', ['Pelicula' =>  Movie::findOrFail($id)]);
    }

   
    public function getCreate(){    
        return view('catalog.create');
    
    
    }
    
    public function getEdit($id) {
      
    
        return view('catalog.edit',['Pelicula' => Movie::findOrFail($id)]);
    
    }

    public function putEdit($id, Request $request) {

      $p = Movie::findOrFail($id);
      $p->title = $request->input('title');
      $p->year = $request->input('fecha');
      $p->director = $request->input('director');
      $p->poster = $request->input('Poster');
      $p->synopsis = $request->input('synopsis'); 
      $p->save();
 
      return redirect()->action('CatalogController@getShow', ['id'=>$id]);
    }

    public function postCreate(Request $request) {

      $p = new Movie;
      $p->title = $request->input('title');
      $p->year = $request->input('fecha');
      $p->director = $request->input('director');
      $p->poster = $request->input('Poster');
      $p->synopsis = $request->input('synopsis');
      $p->save();
   
      return redirect()->action('CatalogController@getIndex');    


   

    }
}
