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

        foreach ($ardecode as $key => $value) {
            if ($value['idHall'] == $arrayIdAndTime[2]) {
                $filteredArray = $value;
            }else {
                $filteredArray = 0;
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
    public function store(Request $data)
    {
        $hallBuy = new HallBuy;
        $clone = array_values((array)$data);
        $hallBuy->json_data = $clone[11]; // Преобразуйте данные в JSON
        $hallBuy->save();
        
        /*
        $hall = HallBuy::find($id);
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
        return 'New Spot';*/
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
