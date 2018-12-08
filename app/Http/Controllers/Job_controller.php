<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;

class Job_controller extends Controller
{
    
    public function get_job(Request $request){

        $term = $request->input('term');
        
        $results = array();
                
        $queries = Job::select('id', 'name')
            ->where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }        

        return $results;
    }

    
}