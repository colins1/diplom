<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CinemaHall;
use App\Models\Films;
use App\Models\Session;
use App\Models\Tickets;

class IndexController extends Controller
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
        
        return view('index', ['cinemaHalls' => $cinemaHalls,'cinema_all' => $cinema_all,'sessions' => $newArraySessions, 'tickets' => $tickets]);
    }
}
