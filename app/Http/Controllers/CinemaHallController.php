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
        return view('cinema_halls.index', ['cinemaHalls' => $cinemaHalls]);
    }

    public function create()
    {
        return view('cinema_halls.create');
    }

    public function store(Request $request)
    {
        $cinemaHall = new CinemaHall;
        $cinemaHall->hall_number = $request->hall_number;
        $cinemaHall->number_of_seats = $request->number_of_seats;
        $cinemaHall->price_per_regular_seat = $request->price_per_regular_seat;
        $cinemaHall->price_per_vip_seat = $request->price_per_vip_seat;
        $cinemaHall->vip_seats = $request->vip_seats;
        $cinemaHall->unavailable_seats = $request->unavailable_seats;
        $cinemaHall->save();

        return redirect('/cinema_halls');
    }

    public function edit($id)
    {
        $cinemaHall = CinemaHall::find($id);
        return view('cinema_halls.edit', ['cinemaHall' => $cinemaHall]);
    }

    public function update(Request $request, $id)
    {
        $cinemaHall = CinemaHall::find($id);
        $cinemaHall->hall_number = $request->hall_number;
        $cinemaHall->number_of_seats = $request->number_of_seats;
        $cinemaHall->price_per_regular_seat = $request->price_per_regular_seat;
        $cinemaHall->price_per_vip_seat = $request->price_per_vip_seat;
        $cinemaHall->vip_seats = $request->vip_seats;
        $cinemaHall->unavailable_seats = $request->unavailable_seats;
        $cinemaHall->save();

        return redirect('/cinema_halls');
    }

    public function destroy($id)
    {
        $cinemaHall = CinemaHall::find($id);
        $cinemaHall->delete();

        return redirect('/cinema_halls');
    }
}
