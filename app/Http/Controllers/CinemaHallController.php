<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CinemaHall;
use App\Models\Films;
use App\Models\Session;
use App\Models\Tickets;


class CinemaHallController extends Controller
{
    public function index()
    {
        $cinemaHalls = CinemaHall::all();
        for ($i = 0; $i < count($cinemaHalls); $i++) {
            $cinemaHalls[$i]['number_of_seats'] = json_decode($cinemaHalls[$i]['number_of_seats'], true);
        }

        $cinema_all = Films::all();

        $sessions = Session::all();

        $tickets = Tickets::all();

        $newArraySessions = array();

        foreach ($sessions as $session) {
            $hall_id = $session->hall_id;
            $movie_id = $session->movie_id;
            $time = $session->show_time;
        
            $hall = $cinemaHalls->where('id', $hall_id)->first();
            $hall_name = $hall->name;
        
            $movie = $cinema_all->where('id', $movie_id)->first();
            if (isset($movie->name)) {
                $movie_name = $movie->name;
                $minutes = $movie->minutes;
                $newArraySessions[] = (object) array(
                    'id_ses' => $session->id,
                    'hall_id' => $hall_id,
                    'hall_name' => $hall_name,
                    'movie_id' => $movie_id,
                    'movie_name' => $movie_name,
                    'duration' => $minutes,
                    'time' => $time
                );
            }

        }
        
        return view('admin.index', ['cinemaHalls' => $cinemaHalls,'cinema_all' => $cinema_all,'sessions' => $newArraySessions, 'tickets' => $tickets]);
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
        $hall = CinemaHall::find($id);
        $array = [];
        $clone = array_values((array)$request);
        $check = json_decode($clone[11]); 
        if ($check[0] == 'price') {
            $hall->price_per_regular_seat = $check[1];
            $hall->price_per_vip_seat = $check[2];
            $hall->save();
            return 'New Price';
        }
        $hall->number_of_seats = $clone[11];
        $hall->save();
        return 'New Spot';
    }

    public function destroy($id)
    {
        $cinemaHall = CinemaHall::find($id);
        $cinemaHall->delete();

        return redirect('/admin/index');
    }
}
