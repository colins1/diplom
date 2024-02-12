<?php

namespace App\Http\Controllers;

use App\Models\HallBuy;
use Illuminate\Http\Request;
use App\Models\CinemaHall;
use App\Models\Films;
use App\Models\Session;
use App\Models\Tickets;
use Illuminate\Support\Arr;



class HallBuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_ses)
    {
        $arrayIdAndTime = explode("_", $id_ses);
        $cinemaHalls = CinemaHall::all();
        for ($i = 0; $i < count($cinemaHalls); $i++) {
            $cinemaHalls[$i]['number_of_seats'] = json_decode($cinemaHalls[$i]['number_of_seats'], true);
        }

        $hallBuySpot = HallBuy::all();
        $cloneAr = [];
        for ($i = 0; $i < count($hallBuySpot); $i++) {
            $cloneAr[] = $hallBuySpot[$i]['json_data'];
        }

        for ($i = 0; $i < count($cloneAr); $i++) {
            $ardecode[] = json_decode($cloneAr[$i], true);
        }

        $filteredArray = [];
        
        if (!empty($ardecode)) {
            foreach ($ardecode as $key => $value) {
                if ($value['idHall'] == $arrayIdAndTime[2]) {
                    $filteredArray[] = $value;
                }
            }
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
        
        return view('client.hall', ['hallBuySpot' => $filteredArray ,'cinemaHalls' => $cinemaHalls,'cinema_all' => $cinema_all, 'id_ses' => $arrayIdAndTime[0], 'timeToDay' => $arrayIdAndTime[1], 'holl_id_now' => $arrayIdAndTime[2], 'sessions' => $newArraySessions, 'tickets' => $tickets]);
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
        $hallBuy = new HallBuy;
        $check = $request->all();
        $check = json_encode($check);
        $hallBuy->json_data = $check; // Преобразуйте данные в JSON
        $hallBuy->save();
        return $hallBuy->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HallBuy  $hallBuy
     * @return \Illuminate\Http\Response
     */
    public function show(HallBuy $hallBuy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HallBuy  $hallBuy
     * @return \Illuminate\Http\Response
     */
    public function edit(HallBuy $hallBuy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HallBuy  $hallBuy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HallBuy $hallBuy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HallBuy  $hallBuy
     * @return \Illuminate\Http\Response
     */
    public function destroy(HallBuy $hallBuy)
    {
        //
    }
}
