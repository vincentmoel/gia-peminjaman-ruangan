<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $guarded = ['id'];

    protected $with = ['division','room'];


    public function division()
    {
        return $this->belongsTo(Division::class,'division_id')->withTrashed();
    }

    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');

    }

}
