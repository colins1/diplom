<?php

namespace App\Http\Controllers;

use App\Models\Films;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
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
        //
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
    public function destroy(Films $films)
    {
        //
    }
}
