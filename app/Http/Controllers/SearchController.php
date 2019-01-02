<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index(){

        return view('search');
    }

    public function autocomplete(){
        $term = Input::get('term');
        
        $results = array();
        
        $queries = DB::table('empresas')
            ->where('razon_social', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->first_name.' '.$query->last_name ];
        }
    return Response::json($results);
    }
    
}
