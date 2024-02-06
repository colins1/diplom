<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HallBuy;
use App\Models\CinemaHall;
use App\Models\Films;
use App\Models\Session;
use App\Models\Tickets;
use Illuminate\Support\Arr;

class PaymentController extends Controller
{
    public function index($id)
    {

        $hallBuySpot = HallBuy::find($id);
        $cloneAr = $hallBuySpot['json_data'];

        $ardecode = json_decode($cloneAr, true);

        $session = Session::find($ardecode['id_ses']);

        $hall = CinemaHall::find($ardecode['idHall']);

        $spotsAll = implode(',', array_column($ardecode['data_row_spot'], 1));

        $allInfo = [$ardecode['nameMov'], $spotsAll, $hall['name'], $session['show_time'], $ardecode['priceText']];

        return view('client.payment', ['allInfo' => $allInfo ]);
    }
}
