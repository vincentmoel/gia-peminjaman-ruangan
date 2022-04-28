<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use App\Services\DepartmentServices;
use App\Services\RoomServices;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->departmentServices = new DepartmentServices();
        $this->roomServices = new RoomServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = $this->roomServices->getAll();
        $departments = $this->departmentServices->getAll();
        return view('room.index',[
            "rooms"         => $rooms,
            "departments"   => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        $this->roomServices->saveData($request);
        return redirect('/rooms')->with('success', 'Success Save Data');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $departments = $this->departmentServices->getAll();

        return view('room.edit',[
            'room'          => $room,
            'departments'   => $departments

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $this->roomServices->updateData($request,$room);
        return redirect('/rooms')->with('success', 'Success Update Data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $this->roomServices->deleteData($room);
        return redirect('/rooms')->with('success', 'Success Delete Data');
    }
}
