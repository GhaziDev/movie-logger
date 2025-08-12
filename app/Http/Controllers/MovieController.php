<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Inertia\Inertia;

class MovieController extends Controller
{
    //
    public function Index(){
        return Inertia::render("movies/Index",[]);
    }
    public function create(){
        return Inertia::render("movies/Create",[]);
    }

    public function post(Request $request){
        $data = $request->validate([
            "name"=>["required","string"],
            "rating"=>["required","string"],
            "favorite"=>["required","boolean"]
        ]);

        Movie::create($data);
        return redirect().route("movies.index").with("message","Movie logged successfuly!");

    }
}
