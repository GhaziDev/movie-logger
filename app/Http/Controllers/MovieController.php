<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Inertia\Inertia;

class MovieController extends Controller
{
    //
    public function Index(){
        $movies = Movie::latest()->get();
        return Inertia::render("movies/Index",compact('movies'));
    }
    public function create(){
        return Inertia::render("movies/Create",[]);
    }

    public function post(Request $request){
        $data = $request->validate([
            "name"=>["required","string"],
            "rating"=>["required","string"],
            "favorite"=>["required","string"]
        ]);

        if($data['favorite'] == 'yes'){
            $data['favorite']= true;
        }

        $data['rating'] = (float)$data['rating'];
        

        Movie::create($data);
        return redirect()->route("movies.index")->with("message","Movie logged successfuly!");

    }
    public function put(Movie $movie){

        return Inertia::render('movies/Edit',compact('movie'));

    }

    public function update(Request $request,Movie $movie){
     $data = $request->validate([
            "name"=>["required","string"],
            "rating"=>["required","string"],
            "favorite"=>["required","string"]
        ]);

        $rating = (float) $request->input('rating');
        $favorite = $request->input('favorite')=='yes'?true:false;

        $movie->update([
            "name"=>$request->input('name'),
            "rating"=>$rating,
            "favorite"=>$favorite
    

        ]);

        return redirect()->route("movies.index")->with("message","Movie review has been updated successfuly.");

    }

    public function destroy(Movie $movie){
        $movie->delete();
        return redirect()->route('movies.index')->with('message','Review for'.$movie->name.' '.'has been deleted');
    }
}
