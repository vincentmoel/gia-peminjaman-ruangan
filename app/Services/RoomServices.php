<?php

namespace App\Services;

use App\Models\Room;

class RoomServices{


    public function getAll()
    {
        return Room::get();
    }


}