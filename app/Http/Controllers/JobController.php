<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function publicIndex(Request $request){
        //finir de prendre la requete pour category 
        $query = JOb::with([...])
    }
}
