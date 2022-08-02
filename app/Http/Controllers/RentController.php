<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Rent;
use App\Services\DivisionServices;
use App\Services\RentServices;
use App\Services\RoomServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentController extends Controller
{
    public function __construct()
    {
        $this->rentServices = new RentServices();
        $this->roomServices = new RoomServices();
        $this->divisionServices = new DivisionServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rents = $this->rentServices->getAll();
        $rooms = $this->roomServices->getAll();
        $divisions = $this->divisionServices->getAll();
        return view('rent.index', [
            'rents'     => $rents,
            'rooms'     => $rooms,
            'divisions' => $divisions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRentRequest $request)
    {
        $isAvailable = $this->rentServices->isAvailable($request->from_date,$request->until_date,$request->room_id);
        if($isAvailable == 'available')
        {
            return "a";
            $this->rentServices->saveData($request);
            return redirect('/rents')->with('success', 'Success Save Data');
        }
        else
        {
            return "b";
            $room = $this->roomServices->getRoomById($request->room_id);
            return redirect('/rents')->with([
                'error' => "Error : ".$room->name." Collision of dates",
                'data'  => $isAvailable
            ])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function edit(Rent $rent)
    {
        
        $rooms = $this->roomServices->getAll();
        $divisions = $this->divisionServices->getAll();
        return view('rent.edit',[
            'rent'      => $rent,
            'rooms'        => $rooms,
            'divisions' => $divisions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRentRequest $request, Rent $rent)
    {

        $isAvailable = $this->rentServices->isAvailable($request->from_date,$request->until_date,$request->room_id,$rent->id);
        if($isAvailable == 'available')
        {
            $this->rentServices->updateData($request,$rent);
            return redirect('/rents')->with('success', 'Success Save Data');
        }
        else
        {
            $room = $this->roomServices->getRoomById($request->room_id);
            return redirect("/rents/$rent->id/edit")->with([
                'error' => "Error : ".$room->name." Collision of dates",
                'data'  => $isAvailable
            ])->withInput();
        }

    }

    public function schedules()
    {
        $rents_active = $this->rentServices->getActiveSchedule();
        $rooms = $this->roomServices->getAll();
        $divisions = $this->divisionServices->getAll();
        return view('rent.schedules',[
            'rents_active'  => $rents_active,
            'rooms'         => $rooms,
            'divisions'     => $divisions
        ]);
    }

    public function schedules_refresh()
    {
        $rents_active = $this->rentServices->getActiveSchedule();
        $rooms = $this->roomServices->getAll();
        $divisions = $this->divisionServices->getAll();
        return view('rent.schedules_data_ajax',[
            'rents_active'  => $rents_active,
            'rooms'         => $rooms,
            'divisions'     => $divisions
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        $this->rentServices->deleteData($rent);
        return redirect('/rents')->with('success' , 'Success Delete Data');

    }

    public function checkAvailabilitySchedule(Request $request)
    {
        $request->validate([
            "room_id"       => 'required',
            'from_date'     => 'required|before:until_date',
            'until_date'    => 'required|after:from_date'
        ]);

        $isAvailable = $this->rentServices->isAvailable($request->from_date,$request->until_date,$request->room_id);
        
        if($isAvailable == 'available')
        {
            $response = [
                "code"      => "200",
                "status"    => "success",
                "message"   => "Room is available",
                "data"      => "available"
            ];
        }
        else
        {
            // return "asd"
            // return (String) view('rent.alert_collide',[
            //     'data'  => $isAvailable
            // ])->render();
            // return (String) view('rent.alert_collide',[
            //     "data" => $isAvailable
            // ]);
            $response = [
                "code"      => "422",
                "status"    => "error",
                "message"   => "Room is not available",
                "data"      =>  view('rent.alert_collide',[
                                    'datas'  => $isAvailable
                                ])->render()
            ];
        }

        return response()->json($response);

    }

    
}
