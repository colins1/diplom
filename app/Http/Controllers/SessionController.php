<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;

class SessionController extends Controller
{
    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $session = new Session;
        $session->hall_id = $request->hall_id;
        $session->show_time = $request->start_time;
        $session->movie_id = $request->movie_id;
        $session->save();
        return redirect('/admin/index');
    }


    public function show(SessionController $seans)
    {
        //
    }

    public function edit(SessionController $seans)
    {
        //
    }

    public function update(Request $request, SessionController $seans)
    {
        //
    }

    public function destroy(Request $request, $id, $mid)
    {

        Session::where('id', $mid)->where('movie_id', $id)->delete();

        return redirect('/admin/index');
    }
}
