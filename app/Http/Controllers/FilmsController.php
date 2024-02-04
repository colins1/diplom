<?php

namespace App\Http\Controllers;

use App\Models\Films;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $duration = $request->input('duration');
        $description = $request->input('description');
        $country = $request->input('country');

        $movie = new Films;
        $movie->name = $title;
        $movie->minutes = $duration;
        $movie->description = $description;
        $movie->country = $country;
        if ($request->hasFile('addImg')) {
            $file = $request->file('addImg');
            $destinationPath = 'i';
            $fileName = $file->getClientOriginalName();
            $fileName = Str::random(15) . '.' . htmlspecialchars($fileName);
            $file->move($destinationPath, $fileName);
            $filePath = $destinationPath . '/' . $fileName;
            $movie->url_img = $filePath;
        } else {
            $movie->url_img = 'no_img';
        }
        $movie->save();

        return redirect('/admin/index')->with('success', 'Все успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Films  $films
     * @return \Illuminate\Http\Response
     */
    public function show(Films $films)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Films  $films
     * @return \Illuminate\Http\Response
     */
    public function edit(Films $films)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Films  $films
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Films $films)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Films  $films
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Films::find($id);
        $film->delete();
        $sessions = Tickets::where('movie_id', $id)->delete();

        return redirect('/admin/index');
    }
}
