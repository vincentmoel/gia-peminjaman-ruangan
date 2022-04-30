<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Rent;
use App\Services\DivisionServices;
use App\Services\RentServices;
use App\Services\RoomServices;
use Illuminate\Http\Request;

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
    public function store(StoreRentRequest $request)
    {
        $isAvailable = $this->rentServices->isAvailable($request->from_date,$request->until_date,$request->room_id);
        if($isAvailable == 'available')
        {
            $this->rentServices->saveData($request);
            return redirect('/')->with('success', 'Success Save Data');
        }
        else
        {
            $room = $this->roomServices->getRoomById($request->room_id);
            return redirect('/')->with([
                'error' => "Error : ".$room->name." Collision of dates",
                'data'  => $isAvailable
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        //
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

        $isAvailable = $this->rentServices->isAvailable($request->from_date,$request->until_date,$request->room_id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rent  $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        $this->rentServices->deleteData($rent);
        return redirect('/')->with('success' , 'Success Delete Data');

    }

    
}
