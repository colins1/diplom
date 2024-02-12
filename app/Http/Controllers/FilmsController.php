<?php

namespace App\Http\Controllers;

use App\Models\Films;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'duration' => 'required|integer|min:1',
            'description' => 'required',
            'country' => 'required|max:50',
            'addImg' => 'image|mimes:jpeg,png|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $movie = new Films;
        $movie->name = $request->input('title');
        $movie->minutes = $request->input('duration');
        $movie->description = $request->input('description');
        $movie->country = $request->input('country');
    
        if ($request->hasFile('addImg')) {
            $file = $request->file('addImg');
            $destinationPath = 'i';
            $fileName = Str::random(15) . '.' . $file->getClientOriginalExtension();
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
