<?php

namespace App\Services;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;

class RoomServices{


    public function getAll()
    {
        return Room::get();
    }

    public function saveData(StoreRoomRequest $request)
    {
        $room = Room::create([
            "code"          => $request->code,
            "department_id" => $request->department_id,
            "name"          => $request->name,
            "floor"         => $request->floor,
        ]);
        return $room ? true : false;
    }

    public function deleteData(Room $room)
    {
        $room->delete();
    }

    public function updateData(UpdateRoomRequest $request, Room $room)
    {
        $room = Room::where('id',$room->id)->update([
            'code'          => $request->code,
            'name'          => $request->name,
            'floor'         => $request->floor,
            'department_id' => $request->department_id,
        ]);

        return $room ? true : false;

    }


}