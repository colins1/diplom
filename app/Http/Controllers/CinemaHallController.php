<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CinemaHall;

class CinemaHallController extends Controller
{
    public function index()
    {
        $cinemaHalls = CinemaHall::all();
        return view('admin.index', ['cinemaHalls' => $cinemaHalls]);
    }

    public function create()
    {
    
    }

    public function store(Request $request)
    {
        $hall = new CinemaHall;
        $hall->name = $request->name;
        $hall->save();
        return redirect('/admin/index');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        

        return redirect('/cinema_halls');
    }

    public function destroy($id)
    {
        $cinemaHall = CinemaHall::find($id);
        $cinemaHall->delete();

        return redirect('/admin/index');
    }
}
