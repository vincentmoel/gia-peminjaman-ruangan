<?php

namespace App\Http\Controllers;

use App\Services\DivisionServices;
use App\Services\RentServices;
use App\Services\RoomServices;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->rentServices = new RentServices();
        $this->roomServices = new RoomServices();
        $this->divisionServices = new DivisionServices();
    }

    public function index()
    {
        $rents_active = $this->rentServices->getActiveSchedule();
        $rooms = $this->roomServices->getAll();
        $divisions = $this->divisionServices->getAll();
        return view('index',[
            'rents_active'  => $rents_active,
            'rooms'         => $rooms,
            'divisions'     => $divisions
        ]);
    }


    public function date()
    {
        return date('H:i:s');
    }


}
